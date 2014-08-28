<?php 

//constantes.
$mainDir = __DIR__."/../data";
$ext_ok = array("jpg", "png", "gif");

function save_file($file, $ext, $dest){
	if (!in_array($ext, $GLOBALS["ext_ok"]))
		return false;
	if (!move_uploaded_file($file['tmp_name'], $dest."/".$file['name']))
	 	return false;
	chmod($dest."/".$file['name'], 0777);
	return $dest."/".$file['name'];
}

function reArrayFiles(&$file_post) {

	$file_ary = array();
	$file_count = count($file_post['name']);
	$file_keys = array_keys($file_post);

	for ($i=0; $i<$file_count; $i++) {
		foreach ($file_keys as $key) {
			$file_ary[$i][$key] = $file_post[$key][$i];
 		}
	}
	return $file_ary;

}

 function pics_handler($files, $path, $name_pic){
	$files = reArrayFiles($files["pics"]);
	$i = 1;
	foreach ($files as $key => $value) {
		$ext = explode(".", $value["name"]);
		$ext = strtolower($ext[1]);
		$files[$key]["name"] = $name_pic."_$i.".$ext;
		$i++;
		if(!($url = save_file($files[$key], $ext, $path))) {
			echo "<h4> An error has occur saving the file '".$files[$key]["name"]."'. Contact admin please </h4>";
		}
	}
}
function html_edit($entry, $id, $type) {
	echo "<form action='edit.php?type=valid_edit&id=$id&table=$type' method='post'>";
	foreach ($entry as $col => $val) {
		if(!strstr($col, "id") && !strstr($col, "date") && !strstr($col, "path")) {
			echo "<p>$col : </p>";
			switch ($col) {
				case 'text':
					echo "<textarea name='text' rows='5' cols='30' class='input-large' id='$id'>$val</textarea>";
					echo "<script>CKEDITOR.replace( '$id' );</script>";
					break;
				case 'category':
					echo "<input type='checkbox' name='category' value='1' >Visiteur ? ";
					break;
				case 'weekly':
					echo "<input type='checkbox' name='weekly' value='1' checked>Vidéo de la semaine ";
					break;
				default:
					echo "<input type='text' class='input-large' name='$col' value='$val'>";
					break;
			}
		}
	}
	echo "<br><input type='submit' value='valider'>";
	echo "</form>";
}

?>