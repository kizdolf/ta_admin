<?php 
/*
Liste input API: 

get_weekly_post => return post of the week.

get_list_quartiers => return list of all quartiers

get_list_artistes => return list of all artistes

get_related_quartier(quartier) => return list of all post related to a quartier

get_related_category(category) => return list of all post related to a category

get_related_artiste(artiste) => return list of all post related to an artist

*/


/*
INIT
*/
	spl_autoload_register(function ($class) {
		include __DIR__.'/../classes/' . $class . '_class.php';
	});
	if (isset($_GET['get'])) {
		$bdd = new tapdo();
		$get = $_GET['get'];
	}
	else{
		die ("Wrong input.");
	}
	if (isset($_GET['param'])) {
		$param = $_GET['param'];
	}

/*
Helpers
*/

	function related($from, $type_id, $id, $bdd){
		if ($from != "video" && $from != "quartier" && $from != "artiste") {
			return "Wrong request";
		}
		switch ($from) {
			case 'artiste':
				$artiste = $bdd->get_one_artiste($type_id, $id);
				$videos = $bdd->get_videos_related("id_artiste", $artiste['id']);
				$quartiers = array();
				foreach ($videos as $video) {
					$quartiers[] = $bdd->get_one_quartier("id", $video['id_quartier']);
				}
				$related = array("artiste" => $artiste, "videos" => $videos, "quartiers" => $quartiers);
				print_r(json_encode($related));
				break;
			case 'quartier':
				$quartier = $bdd->get_one_quartier($type_id, $id);
				$videos = $bdd->get_videos_related("id_quartier", $quartier['id']);
				$artistes = array();
				foreach ($videos as $video) {
					$artistes[] = $bdd->get_one_artiste("id", $video['id_artiste']);
				}
				$related = array("artistes" => $artistes, "videos" => $videos, "quartier" => $quartier);
				print_r(json_encode($related));
				break;
			default:
				return "Unsuported feature. (or bug). Please contact webmaster.";
				break;
		}
	}

	function get_pics($path)
	{
		$imgpath = explode("../", $path);
		$imgpath = $imgpath[1];
		if(!is_dir($path))
			die("T");
		$handle = opendir($path);
		$files = array();
		// $path = explode("../", $path);
		// $path= $path[0];
		while ($entry = readdir($handle)){
			if($entry!= "." && $entry != "..")
				$files[] = $imgpath . "/" . $entry;
		}
		print_r(json_encode($files));
	}
/*
Inputs.
*/
	switch ($get) {
		case 'weekly':
			print_r(json_encode($bdd->get_weekly_post()));
			break;
		case 'quartiers':
			if (isset($param))
				print_r(json_encode($bdd->get_quartiers($param)));
			else
				print_r(json_encode($bdd->get_quartiers()));
			break;
		case 'artistes':
			if (isset($param))
				print_r(json_encode($bdd->get_artistes($param)));
			else
				print_r(json_encode($bdd->get_artistes()));
			break;
		case 'related':
			if(!isset($_GET['from']) || !isset($_GET['type_id']) || !isset($_GET['id']))
				echo "Wrong request";
			else
				return related($_GET['from'], $_GET['type_id'], $_GET['id'], $bdd);
			break;
		case 'pics':
			if(!isset($_GET['path']))
				echo "Wrong request";
			else
				get_pics($_GET['path']);
			break;
		case 'about':
			print_r(json_encode($bdd->get_about()));
			break;
		case 'team':
			print_r(json_encode($bdd->get_team()));
			break;
		case 'short_about':
			print_r(json_encode($bdd->get_short_about()));
			break;
		case 'contact':
			print_r(json_encode($bdd->get_contact()));
			break;
		default:
			echo "Wrong request";
			break;
	}


?>