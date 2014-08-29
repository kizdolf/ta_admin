<?php 
$html = "";
if (isset($_GET['case'])) {
	switch ($_GET['case']) {
		case 'logs':
			$html = "Mauvais login ou password.";
			break;
		case 'disconnect':
			$html = "Vous n'êtes pas connecté";
			break;
		case 'leave':
			$html = "Vous êtes bien déconnecté";
			break;
		case 'change':
			$html = 'Veuillez vous reconnecter avec vos nouveaux identifiants.';
			break;
		default:
			$html = "";
			break;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login admin TA</title>
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
	<meta charset="utf-8">
</head>
<body>
<div>
	<h3><?php echo $html; ?></h3>
</div>
<?php 
// echo hash('whirlpool', '123');
 ?>
<form action="index.php" method="post">
	<p>Login : </p>
	<input	type="text" name="login">
	<p>Pasword : </p>
	<input type="password" name="password">
	<br><input type="checkbox" name="trust">Se souvenir de moi pendant une semaine (sur les postes de confiances...)
	<br><input type="submit" name="login_sub" value="Se connecter">
</form>
</body>
</html>