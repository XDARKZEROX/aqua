<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}

class pjAppController extends pjController
{
	public $models = array();

	public $defaultLocale = 'admin_locale_id';
	
	public $defaultFields = 'fields';
	
	public $defaultFieldsIndex = 'fields_index';
	
	public $defaultTopic = 'front_topic_id';
	
	public $defaultTheme = 'front_theme_id';
	
	public $defaultVote = 'front_vote_cookie_';

	protected function loadSetFields($force=FALSE)
	{
		$registry = pjRegistry::getInstance();
		if ($force
				|| !isset($_SESSION[$this->defaultFieldsIndex])
				|| $_SESSION[$this->defaultFieldsIndex] != $this->option_arr['o_fields_index']
				|| !isset($_SESSION[$this->defaultFields])
				|| empty($_SESSION[$this->defaultFields]))
		{
			pjAppController::setFields($this->getLocaleId());
	
			if ($registry->is('fields'))
			{
				$_SESSION[$this->defaultFields] = $registry->get('fields');
			}
			$_SESSION[$this->defaultFieldsIndex] = $this->option_arr['o_fields_index'];
		}
	
		if (isset($_SESSION[$this->defaultFields]) && !empty($_SESSION[$this->defaultFields]))
		{
			$registry->set('fields', $_SESSION[$this->defaultFields]);
		}
			
		return TRUE;
	}
	
	public function isEditor()
    {
   		return $this->getRoleId() == 2;
    }
	public function isOneAdminReady()
    {
    	return $this->isAdmin();
    }
	
	public static function setTimezone($timezone="UTC")
    {
    	if (in_array(version_compare(phpversion(), '5.1.0'), array(0,1)))
		{
			date_default_timezone_set($timezone);
		} else {
			$safe_mode = ini_get('safe_mode');
			if ($safe_mode)
			{
				putenv("TZ=".$timezone);
			}
		}
    }

	public static function setMySQLServerTime($offset="-0:00")
    {
		mysql_query("SET SESSION time_zone = '$offset';");
    }
    
	public function setTime()
	{
		if (isset($this->option_arr['o_timezone']))
		{
			$offset = $this->option_arr['o_timezone'] / 3600;
			if ($offset > 0)
			{
				$offset = "-".$offset;
			} elseif ($offset < 0) {
				$offset = "+".abs($offset);
			} elseif ($offset === 0) {
				$offset = "+0";
			}
	
			pjAppController::setTimezone('Etc/GMT' . $offset);
			if (strpos($offset, '-') !== false)
			{
				$offset = str_replace('-', '+', $offset);
			} elseif (strpos($offset, '+') !== false) {
				$offset = str_replace('+', '-', $offset);
			}
			pjAppController::setMySQLServerTime($offset . ":00");
		}
	}
    
    public function beforeFilter()
    {
    	$this->appendJs('jquery-1.8.2.min.js', PJ_THIRD_PARTY_PATH . 'jquery/');
    	$this->appendJs('pjAdminCore.js');
    	$this->appendCss('reset.css');
    	
    	$this->appendJs('jquery-ui.custom.min.js', PJ_THIRD_PARTY_PATH . 'jquery_ui/js/');
		$this->appendCss('jquery-ui.min.css', PJ_THIRD_PARTY_PATH . 'jquery_ui/css/smoothness/');

		$this->appendCss('pj-all.css', PJ_FRAMEWORK_LIBS_PATH . 'pj/css/');
		$this->appendCss('admin.css');
				
    	if ($_GET['controller'] != 'pjInstaller')
		{
			$this->models['Option'] = pjOptionModel::factory();
			$this->option_arr = $this->models['Option']->getPairs($this->getForeignId());
			$this->set('option_arr', $this->option_arr);
			$this->setTime();
			
			if (!isset($_SESSION[$this->defaultLocale])) {
				$locale_arr = pjLocaleModel::factory()->where('is_default', 1)->limit(1)->findAll()->getData();
				if (count($locale_arr) === 1){
					$this->setLocaleId($locale_arr[0]['id']);
				}
			}
			if (!in_array($_GET['action'], array('pjActionPreview')))
			{
				$this->loadSetFields(true);
			}
		}
    }
	public function pjActionCheckInstall()
	{
		$this->setLayout('pjActionEmpty');
		
		$result = array('status' => 'OK', 'code' => 200, 'text' => 'Operation succeeded', 'info' => array());
		$folders = array(
							'app/web/upload', 
							'app/web/upload/avatars', 
							'app/web/upload/files'
						);
		foreach ($folders as $dir)
		{
			if (!is_writable($dir))
			{
				$result['status'] = 'ERR';
				$result['code'] = 101;
				$result['text'] = 'Permission requirement';
				$result['info'][] = sprintf('Folder \'<span class="bold">%1$s</span>\' is not writable. You need to set write permissions (chmod 777) to directory located at \'<span class="bold">%1$s</span>\'', $dir);
			}
		}
		
		return $result;
	}
	
