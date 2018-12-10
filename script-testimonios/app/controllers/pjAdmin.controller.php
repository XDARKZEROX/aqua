<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}

class pjAdmin extends pjAppController
{
	public $defaultUser = 'admin_user';
	
	public $requireLogin = true;
	
	public function __construct($requireLogin=null)
	{
		$this->setLayout('pjActionAdmin');
		
		if (!is_null($requireLogin) && is_bool($requireLogin))
		{
			$this->requireLogin = $requireLogin;
		}
		
		if ($this->requireLogin)
		{
			if (!$this->isLoged() && !in_array(@$_GET['action'], array('pjActionLogin', 'pjActionForgot', 'pjActionPreview')))
			{
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionLogin");
			}
		}
	}
	
	public function beforeRender()
	{
		
	}
		
	public function pjActionIndex()
	{
		$this->checkLogin();

		if ($this->isAdmin() || $this->isEditor() || $this->isOwner())
		{
			$pjTopicModel = pjTopicModel::factory();
			$pjCommentModel = pjCommentModel::factory();
			$pjMemberModel = pjMemberModel::factory();
			
			$num_of_topics = $pjTopicModel->findCount()->getData();
			$num_of_comments = $pjCommentModel->findCount()->getData();
			$num_of_members = $pjMemberModel->findCount()->getData();
						
			$popular_topics = $pjTopicModel
				->reset()
				->select('t1.*, (SELECT COUNT(*) FROM `'.$pjCommentModel->getTable().'` as t2 WHERE t2.topic_id = t1.id) as cnt_comments, 
								(SELECT t3.created FROM `'.$pjCommentModel->getTable().'` as t3 WHERE t3.topic_id=t1.id ORDER BY t3.created DESC LIMIT 0,1 ) as last_time')
				->orderBy("cnt_comments DESC")
				->limit(3, 0)
				->findAll()
				->getData();
			$latest_comments = $pjCommentModel
				->reset()
				->select("t1.*, t2.name AS member, t2.id AS member_id, t3.topic, t3.id AS topic_id")
				->join('pjMember', 't2.id=t1.member_id', 'left')
				->join('pjTopic', 't3.id=t1.topic_id', 'left')
				->orderBy("t1.created DESC")
				->limit(3, 0)
				->findAll()
				->getData();
			$top_members = $pjMemberModel
				->reset()
				->select('t1.*, (SELECT COUNT(*) FROM `'.$pjCommentModel->getTable().'` as t2 WHERE t2.member_id = t1.id) as cnt_comments, 
								(SELECT t3.created FROM `'.$pjCommentModel->getTable().'` as t3 WHERE t3.member_id=t1.id ORDER BY t3.created DESC LIMIT 0,1 ) as last_time')
				->orderBy("cnt_comments DESC")
				->limit(2, 0)
				->findAll()
				->getData();
			
			$this->set('num_of_topics', $num_of_topics);
			$this->set('num_of_comments', $num_of_comments);
			$this->set('num_of_members', $num_of_members);
			$this->set('popular_topics', $popular_topics);
			$this->set('latest_comments', $latest_comments);
			$this->set('top_members', $top_members);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionForgot()
	{
		$this->setLayout('pjActionAdminLogin');
		
		if (isset($_POST['forgot_user']))
		{
			if (!isset($_POST['forgot_email']) || !pjValidation::pjActionNotEmpty($_POST['forgot_email']) || !pjValidation::pjActionEmail($_POST['forgot_email']))
			{
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionForgot&err=AA10");
			}
			$pjUserModel = pjUserModel::factory();
			
			$user = $pjUserModel
				->where('t1.email', $_POST['forgot_email'])
				->limit(1)
				->findAll()
				->getData();
				
			if (count($user) != 1)
			{
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionForgot&err=AA10");
			} else {
				$user = $user[0];
				
				$Email = new pjEmail();
				
				$body = str_replace(
					array('{Name}', '{Password}'),
					array($user['name'], $user['password']),
					__('emailForgotBody', true)
				);
				$Email->setTo($user['email']);
				$Email->setFrom($this->getFromEmail());
				$Email->setSubject(__('emailForgotSubject', true));
				
				if ($Email->send($body))
				{
					$err = "AA11";
				} else {
					$err = "AA12";
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionForgot&err=$err");
			}
		} else {
			$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
			$this->appendJs('pjAdmin.js');
		}
	}
	
	public function pjActionMessages()
	{
		$this->setAjax(true);
		header("Content-Type: text/javascript; charset=utf-8");
	}
	
	public function pjActionLogin()
	{
		$this->setLayout('pjActionAdminLogin');
		
		if (isset($_POST['login_user']))
		{
			if (!isset($_POST['login_email']) || !isset($_POST['login_password']) ||
				!pjValidation::pjActionNotEmpty($_POST['login_email']) ||
				!pjValidation::pjActionNotEmpty($_POST['login_password']) ||
				!pjValidation::pjActionEmail($_POST['login_email']))
			{
				// Data not validate
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionLogin&err=4");
			}
			$pjUserModel = pjUserModel::factory();

			$user = $pjUserModel
				->where('t1.email', $_POST['login_email'])
				->where(sprintf("t1.password = AES_ENCRYPT('%s', '%s')", pjObject::escapeString($_POST['login_password']), PJ_SALT))
				->limit(1)
				->findAll()
				->getData();
			
			if (count($user) != 1)
			{
				# Login failed
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionLogin&err=1");
			} else {
				$user = $user[0];
				unset($user['password']);
															
				if (!in_array($user['role_id'], array(1,2)))
				{
					# Login denied
					pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionLogin&err=2");
				}
				
				if ($user['role_id'] == 2 && $user['is_active'] == 'F')
				{
					# Login denied
					pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionLogin&err=2");
				}
				
				if ($user['status'] != 'T')
				{
					# Login forbidden
					pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionLogin&err=3");
				}
				
				# Login succeed
				$last_login = date("Y-m-d H:i:s");
    			$_SESSION[$this->defaultUser] = $user;
    			
    			# Update
    			$data = array();
    			$data['last_login'] = $last_login;
    			$pjUserModel->reset()->setAttributes(array('id' => $user['id']))->modify($data);

    			if ($this->isAdmin() || $this->isEditor())
    			{
	    			pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionIndex");
    			}
			}
		} else {
			$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
			$this->appendJs('pjAdmin.js');
		}
	}
	
	public function pjActionLogout()
	{
		if ($this->isLoged())
        {
        	unset($_SESSION[$this->defaultUser]);
        }
       	pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionLogin");
	}
	
	public function pjActionProfile()
	{
		$this->checkLogin();
		
		if ($this->isEditor())
		{
			if (isset($_POST['profile_update']))
			{
				$pjUserModel = pjUserModel::factory();
				
				$arr = $pjUserModel->find($this->getUserId())->getData();
				$data = array();
				$data['role_id'] = $arr['role_id'];
				$data['status'] = $arr['status'];
				$post = array_merge($_POST, $data);
				if (!$pjUserModel->validates($post))
				{
					pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionProfile&err=AA14");
				}
				$pjUserModel->set('id', $this->getUserId())->modify($post);
				
				$pjUserNotification = pjUserNotificationModel::factory();
				$pjUserNotification->where('user_id', $this->getUserId())->eraseAll();
				if (isset($_POST['notify_email']) && is_array($_POST['notify_email']) && count($_POST['notify_email']) > 0)
				{
					$pjUserNotification->begin();
					foreach ($_POST['notify_email'] as $notification_id)
					{
						$pjUserNotification
							->reset()
							->set('user_id', $this->getUserId())
							->set('notification_id', $notification_id)
							->set('type', 'email')
							->insert();
					}
					$pjUserNotification->commit();
				}
				
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdmin&action=pjActionProfile&err=AA13");
			} else {
				$this->set('arr', pjUserModel::factory()->find($this->getUserId())->getData());
				$pjUserNotification = pjUserNotificationModel::factory();
				$this->set('email_arr', $pjUserNotification->reset()->where('t1.user_id', $this->getUserId())->where('t1.type', 'email')->findAll()->getDataPair('id', 'notification_id'));
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('jquery.multiselect.min.js', PJ_THIRD_PARTY_PATH . 'multiselect/');
				$this->appendCss('jquery.multiselect.css', PJ_THIRD_PARTY_PATH . 'multiselect/');
				$this->appendJs('pjAdmin.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
}
?>