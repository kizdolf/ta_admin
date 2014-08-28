<?php
spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
$log = new log();

if (!$log->is_logued()) {
	header('Location: login.php?case=disconnect');
}else{

	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
	<meta charset="utf-8">
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
	<script src="../components/jquery.js"></script>
</head>
<body>
	<?php include('menu.html'); ?>

<h2>To do: </h2>
<ul>
	<li>1: Recup id user in cookie</li>
	<li>2: Recup all infos from bdd</li>
	<li>3: Generate form</li>
	<li>4: record change</li>
</ul>
</body>
</html>
<?php } ?>