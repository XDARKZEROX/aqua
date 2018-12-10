<?php
ob_start();
?>
<!doctype html>
<html>
	<head>
		<title>Post Comment by PHPJabbers.com</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	</head>
	<body>
	{PC_LOAD}
	</body>
</html>

<?php
if (!isset($_GET['iframe']))
{
	$content = ob_get_contents();
	ob_end_clean();
	ob_start();
}
$controller->requestAction(array('controller' => 'pjLoad', 'action' => 'pjActionIndex'));

if (!isset($_GET['iframe']))
{
	$app = ob_get_contents();
	ob_end_clean();
	$app = str_replace('$','&#36;',$app);
	echo preg_replace('/\{PC_LOAD\}/', $app, $content);
}
?>