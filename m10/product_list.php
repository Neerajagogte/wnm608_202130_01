<?
require_once"lib/php/functions.php";
require_once"parts/template.php";

$pagelimit = 12;
$pageoffset = isset($_GET['page'])?$_GET['page']:0;

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Furniture Store Product List</title>
	<? include "parts/meta.php" ?>
</head>
<body>
	<? include "parts/navbar.php" ?>
	<div class="container pad push-down">
		<div class="grid gap xs-small md-medium product-list">
			<?
			$data = getData("
				SELECT *
				FROM `products`
				ORDER BY `date_create` DESC
				LIMIT ".($pageoffset*$pagelimit).",$pagelimit
				");

			echo array_reduce($data,'productListTemplate');

			?>
		</div>
	</div>

</body>
</html>