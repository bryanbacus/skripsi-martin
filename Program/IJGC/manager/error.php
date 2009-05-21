<?
$error = array(
		1 => 'Internal Error Occured ! Please Contact <a href="mailto:'.$_SERVER['SERVER_ADMIN'].'">ADMINISTRATOR</a>',
		2 => 'File doesn\'t exist !'
		);

$p = preg_replace("@[^0-9]@i","",$_GET['p']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Error Occured !</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<div id='error'>
	<h1>Error Occured !</h1>
	<?
		echo $error[$p];
	?>
</div>
</body>
</html>
