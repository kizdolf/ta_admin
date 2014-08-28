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
$post = array_reverse($post);
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
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
	<script src="../components/jquery.js"></script>
</head>
<body>
	<?php include('menu.html'); ?>
	<div id="messages" class="jumbotron"><?php echo $message; ?></div>
	<div><hr>
		<?php 
			foreach ($post as $p) {
				echo "<div id='post' class='container container-fluid'>";
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
				echo "<div class='frame'>".$p['video']['url']."</div>";
				echo "<br><a id='edit_btn' href='edit.php?type=video&id=".$p['video']['id']."' class='btn btn-info'><span class='glyphicon glyphicon-th'></span>Modifier la vidéo</a>";
				echo "<br><a id='edit_btn' href='edit.php?type=artiste&id=".$p['artiste']['id']."'class='btn btn-info'><span class='glyphicon glyphicon-th'></span>Editer l'artiste</a>";
				echo "<br><a id='edit_btn' href='edit.php?type=quartier&id=".$p['quartier']['id']."'class='btn btn-info'><span class='glyphicon glyphicon-th'></span>Editer le quartier</a>";
				echo "</div><hr>";
			}
	 	?>
	</div>
	<script type="text/javascript">
		if ($('#messages').html() == "") {
			$('#messages').hide();
		}
		jQuery(window).load(function () {
			$('.frame').each(function(one){
				var url = $(this).html();
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
				$(this).html(frame);
			});
		});
	</script>
</body>
</html>