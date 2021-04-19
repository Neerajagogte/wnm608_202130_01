<?
function getFileData($url) {
	$file = file_get_contents($url);
	$data = json_decode($file);
	return $data;
}

function print_p($v) {
	echo "<pre>",print_r($v), "</pre>";
}







?>