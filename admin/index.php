<?php 

spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
require_once(__DIR__."/admin_functions.php");
session_start();
$bdd = new tapdo();

$post = $bdd->get_all_post();
if (isset($_POST['new_quartier'])) {
	$path = "../portfolio/quartiers/".$_POST['quartier_name'];
	if (!is_dir($path))
		mkdir($path);
 	pics_handler($_FILES, $path, $_POST['quartier_name']);
	$id = $bdd->new_quartier($_POST['quartier_name'], $path, $_POST['quartier_desc'], $_POST['quartier_url']);
}
elseif (isset($_POST['new_post'])) {
	$path = "../portfolio/artistes/" . $_POST['artiste_name'];
	if (!is_dir($path))
		mkdir($path);
 	pics_handler($_FILES, $path, $_POST['artiste_name']);
	$id_a = $bdd->new_artiste($_POST['artiste_name'], $path, $_POST['artiste_desc'], $_POST['artiste_url'], $_POST['itw']);
	$weekly = (isset($_POST['weekly']) ? 1 : 0);
	$category = (isset($_POST['visiteur']) ? 1 : 0);
	$bdd->new_video($_POST['video_name'], $_POST['video_desc'], $_POST['video_url'], $id_a, $_POST['quartier_id'], $weekly, $category);
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>admin</title>
</head>
<body>
	<a href="new_quartier.php">Nouveau quartier</a>
	<a href="new_post.php">Nouveau post</a>
	<div>
		<?php 
			foreach ($post as $p) {
				if ($p['video']['weekly'] == 1) {
					echo '<h4> THIS IS ON SCREEN </h4>';
				}
				echo "<h5>".$p['video']['name']."</h5>";
				echo "date : ".$p['video']['date']."<br>";
				echo "de : ".$p['artiste']['name']."<br>";
				echo "tournée à : ".$p['quartier']['name'];
			}
	 	?>
	</div>
</body>
</html>