<?
require_once "lib/php/functions.php";
require_once "parts/template.php";

$product = makeQuery(makeConn(), "SELECT * FROM `products` WHERE `id`=".$_GET['id'])[0];

$images = explode(",", $product->images);

$image_elements = array_reduce($images,function($r, $o){
	return $r. "<img src='images/store/$o'>";
})

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Furniture Store Single item: <?= $product->title?></title>

	<? include "parts/meta.php" ?>
</head>
<body>
	<? include "parts/navbar.php" ?>

	<div class="container pad push-down">
		<nav class="nav-crumbs">
			<ul>
				<li><a href="product_list.php">Back</a></li>
			</ul>
		</nav>

		
		<h2><?= $product->title?></h2>
		<div class="grid gap">
			<div class="col-xs-12 col-md-7">
				<div class="card soft">
					<div class="images-main">
						<img src="/images/store/<?= $product->main_image ?>" >
					</div>
					<div class="images-thumbs">
						<?= $image_elements ?>

					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-5">
				<form class="card soft flat" method="post" action="cart_actions.php?action=add-to-cart">
				
				<input type="hidden" name="product-id" value="<?= $product->id ?>">

					<div class="card-section">
						<h2 class="product-title"><?= $product->title ?></h2>
						<div class="product-category"><em><?= $product->category ?></em></div>
						<div class="product-description"><em><?= $product->description ?></div>
						<div class="product-price">
							&dollar;<?= $product->price ?></div>
						
					</div>
					<div class="card-section">
						<div class="display-flex" style="align-items: center;">
							<div class="flex-stretch">
								<strong>Amount</strong>
							</div>
							<div class="flex-none form-select">
								<select name="amount">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
									<option>7</option>
									<option>8</option>
									<option>9</option>
									<option>10</option>
								</select>
							</div>
						</div>
					</div>
					<div class="card-section">
						<input type="hidden" name="id" value="<?= 
						$product->id ?>">
						<input type="submit" class="form-button" value="Add To Cart">
					</div>
				</form>
			</div>
		</div>
		<div class="card-basic">
			<div class="product-description">
				<p><?= $product->description ?></p>
			</div>
		</div>

		<hr class="spacer">
		
		<h2>Related Products</h2>

		<div class="grid gap xs-small md-medium product-list">
			<?
				$data = getData("
						SELECT *
						FROM `products`
						WHERE id <> '$product->id'
						AND category = '$product-category'
						ORDER BY rand()
						LIMIT 4
					");

			?>
		</div>

	</div>
</body>
</html>