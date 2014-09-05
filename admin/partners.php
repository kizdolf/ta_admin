<?php 

spl_autoload_register(function ($class) {
	include __DIR__.'/../classes/' . $class . '_class.php';
});
require_once 'admin_functions.php';
$log = new log();
$bdd = new tapdo();
if (!$log->is_logued()) {
	header('Location: login.php?case=disconnect');
}else{
	$cookie = unserialize($_COOKIE['session']);
	$name = $cookie['user'];
	$profil = $bdd->get_one_user('ta_login', $name);
	$rights = $profil['rights'];
	$partners = $bdd->get_all_partners();
	if ($rights > 2) {
		$message = handler_message(array('no'));
	}
if (isset($_POST['new_partner']) && $rights < 2) {
	handler_new_partner($_POST, $_FILES, $bdd);
	header('Location: index.php?add=partenaire&n='.$_POST['partner_name']);
}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Partenaires - Admin</title>
 	<meta charset="utf-8">
	<script src="../components/ckeditor/ckeditor.js"></script>
  	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
 </head>
 <body>
 <?php include('menu.php'); ?>
	<div id="wrapper">
	<?php if (isset($message)) { echo $message;	} ?>
	<div>
		<h4>Partenaires : </h4>
		<ul>
		<?php 

		foreach ($partners as $p) {
			echo "<li><h5>".$p['name']."</h5>";
			echo "<btn  class='btn btn-danger btn-xs' >Editer</btn>";
			?>
			<div class="edit_partner"><?php if($rights < 2){ ?>
				<form method="post" action="./partners.php" enctype="multipart/form-data">
					<input type="text" class="form-control" name="partner_name" placeholder="nom" value="<?php echo $p['name']; ?>">
					<div id="float_form" class="input-group input-group-lg">
						<span class="input-group-addon">@</span>
						<input type="text" class="inputc form-control" name="partner_url" placeholder="url du site" value="<?php echo $p['url']; ?>">
					</div>			<textarea id="ck_a" name="partner_desc" rows="5" cols="30" class="form-control"><?php echo $p['desc']; ?></textarea>
					<script>CKEDITOR.replace( 'ck_a' );</script>
					<div id="upload" class="jumbotron">
						<h3>Logo partenaire : </h3>
						<input type="file" name="partner_logo" id="partner_logo"> <br>
					</div>
					<div id="sub_form">
						<button class="btn btn-lg btn-success valid" type="submit" name="new_partner">Valider</button>
					</div>	
				</form>
			</div>
		<?php } ?>
	</div>
			<?php 
			echo "<li>";
		}

		?>
		</ul>
	</div>
	<div><?php if($rights < 2){ ?>
		<form method="post" action="./partners.php" enctype="multipart/form-data">
			<input type="text" class="form-control" name="partner_name" placeholder="nom">
			<div id="float_form" class="input-group input-group-lg">
				<span class="input-group-addon">@</span>
				<input type="text" class="inputc form-control" name="partner_url" placeholder="url du site">
			</div>			<textarea id="ck_a" name="partner_desc" rows="5" cols="30" class="form-control"></textarea>
			<script>CKEDITOR.replace( 'ck_a' );</script>
			<div id="upload" class="jumbotron">
				<h3>Logo partenaire : </h3>
				<input type="file" name="partner_logo" id="partner_logo"> <br>
			</div>
			<div id="sub_form">
				<button class="btn btn-lg btn-success valid" type="submit" name="new_partner">Add it</button>
			</div>	
		</form>
		<?php } ?>
	</div>
	</div>
 </body>
 </html>
 <?php } ?>