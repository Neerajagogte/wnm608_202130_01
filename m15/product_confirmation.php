<?
include_once "lib/php/functions.php";

$_SESSION['cart'] = [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Furniture Store: Purchase Confirmation</title>

	<? include "parts/meta.php" ?>
</head>
<body>

	<?php include "parts/navbar.php" ?>

	<div class="container">
		<div class="card soft">

			<h2>Purchase Confirmation</h2>

			<div>Thank you for buying</div>

			<div>
				<a href="product_list.php" class="form-button">Back to shopping</a>
			</div>
		
		</div>
	</div>
	
</body>
</html>