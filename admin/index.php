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
		$message.= "<h2>Welcome ".$_POST['login']."</h2><br>";
		$trust = (isset($_POST['trust']))? true : false;
		$id_admin = $log->set_session($_POST['login'], $_POST['password'], $trust);
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
$post = array_reverse($post);
if (isset($_POST['new_quartier'])) {
	$path = "../portfolio/quartiers/".$_POST['quartier_name'];
	if (!is_dir($path))
		mkdir($path);
 	pics_handler($_FILES, $path, $_POST['quartier_name']);
	$id = $bdd->new_quartier($_POST['quartier_name'], $path, $_POST['quartier_desc'], $_POST['quartier_url']);
	$message .= "<div class='alert alert-success'>Quartier \"".$_POST['quartier_name']."\" sauvergardé!</div>";
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
	$message .= "<div class='alert alert-success'><a href='index.php'>Sauvegarde effectuée. Cliquez ici pour actualiser et voir le post apparaitre.</a></div>";
}
elseif (isset($_POST['new_profil'])) {
		$password = hash('whirlpool', $_POST['password']);
		$bdd->new_user(array($_POST["ta_login"], $password, $_POST["mail"], $_POST["rights"]));
		header('Location: add_profil.php');
	}

/*
	HANDLER MESSAGES
*/
if (isset($_GET['wrong'])) {
	$message .= "<div class='alert alert-danger'>ERREUR!! Le programme recontre une erreur lors de : <p style='font-weight: bold'>".$_GET['wrong']."</p></div>";
}
if (isset($_GET['no'])) {
	$message .= "<div class='alert alert-danger'>Vous n'avez pas les droits pour ça.</div>";
}
if (isset($_GET['done'])){
	$message .= "<div class='alert alert-success'>".$_GET['done'] . " effectué! </div>";
}
if (isset($_COOKIE['session'])) {
	$cookie = unserialize($_COOKIE['session']);
	$name = $cookie['user'];
	$user = $bdd->get_one_user('ta_login', $name);
	$rights = $user['rights'];
}else{
	$rights = $bdd->get_rights_user(array($id_admin));
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<meta charset="utf-8">
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
	<script src="../components/jquery.js"></script>
</head>
<body>
	<?php include('menu.php'); ?>	
	<div id="wrapper">
	<div id="messages"><?php echo $message; ?></div>
		<?php 
			foreach ($post as $p) {
				echo "<div id='post' >";
				if ($p['video']['weekly'] == 1) {
					echo "<span class='weekly'><img src='img/weekly.jpg'></span>";
				}
				if ($p['video']['category'] == 1) {
					echo "<span class='weekly'><img src='img/visiteur.jpg'><p>Visiteur</p></span>";
				}
				else{
					echo "<span class='weekly'><img src='img/local.jpg'><p>Local</p></span>";
				}
				echo "<div class='page-header'>";
   				echo "<h3>".$p['artiste']['name'];
				echo "<br><small>".$p['video']['name']."</small>";
				echo "</h3>".$p['video']['date']."</div>";
				echo "Quartier : ".$p['quartier']['name'];
				echo "<button class='btn btn-default btn-xs get_vid'>Récupérer la vidéo</button><div class='frame'>".$p['video']['url']."</div>";
				if ($rights < 3) {
					echo "<br><a id='edit_btn' href='edit.php?type=video&id=".$p['video']['id']."' class='btn btn-info'><span class='glyphicon glyphicon-th'></span>Modifier la vidéo</a>";
					echo "<br><a id='edit_btn' href='edit.php?type=artiste&id=".$p['artiste']['id']."'class='btn btn-info'><span class='glyphicon glyphicon-th'></span>Editer l'artiste</a>";
					echo "<br><a id='edit_btn' href='edit.php?type=quartier&id=".$p['quartier']['id']."'class='btn btn-info'><span class='glyphicon glyphicon-th'></span>Editer le quartier</a>";
				}
				echo "</div><hr>";
			}
	 	?>
	</div>
	<script type="text/javascript">
		if ($('#messages').html() == "") {
			$('#messages').hide();
		}
		$('.get_vid').click(function(){
			$(this).hide();
			$frame = $(this).next('div');
			var url = $frame.html();
			if (url.indexOf('youtube') != -1) {
				var token = url.split("watch?v=");
				token = token[1].split("&");
				token = token[0];
				var frame = "<iframe src='//www.youtube.com/embed/"+token+"?feature=player_detailpage' frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
			}
			else if (url.indexOf('vimeo') != -1) {
				var token = url.split("/");
				token = token[3];
				var frame = "<iframe src='//player.vimeo.com/video/"+ token+ "' frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
			}
			$frame.html(frame);
		});
	</script>
</body>
</html>
