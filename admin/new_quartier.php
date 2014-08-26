<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un quartier</title>
</head>
<body>
	<h2>Nouveau quartier</h2>
	<form method="post" action="./index.php" >
		<div id="float_form" class="span4">
			<p>Nom : </p>
			<input type="text" class="input-large" name="quartier_name"\>
			<p>Texte : </p>
			<textarea name="quartier_desc" rows="5" cols="30" class="input-large"></textarea>
			<p>Site Web : </p>
			<input type="text" class="input-large" name="quartier_url">
		</div>
		<div id="sub_form" class="jumbotron">
			<button class="v btn btn-warning" type="submit" name="new_quartier">Add it</button>
		</div>	
	</form>
</body>
</html>