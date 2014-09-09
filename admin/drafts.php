<?php
spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
require_once('admin_functions.php');
$log = new log();
if (!$log->is_logued()) {
	header('Location: login.php?case=disconnect');
}else{
	if (isset($_POST['get']) && $_POST['get'] ="drafts") {
		$drafts = $bdd->get_all('draft');
	}

	if (!isset($_POST['name']) || !isset($_POST['txt'])) {
		header('Location: index.php?wrong=params drafts ajax');
	}
	$bdd = new tapdo();
	$cookie = unserialize($_COOKIE['session']);
	$name = $cookie['user'];
	$kwarg = array($name, $_POST['name'], $_POST['txt']);
	$bdd->new_draft($kwarg);
?>

<?php } ?>