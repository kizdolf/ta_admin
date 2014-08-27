'use strict';

angular.module('myApp.controllers', [])

.controller('headCtrl', ['filterFilter', '$scope', '$http', '$sce', 'getData', 'tools'
	,function(filterFilter, $scope, $http, $sce, getData, tools){

	$scope.title = "Welcome at Toulouse Acoustics";
	
	getData.quartiers('name').then(function(data){
		$scope.quartiers = data.data;
	});

	getData.artistes('name').then(function(data){
		$scope.artistes = data.data;
	});

	getData.weekly().then(function(data){
		$scope.weekly = data.data;
		$scope.weekly.video.frame = tools.iframe($scope.weekly.video.url);
	});
}])

.controller('artisteCtrl', ['tools', 'getData', '$scope', '$routeParams', '$http', '$sce', function(tools, getData, $scope, $routeParams, $http, $sce){

	getData.related('artiste', 'name', $routeParams.id).then(function(data){
		$scope.artiste = data.data;
	});

}])


.controller('artistesCtrl', ['getData', '$scope', '$routeParams', '$http', '$sce', function(getData, $scope, $routeParams, $http, $sce){

	getData.artistes('').then(function(data){
		$scope.artistes = data.data;
	});
}])

.controller('quartierCtrl', ['tools', 'getData', '$scope', '$routeParams', '$http', '$sce', function(tools, getData, $scope, $routeParams, $http, $sce){

	getData.related('quartier', 'name', $routeParams.id).then(function(data){
		console.log(data.data);
		$scope.quartier = data.data;
		for (var i in $scope.quartier.videos){
			$scope.quartier.videos[i].frame = tools.iframe($scope.quartier.videos[i].url);
		}
	});



}])

.controller('quartiersCtrl', ['getData', '$scope', '$routeParams', '$http', '$sce', function(getData, $scope, $routeParams, $http, $sce){

	getData.quartiers('').then(function(data){
		$scope.quartiers = data.data;
	});
}])

.controller('picsCtrl', ['$scope', '$routeParams', '$http', '$sce', function($scope, $routeParams, $http, $sce){

}]);
