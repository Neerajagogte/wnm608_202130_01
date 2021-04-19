<?
require_once "lib/php/functions.php";
require_once "parts/template.php";

$product = getData("SELECT * FROM `products` WHERE `id` = {$_GET['id']}")[0];

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
		<div class="grid gap xs-small">
			<div class="col-xs-12 col-md-7">
				<div class="card-basic">
					<div class="product-imagemain">
						<img src="/images/store/<?= $product->thumbnail?>" alt="" class="image-fit">
					</div>
					<div class="product-thumbs">
						<?= 
							array_reduce(explode(",",$product->images),function($r,$o){
								return $r."<img src='/images/store/$o' alt=''>";
							})

						 ?>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-5">
				<form action="product_addtocart.php" class="card-basic card-flat" method="get">
					<div class="card-section">
						<div class="product-name">
							<h2><?= $product->title?></h2>
						</div>
						<div class="product-price">
							&dollar;<?= $product->price ?>
						</div>
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
		<div class="card-vasic">
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