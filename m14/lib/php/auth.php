<?

function makePDOAuth() {
	return[
		"mysql:host=localhost;dbname=neerajashop",
		"neerajashop",
		"Raspberryparfait123",
		[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
	];
}

function makeAuth() {
	return[
		"localhost",    //database host location name
		"neerajashop",   //username
		"Raspberryparfait123",  //password
		"neerajashop"  //database name
		];
}

?>