    public function getForeignId()
    {
    	return 1;
    }
    
    public static function setFields($locale)
    {
   	 	if(isset($_SESSION['lang_show_id']) && (int) $_SESSION['lang_show_id'] == 1)
		{
			$fields = pjMultiLangModel::factory()
				->select('CONCAT(t1.content, CONCAT(":", t2.id, ":")) AS content, t2.key')
				->join('pjField', "t2.id=t1.foreign_id", 'inner')
				->where('t1.locale', $locale)
				->where('t1.model', 'pjField')
				->where('t1.field', 'title')
				->findAll()
				->getDataPair('key', 'content');
		}else{
			$fields = pjMultiLangModel::factory()
				->select('t1.content, t2.key')
				->join('pjField', "t2.id=t1.foreign_id", 'inner')
				->where('t1.locale', $locale)
				->where('t1.model', 'pjField')
				->where('t1.field', 'title')
				->findAll()
				->getDataPair('key', 'content');
		}
		$registry = pjRegistry::getInstance();
		$tmp = array();
		if ($registry->is('fields'))
		{
			$tmp = $registry->get('fields');
		}
		$arrays = array();
		foreach ($fields as $key => $value)
		{
			if (strpos($key, '_ARRAY_') !== false)
			{
				list($prefix, $suffix) = explode("_ARRAY_", $key);
				if (!isset($arrays[$prefix]))
				{
					$arrays[$prefix] = array();
				}
				$arrays[$prefix][$suffix] = $value;
			}
		}
		require PJ_CONFIG_PATH . 'settings.inc.php';
		$fields = array_merge($tmp, $fields, $settings, $arrays);
		$registry->set('fields', $fields);
    }

    public static function jsonDecode($str)
	{
		$Services_JSON = new pjServices_JSON();
		return $Services_JSON->decode($str);
	}
	
	public static function jsonEncode($arr)
	{
		$Services_JSON = new pjServices_JSON();
		return $Services_JSON->encode($arr);
	}
	
	public static function jsonResponse($arr)
	{
		header("Content-Type: application/json; charset=utf-8");
		echo pjAppController::jsonEncode($arr);
		exit;
	}

	public function getLocaleId()
	{
		return isset($_SESSION[$this->defaultLocale]) && (int) $_SESSION[$this->defaultLocale] > 0 ? (int) $_SESSION[$this->defaultLocale] : false;
	}
	
	public function setLocaleId($locale_id)
	{
		$_SESSION[$this->defaultLocale] = (int) $locale_id;
	}
	
	public function friendlyURL($str, $divider='-')
	{
		$str = mb_strtolower($str, mb_detect_encoding($str)); // change everything to lowercase
		$str = trim($str); // trim leading and trailing spaces
		$str = preg_replace('/[_|\s]+/', $divider, $str); // change all spaces and underscores to a hyphen
		$str = preg_replace('/\x{00C5}/u', 'AA', $str);
		$str = preg_replace('/\x{00C6}/u', 'AE', $str);
		$str = preg_replace('/\x{00D8}/u', 'OE', $str);
		$str = preg_replace('/\x{00E5}/u', 'aa', $str);
		$str = preg_replace('/\x{00E6}/u', 'ae', $str);
		$str = preg_replace('/\x{00F8}/u', 'oe', $str);
		$str = preg_replace('/[^a-z\x{0400}-\x{04FF}0-9-]+/u', '', $str); // remove all non-cyrillic, non-numeric characters except the hyphen
		$str = preg_replace('/[-]+/', $divider, $str); // replace multiple instances of the hyphen with a single instance
		$str = preg_replace('/^-+|-+$/', '', $str); // trim leading and trailing hyphens
		return $str;
	}
	
	public function setTopic($topic_id)
	{
		$_SESSION[$this->defaultTopic] = $topic_id;
		
		$pjTopicModel = pjTopicModel::factory();
		$arr = $pjTopicModel->find($topic_id)->getData();
		
		$views = intval($arr['views']) + 1;
		
		$data = array();
		$data['views'] = $views;
		$pjTopicModel->reset()->where('id', $topic_id)->limit(1)->modifyAll($data);
	}
	
