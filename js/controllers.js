'use strict';

angular.module('myApp.controllers', [])

.controller('headCtrl', ['filterFilter', '$scope', '$http', '$sce', 'getData', 'tools'
	,function(filterFilter, $scope, $http, $sce, getData, tools){

	$scope.title = "Welcome at Toulouse Acoustics";


	getData.weekly().then(function(data){
		$scope.weekly = data.data;
		$scope.weekly.video.frame = tools.iframe($scope.weekly.video.url);
		$scope.weekly.video.text = $sce.trustAsHtml($scope.weekly.video.text);
		$scope.weekly.artiste.text = $sce.trustAsHtml($scope.weekly.artiste.text);
		$scope.weekly.quartier.text = $sce.trustAsHtml($scope.weekly.quartier.text);
	});
}])

.controller('artisteCtrl', ['tools', 'getData', '$scope', '$routeParams', '$http', '$sce', function(tools, getData, $scope, $routeParams, $http, $sce){

	getData.related('artiste', 'name', $routeParams.id).then(function(data){
		$scope.artiste = data.data;
		tools.soundcloud(data.data.artiste.itw, "lol");
	});
}])


.controller('artistesCtrl', ['pics', 'getData', '$scope', '$routeParams', '$http', '$sce', function(pics, getData, $scope, $routeParams, $http, $sce){

	getData.artistes('').then(function(data){
		$scope.artistes = data.data;
	}).then(function(){

	$scope.artistes.forEach(function(i){
		pics.list_pics(i.path_pics).then(function(data){
			$scope.truc = data.data;
		}).then(function(){
			if ($scope.truc == "T") {
				i.imgs = ["img/badges/weekly.jpg"];
			}
			else{
				i.imgs = $scope.truc;
			}
		});
	});
	});
}])

.controller('quartierCtrl', ['tools', 'getData', '$scope', '$routeParams', '$http', '$sce', function(tools, getData, $scope, $routeParams, $http, $sce){

	getData.related('quartier', 'name', $routeParams.id).then(function(data){
		$scope.quartier = data.data;
		for (var i in $scope.quartier.videos){
			$scope.quartier.videos[i].frame = tools.iframe($scope.quartier.videos[i].url);
		}
	});
}])

.controller('quartiersCtrl', ['pics', 'getData', '$scope', '$routeParams', '$http', '$sce', function(pics, getData, $scope, $routeParams, $http, $sce){

	getData.quartiers('').then(function(data){

		$scope.quartiers = data.data;
		
	}).then(function(){

	$scope.quartiers.forEach(function(i){
		pics.list_pics(i.path_pics).then(function(data){
			$scope.truc = data.data;
		}).then(function(){
			i.imgs = $scope.truc;
		});
	})
	});
}])

.controller('picsCtrl', ['pics', 'getData', '$scope', '$routeParams', '$http', '$sce', function(pics, getData, $scope, $routeParams, $http, $sce){

	$scope.index = 0;

	getData.artistes('').then(function(data){
		$scope.artistes = data.data;
	});

	getData.quartiers('').then(function(data){
		$scope.quartiers = data.data;
	});

	$scope.name_click = function(path){
		
		pics.list_pics(path).then(function(data){
			$scope.pics = data.data;
			$scope.pic = data.data[$scope.index];
			$scope.index = $scope.index + 1;
			if(!angular.isDefined(data.data[$scope.index]))
				$scope.index = 0;
		});
	};

	$scope.next_pic = function(){
		$scope.pic = $scope.pics[$scope.index];
		$scope.index = $scope.index + 1;
		if(!angular.isDefined($scope.pics[$scope.index]))
				$scope.index = 0;
	}
}]);
