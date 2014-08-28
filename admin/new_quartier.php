<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un quartier</title>
	<script src="../components/ckeditor/ckeditor.js"></script>
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
</head>
<body>
	<?php include('menu.html'); ?>

	<h2>Nouveau quartier</h2>
	<form method="post" action="./index.php"  enctype="multipart/form-data">
		<div id="float_form" class="span4">
			<p>Nom : </p>
			<input type="text" class="input-large" name="quartier_name"\>
			<p>Texte : </p>
			<textarea name="quartier_desc" rows="5" cols="30" class="input-large" id="ck"></textarea>
			<script>CKEDITOR.replace( 'ck' );</script>
			<p>Site Web : </p>
			<input type="text" class="input-large" name="quartier_url">
		</div>
		<div id="upload">
			<h3>Photos</h3>
			<input type="file" multiple="multiple" name="pics[]" id="pics"> <br>
		</div>
		<div id="sub_form" class="jumbotron">
			<button class="v btn btn-warning" type="submit" name="new_quartier">Add it</button>
		</div>	
	</form>
</body>
</html>