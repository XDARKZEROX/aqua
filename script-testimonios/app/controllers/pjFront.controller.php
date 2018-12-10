<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjFront extends pjAppController
{
	public $defaultCaptcha = 'StivaSoftCaptcha';
	
	public $defaultLocale = 'front_locale_id';
	
	public $defaultMember = 'front_member';
	
	public $defaultTopic = 'front_topic_id';
	
	public function __construct()
	{
		$this->setLayout('pjActionFront');
	}

	public function afterFilter()
	{
		$pjCommentModel = pjCommentModel::factory();
			
		$pjCommentModel->where("(t1.status = 'T' OR t1.status = 'R')");
		$pjCommentModel->where("t1.member_id IN(SELECT t4.id FROM `".pjMemberModel::factory()->getTable()."` as t4 WHERE t4.status='T')");
		if ($this->getTopic())
		{
			$topic_arr = pjTopicModel::factory()->find($this->getTopic())->getData();
			if(empty($topic_arr))
			{
				if($_GET['action'] != 'pjActionNoTopic')
				{
					pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionNoTopic&err=0' . (isset($_POST['iframe']) ? '&iframe' : NULL));
				}
			}else{
				if($topic_arr['status'] == 'F' && $_GET['action'] != 'pjActionNoTopic')
				{
					pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionNoTopic&err=1' . (isset($_POST['iframe']) ? '&iframe' : NULL));
				}
			}
			$pjCommentModel->where('t1.topic_id', $this->getTopic());
		}

		$column = 'created';
		if($this->option_arr['o_comment_order'] == 'new_on_top')
		{
			$direction = 'DESC';
		}else{
			$direction = 'ASC';
		}
		$total = $pjCommentModel->findCount()->getData();
		$rowCount = $this->option_arr['o_items_per_page'];
		$pages = ceil($total / $rowCount);
		$page = isset($_GET['pjPage']) && (int) $_GET['pjPage'] > 0 ? intval($_GET['pjPage']) : 1;
		$offset = ((int) $page - 1) * $rowCount;
		if ($page > $pages)
		{
			$page = $pages;
		}
		$comment_arr = $pjCommentModel
			->select("t1.*, t2.name AS member, t2.avatar_path, t3.topic, t3.id AS topic_id")
			->join('pjMember', 't2.id=t1.member_id', 'left')
			->join('pjTopic', 't3.id=t1.topic_id', 'left')
			->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();
		if(!empty($comment_arr))
		{
			$comment_id_str = '';
			foreach($comment_arr as $v){
				$comment_id_str .= $v['id'] . ',' ;
			}
			$comment_id_str = substr($comment_id_str, 0, -1);
			$temp_arr = pjFileModel::factory()->select('t1.*')
						->where("t1.comment_id IN($comment_id_str)")->findAll()->getData();
			$comment_file_arr = array();
			foreach($temp_arr as $v)
			{
				$comment_file_arr[$v['comment_id']][] = $v;
			}
			$this->set('comment_file_arr', $comment_file_arr);
		}
		$theme = $this->getTheme();
		if($theme == false)
		{
			$theme = $this->option_arr['o_theme'];
		}
		$this->set('comment_arr', $comment_arr);
		$this->set('paginator', array('pages' => $pages, 'total' => $total));
		$this->set('topic_id', $this->getTopic());
		
		$this->appendCss('pj.bootstrap.min.css', PJ_FRAMEWORK_LIBS_PATH . 'pj/css/');
		$this->appendCss('front.css');
		$this->appendCss($theme.'.css');
	}
	
	public function beforeFilter()
	{
		$OptionModel = pjOptionModel::factory();
		$this->option_arr = $OptionModel->getPairs($this->getForeignId());
		$this->set('option_arr', $this->option_arr);
		$this->setTime();

		if(isset($_GET['topic_id']))
		{
			$topic_id = pjObject::escapeString($_GET['topic_id']);
			if((int) $topic_id > 0)
			{
				$this->setTopic(pjObject::escapeString($_GET['topic_id']));
			}
		}
		if(isset($_GET['theme']))
		{
			$theme = pjObject::escapeString($_GET['theme']);
			if(!empty($theme))
			{
				$this->setTheme($theme);
			}
		}else{
			if(!isset($_SESSION[$this->defaultTheme]))
			{
				$this->setTheme($this->option_arr['o_theme']);
			}
		}
		
		if (!isset($_SESSION[$this->defaultLocale]))
		{
			$locale_arr = pjLocaleModel::factory()->where('is_default', 1)->limit(1)->findAll()->getData();
			if (count($locale_arr) === 1)
			{
				$this->setLocaleId($locale_arr[0]['id']);
			}
		}
		$this->loadSetFields();
	}
	
	public function beforeRender()
	{
		if (isset($_GET['iframe']))
		{
			$this->setLayout('pjActionIframe');
		}
	}
	
	public function pjActionCaptcha()
	{
		$this->setAjax(true);
		
		$Captcha = new pjCaptcha('app/web/obj/Anorexia.ttf', $this->defaultCaptcha, 6);
		$Captcha->setImage('app/web/img/button.png')->init(isset($_GET['rand']) ? $_GET['rand'] : null);
	}


	public function pjActionCheckCaptcha()
	{
		$this->setAjax(true);
		
		$verification = $_GET['verification'];
				
		if (!isset($_GET['verification']) || empty($_GET['verification']) || strtoupper($_GET['verification']) != $_SESSION[$this->defaultCaptcha]){
			echo 101;
		}else{
			echo 100;
		}
	}
	
	public function pjActionSetLocale()
	{
		$this->setLocaleId(@$_GET['locale']);
		pjUtil::redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function pjActionDownloadFile()
	{
		$id = pjObject::escapeString($_GET['id']);
		$arr = pjFileModel::factory()->find($id)->getData();
		if(!empty($arr))
		{
			if($arr['hash'] == $_GET['hash'])
			{
				pjToolkit::download(file_get_contents(PJ_INSTALL_PATH . $arr['file_path']), $arr['file_name'], $arr['mime_type']);
			}
			exit;
		}
	}
	
	public function checkLogin()
	{
		if (isset($_SESSION[$this->defaultMember]) && count($_SESSION[$this->defaultMember]) > 0)
        {
            return true;
	    }
	    return false;
	}
	
	protected function getReceivedEmail($notification_id)
	{
		$arr = array();
		$pjUserNotificationModel = pjUserNotificationModel::factory()
			->select('t1.type, t2.email, t2.phone')
			->join('pjUser', "t2.id=t1.user_id", 'inner')
			->where('t1.notification_id', $notification_id)->where('`type`', 'email');

		$recipients = $pjUserNotificationModel->findAll()->getData();
		foreach ($recipients as $recipient)
		{
			if (empty($recipient['email']))
			{
				continue;
			}
			$arr[] = $recipient['email'];
		}
		
		return $arr;
	}
	
	protected function getAdminEmail()
	{
		$arr = array();
		$pjUserModel = pjUserModel::factory();
		
		$recipients = $pjUserModel->select('t1.email')->where('t1.role_id', '1')->findAll()->getData();
		foreach ($recipients as $recipient)
		{
			if (empty($recipient['email']))
			{
				continue;
			}
			$arr[] = $recipient['email'];
		}
		return $arr;
	}
	
	protected function getReceivedPhone($notification_id){
		$arr = array();
		$pjUserNotificationModel = pjUserNotificationModel::factory()
			->select('t1.type, t2.email, t2.phone')
			->join('pjUser', "t2.id=t1.user_id", 'inner')
			->where('t1.notification_id', $notification_id)->where('`type`', 'sms');

		$recipients = $pjUserNotificationModel->findAll()->getData();
		foreach ($recipients as $recipient)
		{
			if (empty($recipient['phone']))
			{
				continue;
			}
			$arr[] = $recipient['phone'];
		}
		
		return $arr;
	}
	
	protected function sendRegistrationEmail($member_email, $member_name)
	{
		$receiver_arr = $this->getReceivedEmail(1);
		$receiver_arr = array_unique($receiver_arr);
		
		$message = str_replace(array('{Name}', '{Email}'), array($member_name, $member_email), $this->option_arr['o_email_new_member']);
		$subject = $this->option_arr['o_email_new_member_subject'];
		
		$pjEmail = new pjEmail();
		if ($this->option_arr['o_send_email'] == 'smtp')
		{
			$pjEmail
				->setTransport('smtp')
				->setSmtpHost($option_arr['o_smtp_host'])
				->setSmtpPort($option_arr['o_smtp_port'])
				->setSmtpUser($option_arr['o_smtp_user'])
				->setSmtpPass($option_arr['o_smtp_pass'])
			;
		}
		foreach($receiver_arr as $v){
			$pjEmail->setFrom($this->getFromEmail())
					->setTo($v)
					->setSubject($subject)
					->send($message);
		}
	}
	
	protected function sendSMS($notification_id){
		
		$text = '';
		if($notification_id == 1)
		{
			$text = $this->option_arr['o_sms_new_member_registration'];
		}
		if($notification_id == 2)
		{
			$text = $this->option_arr['o_sms_new_comment'];
		}
		if($notification_id == 3)
		{
			$text = $this->option_arr['o_sms_comment_reported'];
		}
		
		$recipients = $this->getReceivedPhone($notification_id);
		
		$smsPlugin = (pjObject::getPlugin('pjSms') !== NULL);
		foreach ($recipients as $recipient)
		{
			if (empty($recipient['phone']) || !$smsPlugin)
			{
				continue;
			}
			$this->requestAction(array(
				'controller' => 'pjSms',
				'action' => 'pjActionSend',
				'params' => array(
					'number' => $recipient['phone'],
					'text' => $text,
					'key' => md5($this->option_arr['private_key'] . PJ_SALT)
				)
			), array('return'));
		}
	}
	
	protected function sendActivationEmail($member_email, $member_name, $id)
	{
		$hash = md5(PJ_SALT . $id);
		$activated_url = PJ_INSTALL_URL.'index.php?controller=pjLoad&action=pjActionActivate&id='.$id.'&hash='.$hash;
		
		$message = str_replace(array('{Name}', '{Email}', '{ActivatedURL}'), array($member_name, $member_email, $activated_url), $this->option_arr['o_email_member_confirmation']);
		$subject = $this->option_arr['o_email_member_confirmation_subject'];
		$pjEmail = new pjEmail();
		if ($this->option_arr['o_send_email'] == 'smtp')
		{
			$pjEmail
				->setTransport('smtp')
				->setSmtpHost($this->option_arr['o_smtp_host'])
				->setSmtpPort($this->option_arr['o_smtp_port'])
				->setSmtpUser($this->option_arr['o_smtp_user'])
				->setSmtpPass($this->option_arr['o_smtp_pass'])
			;
		}
		$pjEmail->setFrom($this->getFromEmail())
				->setTo($member_email)
				->setSubject($subject)
				->send($message);
		
	}
	
	protected function resendActivationURLEmail($member_email, $member_name, $id)
	{
		$hash = md5(PJ_SALT . $id);
		$activated_url = PJ_INSTALL_URL.'index.php?controller=pjLoad&action=pjActionActivate&id='.$id.'&hash='.$hash;
		
		$message = str_replace(array('{Name}', '{Email}', '{ActivatedURL}'), array($member_name, $member_email, $activated_url), $this->option_arr['o_resend_activation_url']);
		$subject = $this->option_arr['o_resend_activation_url_subject'];
		$pjEmail = new pjEmail();
		if ($this->option_arr['o_send_email'] == 'smtp')
		{
			$pjEmail
				->setTransport('smtp')
				->setSmtpHost($this->option_arr['o_smtp_host'])
				->setSmtpPort($this->option_arr['o_smtp_port'])
				->setSmtpUser($this->option_arr['o_smtp_user'])
				->setSmtpPass($this->option_arr['o_smtp_pass'])
			;
		}
		$pjEmail->setFrom($this->getFromEmail())
				->setTo($member_email)
				->setSubject($subject)
				->send($message);
		
	}
	
	protected function sendCommentEmail($member_email, $comment_id)
	{
		$receiver_arr = $this->getReceivedEmail(2);
		$receiver_arr = array_unique($receiver_arr);
		
		$pjCommentModel = pjCommentModel::factory();
		
		$arr = $pjCommentModel->select("t1.*, t2.topic, t2.id AS topic_id")
				->join('pjTopic', 't2.id=t1.topic_id', 'left')
				->find($comment_id)->getData();
		
		$edit_comment_url = PJ_INSTALL_URL . 'index.php?controller=pjAdminComments&action=pjActionUpdate&id=' . $comment_id;
		$topic_name = $arr['topic'];
		$comment_message = $arr['comment_text'];
		
		$message = str_replace(array('{CommentID}', '{ThreadReferenceId}', '{CommentMessage}', '{EditCommentURL}'), array($comment_id, $topic_name, $comment_message, $edit_comment_url), $this->option_arr['o_email_new_comment']);
		$subject = $this->option_arr['o_email_new_comment_subject'];
		
		$pjEmail = new pjEmail();
		
		if ($this->option_arr['o_send_email'] == 'smtp')
		{
			$pjEmail
				->setTransport('smtp')
				->setSmtpHost($this->option_arr['o_smtp_host'])
				->setSmtpPort($this->option_arr['o_smtp_port'])
				->setSmtpUser($this->option_arr['o_smtp_user'])
				->setSmtpPass($this->option_arr['o_smtp_pass'])
			;
		}
		
		foreach($receiver_arr as $v){
			
			$pjEmail->setFrom($this->getFromEmail())
					->setTo($v)
					->setSubject($subject)
					->send($message);
		}
	}
	
	protected function sendReportEmail($comment_id){
		$receiver_arr = $this->getReceivedEmail(3);
		$receiver_arr = array_unique($receiver_arr);
		
		$pjCommentModel = pjCommentModel::factory();
		
		$arr = $pjCommentModel->select("t1.*, t2.topic, t2.id AS topic_id")
				->join('pjTopic', 't2.id=t1.topic_id', 'left')
				->find($comment_id)->getData();
		
		$edit_comment_url = PJ_INSTALL_URL . 'index.php?controller=pjAdminComments&action=pjActionUpdate&id=' . $comment_id;
		$topic_name = $arr['topic'];
		$comment_message = $arr['comment_text'];
		
		$message = str_replace(array('{CommentID}', '{ThreadReferenceId}', '{CommentMessage}', '{EditCommentURL}'), array($comment_id, $topic_name, $comment_message, $edit_comment_url), $this->option_arr['o_email_report']);
		$subject = $this->option_arr['o_email_report_subject'];
		
		$pjEmail = new pjEmail();
		if ($this->option_arr['o_send_email'] == 'smtp' && 
			$this->option_arr['o_smtp_host'] != '' && 
			$this->option_arr['o_smtp_port'] != '' &&
			$this->option_arr['o_smtp_user'] != '' &&
			$this->option_arr['o_smtp_pass'] != '')
		{
			$pjEmail
				->setTransport('smtp')
				->setSmtpHost($this->option_arr['o_smtp_host'])
				->setSmtpPort($this->option_arr['o_smtp_port'])
				->setSmtpUser($this->option_arr['o_smtp_user'])
				->setSmtpPass($this->option_arr['o_smtp_pass'])
			;
		}
		foreach($receiver_arr as $v){
			$pjEmail->setFrom($this->getFromEmail())
					->setTo($v)
					->setSubject($subject)
					->send($message);
		}
	}
	
	protected function sendNewReplyEmail($member_email, $comment_id)
	{
		$topic_id = $this->getTopic();
		
		$pjCommentModel = pjCommentModel::factory();

		$member_arr = $pjCommentModel->select('DISTINCT t2.email, t2.id')->join('pjMember', "t1.member_id=t2.id", 'inner')
						->where('t1.topic_id', $topic_id)
						->where('t1.subscribed', '1')->findAll()->getData();
		
		$arr = $pjCommentModel
			->reset()
			->select("t1.*, t2.topic, t2.page_url")
			->join('pjTopic', 't2.id=t1.topic_id', 'left')
			->find($comment_id)->getData();
		
		$view_comment_url = $arr['page_url'];
		$topic_name = $arr['topic'];
		$comment_message = $arr['comment_text'];
		
		$message = str_replace(array('{CommentID}', '{ThreadReferenceId}', '{CommentMessage}', '{ViewCommentURL}'), array($comment_id, $topic_name, $comment_message, $view_comment_url), $this->option_arr['o_email_new_reply']);
		$subject = str_replace(array('{ThreadReferenceId}'), array($topic_name), $this->option_arr['o_email_new_reply_subject']);
		
		$pjEmail = new pjEmail();
		if ($this->option_arr['o_send_email'] == 'smtp' && 
			$this->option_arr['o_smtp_host'] != '' && 
			$this->option_arr['o_smtp_port'] != '' &&
			$this->option_arr['o_smtp_user'] != '' &&
			$this->option_arr['o_smtp_pass'] != '')
		{
			$pjEmail
				->setTransport('smtp')
				->setSmtpHost($this->option_arr['o_smtp_host'])
				->setSmtpPort($this->option_arr['o_smtp_port'])
				->setSmtpUser($this->option_arr['o_smtp_user'])
				->setSmtpPass($this->option_arr['o_smtp_pass'])
			;
		}
		
		foreach($member_arr as $v)
		{
			if(empty($v['email']))
			{
				continue;
			}
			
			$hash = md5($v['id']);
			$unsubscribe_url = PJ_INSTALL_URL . 'index.php?controller=pjLoad&action=pjActionUnsubscribe&topic_id=' . $topic_id . '&member_id=' . $v['id'] . '&hash=' . $hash;
			$body = $message . "\r\n" . __('front_label_unsubscribe', true) . ' ' . $unsubscribe_url;
			$pjEmail->setFrom($this->getFromEmail())
					->setTo($v['email'])
					->setSubject($subject)
					->send($body);
			
		}
	}
	
	public function pjActionNoTopic()
	{
		
	}
}
?>