<?
	include_once "lib/php/functions.php";
	include_once "parts/template.php";

$result = getCartItems();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Furniture Store: Cart</title>
	<? include "parts/meta.php" ?>
</head>
<body>
	<? include "parts/navbar.php" ?>

	<div class="container">
		<nav class="nav-crumbs" style="margin:1em 0">
			<ul>
				<li><a href="product_list.php">Back</a></li>
			</ul>
		</nav>

		<div class="grid gap">
			<div class="col-xs-12 col-md-8">
				<div class="card flat">
				<?php
				echo array_reduce($result,'cartListTemplate');
				?>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="card flat">
					<?= cartTotals(); ?>
					<div class="card-section">
						<a href="product_checkout.php" class="form-button-dark">Checkout</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>