<?php 
/*
	INIT
*/
spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
require_once(__DIR__."/admin_functions.php");
$bdd = new tapdo();
$log = new log();
$message = "";


/*
	LOGIN:
*/
if (isset($_POST['login_sub']) && isset($_POST['login']) && isset($_POST['password'])){
	if (!$log->is_user($_POST['login'], $_POST['password'])) {
	 	header('Location: login.php?case=logs');
	}else{
		$message.= "Welcome ".$_POST['login']."<br>";
		if(isset($_POST['trust']))
			$trust = true;
		else
			$trust = false;
		$log->set_session($_POST['login'], $_POST['password'], $trust);
	}
}
elseif (!$log->is_logued()) {
	header('Location: login.php?case=disconnect');
}
if (isset($_GET['session']) && $_GET['session'] == "leave") {
	$log->unset_session();
	header('Location: login.php?case=leave');
}

/*
	NEW ENTRY:
*/
$post = $bdd->get_all_post();
if (isset($_POST['new_quartier'])) {
	$path = "../portfolio/quartiers/".$_POST['quartier_name'];
	if (!is_dir($path))
		mkdir($path);
 	pics_handler($_FILES, $path, $_POST['quartier_name']);
	$id = $bdd->new_quartier($_POST['quartier_name'], $path, $_POST['quartier_desc'], $_POST['quartier_url']);
	$message .= "Quartier ".$_POST['quartier_name']." sauvergardé!";
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
	$message .= "<a href='index.php'>Sauvegarde effectuée. Cliquez ici pour actualiser et voir le post apparaitre.</a>";
}

/*
	HANDLER MESSAGES
*/
if (isset($_GET['wrong'])) {
	$message .= "ERREUR!! Le programme recontre une erreur lors de : <p style='font-weight: bold'>".$_GET['wrong']."</p>";
}
if (isset($_GET['done'])){
	$message .= $_GET['done'] . " effectué! ";
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
	<a href="index.php?session=leave">Se déconnecter</a>
	<a href="../index.php">Voir le site</a>
	<div id="messages">
		<?php echo $message; ?>
	</div>
	<div>
		<?php 
			foreach ($post as $p) {
				if ($p['video']['weekly'] == 1) {
					echo '<h4> Vidéo de la semaine </h4>';
				}
				echo "<h5>".$p['video']['name']."</h5>";
				echo "date : ".$p['video']['date']."<br>";
				echo "de : ".$p['artiste']['name']."<br>";
				echo "tournée à : ".$p['quartier']['name'];
				echo "<br><a href='edit.php?type=video&id=".$p['video']['id']."'>Editer la vidéo</a>";
				echo "<br><a href='edit.php?type=artiste&id=".$p['artiste']['id']."'>Editer l'artiste</a>";
				echo "<br><a href='edit.php?type=quartier&id=".$p['quartier']['id']."'>Editer le quartier</a>";
			}
	 	?>
	</div>
</body>
</html>