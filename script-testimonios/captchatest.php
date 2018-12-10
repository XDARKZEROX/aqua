<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test tool by StivaSoft Ltd</title>
<style>
BODY { margin:30px; font-family:Verdana, Geneva, sans-serif; font-size:12px; }
</style>
</head>

<body>


<?php
//ini_set("display_errors",1);
//error_reporting(E_ALL);

echo $value."<p><h3><b>This is a simple test to check if all PHP functions needed for the captcha to function <br /> are supported on your hosting account</h3></b><br /><p>";

$functions_used = array ("imagecreatefrompng","imagecreatetruecolor","imagecolorallocate","imagefilledrectangle","imagerectangle","imagettfbbox","imagettftext");
	foreach ($functions_used as $key=>$value) {
		if (function_exists($value)) {
			echo $value." <b>SUPPORTED</b><br />";
		} else {
			echo $value." <b>MISSING</b><br />";
		}

	}
?>

</body>
</html>