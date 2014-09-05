<?php 
if(!isset($bdd)){$bdd = new tapdo();}
$alls = $bdd->get_all_names_id();

 ?>
<div id="conteneur-menu2">
	<ul>
		<li><a href="index.php">Admin</a></li>
		<li><a href="profil.php">Editer le profil</a></li>
		<li><a href="add_profil.php">gestion admins</a></li>
		<li><a href="../components/piwik/piwik/index.php">Stats site</a></li>
		<li><a href="new_quartier.php">Nouveau quartier</a></li>
		<li><a href="new_post.php">Nouveau post</a></li>
		<li><a href="index.php?session=leave">Se déconnecter</a></li>
		<li><a href="../index.php">Voir le site</a></li>
	</ul>
</div>
<div id="sidebar">
		<h3>Raccourcis</h3>
		<ul>
			<li><a href="https://www.facebook.com/toulouseacoustics">Facebook Page</a></li>
			<li><a href="https://www.facebook.com/groups/495231230518643/">Facebook Groupe</a></li>
			<li><a href="https://trello.com/#">Trello</a></li>
			<li><a href="https://soundcloud.com/toulouse-acoustics">Souncloud</a></li>
			<li><a href="edit_texts.php">Editer les textes</a></li>
			<li><a href="styles.php">Ajouter un style</a></li>
			<li><a href="partners.php">Partenaires</a></li>
		</ul>
		<hr>
		<h3>Edition rapide</h3>
		<div class="dropdown">
			<a  class='btn btn-default btn-md' data-toggle="dropdown" href="#">artistes</a>
  			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
  			<?php foreach ($alls['artistes'] as $artiste) {
  				echo "<li><a  href='edit.php?type=artiste&id=".$artiste['id']."'>".$artiste['name']."</a></li>";
  			} ?>
  			</ul>
		</div>
		<div class="dropdown">
			<a  class='btn btn-default btn-md'  data-toggle="dropdown" href="#">quartiers</a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<?php foreach ($alls['quartiers'] as $quartier) {
  				echo "<li><a href='edit.php?type=quartier&id=".$quartier['id']."'>".$quartier['name']."</a></li>";
  			} ?>
  			</ul>
		</div>
		<div class="dropdown">
			<a   class='btn btn-default btn-md' data-toggle="dropdown" href="#">videos</a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<?php foreach ($alls['videos'] as $video) {
  				echo "<li><a  href='edit.php?type=video&id=".$video['id']."'>".$video['name']."</a></li>";
  			} ?>
  			</ul>
		</div>
		<hr>
		<div>
			<button class="btn btn-default draft">Notes publiques</button>
		</div>
</div>
</div>
<script src="../components/jquery.js"></script>
<script src="../css/bootstrap/js/bootstrap.min.js"></script>
