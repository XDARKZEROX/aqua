<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}

class pjAdminTopics extends pjAdmin
{
	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
			if (isset($_POST['topic_create']))
			{
				$pjTopicModel = pjTopicModel::factory();
				
				$data = array();
				$data['is_active'] = 'T';
				$id = $pjTopicModel->reset()->setAttributes(array_merge($_POST, $data))->insert()->getInsertId();
				if ($id !== false && (int) $id > 0)
				{
					$err = 'AT03';
				} else {
					$err = 'AT04';
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminTopics&action=pjActionIndex&err=$err");
			} else {
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminTopics.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteTopic()
	{
		$this->setAjax(true);
		
		if ($this->isXHR())
		{
			$response = array();
			if ($this->isAdmin())
			{
				$pjTopicModel = pjTopicModel::factory();
				$pjCommentModel = pjCommentModel::factory();
				$pjFileModel = pjFileModel::factory();
				
				if ($pjTopicModel->reset()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
				{
					
					$comment_arr = $pjCommentModel->where('topic_id=' . $_GET['id'])->findAll()->getData();
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
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteTopicBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if ($this->isAdmin())
			{
				if (isset($_POST['record']) && count($_POST['record']) > 0)
				{
					$pjTopicModel = pjTopicModel::factory();
					$pjCommentModel = pjCommentModel::factory();
					$pjFileModel = pjFileModel::factory();
				
					$pjTopicModel->whereIn('id', $_POST['record'])->eraseAll();
						
					$comment_arr = $pjCommentModel->whereIn('topic_id' , $_POST['record'])->findAll()->getData();
					
					foreach($comment_arr as $comment)
					{
						$comment_id = $comment['id'];
						if ($pjCommentModel->reset()->setAttributes(array('id' => $comment_id))->erase()->getAffectedRows() == 1)
						{
							$file_arr = $pjFileModel->where('comment_id=' . $comment_id)->findAll()->getData();
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
			}
		}
		exit;
	}
	
	public function pjActionExportTopic()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjTopicModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Topics-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionExportComments()
	{
		$this->checkLogin();
		
		if (isset($_GET['topic_id']))
		{
			$arr = pjCommentModel::factory()->where('topic_id', $_GET['topic_id'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Comments-of-topic-". $_GET['topic_id'] . '-' .time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	
	public function pjActionGetTopic()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjTopicModel = pjTopicModel::factory();
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				$pjTopicModel->where('t1.topic LIKE', "%$q%");
			}

			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F')))
			{
				$pjTopicModel->where('t1.status', $_GET['status']);
			}
				
			$column = 'topic';
			$direction = 'ASC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}

			$total = $pjTopicModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}

			$data = $pjTopicModel->select('t1.*, (SELECT COUNT(*) FROM `'.pjCommentModel::factory()->getTable().'` as t2 WHERE t2.topic_id = t1.id) as cnt_comments')
				->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();

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
			$this->appendJs('pjAdminTopics.js');
			$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSetActive()
	{
		$this->setAjax(true);

		if ($this->isXHR())
		{
			$pjTopicModel = pjTopicModel::factory();
			
			$arr = $pjTopicModel->find($_POST['id'])->getData();
			
			if (count($arr) > 0)
			{
				switch ($arr['is_active'])
				{
					case 'T':
						$sql_status = 'F';
						break;
					case 'F':
						$sql_status = 'T';
						break;
					default:
						return;
				}
				$pjTopicModel->reset()->setAttributes(array('id' => $_POST['id']))->modify(array('is_active' => $sql_status));
			}
		}
		exit;
	}
	
	public function pjActionSaveTopic()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if($_POST['column'] == 'topic')
			{
				if($_POST['value'] != '')
				{
					pjTopicModel::factory()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
				}
			}else{
				pjTopicModel::factory()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
			}
		}
		exit;
	}
	
	public function pjActionStatusTopic()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjTopicModel::factory()->whereIn('id', $_POST['record'])->modifyAll(array(
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
			$pjTopicModel = pjTopicModel::factory();
			if (isset($_POST['topic_update']))
			{
				$pjTopicModel->where('id', $_POST['id'])->limit(1)->modifyAll($_POST);
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminTopics&action=pjActionIndex&err=AT01");
				
			} else {
				$pjCommentModel = pjCommentModel::factory();
				
				$arr = $pjTopicModel
					->select('t1.*, (SELECT COUNT(*) FROM `'.$pjCommentModel->getTable().'` as t2 WHERE t2.topic_id = t1.id) as cnt_comments,
									(SELECT t3.id FROM `'.$pjCommentModel->getTable().'` as t3 WHERE t3.topic_id = t1.id ORDER BY t3.created DESC LIMIT 1 ) as last_id')
					->find($_GET['id'])
					->getData();
					
				if (count($arr) === 0)
				{
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminTopics&action=pjActionIndex&err=AT08");
				}
				if(!empty($arr['last_id']))
				{
					$last_arr = $pjCommentModel
						->reset()
						->select('t1.*, t2.name')
						->join("pjMember", "t1.member_id=t2.id", 'left')
						->find($arr['last_id'])
						->getData();
					$this->set('last_arr', $last_arr);
				}
				
				$this->set('arr', $arr);
				
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminTopics.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionPreview()
	{
		$this->setAjax(true);
		$this->setLayout('pjAdminEmpty');
	}
}
?>