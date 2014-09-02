<?php 
spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
$log = new log();

if (!$log->is_logued()) {
	header('Location: login.php?case=disconnect');
}else{

$bdd = new tapdo();
$quartiers = $bdd->get_all_quartiers_name();
$html = "";
foreach ($quartiers as $q) {
	$html .= "<button value='" .  $q['id'] . "' class='quartier_choix btn btn-default'>" . $q['name'] . "</button>";
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un post</title>
	<script src="../components/ckeditor/ckeditor.js"></script>
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
</head>
<body>
	<?php include('menu.php'); ?>
	<div id="wrapper">

	<div>
	<h2>Nouveau post</h2>
		<div>
			<h3>Choisir un quartier</h3>
			<div class="btn-group">
			<a class='btn btn-warning' href="new_quartier.php">nouveau</a>
			<?php echo $html; ?>
			</div>
		</div>
	<form method="post" action="./index.php" enctype="multipart/form-data">
		<input type="hidden" id="quartier_id" name="quartier_id" class="inputc">
		<div id="float_form" class="input-group input-group-lg">
			<div class='page-header'>
				<h2>Artiste</h2>
			</div>
			<input type="text" class="form-control inputc" name="artiste_name" placeholder="nom">
			<hr>
			<div id="float_form" class="input-group input-group-lg">
				<span class="input-group-addon">@</span>
				<input type="text" class="inputc form-control" name="artiste_url" placeholder="url de l'artiste">
			</div>
			<p>Texte : </p>
			<textarea id="ck_a" name="artiste_desc" rows="5" cols="30" class="form-control"></textarea>
			<script>CKEDITOR.replace( 'ck_a' );</script>

			<div id="float_form" class="input-group input-group-lg">
				<span class="input-group-addon">@</span>
				<input type="text" class="inputc form-control" name="itw" placeholder='Itw sounclound'>
			</div>
			<div id="upload" class="jumbotron">
				<h3>Photos</h3>
				<input type="file" multiple="multiple" name="pics[]" id="pics"> <br>
				<h3>Vignette Quartier : 220px / 220px</h3>
				<input type="file" name="vignette" id="vignette"> <br>
			</div>
		</div>
		<div id="float_form" class="input-group input-group-lg">
			<div class="page-header">
				<h2>video</h2>
			</div>
			<input type="text" class="inputc form-control" name="video_name" placeholder="nom">
			<div id="float_form" class="input-group input-group-lg">
				<span class="input-group-addon">@</span>
				<input type="text" class="form-control" name="video_url">
			</div>
			<p>Texte : </p>
			<textarea id="ck_v" name="video_desc" rows="5" cols="30" class="form-control"></textarea>
			<script>CKEDITOR.replace( 'ck_v' );</script>
		</div>
		<div id="sub_form" class="jumbotron">
			<input type="checkbox" name="weekly" value="yes" checked> Vidéo de la semaine?<br>
			<input type="checkbox" name="visiteur" value="yes" > Visiteur?<br>
		</div>	
		<div class="alert alert-danger" role="alert">Heu.. Je crois qu'il manque un truc. Faudrais vérifier!</div>
		<div id="sub_form">
			<button class="btn btn-lg btn-success valid" type="submit" name="new_post">Add it</button>
		</div>	
	</form>
	</div>
	<script src="../components/jquery.js"></script>
	<script type="text/javascript">

	$check = function(){
		$('.inputc').each(function(){
			if($(this).val() == ''){
				$(this).addClass('missing');
				$('.valid').hide();
				$('.alert').show();
			}
			else{
				$(this).removeClass('missing');
			}
		});
	};

	$check();

	$(".quartier_choix").click(function(){
		$val = $(this).val();
		$('.quartier_choix').each(function(){
			$(this).removeClass('btn-success')
		})
		$(this).addClass('btn-success');
		$("#quartier_id").val($val);
	});

	

	$('input').keypress(function(){
		$('.valid').show();
		$('.alert').hide();
		$check();
	});

	</script>
	</div>
</body>
</html>
<?php } ?>
