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
			<li><a href="pics.php?show=team">Galerie équipe</a></li>
			<li><a href="pics.php?show=off">Galerie 'off'</a></li>
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
<div id="drafts">
	<button class="btn btn-default btn-xs add_draft">Ajouter une note</button>
	<div id="form_draft">
		<form method="post" action="./drafts.php" id="send_draft">
			<input type="text" class="form-control" name="draft_name" placeholder="nom">
			<textarea id="ck_b" name="draft" rows="5" cols="30" class="form-control"></textarea>
			<script>CKEDITOR.replace( 'ck_b' );</script>
			<div id="sub_form">
				<button class="btn btn-lg btn-success valid" type="submit" name="new_partner">Add it</button>
			</div>
		</form>
	</div>
</div>
<script src="../components/jquery.js"></script>
<script src="../css/bootstrap/js/bootstrap.min.js"></script>
 <script src="http://malsup.github.com/jquery.form.js"></script> 
<script type="text/javascript">
	$( document ).ready(function(){
		$("#drafts").hide(0);
		$(".draft").click(function(){
			$("#form_draft").hide(0);
			$("#drafts").show("slow");
		});

		$(document).keyup(function(e) {
			if (e.keyCode == 27) {
				$('#drafts').hide("slow");
			}
		});

		$('.add_draft').click(function(){
			$("#form_draft").show('5000');
		});
		$('#send_draft').submit(function( event ) { 
			event.preventDefault();
			$name = $('input').val();
			$txt = $('textarea').val();
			$txt = $('textarea').val();
			$.post('drafts.php', {name: $name, txt: $txt}).done(function(data){
				console.log(data);
			})
		}); 
	});
</script>
