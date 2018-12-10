<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}

class pjAdminUsers extends pjAdmin
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
			$pjUserModel = pjUserModel::factory()->where('t1.email', $_GET['email']);
			if (isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				$pjUserModel->where('t1.id !=', $_GET['id']);
			}
			echo $pjUserModel->findCount()->getData() == 0 ? 'true' : 'false';
		}
		exit;
	}
	
	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			if (isset($_POST['user_create']))
			{
				$pjUserModel = pjUserModel::factory();
				if (!$pjUserModel->validates($_POST))
				{
					pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminUsers&action=pjActionIndex&err=AU04");
				}
				$data = array();
				$data['is_active'] = 'T';
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				$id = $pjUserModel->setAttributes(array_merge($_POST, $data))->insert()->getInsertId();
				if ($id !== false && (int) $id > 0)
				{
					$pjUserNotification = pjUserNotificationModel::factory();
					if (isset($_POST['notify_email']) && is_array($_POST['notify_email']) && count($_POST['notify_email']) > 0)
					{
						$pjUserNotification->begin();
						foreach ($_POST['notify_email'] as $notification_id)
						{
							$pjUserNotification
								->reset()
								->set('user_id', $id)
								->set('notification_id', $notification_id)
								->set('type', 'email')
								->insert();
						}
						$pjUserNotification->commit();
					}
					if (isset($_POST['notify_sms']) && is_array($_POST['notify_sms']) && count($_POST['notify_sms']) > 0)
					{
						$pjUserNotification->begin();
						foreach ($_POST['notify_sms'] as $notification_id)
						{
							$pjUserNotification
								->reset()
								->set('user_id', $id)
								->set('notification_id', $notification_id)
								->set('type', 'sms')
								->insert();
						}
						$pjUserNotification->commit();
					}
					$err = 'AU03';
					if (isset($_POST['i18n']))
					{
						pjMultiLangModel::factory()->saveMultiLang($_POST['i18n'], $id, 'pjUser');
					}
				} else {
					$err = 'AU04';
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminUsers&action=pjActionIndex&err=$err");
			} else {
				
				$this->set('role_arr', pjRoleModel::factory()->orderBy('t1.id ASC')->findAll()->getData());
		
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('jquery.multilang.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendJs('jquery.tipsy.js', PJ_THIRD_PARTY_PATH . 'tipsy/');
				$this->appendCss('jquery.tipsy.css', PJ_THIRD_PARTY_PATH . 'tipsy/');
				$this->appendJs('pjAdminUsers.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteUser()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			if ($_GET['id'] != $this->getUserId())
			{
				if (pjUserModel::factory()->set('id', $_GET['id'])->erase()->getAffectedRows() == 1)
				{
					pjMultiLangModel::factory()->where('model', 'pjUser')->where('foreign_id', $_GET['id'])->eraseAll();
					$response['code'] = 200;
				} else {
					$response['code'] = 100;
				}
			} else {
				$response['code'] = 101;
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteUserBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjUserModel::factory()
					->where('id !=', $this->getUserId())
					->whereIn('id', $_POST['record'])->eraseAll();
				pjMultiLangModel::factory()->where('model', 'pjUser')->whereIn('foreign_id', $_POST['record'])->eraseAll();
			}
		}
		exit;
	}
	
	public function pjActionExportUser()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjUserModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Users-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionGetUser()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjUserModel = pjUserModel::factory();
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				$pjUserModel->where('t1.email LIKE', "%$q%");
				$pjUserModel->orWhere('t1.name LIKE', "%$q%");
			}

			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F')))
			{
				$pjUserModel->where('t1.status', $_GET['status']);
			}
				
			$column = 'name';
			$direction = 'ASC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}

			$total = $pjUserModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}

			$data = $pjUserModel->select('t1.id, t1.email, t1.name, t1.created, t1.status, t1.is_active, t1.role_id, t2.role')
				->join('pjRole', 't2.id=t1.role_id', 'left')
				->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();
			foreach($data as $k => $v)
			{
				$v['created'] = date($this->option_arr['o_date_format'], strtotime($v['created'])) . ', ' . date($this->option_arr['o_time_format'], strtotime($v['created']));
				$data[$k] = $v;
			}
			$data = pjSanitize::clean($data);
			pjAppController::jsonResponse(compact('data', 'total', 'pages', 'page', 'rowCount', 'column', 'direction'));
		}
		exit;
	}
	
	public function pjActionIndex()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			$this->appendJs('jquery.datagrid.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
			$this->appendJs('pjAdminUsers.js');
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
			$pjUserModel = pjUserModel::factory();
			
			$arr = $pjUserModel->find($_POST['id'])->getData();
			
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
				$pjUserModel->reset()->setAttributes(array('id' => $_POST['id']))->modify(array('is_active' => $sql_status));
			}
		}
		exit;
	}
	
	public function pjActionSaveUser()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjUserModel = pjUserModel::factory();
			if (!in_array($_POST['column'], $pjUserModel->getI18n()))
			{
				$pass = true;
				if ((int) $_GET['id'] === 1 && in_array($_POST['column'], array('role_id', 'status', 'is_active')))
				{
					$pass = false;
				}
				if ($pass)
				{
					$pjUserModel->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
				}
			} else {
				pjMultiLangModel::factory()->updateMultiLang(array($this->getLocaleId() => array($_POST['column'] => $_POST['value'])), $_GET['id'], 'pjUser');
			}
		}
		exit;
	}
	
	public function pjActionStatusUser()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjUserModel::factory()->whereIn('id', $_POST['record'])->where('id <>', 1)->modifyAll(array(
					'status' => ":IF(`status`='F','T','F')"
				));
			}
		}
		exit;
	}
	
	public function pjActionGetNotifications()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				$type = $_GET['name'] == 'notify_email' ? 'email' : 'sms';
				$this->set('arr', pjUserNotificationModel::factory()
					->where('t1.user_id', $_GET['id'])
					->where('t1.type', $type)
					->findAll()
					->getDataPair('id', 'notification_id')
				);
			}
		}
	}
	
	public function pjActionUpdate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			if (isset($_POST['user_update']))
			{
				$pjUserModel = pjUserModel::factory();
				
				$pjUserModel->where('id', $_POST['id'])->limit(1)->modifyAll($_POST);
				
				$pjUserNotification = pjUserNotificationModel::factory();
				$pjUserNotification->where('user_id', $_POST['id'])->eraseAll();
				if (isset($_POST['notify_email']) && is_array($_POST['notify_email']) && count($_POST['notify_email']) > 0)
				{
					$pjUserNotification->begin();
					foreach ($_POST['notify_email'] as $notification_id)
					{
						$pjUserNotification
							->reset()
							->set('user_id', $_POST['id'])
							->set('notification_id', $notification_id)
							->set('type', 'email')
							->insert();
					}
					$pjUserNotification->commit();
				}
				if (isset($_POST['notify_sms']) && is_array($_POST['notify_sms']) && count($_POST['notify_sms']) > 0)
				{
					$pjUserNotification->begin();
					foreach ($_POST['notify_sms'] as $notification_id)
					{
						$pjUserNotification
							->reset()
							->set('user_id', $_POST['id'])
							->set('notification_id', $notification_id)
							->set('type', 'sms')
							->insert();
					}
					$pjUserNotification->commit();
				}				
				if (isset($_POST['i18n']))
				{
					pjMultiLangModel::factory()->updateMultiLang($_POST['i18n'], $_POST['id'], 'pjUser');
				}
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminUsers&action=pjActionIndex&err=AU01");
				
			} else {
				$arr = pjUserModel::factory()->find($_GET['id'])->getData();
				if (count($arr) === 0)
				{
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminUsers&action=pjActionIndex&err=AU08");
				}
				
				$this->set('arr', $arr);
				
				$this->set('role_arr', pjRoleModel::factory()->orderBy('t1.id ASC')->findAll()->getData());
				
				$pjUserNotification = pjUserNotificationModel::factory();
				$this->set('email_arr', $pjUserNotification->reset()->where('t1.user_id', $arr['id'])->where('t1.type', 'email')->findAll()->getDataPair('id', 'notification_id'));
				$this->set('sms_arr', $pjUserNotification->reset()->where('t1.user_id', $arr['id'])->where('t1.type', 'sms')->findAll()->getDataPair('id', 'notification_id'));
				
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('jquery.multilang.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendJs('jquery.tipsy.js', PJ_THIRD_PARTY_PATH . 'tipsy/');
				$this->appendCss('jquery.tipsy.css', PJ_THIRD_PARTY_PATH . 'tipsy/');
				$this->appendJs('pjAdminUsers.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
}
?>