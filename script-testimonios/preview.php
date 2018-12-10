<?php
ob_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Comment Script - Preview</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>
	<body>
		<div style="max-width: 900px;">
			{PC_LOAD}
		</div>
	</body>
</html>
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