	public function getTopic()
	{
		return isset($_SESSION[$this->defaultTopic]) && (int) $_SESSION[$this->defaultTopic] > 0 ? (int) $_SESSION[$this->defaultTopic] : false;
	}
	
	public function setTheme($theme)
	{
		$_SESSION[$this->defaultTheme] = $theme;
	}
	
	public function getTheme()
	{
		return isset($_SESSION[$this->defaultTheme]) && !empty($_SESSION[$this->defaultTopic]) ? $_SESSION[$this->defaultTheme] : false;
	}
	
	public function getFromEmail()
	{
		$arr = pjUserModel::factory()->find(1)->getData();
		return $arr['email'];
	}
	
	protected function voteCookie($comment_id, $vote_value)
	{
		$is_can_vote = true;
		$is_update = 0;
		if(isset($_COOKIE[$this->defaultVote . $comment_id])){
			if($_COOKIE[$this->defaultVote . $comment_id] == $vote_value){
				$is_can_vote = false;
			}else{
				$is_update = 1;
			}
		}
		$pjCommentModel = pjCommentModel::factory();
		if($is_can_vote == true){
			$arr = $pjCommentModel->find($comment_id)->getData();
			
			$expire=time() + 60*60*24;
			setcookie($this->defaultVote . $comment_id, $vote_value, $expire);
			if(!empty($arr)){
				$data = array();
				if($is_update == 1){
					if($vote_value == 'up'){
						$data['likes'] = intval($arr['likes']) + 1;
						$data['dislikes'] = intval($arr['dislikes']) - 1;
					}else{
						$data['likes'] = intval($arr['likes']) - 1;
						$data['dislikes'] = intval($arr['dislikes']) + 1;
					}
					$pjCommentModel->reset()->where('id', $comment_id)->limit(1)->modifyAll($data);
				}else{
					if($vote_value == 'up'){
						$data['likes'] = intval($arr['likes']) + 1;
					}else{
						$data['dislikes'] = intval($arr['dislikes']) + 1;
					}
					$pjCommentModel->reset()->where('id', $comment_id)->limit(1)->modifyAll($data);
				}
				
			}
		}
		$arr = $pjCommentModel->reset()->find($comment_id)->getData();
		unset($arr['comment_text']);
		return $this->jsonResponse($arr);
	}
	
	protected function voteIp($comment_id, $user_ip, $vote_value)
	{
		$pjCommentModel = pjCommentModel::factory();
		$pjVoteModel = pjVoteModel::factory();
		$arr = $pjCommentModel->find($comment_id)->getData();
		
		$vote_arr = $pjVoteModel->where('comment_id', $comment_id)
								->where('user_ip', $user_ip)
								->where("DATE_ADD(voted_date,INTERVAL 1 DAY) >= NOW()")
								->findAll()->getData();
		
		$update_vote_date = true;
		if(!empty($vote_arr)){
			$val = $vote_arr[0]['vote_value'];
			if($val != $vote_value){
				if($vote_value == 'up'){
					$data['likes'] = intval($arr['likes']) + 1;
					$data['dislikes'] = intval($arr['dislikes']) - 1;
				}else{
					$data['likes'] = intval($arr['likes']) - 1;
					$data['dislikes'] = intval($arr['dislikes']) + 1;
				}
				$pjCommentModel->reset()->where('id', $comment_id)->limit(1)->modifyAll($data);
			}else{
				$update_vote_date = false;
			}
		}else{
			if($vote_value == 'up'){
				$data['likes'] = intval($arr['likes']) + 1;
			}else{
				$data['dislikes'] = intval($arr['dislikes']) + 1;
			}
			$pjCommentModel->reset()->where('id', $comment_id)->limit(1)->modifyAll($data);
		}
		
		if($update_vote_date == true){
			$pjVoteModel->reset()->where('comment_id', $comment_id)->where('user_ip', $user_ip)->eraseAll();
			$vdata = array();
			$vdata['comment_id'] = $comment_id;
			$vdata['user_ip'] = $user_ip;
			$vdata['vote_value'] = $vote_value;
			$pjVoteModel->reset()->setAttributes($vdata)->insert()->getInsertId();
		}

		$arr = $pjCommentModel->reset()->find($comment_id)->getData();
		unset($arr['comment_text']);
		return $this->jsonResponse($arr);
	}
}
?>