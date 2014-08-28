<?php 
/*
	TO DO :
	Rendre TOUT les champs obligatoire. Rendre le bouton inclickable sinon (jquery)
	Améliorer la lisibilité du bouton de choix de quartier.
*/


spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
$log = new log();

if (!$log->is_logued()) {
	header('Location: login.php?case=disconnect');
}

$bdd = new tapdo();
$quartiers = $bdd->get_all_quartiers_name();
$html = "";
foreach ($quartiers as $q) {
	$html .= "<button value='" .  $q['id'] . "' class='quartier_choix'>" . $q['name'] . "</button>";
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un post</title>
	<script src="../components/ckeditor/ckeditor.js"></script>
</head>
<body>
	<h2>Nouveau post</h2>
		<div>
			<h3>Choisir un quartier.</h3>
			<h4><a href="new_quartier.php">Ou en créer un nouveau</a></h4>
			<?php echo $html; ?>
		</div>
	<form method="post" action="./index.php" enctype="multipart/form-data">
		<input type="hidden" id="quartier_id" name="quartier_id">
		<div id="float_form" class="span4">
			<h3>Artiste</h3>
			<p>Nom : </p>
			<input type="text" class="input-large" name="artiste_name"\>
			<p>Texte : </p>
			<textarea id="ck_a" name="artiste_desc" rows="5" cols="30" class="input-large"></textarea>
			<script>CKEDITOR.replace( 'ck_a' );</script>
			<p>Site Web : </p>
			<input type="text" class="input-large" name="artiste_url">
			<p>Itw sounclound</p>
			<input type="text" class="input-large" name="itw">
			<div id="upload">
				<h3>Photos</h3>
				<input type="file" multiple="multiple" name="pics[]" id="pics"> <br>
			</div>
		</div>
		<div id="float_form" class="span4">
			<h3>video</h3>
			<p>Nom : </p>
			<input type="text" class="input-large" name="video_name"\>
			<p>Texte : </p>
			<textarea id="ck_v" name="video_desc" rows="5" cols="30" class="input-large"></textarea>
			<script>CKEDITOR.replace( 'ck_v' );</script>
			<p>url : </p>
			<input type="text" class="input-large" name="video_url">
		</div>
		<div id="sub_form" class="jumbotron">
			<input type="checkbox" name="weekly" value="yes" checked> Vidéo de la semaine?<br>
			<input type="checkbox" name="visiteur" value="yes" > Visiteur?<br>
			<button class="sub btn btn-warning" type="submit" name="new_post">Add it</button>
		</div>	
	</form>
	<script src="../components/jquery.js"></script>
	<script type="text/javascript">

	$(".quartier_choix").click(function(){
		$val = $(this).val();
		$(this).append(" => checked.");
		$("#quartier_id").val($val);
	});

	</script>
</body>
</html>