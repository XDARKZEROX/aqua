<?php

if (!isset($_GET['iframe']))
{
	$content = ob_get_contents();
	ob_end_clean();
	ob_start();
}
if (!isset($_GET['controller']) || empty($_GET['controller']))
{
	$_GET["controller"] = "pjLoad";
}

if (!isset($_GET['action']) || empty($_GET['action']))
{
	$_GET["action"] = "pjActionIndex";
}
$_GET["topic_id"] = $PJ_TOPIC;
$_GET["theme"] = $PJ_THEME;
$_GET['params'] = array('menu' => false);

$dirname = str_replace("\\", "/", dirname(__FILE__));

include str_replace("app/views/pjLayouts", "", $dirname) . '/ind'.'ex.php';

if (!isset($_GET['iframe']))
{
	$app = ob_get_contents();
	ob_end_clean();
	ob_start();
	$app = str_replace('$','&#36;',$app);
	echo preg_replace('/\{PC_LOAD\}/', $app, $content);
}
?>