<?
require_once "lib/php/functions.php";
require_once "parts/template.php";

$product = getdata("SELECT * FROM `product` WHERE `id` = '{$_GET[`id`]}'") [0];

$totalCartItems = getCartTotalItems();
$totalCartPrice = getCartTotalPrice();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Furniture Store: <?=$product->title?> added to cart</title>

	<? include "parts/meta.php";?>

	
</head>
<body>

	<? include "parts/navbar.php"; ?>

	<div class="container pad push-down">
			<nav class="nav-crumbs">
				<ul>
					<li><a href="product_list.php">Back</a></li>
				</ul>
			</nav>
		
		<div class="card-basic">
			<div class="display-flex">
				<div class="flex-none">
					<div class="product-thumbs">
						<a href="product_item.php?id=<?= $product->id?>">
							<img src="/images/store/<?= $product-> thumbnail ?>" alt="">
						</a>
					</div>
				</div>
				<div class="flex-stretch">
					<p><?= $product->title ?> added to cart. (<?= $totalCartItems ?>)
					&dollar;<?= $totalCartPrice?> </p>
				</div>
				<div class="flex-none">
					<div class="display-flex">
						<div>
							<a href="product_list.php" class="form-button lined">Continue Shopping</a>
						</div>
						<div>
							<a href="product_cart.php">Go To Cart</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr class="spacer">
		<h2>Other Products</h2>

		<div class="grid gap xs-small md-medium product-list">
			<?
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
