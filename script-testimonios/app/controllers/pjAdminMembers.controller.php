<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}

class pjAdminMembers extends pjAdmin
{
	public function pjActionCheckEmail()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (!isset($_GET['email']) || empty($_GET['email']))
			{
				echo 'false';
				exit;
			}
			$pjMemberModel = pjMemberModel::factory()->where('t1.email', $_GET['email']);
			if (isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				$pjMemberModel->where('t1.id !=', $_GET['id']);
			}
			echo $pjMemberModel->findCount()->getData() == 0 ? 'true' : 'false';
		}
		exit;
	}

	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
			if (isset($_POST['member_create']))
			{
				$pjMemberModel = pjMemberModel::factory();
				
				$data = array();
				$data['password'] = pjToolkit::getRandomPassword();
				if(!empty($_POST['member_since']))
				{
					$data['member_since'] = pjUtil::formatDate($_POST['member_since'], $this->option_arr['o_date_format']);
				}
				unset($_POST['member_since']);
				$id = $pjMemberModel->setAttributes(array_merge($_POST, $data))->insert()->getInsertId();
				
				if ($id !== false && (int) $id > 0)
				{
					if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name']))
					{
						$Image = new pjImage();
						if ($Image->getErrorCode() !== 200)
						{
							$Image->setAllowedTypes(array('image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'image/pjpeg'));
							if ($Image->load($_FILES['avatar']))
							{
								$resp = $Image->isConvertPossible();
								if ($resp['status'] === true)
								{
									$hash = md5(uniqid(rand(), true));
									$avatar_path = PJ_UPLOAD_PATH . 'avatars/' . $id . '_' . $hash . '.' . $Image->getExtension();
									
									$Image->loadImage();
									$Image->resizeSmart(60, 60);
									$Image->saveImage($avatar_path);
									$d['avatar_path'] = $avatar_path;
									$d['avatar_name'] = $_FILES['avatar']['name'];
									$d['mime_type'] = $_FILES['avatar']['type'];
									$d['hash'] = $hash;
									
									$pjMemberModel->reset()->where('id', $id)->limit(1)->modifyAll($d);
									
								}
							}
						}
					}
					$err = 'AM03';
				} else {
					$err = 'AM04';
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminMembers&action=pjActionIndex&err=$err");
			} else {
				
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminMembers.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteMember()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjMemberModel = pjMemberModel::factory();
			$pjCommentModel = pjCommentModel::factory();
			$pjFileModel = pjFileModel::factory();
			
			$response = array();
			$arr = $pjMemberModel->find($_GET['id'])->getData();
			if ($pjMemberModel->reset()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
			{
				$avatar_path = $arr['avatar_path'];
				if (file_exists(PJ_INSTALL_PATH . $avatar_path)) {
					if(unlink(PJ_INSTALL_PATH . $avatar_path)){
					}
				}
				
				$comment_arr = $pjCommentModel->where('member_id=' . $_GET['id'])->findAll()->getData();
				foreach($comment_arr as $comment)
				{
					$comment_id = $comment['id'];
					if ($pjCommentModel->reset()->setAttributes(array('id' => $comment_id))->erase()->getAffectedRows() == 1)
					{
						$file_arr = $pjFileModel->reset()->where('comment_id=' . $comment_id)->findAll()->getData();
						foreach($file_arr as $file)
						{
							$file_id = $file['id'];
							if ($pjFileModel->reset()->setAttributes(array('id' => $file_id))->erase()->getAffectedRows() == 1)
							{
								$file_path = $file['file_path'];
								if (file_exists(PJ_INSTALL_PATH . $file_path)) {
									if(unlink(PJ_INSTALL_PATH . $file_path)){
									}
								}
							}
						}
					}
				}
				
				$response['code'] = 200;
			} else {
				$response['code'] = 100;
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteMemberBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				$pjMemberModel = pjMemberModel::factory();
				$pjCommentModel = pjCommentModel::factory();
				$pjFileModel = pjFileModel::factory();
			
				$arr = $pjMemberModel->whereIn('id', $_POST['record'])->findAll()->getData();
				foreach($arr as $member)
				{
					$avatar_path = $member['avatar_path'];
					if (file_exists(PJ_INSTALL_PATH . $avatar_path)) {
						if(@unlink(PJ_INSTALL_PATH . $avatar_path)){
						}
					}
					$member_id = $member['id'];
					$comment_arr = $pjCommentModel->where('member_id=' . $member_id)->findAll()->getData();
					
					foreach($comment_arr as $comment)
					{
						$comment_id = $comment['id'];
						if ($pjCommentModel->reset()->setAttributes(array('id' => $comment_id))->erase()->getAffectedRows() == 1)
						{
							$file_arr = $pjFileModel->reset()->where('comment_id=' . $comment_id)->findAll()->getData();
							foreach($file_arr as $file)
							{
								$file_id = $file['id'];
								if ($pjFileModel->reset()->setAttributes(array('id' => $file_id))->erase()->getAffectedRows() == 1)
								{
									$file_path = $file['file_path'];
									if (file_exists(PJ_INSTALL_PATH . $file_path)) {
										if(unlink(PJ_INSTALL_PATH . $file_path)){
										}
									}
								}
							}
						}
					}
					
				}
				$pjMemberModel->reset()->whereIn('id', $_POST['record'])->eraseAll();
			}
		}
		exit;
	}
	
	public function pjActionExportMember()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjMemberModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Members-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionGetMember()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjMemberModel = pjMemberModel::factory();
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				$pjMemberModel->where('t1.email LIKE', "%$q%");
				$pjMemberModel->orWhere('t1.name LIKE', "%$q%");
			}

			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F')))
			{
				$pjMemberModel->where('t1.status', $_GET['status']);
			}
				
			$column = 'name';
			$direction = 'ASC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}

			$total = $pjMemberModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}
			$data = $pjMemberModel
				->select("t1.*, 
						(SELECT COUNT(*) FROM `".pjCommentModel::factory()->getTable()."` AS t2 WHERE t2.member_id = t1.id) as cnt_comments,
						(SELECT t2. created FROM `".pjCommentModel::factory()->getTable()."` AS t2 WHERE t2.member_id = t1.id ORDER BY t2.created ASC LIMIT 1) as first_comment")
				->orderBy("$column $direction")
				->limit($rowCount, $offset)
				->findAll()->getData();
			
			foreach($data as $k => $v)
			{
				$v['first_comment'] = !empty($v['first_comment']) ? date($this->option_arr['o_date_format'], strtotime($v['first_comment'])) : '';
				$data[$k] = $v;
			}
			
			pjAppController::jsonResponse(compact('data', 'total', 'pages', 'page', 'rowCount', 'column', 'direction'));
		}
		exit;
	}
	
	public function pjActionIndex()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
			$this->appendJs('jquery.datagrid.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
			$this->appendJs('pjAdminMembers.js');
			$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSaveMember()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjMemberModel = pjMemberModel::factory();
	
			$pjMemberModel->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
			
		}
		exit;
	}
	
	public function pjActionStatusMember()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjMemberModel::factory()->whereIn('id', $_POST['record'])->modifyAll(array(
					'status' => ":IF(`status`='F','T','F')"
				));
			}
		}
		exit;
	}
	
	public function pjActionUpdate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
				
			if (isset($_POST['member_update']))
			{
				if(!empty($_POST['member_since']))
				{
					$_POST['member_since'] = pjUtil::formatDate($_POST['member_since'], $this->option_arr['o_date_format']);
				}
				$pjMemberModel = pjMemberModel::factory();
				
				$pjMemberModel->where('id', $_POST['id'])->limit(1)->modifyAll($_POST);
				
				if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name']))
				{
					$arr = $pjMemberModel->reset()->find($_POST['id'])->getData();
					$avatar_path = $arr['avatar_path'];
					if (file_exists(PJ_INSTALL_PATH . $avatar_path) && !empty($avatar_path)) {
						if(unlink(PJ_INSTALL_PATH . $avatar_path)){
						}
					}
					
					$Image = new pjImage();
					if ($Image->getErrorCode() !== 200)
					{
						$Image->setAllowedTypes(array('image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'image/pjpeg'));
						if ($Image->load($_FILES['avatar']))
						{
							$resp = $Image->isConvertPossible();
							if ($resp['status'] === true)
							{
								$hash = md5(uniqid(rand(), true));
								$avatar_path = PJ_UPLOAD_PATH . 'avatars/' . $_POST['id'] . '_' . $hash . '.' . $Image->getExtension();
								
								$Image->loadImage();
								$Image->resizeSmart(60, 60);
								$Image->saveImage($avatar_path);
								$d['avatar_path'] = $avatar_path;
								$d['avatar_name'] = $_FILES['avatar']['name'];
								$d['mime_type'] = $_FILES['avatar']['type'];
								$d['hash'] = $hash;
								
								$pjMemberModel->reset()->where('id', $_POST['id'])->limit(1)->modifyAll($d);
								
							}
						}
					}
				}
				
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminMembers&action=pjActionIndex&err=AM01");
				
			} else {
				$pjMemberModel = pjMemberModel::factory();
				$arr = $pjMemberModel
					->select("t1.*, 
						(SELECT COUNT(*) FROM `".pjCommentModel::factory()->getTable()."` AS t2 WHERE t2.member_id = t1.id) as cnt_comments,
						(SELECT t2. created FROM `".pjCommentModel::factory()->getTable()."` AS t2 WHERE t2.member_id = t1.id ORDER BY t2.created ASC LIMIT 1) as first_comment")
					->find($_GET['id'])
					->getData();
				if (count($arr) === 0)
				{
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminMembers&action=pjActionIndex&err=AM08");
				}
				$this->set('arr', $arr);
								
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminMembers.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteAvatar()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			
			$pjMemberModel = pjMemberModel::factory();
			
			$arr = $pjMemberModel->find($_GET['id'])->getData();
			
			if(!empty($arr))
			{
				$avatar_path = $arr['avatar_path'];
				if (file_exists(PJ_INSTALL_PATH . $avatar_path)) {
					if(unlink(PJ_INSTALL_PATH . $avatar_path)){
					}
				}
				
				$data = array();
				
				$data['mime_type'] = ':NULL';
				$data['avatar_path'] = ':NULL';
				$data['avatar_name'] = ':NULL';
				$data['hash'] = ':NULL';
				$pjMemberModel->reset()->where('id', $_GET['id'])->limit(1)->modifyAll($data);
				
				$response['code'] = 200;
			}else{
				$response['code'] = 100;
			}
			
			pjAppController::jsonResponse($response);
		}
		exit;
	}
}
?>