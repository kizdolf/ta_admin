(function(){
	'use strict';

	angular.module('myApp.services',[])

		.service('getData', ['$http', function($http){

			this.quartiers = function(param){
				if(param == '')
					return $http.get('API/api.php?get=quartiers');
				else
					return $http.get('API/api.php?get=quartiers&param=' + param);
			};

			this.artistes =  function(param){
				if(param == '')
					return $http.get('API/api.php?get=artistes');
				else
					return $http.get('API/api.php?get=artistes&param=' + param);
			};

			this.weekly = function(){
				return $http.get('API/api.php?get=weekly');
			};

			this.related = function(from, type_id, id){
				return $http.get('API/api.php?get=related&from=' + from + "&type_id=" + type_id + "&id=" + id);
			};

		}])

		.service('tools',['$http', '$sce', function($http, $sce){

			this.iframe = function(url){
				if (url.indexOf('youtube') != -1) {
					var token = url.split("watch?v=");
					token = token[1].split("&");
					token = token[0];
					var frame = "<iframe src='//www.youtube.com/embed/"+token+"?feature=player_detailpage' frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
				}
				else if (url.indexOf('vimeo') != -1) {
					var token = url.split("/");
					token = token[3];
					var frame = "<iframe src='//player.vimeo.com/video/"+ token+ "' frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
				}
				else{
					return "unsupported source. Contact webmaster.";
				}
				return $sce.trustAsHtml(frame);
			}
		}])

		.service('pics', ['$http', function($http){

			this.list_pics = function(path){
				return $http.get('API/api.php?get=pics&path=' + path);
			}
		}]);

})();

