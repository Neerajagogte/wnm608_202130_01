<?


function print_p($v) {
	echo "<pre>",print_r($v), "</pre>";
}

//PHP MYSQL functions

include_once "auth.php";
function makeConn() {
	if(!function_exists('makeAuth')) die("No makeAuth, check in auth.php");

	@$conn = new mysqli(...makeAuth());

	if($conn->errno) die($conn->connect_error);

	$conn->set_charset("utf8");

	return $conn;
}

function getData($sql) { //read
	$conn = makeConn();

	$result = $conn->query($sql);

	if($conn->errno) die($conn->error);

	$arr = [];
	while($row = $result->fetch_objects())
		$arr[] = $row;

	$conn->close();

	return $arr;
}

?>