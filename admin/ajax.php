<?php 
spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
$log = new log();

if (!$log->is_logued()) {
	header('Location: login.php?case=disconnect');
}else{

$bdd = new tapdo();

if (isset($_POST['id'])) {
	$artiste = $bdd->get_one_artiste("id", $_POST['id']);
	$path = $artiste['path_pics'];
	$handle = opendir($path);
	$files = array();
	while ($entry = readdir($handle)){
		if($entry!= "." && $entry != "..")
			$files[] = $path ."/" . $entry;
	}
	print_r(json_encode($files));
}elseif (isset($_POST['del'])) {
	echo unlink($_POST['src']);
}
}
?>