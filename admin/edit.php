<?php 
spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
require_once('admin_functions.php');
$log = new log();
if (!$log->is_logued()) {
	header('Location: login.php?case=disconnect');
}
if (!isset($_GET['type']) || !isset($_GET['id'])) {
	header('Location: index.php?wrong=edition');
}
$bdd = new tapdo();
$type = $_GET['type'];
$id = $_GET['id'];
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
	<?php include('menu.html'); ?>

<?php

if ($_GET['type'] == "valid_edit") {
	$get = "get_one_".$_GET['table'];
	$entry = $bdd->$get('id', $id);
	foreach ($_POST as $key => $value) {
		if (isset($entry[$key])) {
			$entry[$key] = $value;
		}
	}
	if (isset($entry['weekly']) && !isset($_POST['weekly'])) {
		$entry['weekly'] = 0;
	}
	if (isset($entry['category']) && !isset($_POST['category'])) {
		$entry['category'] = 0;
	}
	$update = "update_one";
	$entry['date_update'] = date("Y-m-d H:i:s");
	$bdd->$update($_GET['table'], 'id', $id, $entry);
	header('Location: index.php?done=edit');
}
else{
	$get = "get_one_".$type;
	html_edit($bdd->$get('id', $id), $id, $type);
}
 ?>

</body>
</html>