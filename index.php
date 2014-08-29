 
<!DOCTYPE html>
<html  ng-app="myApp">
<head>
	<meta charset="UTF-8">
	<title>Toulouse Acoustics </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
  <base href="/public/adminta/">
</head>
<body>
  <div id="header" class="page-header">
    <h1>Welcome at Toulouse Acoustics</h1>
  </div>

<!-- MAIN MENU -->
  <div ng-controller="headCtrl" id="divMenu">
    <ul class="list-unstyled container" id="menuList">
      <li class="pull-left" id="menuLi">
        <a href="#/home" class="title">ACCUEIL</a>
      </li>
      <li class="pull-left" id="menuLi">
        <a href="#/artistes" class="title" id="artistesMenu">ARTISTES</a>
        <ul class="list-unstyled subMenu" id="artistesListe">
          <li ng-repeat="a in artistes" class="pull-left subItem">
          <a href="#/artistes/{{ a.name }}" class="btn btn-info">{{ a.name }}</a>  
          </li>
        </ul>
      </li>
      <li class="pull-left" id="menuLi">
      <a href="#/quartiers" class="title" id="quartiersMenu">QUARTIERS</a>
        <ul class="list-unstyled subMenu" id="quartiersListe">
          <li ng-repeat="q in quartiers" class="pull-left subItem">
            <a href="#/quartiers/{{q.name}}" class="btn btn-info">{{ q.name }}</a>
          </li>
        </ul>
      </li>
      <li class="pull-left" id="menuLi">
        <a href="#/portfolio" class="title"> PORTFOLIO </a>
      </li>
      <li class="pull-left" id="menuLi">
        <a href="#/about" class="title"> A PROPOS </a>
      </li>
      <li class="pull-left" id="menuLi">
        <a href="#/contact" class="title"> CONTACT </a>
      </li>
      <li class="pull-left" id="menuLi">
        <a href="#/partners" class="title"> PARTENAIRES </a>
      </li>
      <li class="pull-left" id="menuLi">
      <form>
        <input type="text" placeholder="Recherche" ng-model="search" ng-change="getRes()" >
      </form>
      </li>
    </ul>
    <div id="resultSearch">
      <ul>
        <li ng-repeat="res in resSearch" >
       <a href="#/{{res.id}}/{{ res.name }}"> {{ res.name }} </a>
        </li>
      </ul>
    </div>
  </div>

<div ng-view></div>


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
  
</body>
</html>
