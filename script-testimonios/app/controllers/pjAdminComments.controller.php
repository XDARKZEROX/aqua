<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjAdminComments extends pjAdmin
{
	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
			$post_max_size = pjUtil::getPostMaxSize();
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER['CONTENT_LENGTH']) && (int) $_SERVER['CONTENT_LENGTH'] > $post_max_size)
			{
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminPosts&action=pjActionIndex&err=AC05");
			}
			if (isset($_POST['comment_create']))
			{
				$data = array();
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				$data['created'] = date('Y-m-d H:i:s');
				
				$pjMemberModel = pjMemberModel::factory();
				
				if($_POST['is_existing'] == 'F'){
					$email = $_POST['email'];
					$member_arr = $pjMemberModel->where("t1.email='$email'")->findAll()->getData();
					if(count($member_arr) > 0)
					{
						$data['member_id'] = $member_arr[0]['id'];
					}else{
						$member_data = array();
						$member_data['name'] = $_POST['name'];
						$member_data['email'] = $_POST['email'];
						$member_data['member_since'] = date('Y-m-d');
						$member_data['password'] = pjToolkit::getRandomPassword();
						$data['member_id'] = $pjMemberModel->reset()->setAttributes($member_data)->insert()->getInsertId();
					}
					unset($_POST['member_id']);
				}
								
				$id = pjCommentModel::factory(array_merge($_POST, $data))->insert()->getInsertId();
				
				if ($id !== false && (int) $id > 0)
				{
					
					if (isset($_FILES['files']))
					{
						$files = array();
						foreach ($_FILES['files'] as $k => $l) {
							foreach ($l as $i => $v) {
						 		if (!array_key_exists($i, $files))
						 		{
						   			$files[$i] = array();
						 		}				   			
						   		$files[$i][$k] = $v;
						 	}
						}
						$has_error = false;
						foreach ($files as $file) 
						{
							if($file['error'] != 4 && $file['error'] != 0)
							{
								$has_error = true;
							}
						}
						if($has_error == false)
						{
							$pjFileModel = pjFileModel::factory();
							foreach ($files as $file) 
							{
								if($file['error'] == 0)
								{
									$data = array();
									$data['comment_id'] = $id;
									
									$handle = new pjUpload();
									if ($handle->load($file))
									{
										$hash = md5(uniqid(rand(), true));
										$file_ext = $handle->getExtension();
										$file_path = PJ_UPLOAD_PATH . 'files/' . $id . "_" . $hash . '.' . $file_ext;
										if($handle->save($file_path))
										{
											$data['file_path'] = $file_path;
											$data['file_name'] = $file['name'];
											$data['mime_type'] = $file['type'];
											$data['hash'] = $hash;
											$data['type'] = 'comment';
										}
										$pjFileModel->reset()->setAttributes($data)->insert();
									}
								}
							}
						}else{
							pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminComments&action=pjActionUpdate&id=".$id."&err=AC09");
						}
					}
					$err = 'AC03';
				} else {
					$err = 'AC04';
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminComments&action=pjActionIndex&err=$err");
			} else {

				$member_arr = pjMemberModel::factory()->orderBy('t1.name ASC')->findAll()->getData();
				$topic_arr = pjTopicModel::factory()->where("t1.status = 'T'")->orderBy('t1.topic ASC')->findAll()->getData();
				
				$this->set('member_arr', pjSanitize::clean($member_arr));
				$this->set('topic_arr', pjSanitize::clean($topic_arr));
				
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
								
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminComments.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteComment()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			if (pjCommentModel::factory()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
			{
				$comment_id = $_GET['id'];
				$pjFileModel = pjFileModel::factory();
				$pjFileModel->where('comment_id', $comment_id);
				$file_arr = $pjFileModel->findAll()->getData();
				foreach($file_arr as $f)
				{
					$file_path = $f['file_path'];
					if (file_exists(PJ_INSTALL_PATH . $file_path)) {
						if(unlink(PJ_INSTALL_PATH . $file_path)){
						}
					}
				}
				$pjFileModel->reset()->where('comment_id', $comment_id)->eraseAll();
				
				$response['code'] = 200;
			} else {
				$response['code'] = 100;
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteCommentBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjCommentModel::factory()->whereIn('id', $_POST['record'])->eraseAll();
				
				$pjFileModel = pjFileModel::factory();
				$pjFileModel->whereIn('comment_id', $_POST['record']);
				$file_arr = $pjFileModel->findAll()->getData();
				foreach($file_arr as $f)
				{
					$file_path = $f['file_path'];
					if (file_exists(PJ_INSTALL_PATH . $file_path)) {
						if(unlink(PJ_INSTALL_PATH . $file_path)){
						}
					}
				}
				$pjFileModel->reset()->whereIn('comment_id', $_POST['record'])->eraseAll();
			}
		}
		exit;
	}
	
	public function pjActionExportComment()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjCommentModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Comments-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionGetComment()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjCommentModel = pjCommentModel::factory();
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				$pjCommentModel->where("(t1.comment_text LIKE '%$q%' OR t1.member_id IN(SELECT t4.id FROM " . pjMemberModel::factory()->getTable() . " AS t4 WHERE t4.name LIKE '%$q%'))");
			}

			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F', 'R')))
			{
				$pjCommentModel->where('t1.status', $_GET['status']);
			}
			if (isset($_GET['member_id']))
			{
				$pjCommentModel->where('t1.member_id', $_GET['member_id']);
			}
			if (isset($_GET['topic_id']))
			{
				$pjCommentModel->where('t1.topic_id', $_GET['topic_id']);
			}
				
			$column = 'id';
			$direction = 'DESC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}
			$total = $pjCommentModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}
			$data = array();
			$arr = $pjCommentModel
				->select("t1.id, t1.status, t2.name AS member, t2.id AS member_id, t3.topic, t3.id AS topic_id, t2.status as member_status,
						(IF(CHAR_LENGTH(t1.comment_text) >= 80, CONCAT(SUBSTRING(t1.comment_text, 1, 80), ' ...'), t1.comment_text)) as comment")
				->join('pjMember', 't2.id=t1.member_id', 'left')
				->join('pjTopic', 't3.id=t1.topic_id', 'left')
				->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();

			foreach($arr as $k => $v)
			{
				$v['comment'] = pjSanitize::clean($v['comment']);
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
			$this->appendJs('pjAdminComments.js');
			$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSaveComment()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjCommentModel = pjCommentModel::factory();
	
			$pjCommentModel->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
			
		}
		exit;
	}
	
	public function pjActionUpdate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
			$post_max_size = pjUtil::getPostMaxSize();
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER['CONTENT_LENGTH']) && (int) $_SERVER['CONTENT_LENGTH'] > $post_max_size)
			{
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminComments&action=pjActionIndex&err=AC06");
			}	
			if (isset($_POST['comment_update']))
			{
				$data = array();
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
								
				pjCommentModel::factory()->where('id', $_POST['id'])->limit(1)->modifyAll(array_merge($_POST, $data));
				
				if (isset($_FILES['files']))
				{
					$files = array();
					foreach ($_FILES['files'] as $k => $l) {
						foreach ($l as $i => $v) {
					 		if (!array_key_exists($i, $files))
					 		{
					   			$files[$i] = array();
					 		}				   			
					   		$files[$i][$k] = $v;
					 	}
					}
					$has_error = false;
					foreach ($files as $file) 
					{
						if($file['error'] != 4 && $file['error'] != 0)
						{
							$has_error = true;
						}
					}
					if($has_error == false)
					{
						$pjFileModel = pjFileModel::factory();
						foreach ($files as $file) {
							$data = array();
							$data['comment_id'] = $_POST['id'];
							
							$handle = new pjUpload();
							if ($handle->load($file))
							{
								$hash = md5(uniqid(rand(), true));
								$file_ext = $handle->getExtension();
								$file_path = PJ_UPLOAD_PATH . 'files/' . $_POST['id'] . "_" . $hash . '.' . $file_ext;
								if($handle->save($file_path))
								{
									$data['file_path'] = $file_path;
									$data['file_name'] = $file['name'];
									$data['mime_type'] = $file['type'];
									$data['hash'] = $hash;
									$data['type'] = 'comment';
								}
								$pjFileModel->reset()->setAttributes($data)->insert();
							}
						}
					}else{
						pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminComments&action=pjActionUpdate&id=".$_POST['id']."&err=AC10");
					}
				}
				
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminComments&action=pjActionIndex&err=AC01");
				
			} else {
				
				$pjFileModel = pjFileModel::factory();
				$pjCommentModel = pjCommentModel::factory();
				
				$arr = $pjCommentModel
					->select('t1.*, t2.page_url')
					->join('pjTopic', 't1.topic_id = t2.id', 'left')
					->find($_GET['id'])
					->getData();
				if (count($arr) === 0)
				{
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminComments&action=pjActionIndex&err=AC08");
				}
								
				$member_arr = pjMemberModel::factory()->orderBy('t1.name ASC')->findAll()->getData();
				$topic_arr = pjTopicModel::factory()->where("t1.status = 'T'")->orderBy('t1.topic ASC')->findAll()->getData();
				$comment_file_arr = pjFileModel::factory()->where("comment_id=".$_GET['id'])->findAll()->getData();
				
				$this->set('arr', $arr);
				$this->set('topic_arr', pjSanitize::clean($topic_arr));
				$this->set('member_arr', pjSanitize::clean($member_arr));
				$this->set('comment_file_arr', $comment_file_arr);
								
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
								
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminComments.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionFeed()
	{
		$this->checkLogin();
	
		if ($this->isAdmin()|| $this->isEditor())
		{
			if(isset($_POST['comment_feed']))
			{
				$pjPasswordModel = pjPasswordModel::factory();
				$password = md5($_POST['password'].PJ_SALT);
				$arr = $pjPasswordModel
					->where("t1.password", $password)
					->limit(1)
					->findAll()
					->getData();
				if (count($arr) != 1)
				{
					$pjPasswordModel->setAttributes(array('password' => $password))->insert();
				}
				$this->set('password', $password);
			}
	
			$topic_arr = pjTopicModel::factory()
				->where('t1.status', 'T')
				->orderBy("`topic` ASC")
				->findAll()
				->getData();
			
			$this->set('topic_arr', $topic_arr);
			
			$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
			$this->appendJs('pjAdminComments.js');
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionExportFeed()
	{
		$this->setLayout('pjActionEmpty');
		$access = true;
		if(isset($_GET['p']))
		{
			$pjPasswordModel = pjPasswordModel::factory();
			$arr = $pjPasswordModel
				->where('t1.password', $_GET['p'])
				->limit(1)
				->findAll()
				->getData();
			if (count($arr) != 1)
			{
				$access = false;
			}
		}else{
			$access = false;
		}
		if($access == true)
		{
			$arr = $this->pjGetFeedData($_GET);
			
			if(!empty($arr))
			{
				if($_GET['format'] == 'xml')
				{
					$xml = new pjXML();
					echo $xml
						->setEncoding('UTF-8')
						->process($arr)
						->getData();
	
				}
				if($_GET['format'] == 'csv')
				{
					$csv = new pjCSV();
					echo $csv
						->setHeader(true)
						->process($arr)
						->getData();
	
				}
			}
		}else{
			__('lblNoAccessToFeed');
		}
		exit;
	}
	
	public function pjGetFeedData($get)
	{
		$arr = array();
		$status = true;
		$period = '';
		if(isset($get['period']))
		{
			if(!ctype_digit($get['period']))
			{
				$status = false;
			}else{
				$period = $get['period'];
			}
		}else{
			$status = false;
		}
		
		if($status == true && $period != '')
		{
			$pjCommentModel = pjCommentModel::factory();
				
			$column = 'created';
			$direction = 'DESC';
			$where_str = pjUtil::getWhereClause($period, 1);
			if($where_str != '')
			{
				$pjCommentModel->where($where_str);
			}
			if(isset($get['topic_id']))
			{
				$pjCommentModel->where('t1.topic_id', $get['topic_id']);
			}
			$arr= $pjCommentModel
				->select('t1.*,t2.name, t3.topic')
				->join('pjMember', "t1.member_id=t2.id", 'left')
				->join('pjTopic', "t1.topic_id=t3.id", 'left')
				->orderBy("$column $direction")
				->findAll()
				->getData();
		}
		return $arr;
	}
	
	public function pjActionDeleteFile()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			
			$pjFileModel = pjFileModel::factory();
			$arr = $pjFileModel->find($_GET['id'])->getData(); 
			
			if(!empty($arr))
			{
				$file_path = $arr['file_path'];
				if (file_exists(PJ_INSTALL_PATH . $file_path)) {
					if(unlink(PJ_INSTALL_PATH . $file_path)){
					}
				}
				
				if ($pjFileModel->reset()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
				{
					$response['code'] = 200;
				}else{
					$response['code'] = 100;
				}
			}else{
				$response['code'] = 100;
			}
			
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDownloadFile()
	{
		$id = $_GET['id'];
		$arr = pjFileModel::factory()->find($id)->getData();
		if(!empty($arr))
		{
			pjToolkit::download(@file_get_contents(PJ_INSTALL_URL . $arr['file_path']), $arr['file_name'], $arr['mime_type']);
			exit;
		}
	}
}
?>