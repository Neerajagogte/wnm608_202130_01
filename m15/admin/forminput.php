<?php 

include "../lib/php/functions.php";

$filename = "../data/products.json";
$products = file_get_json($filename);


$empty_product = (object)[
	"product_name"=>"",
	"product_description"=>"",
	"technical_specs"=>[],
	"price"=>""
];



// file_put_contents json_encode explode $_POST
// CRUD, Create Read Update Delete


// print_p([$_GET,$_POST]);

if(isset($_GET['action'])) {
	switch($_GET['action']) {
		case "update":
			$products[$_GET['id']]->product_name = $_POST['product-name'];
			$products[$_GET['id']]->product_description = $_POST['product-description'];
			$products[$_GET['id']]->technical_specs = explode(", ", $_POST['tech-specs']);
			$products[$_GET['id']]->price = $_POST['product-price'];

			file_put_contents($filename,json_encode($products));
			header("location:{$_SERVER['PHP_SELF']}?id={$_GET['id']}");
			break;
		case "create":
			$empty_product->product_name = $_POST['product-name'];
			$empty_product->product_description = $_POST['product-description'];
			$empty_product->technical_specs = explode(", ", $_POST['tech-specs']);
			$empty_product->price = $_POST['product-price'];

			$id = count($products->products);

			$products->$products[] = $empty_product;

			file_put_contents($filename,json_encode($products));
			header("location:{$_SERVER['PHP_SELF']}?id=$id");
			break;
		case "delete":
			array_splice($products->products,$_GET['id'],1);
			file_put_contents($filename,json_encode($products->products));
			header("location:{$_SERVER['PHP_SELF']}");
			break;
	}
}



function showUserPage($product) {

$id = $_GET['id'];
$addoredit = $id == "new" ? "Add" : "Edit";
$createorupdate = $id == "new" ? "create" : "update";
$technical_specs = implode(", ", $product->technical_specs);

// heredoc
$display = <<<HTML
<div>
	<h2>$product->product_name</h2>
	<div>
		<strong>Description</strong>
		<span>$product->product_description</span>
	</div>
	<div>
		<strong>Price</strong>
		<span>$product->price</span>
	</div>
	<div>
		<strong>Technical Specs</strong>
		<span>$technical_specs</span>
	</div>
</div>
HTML;

$form = <<<HTML
<form method="post" action="{$_SERVER['PHP_SELF']}?id=$id&action=$createorupdate">
	<h2>$addoredit User</h2>
	<div class="form-control">
		<label class="form-label" for="product-name">Name</label>
		<input class="form-input" name="product-name" id="product-name" type="text" value="$product->product_name" placeholder="Enter the Product Name">
	</div>
	<div class="form-control">
		<label class="form-label" for="product-description">Description</label>
		<input class="form-input" name="product-description" id="product-description" type="text" value="$product->product_description" placeholder="Enter the Product Description">
	</div>
	<div class="form-control">
		<label class="form-label" for="tech-specs">Technical Specs</label>
		<input class="form-input" name="tech-specs" id="tech-specs" type="text" value="$technical_specs" placeholder="Enter the Technical Specs, comma separated">
	</div>
	<div class="form-control">
		<label class="form-label" for="product-price">Price</label>
		<input class="form-input" name="product-price" id="product-price" type="text" value="$product->price" placeholder="Enter the Price">
	</div>
	<div class="form-control">
		<input class="form-button" type="submit" value="Save Changes">
	</div>
</form>
HTML;

$output = $id == "new" ? $form :
	"<div class='grid gap'>
		<div class='col-xs-12 col-md-7'>$display</div>
		<div class='col-xs-12 col-md-5'>$form</div>
	</div>
	";

$delete = $id == "new" ? "" : "<a href='{$_SERVER['PHP_SELF']}?id=$id&action=delete'>Delete</a>";


echo <<<HTML
<nav class="display-flex">
	<div class="flex-stretch"><a href="{$_SERVER['PHP_SELF']}">Back</a></div>
	<div class="flex-none">$delete</div>
</nav>
$output
HTML;
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Admin Page</title>

	<?php include "../parts/meta.php"; ?>
</head>
<body>

	<header class="navbar">
		<div class="container display-flex">
			<div class="flex-none">
				<h1>User Admin</h1>
			</div>
			<div class="flex-stretch"></div>
			<nav class="nav nav-flex flex-none">
				<ul>
					<li><a href="<?= $_SERVER['PHP_SELF'] ?>">User List</a></li>
					<li><a href="<?= $_SERVER['PHP_SELF'] ?>?id=new">Add New User</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<div class="container">

		<div class="card soft">

			<?php 

			if(isset($_GET['id'])) {
				showUserPage($_GET['id'] == "new" ? $empty_product : $products->products[$_GET['id']]);
			} else {

			?>
			<h2>User List</h2>

			<nav class="nav">
				<ul>
			<?php

			for($i=0;$i<count($products->products);$i++){
				echo "<li>
					<a href='{$_SERVER['PHP_SELF']}?id=$i'>{$products->products[$i]->product_name}</a>
				</li>";
			}

			?>
				</ul>
			</nav>

			<?php } ?>
		</div>
	</div>
	
</body>
</html>