<?php
require_once "lib/php/functions.php";
require_once "parts/template.php";

$product = getData("SELECT * FROM `products` WHERE `id` = '{$_GET['id']}'") [0];

$totalCartItems = getCartTotalItems();
$totalCartPrice = getCartTotalPrice();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Furniture Store: <?=$product->title?> added to cart</title>

	<?php include "parts/meta.php"; ?>

	
</head>
<body>

	<?php include "parts/navbar.php"; ?>

	<div class="container pad push-down">
		<div class="card-basic">
			<div class="display-flex">
				<div>
					<a href="product_list.php" class="form-button lined">Continue Shopping</a>
				</div>
				<div class="flex-stretch"></div>
				<div>
					<a href="product_cart.php" class="form-button">Go To Cart</a>
				</div>
			</div>
			<div class="display-flex">
				<div class="flex-none">
					<div class="product-thumbs">
						<a href="product_item.php?id=<?= $product->id?>"><img src="images/store/<?= $product->main_image ?>" alt=""></a>
					</div>
				</div>
				<div class="flex-stretch">
					<p><?= $product->title ?> added to cart.</p>
				</div>
				<div class="flex-none">
					<?= cartTotals(false) ?>
				</div>
			</div>

			<div class="display-flex">
				<div class="display-stretch"></div>
				<div>
					<a href="product_checkout.php" class="form-button">Proceed to Checkout</a>
				</div>
			</div>
		</div>


		<hr class="spacer">

		<h2>Other Products</h2>

		<div class="grid gap xs-small md-medium product-list">
			<?php
				$data = getData("
					SELECT *
					FROM `products`
					WHERE id <> '$product->id'
					ORDER BY rand()
					LIMIT 4
					");

				echo array_reduce($data, 'productListTemplate');
			?>
		</div>
	</div>

</body>
</html>
