<?php 

/**
* New class for ta.. again!
* 
*/
class tapdo
{
	private $_conf;
	private $_con;
	private $_querys;

	function __construct()
	{
		$this->set_conf();
		$str = "mysql:host=" . $this->_conf->server . ";dbname=" . $this->_conf->dbname;
		try {
			$this->_con = new PDO($str, $this->_conf->user, $this->_conf->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (PDOException $e) {
			echo ("<bold>Connection failed. Message: " . $e->getMessage() . "<br></bold>");
			return false;
		}
		return true;

	}

	private function set_conf()
	{
		$file = __DIR__ . "/../admin/conf/bdd_conf.json";
		$conf = json_decode(file_get_contents($file));
		$this->_conf = $conf->init;
		$this->_querys = $conf->querys;
	}

	public function new_quartier($name, $path, $text, $url = "")
	{
		$verif_q = "SELECT `id` FROM `quartier` WHERE `name`='$name'";
		$prep = $this->_con->prepare($verif_q);
		$prep->execute();
		$result = $prep->fetch(PDO::FETCH_ASSOC);
		if (!empty($result)) {
			return $result['id'];
		}
		$q = $this->_querys->new->quartier;
		$prep = $this->_con->prepare($q);
		$vars = array(
			"name" => $name
			,"path" => $path
			,"text" => $text
			,"url" => $url);
		$prep->execute($vars);
		return $this->_con->lastInsertId();
	}

	public function new_artiste($name, $path, $text, $url = "")
	{
		$verif_q = "SELECT `id` FROM `artiste` WHERE `name`='$name'";
		$prep = $this->_con->prepare($verif_q);
		$prep->execute();
		$result = $prep->fetch(PDO::FETCH_ASSOC);
		if (!empty($result)) {
			return $result['id'];
		}
		$q = $this->_querys->new->artiste;
		$prep = $this->_con->prepare($q);
		$vars = array(
			"name" => $name
			,"path" => $path
			,"text" => $text
			,"url" => $url);
		$prep->execute($vars);
		return $this->_con->lastInsertId();
	}

	public function new_video($name, $text, $url, $id_artiste, $id_quartier, $weekly, $cat)
	{
		$this->_con->beginTransaction();

		$verif_q = "SELECT `id` FROM `video` WHERE `name`='$name'";
		$prep = $this->_con->prepare($verif_q);
		$prep->execute();
		$result = $prep->fetch(PDO::FETCH_ASSOC);
		if (!empty($result)) {
			return $result['id'];
		}

		if($weekly == 1)
		{
			$qu = $this->_querys->update->video_week;
			$p = $this->_con->prepare($qu);
			$p->execute();
		}

		$q = $this->_querys->new->video;
		$prep = $this->_con->prepare($q);
		$vars = array(
			"name" => $name
			,"url" => $url
			,"id_artiste" => $id_artiste
			,"id_quartier" => $id_quartier
			,"text" => $text
			,"weekly"=> $weekly
			,"category" => $cat);
		$prep->execute($vars);

		$q = $this->_querys->get->nb_videos;
		$vars = array("id_quartier" => $id_quartier);
		$prep = $this->_con->prepare($q);
		$prep->execute($vars);
		$result = $prep->fetch(PDO::FETCH_ASSOC);
		$nb = $result['nb_videos'] + 1;

		$q = $this->_querys->update->quartier_nb;
		$vars = array("new_nb" => $nb, "id_quartier" => $id_quartier);
		$prep = $this->_con->prepare($q);
		$prep->execute($vars);

		$this->_con->commit();
	}

	public function get_all_quartiers_name()
	{
		$q = $this->_querys->get->all_quartiers_name;
		$prep = $this->_con->prepare($q);
		$prep->execute();
		return $prep->fetchAll();
	}

	public function get_all_post()
	{
		$post = array();
		$this->_con->beginTransaction();

		$q = $this->_querys->get->all_videos;
		$prep = $this->_con->prepare($q);
		$prep->execute();
		$videos = $prep->fetchAll();
		foreach ($videos as $video) {
			$q_id = $video['id_quartier'];
			$a_id = $video['id_artiste'];
			$q_q = $this->_querys->get->one_quartier_id;
			$q_a = $this->_querys->get->one_artiste_id;
			$prep_q = $this->_con->prepare($q_q);
			$prep_a = $this->_con->prepare($q_a);
			$prep_q->execute(array("q_id" => $q_id));
			$prep_a->execute(array("a_id" => $a_id));
			$post[] = $this->build_fetch($video, $prep_a->fetchAll(), $prep_q->fetchAll());
		}
		$this->_con->commit();
		return $post;
	}

	private function build_fetch($video, $artiste, $quartier)
	{
		$artiste = $artiste[0];
		$quartier = $quartier[0];
		$post = array();
		$post['video'] = array(
			"id" => $video['id']
			,"name" => $video['name']
			,"text" =>$video['text']
			,"url" => $video['url']
			,"date" => $video['date_creation']
			,"weekly" => $video['weekly']);
		$post['artiste'] = array(
			"id" => $artiste['id']
			,"name" => $artiste['name']
			,"text" =>$artiste['text']
			,"url" => $artiste['url']
			,"date" => $artiste['date_creation']);
		$post['quartier'] = array(
			"id" => $quartier['id']
			,"name" => $quartier['name']
			,"text" =>$quartier['text']
			,"url" => $quartier['url']
			,"date" => $quartier['date_creation']);
		return $post;
	}
}

?>