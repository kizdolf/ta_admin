 
<!DOCTYPE html>
<html  ng-app="myApp">
<head>
	<meta charset="UTF-8">
	<title>Toulouse Acoustics </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
  <base href="/public/adminta/">
</head>
<body>
<div class="container container-fluid">
  <div id="header">
  	<a href="#/home" id="img_header">
  		<img src="img/headers/header.jpg" id="img_header">
  	</a>
  </div>
  <!-- Nouveau Menu responsive: -->
<nav ng-controller="headCtrl" class="navbar navbar-default" role="navigation" id="resp_menu">
	<div class="container container-fluid">
		<div>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#list_items_menu">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="list_items_menu">
			<ul class="nav navbar-nav">
				<li>
					<a href="#/home">accueil</a>
				</li>
				<li>
					<a href="#/artistes">artistes</a>
				</li>
				<li>
					<a href="#/quartiers">quartiers</a>
				</li>
				<li>
					<a href="#/portfolio">portfolio</a>
				</li>
				<li>
					<a href="#/a propos">a propos</a>
				</li>
				<li>
					<a href="#/contact">contact</a>
				</li>
				<li>
					<a href="#/partners">partenaires</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div ng-view style="height:100%;"></div>


<!-- <div id="container-fluid" >
	by DonKino. all rights are reserved but do what you want also :)
</div> -->
<!-- 
<div id="playerSound">
<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/49488549&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
</div> -->
  <script src="components/angular.min.js"></script>
  <script src="components/angular_routes.js"></script>
  <script src="components/jquery.js"></script>
  <script src="js/app.js"></script>
  <script src="js/controllers.js"></script>
  <script src="js/routes.js"></script>
  <script src="js/jque.js"></script>
  <script src="css/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/services.js"></script>
  <script src="//connect.soundcloud.com/sdk.js"></script>
  </div>
</body>
</html>
