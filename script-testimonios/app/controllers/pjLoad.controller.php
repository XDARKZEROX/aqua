<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}

class pjLoad extends pjFront
{
	private $isoDatePattern = '/\d{4}-\d{2}-\d{2}/';
	
	public function pjActionIndex()
	{	
		$post_max_size = pjUtil::getPostMaxSize();
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER['CONTENT_LENGTH']) && (int) $_SERVER['CONTENT_LENGTH'] > $post_max_size)
		{
			pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionIndex&err=FPC19' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
		}
		if(isset($_POST['post_comment']))
		{
			set_time_limit(0);
			$err = '';
			
			if (!isset($_POST['comment_text']))
			{
				$err = 'FPC10';
			}
			if (isset($_POST['comment_text']) && !pjValidation::pjActionNotEmpty($_POST['comment_text']))
			{
				$err = 'FPC15';
			}else{
				if($this->pjCheckBannedWords($_POST['comment_text']) == false)
				{
					$err = 'FPC21';
				}
			}
			if (isset($_POST['email']) && pjValidation::pjActionNotEmpty($_POST['email']) && !pjValidation::pjActionEmail($_POST['email']))
			{
				$err = 'FPC17';
			}
			if(!$this->checkLogin())
			{
				if (!isset($_POST['email']))
				{
					$err = 'FPC09';
				}
				if (!isset($_POST['name']))
				{
					$err = 'FPC11';
				}
				if (isset($_POST['email']) && !pjValidation::pjActionNotEmpty($_POST['email']))
				{
					$err = 'FPC13';
				}
				if (isset($_POST['name']) && !pjValidation::pjActionNotEmpty($_POST['name']))
				{
					$err = 'FPC14';
				}
				if (!isset($_POST['verification']))
				{
					$err = 'FPC12';
				}
				if (isset($_POST['verification']) && !pjValidation::pjActionNotEmpty($_POST['verification']))
				{
					$err = 'FPC16';
				}
				if ($_SESSION[$this->defaultCaptcha]=="" || $_POST['verification']=="" || strtoupper($_POST['verification']) != $_SESSION[$this->defaultCaptcha])
				{
					$err = 'FPC08';
				}
			}
			if(isset($_FILES['file']))
			{
				if($_FILES['file']['error'] == 0)
				{
					$path = $_FILES['file']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$allowed_ext = explode("|", $this->option_arr['o_file_allowed']);
					if(!in_array($ext, $allowed_ext)){
						$err = 'FPC18';
					}
				}else if($_FILES['file']['error'] != 4){
					$err = 'FPC20';
				}
			}
			if ($err != '')
			{
				if (isset($_SESSION[$this->defaultCaptcha]))
				{
					$_SESSION[$this->defaultCaptcha] = NULL;
					unset($_SESSION[$this->defaultCaptcha]);
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionIndex&err=' . $err . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
			}
			
			$data = array();
			$err = 'FPC01';
			
			$data['created'] = date('Y-m-d H:i:s');
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
			$data['status'] = 'T';
			
			$pjMemberModel = pjMemberModel::factory();
			$pjCommentModel = pjCommentModel::factory();
						
			if(!$this->checkLogin())
			{
				$email = $_POST['email'];
			
				$member_arr = $pjMemberModel->where("t1.email='$email'")->findAll()->getData();
				if(count($member_arr) > 0)
				{
					$data['member_id'] = $member_arr[0]['id'];
					$email = $member_arr[0]['email'];
				}else{
					
					$member_data = array();
					$member_data['name'] = $_POST['name'];
					$member_data['email'] = $_POST['email'];
					$member_data['status'] = 'F';
					$member_data['member_since'] = date('Y-m-d H:i:s');
					$member_data['password'] = pjToolkit::getRandomPassword();
					
					$data['member_id'] = $pjMemberModel->reset()->setAttributes($member_data)->insert()->getInsertId();
					
					$active_expire = date('Y-m-d', strtotime("+7 days"));
					$pjMemberModel->reset()->where('id', $data['member_id'])->limit(1)->modifyAll(array('active_expire'=>$active_expire));
					
					$this->sendRegistrationEmail($member_data['email'], $member_data['name']);
					$this->sendSMS(1);
					
					if($this->option_arr['o_new_member_activation'] == 'confirmed'){
						$pjMemberModel->reset()->where('id', $data['member_id'])->limit(1)->modifyAll(array('status'=>'T'));
						$err = 'FPC01';
					}else if($this->option_arr['o_new_member_activation'] == 'email'){
						$err = 'FPC04';
						$this->sendActivationEmail($member_data['email'], $member_data['name'], $data['member_id']);
					}else{
						$err = 'FPC05';
					}
				}
			}else{
				$data['member_id'] = $_SESSION[$this->defaultMember]['id'];
				$member = $pjMemberModel->find($data['member_id'])->getData();
				if(empty($member))
				{
					unset($_SESSION[$this->defaultMember]);
					pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionIndex&err=FPC06' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
				}else{
					if($member['status'] == 'F')
					{
						unset($_SESSION[$this->defaultMember]);
						pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionIndex&err=FPC07' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
					}
				}
				if (!isset($_POST['comment_text']) || !pjValidation::pjActionNotEmpty($_POST['comment_text']))
				{
					pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionIndex&err=FPC03' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
				}
				$email = $member['email'];
			}
			
			$id = $pjCommentModel->setAttributes(array_merge($_POST, $data))->insert()->getInsertId();
			
			if ($id !== false && (int) $id > 0)
			{
				if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
					$file = $_FILES['file'];
					$data = array();
					$data['comment_id'] = $id;

					$pjFileModel = pjFileModel::factory();
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
				
				$this->sendCommentEmail($email, $id);
				$this->sendSMS(2);
				if($err == 'FPC01')
				{
					$this->sendNewReplyEmail($email, $id);
				}
			}else{
				$err = 'FPC02';
			}
			pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionIndex&err=' . $err . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
		}
		
		$this->appendJs('jabb-0.4.3.min.js', PJ_LIBS_PATH . 'jabb/');
		$this->appendJs('tiny.js', PJ_LIBS_PATH . 'tiny/');
		$this->appendJs('pjLoad.js');
	}
	
	public function pjActionReportDialog()
	{
		$this->setAjax(true);
		
		if ($this->isXHR())
		{
			$id = pjObject::escapeString($_GET['id']);
			$this->set('comment_id', $id);
		}
	}
	
	public function pjActionSubmitReport()
	{
		$this->setAjax(true);
		
		if ($this->isXHR())
		{
			$id = $_GET['id'];
			$data = array();
			$data['status'] = 'R';
			pjCommentModel::factory()->where('id', $id)->limit(1)->modifyAll($data);
			
			$this->sendReportEmail($id);
			$this->sendSMS(3);
		}
	}
	
	public function pjActionVote()
	{
		$this->setAjax(true);
		
		if ($this->isXHR())
		{
			$id = $_GET['id'];
			$vote_value =  $_GET['value'];
			$vote_type = 2;
			if(isset($_GET['type']))
			{
				$vote_type = 1;
			}
			
			if($vote_type == 1){
				$user_ip = $_SERVER["REMOTE_ADDR"];
				echo $this->voteIp($id, $user_ip, $vote_value);
			}else{
				echo $this->voteCookie($id, $vote_value);
			}
		}
	}
	
	public function pjActionLogin()
	{
		if(isset($_POST['front_login']))
		{
			set_time_limit(0);
			$err = '';
			
			if (!isset($_POST['email']))
			{
				$err = 'FL05';
			}
			if (!isset($_POST['password']))
			{
				$err = 'FL06';
			}
			if (isset($_POST['email']) && !pjValidation::pjActionNotEmpty($_POST['email']))
			{
				$err = 'FL07';
			}
			if (isset($_POST['password']) && !pjValidation::pjActionNotEmpty($_POST['password']))
			{
				$err = 'FL08';
			}
			if (isset($_POST['email']) && !pjValidation::pjActionEmail($_POST['email']))
			{
				$err = 'FL09';
			}
			
			if ($err != '')
			{
				pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionLogin&err=' . $err . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
			}

			$pjMemberModel = pjMemberModel::factory();
				
			$member = $pjMemberModel
				->where('t1.email', $_POST['email'])
				->where('t1.password', $_POST['password'])
				->limit(1)
				->findAll()
				->getData();
			if (count($member) != 1)
			{
				pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionLogin&err=FL02' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
			}else{
				$member = $member[0];
				unset($member['password']);
				
				if ($member['status'] != 'T')
				{
					pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionLogin&err=FL03' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
				}
				
				$last_login = date("Y-m-d H:i:s");
				$member['last_login'] = $last_login;
    			$_SESSION[$this->defaultMember] = $member;
    			
    			$data = array();
    			$data['last_login'] = $last_login;
    			$pjMemberModel->reset()->setAttributes(array('id' => $member['id']))->modify($data);
    			
				pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionIndex' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
			}
		}else{
			$this->appendJs('jabb-0.4.3.min.js', PJ_LIBS_PATH . 'jabb/');
			$this->appendJs('tiny.js', PJ_LIBS_PATH . 'tiny/');
			$this->appendJs('pjLoad.js');
		}
	}
	
	public function pjActionLogout()
	{
		if ($this->checkLogin())
        {
        	unset($_SESSION[$this->defaultMember]);
        }
       	pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionIndex' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
	}
	
	public function pjActionForgot()
	{
		if(isset($_POST['forgot_password']))
		{
			set_time_limit(0);
			$err = '';
			
			if (!isset($_POST['email']))
			{
				$err = 'FF05';
			}
			if (isset($_POST['email']) && !pjValidation::pjActionNotEmpty($_POST['email']))
			{
				$err = 'FF06';
			}
			if (isset($_POST['email']) && !pjValidation::pjActionEmail($_POST['email']))
			{
				$err = 'FF07';
			}
			
			if ($err != '')
			{
				pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionForgot&err=' . $err . (isset($_POST['iframe']) ? '&iframe' : NULL));
			}else{
				$pjMemberModel = pjMemberModel::factory();
				
				$member = $pjMemberModel
					->where('t1.email', $_POST['email'])
					->limit(1)
					->findAll()
					->getData();
				if(count($member) > 0)
				{
					$member = $member[0];
					if($member['status'] == 'F')
					{
						pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionForgot&err=FF02' . (isset($_POST['iframe']) ? '&amp;iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
					}else{
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
						
						$to = $_POST['email'];
						$subject = $subject = $this->option_arr['o_email_password_reminder_subject'];
						$from = $this->getFromEmail();
						
						$message = str_replace(
							array('{Name}', '{Email}', '{Password}'),
							array($member['name'], $member['email'], $member['password']),
							$this->option_arr['o_email_password_reminder']
						);
						
						$pjEmail->setContentType('text/plain');
						$pjEmail->setTo($to);
						$pjEmail->setFrom($from);
						$pjEmail->setSubject($subject);
						$pjEmail->send($message);
						
						pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionForgot&err=FF01' . (isset($_POST['iframe']) ? '&amp;iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
					}
				}else{
					pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionForgot&err=FF03' . (isset($_POST['iframe']) ? '&amp;iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
				}	
			}
		}else{
			$this->appendJs('jabb-0.4.3.min.js', PJ_LIBS_PATH . 'jabb/');
			$this->appendJs('tiny.js', PJ_LIBS_PATH . 'tiny/');
			$this->appendJs('pjLoad.js');
		}
	}
	

	public function pjActionResendActivationUrl()
	{
		if(isset($_POST['resend_url']))
		{
			set_time_limit(0);
			$err = '';
			
			if (!isset($_POST['email']))
			{
				$err = 'FS04';
			}
			if (isset($_POST['email']) && !pjValidation::pjActionNotEmpty($_POST['email']))
			{
				$err = 'FS05';
			}
			if (isset($_POST['email']) && pjValidation::pjActionNotEmpty($_POST['email']) && !pjValidation::pjActionEmail($_POST['email']))
			{
				$err = 'FS06';
			}
			
			if ($err != '')
			{
				pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionResendActivationUrl&err=' . $err . (isset($_POST['iframe']) ? '&iframe' : NULL));
			}else{
				$pjMemberModel = pjMemberModel::factory();
			
				$member = $pjMemberModel
					->where('t1.email', $_POST['email'])
					->limit(1)
					->findAll()
					->getData();
				if(count($member) > 0)
				{
					$member = $member[0];
					if($member['status'] == 'F')
					{
						$this->resendActivationURLEmail($member['email'], $member['name'], $member['id']);
						
						$active_expire = date('Y-m-d', strtotime("+7 days"));
						$pjMemberModel->reset()->where('id', $member['id'])->limit(1)->modifyAll(array('active_expire'=>$active_expire));
						
						pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionResendActivationUrl&err=FS01' . (isset($_POST['iframe']) ? '&amp;iframe' : NULL));
					}else{
						pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionResendActivationUrl' . (isset($_POST['iframe']) ? '&amp;iframe' : NULL));
					}
				}else{
					pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionResendActivationUrl&err=FS03' . (isset($_POST['iframe']) ? '&amp;iframe' : NULL));
				}
			}
		}else{
			$this->appendJs('jabb-0.4.3.min.js', PJ_LIBS_PATH . 'jabb/');
			$this->appendJs('tiny.js', PJ_LIBS_PATH . 'tiny/');
			$this->appendJs('pjLoad.js');
		}
	}
	
	public function pjActionCheckForm()
	{
		$this->setAjax(true);
	
		$email = $_POST['email'];
		$verification = $_POST['verification'];
		
		$status = array();
		$status['captcha'] = 1;
		$status['email'] = 1;
		
		if (strtoupper($verification) != $_SESSION[$this->defaultCaptcha]){
			$status['captcha'] = 0;
		}
		
		$pjMemberModel = pjMemberModel::factory()->where('t1.email', $email);
		
		if($pjMemberModel->findCount()->getData() != 0){
			$status['email'] = 0;
		}
		
		pjAppController::jsonResponse($status);
	}
	
	public function pjActionRegister()
	{
		if(isset($_POST['register']))
		{
			set_time_limit(0);
			
			$err = '';
			if (!isset($_POST['email']))
			{
				$err = 'FR20';
			}
			if (!isset($_POST['password']))
			{
				$err = 'FR21';
			}
			if (!isset($_POST['name']))
			{
				$err = 'FR22';
			}
			if (!isset($_POST['verification']))
			{
				$err = 'FR23';
			}
			if (isset($_POST['email']) && !pjValidation::pjActionNotEmpty($_POST['email']))
			{
				$err = 'FR24';
			}
			if (isset($_POST['name']) && !pjValidation::pjActionNotEmpty($_POST['name']))
			{
				$err = 'FR25';
			}
			if (isset($_POST['password']) && !pjValidation::pjActionNotEmpty($_POST['password']))
			{
				$err = 'FR26';
			}
			if (isset($_POST['verification']) && !pjValidation::pjActionNotEmpty($_POST['verification']))
			{
				$err = 'FR27';
			}
			if (isset($_POST['email']) && pjValidation::pjActionNotEmpty($_POST['email']) && !pjValidation::pjActionEmail($_POST['email']))
			{
				$err = 'FR28';
			}
			if ($_SESSION[$this->defaultCaptcha]=="" || $_POST['verification']=="" || strtoupper($_POST['verification']) != $_SESSION[$this->defaultCaptcha])
			{
				$err = 'FR04';
			}
			if ($err != '')
			{
				if (isset($_SESSION[$this->defaultCaptcha]))
				{
					$_SESSION[$this->defaultCaptcha] = NULL;
					unset($_SESSION[$this->defaultCaptcha]);
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionRegister&err=' . $err . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
			}	
			
			$data = array();
			$data['member_since'] = date('Y-m-d H:i:s');
			$data['status'] = 'F';
						
			$pjMemberModel = pjMemberModel::factory();
			
			$_POST = pjSanitize::clean($_POST, array('remove_html' => true, 'unicode' => false));
			
			$id = $pjMemberModel->setAttributes(array_merge($_POST, $data))->insert()->getInsertId();
			
			if ($id !== false && (int) $id > 0)
			{
				$this->sendRegistrationEmail($_POST['email'], $_POST['name']);
				$this->sendSMS(1);
				
				if($this->option_arr['o_new_member_activation'] == 'confirmed'){
					$pjMemberModel->reset()->where('id', $id)->limit(1)->modifyAll(array('status'=>'T'));
					$err = 'FR011';
				}else if($this->option_arr['o_new_member_activation'] == 'email'){
					$active_expire = date('Y-m-d', strtotime("+7 days"));
					$pjMemberModel->reset()->where('id', $id)->limit(1)->modifyAll(array('active_expire'=>$active_expire));
					$this->sendActivationEmail($_POST['email'], $_POST['name'], $id);
					$err = 'FR012';
				}else{
					$err = 'FR013';
				}
				
			}else{
				$err = 'FR02';
			}
			pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionRegister&err=' . $err . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
		}else{
			
			$this->appendJs('jabb-0.4.3.min.js', PJ_LIBS_PATH . 'jabb/');
			$this->appendJs('tiny.js', PJ_LIBS_PATH . 'tiny/');
			$this->appendJs('pjLoad.js');
		}
	}
	
	public function pjActionActivate()
	{
		$id = pjObject::escapeString($_GET['id']);
		$hash = $_GET['hash'];
		if($hash == md5(PJ_SALT . $id))
		{
			$pjMemberModel = pjMemberModel::factory();
			if($pjMemberModel->where('id', $id)->where('status', 'T')->findCount()->getData() == 0)
			{
				$today = date('Y-m-d');
				if($pjMemberModel->reset()->where('id', $id)->where("t1.active_expire >= '$today'")->findCount()->getData() > 0)
				{
					$pjMemberModel->reset()->where('id', $id)->limit(1)->modifyAll(array('status'=>'T'));
					
					$comment_arr = pjCommentModel::factory()->where('member_id', $id)->limit(1)->orderBy('created DESC')->findAll()->getData();
					if(!empty($comment_arr))
					{
						$arr = $comment_arr[0];
						$this->sendNewReplyEmail(null, $arr['id']);
					}
					$err = 'FA01';
				}else{
					$err = 'FA04';
				}
			}else{
				$err = 'FA03';
			}
		}else{
			$err = 'FA02';
		}
		$this->set('status', $err);
	}
	
	public function pjActionMyProfile()
	{
		if($this->checkLogin())
		{
			$current_member = $_SESSION[$this->defaultMember];
			
			if(isset($_POST['update_profile']))
			{
				if($_POST['password'] == 'password' || $_POST['password'] == ''){
					unset($_POST['password']);
				}
				$pjMemberModel = pjMemberModel::factory();
				
				$_POST = pjSanitize::clean($_POST, array('remove_html' => true, 'unicode' => false));
				
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
				pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionMyProfile&err=FP01' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
			}else{
				$arr = pjMemberModel::factory()->find($current_member['id'])->getData();
				
				$this->set('arr', $arr);
				
				$this->appendJs('jabb-0.4.3.min.js', PJ_LIBS_PATH . 'jabb/');
				$this->appendJs('tiny.js', PJ_LIBS_PATH . 'tiny/');
				$this->appendJs('pjLoad.js');
			}
		}else{
			pjUtil::redirect($_SERVER['PHP_SELF'] . '?controller=pjLoad&action=pjActionLogin' . (isset($_POST['iframe']) ? '&iframe' : NULL) . '#pjCpForm_' . $this->getTopic());
		}
	}
	
	public function pjActionRemoveAvatar()
	{
		$this->setAjax(true);
		
		$id = pjObject::escapeString($_GET['id']);
		$data = array();
		
		$pjMemberModel = pjMemberModel::factory();
		
		$arr = $pjMemberModel->find($id)->getData();
		
		$avatar_path = $arr['avatar_path'];
		if (file_exists(PJ_INSTALL_PATH . $avatar_path) && !empty($avatar_path)) {
			if(unlink(PJ_INSTALL_PATH . $avatar_path)){
			}
		}
		$data['mime_type'] = ':NULL';
		$data['avatar_path'] = ':NULL';
		$data['avatar_name'] = ':NULL';
		$data['hash'] = ':NULL';
		
		$pjMemberModel->reset()->where('id', $id)->limit(1)->modifyAll($data);
	}
	
	public function pjActionUnsubscribe()
	{
		$topic_id = pjObject::escapeString($_GET['topic_id']);
		$member_id = pjObject::escapeString($_GET['member_id']);
		$hash = $_GET['hash'];
		$status = 1;
		if($hash == md5($member_id))
		{
			$pjCommentModel = pjCommentModel::factory();
			$data = array('subscribed' => '0');
			$pjCommentModel->where('topic_id', $topic_id)->where('member_id', $member_id)->modifyAll($data);
			$status = 1;
		}else{
			$status = 0;
		}
		$this->set('status', $status);
	}
	
	private function pjCheckBannedWords($string)
	{
		if($this->option_arr['o_banned_words'] == ''){
			return true;
		}else{
			$banned_words = trim($this->option_arr['o_banned_words']);
			$banned_arr = explode(",", $banned_words);
			foreach($banned_arr as $k => $v){
				$banned_arr[$k] = trim($v);
			}
			$matches = array();
			$matchFound = preg_match_all("/\b(" . implode($banned_arr,"|") . ")\b/i", $string, $matches);
			if ($matchFound) {
				return false;
			}else{
				return true;
			}
		}
	}
}
?>