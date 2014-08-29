<?php 
spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
require_once('admin_functions.php');
$log = new log();
if (!$log->is_logued()) {
	header('Location: login.php?case=disconnect');
}else{
$bdd = new tapdo();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit</title>
	<meta charset="utf-8">
	<script src="../components/ckeditor/ckeditor.js"></script>
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
</head>
<body>
	<?php include('menu.php'); ?>
	<div id="wrapper">
	<h1>Modifications des textes:</h1>
	</div>
</body>
</html>
<?php } ?>