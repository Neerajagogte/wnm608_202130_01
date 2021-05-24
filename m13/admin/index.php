<?php


include_once "../lib/php/functions.php"

$empty_product = (object)[
	"title" => "",
	"price" => "",
	"category" => "",
	"description" => "",
	"main_image" => "",
	"images" => "",
	"quantity" => 0 
];



/* logic actions */

$conn = makePDOConn();
try {
	switch(@$_GET['action']) {
		case "update":

		$statement = $conn->prepare("UPDATE
			`products`
			SET
			`title`=?,
			`price`=?,
			`category`=?,
			`description`=?,
			`main_image`=?,
			`images`=?,
			`quantity`=?,
			`date_modify`=NOW()
			WHERE `id` =?
			");
		$statement->execute([
			$_POST["title"],
			$_POST["price"],
			$_POST["category"],
			$_POST["description"],
			$_POST["main_image"],
			$_POST["images"],
			$_POST["quantity"],
			$_GET["id"]
		]);

		header("location:{$_SERVER['PHP_SELF']}?id={$_GET['id']}");
		break;

		case "create":
		$statement = $conn->prepare("INSERT INTO
			`products`
			(
				`title`,
				`price`,
				`category`,
				`description`,
				`main_image`,
				`images`,
				`quantity`,
				`date_create`,
				`date_modify`
			)
			VALUES (?,?,?,?,?,?,?,NOW(),NOW())
			");
		$statement->execute([
			$_POST["title"],
			$_POST["price"],
			$_POST["category"],
			$_POST["description"],
			$_POST["main_image"],
			$_POST["images"],
			$_POST["quantity"]
		]);
		$id = $conn->lastInsertId();

		header("location:{$_SERVER['PHP_SELF']}?id=$id");
		break;

		case "delete":

		$statement = $conn->prepare("DELETE FROM `products` WHERE `id`=?");
		$statement->execute([$_GET['id']]);

		header("location:{$_SERVER['PHP_SELF']}");
		break;

		default: break;
	}
} catch(PDOException $e) {
	die($e->getMessage());
}



/* template */

function makeListItemTemplate($carry,$item) {
return $carry.<<<HTML
<div class='itemlist-item display-flex'>
	<div class="flex-none" style="width:6em;">
		<div class="image-square">
			<img src="/images/store/$item->main_image">
		</div>
	</div>
	<div class="flex-stretch">
		<div><strong>$item->title</strong></div>
		<div>$item->category</div>
	</div>
	<div class="flex-none">
		<div>[<a href='admin/?id=$item->id'>Edit</a>]</div>
		<div>[<a href='product_item.php?id=$item->id'>Visit</a>]</div>
	</div>
</div>
HTML;
}

function makeProductForm($o) {
	$id = $_GET['id'];
	$addoredit = $id=='new' ? 'Add': 'Edit';
	$createorupdate = $id=='new' ? 'create' : 'update';

echo <<<HTML
<div class="display-flex">
	<div class="flex-stretch">
		<a href="admin/">Back</a>
	</div>
	<div class="flex-none">
		[<a href="admin/?id=$id&action=delete">Delete</a>]
	</div>
</div>
<form class="card-basic" method="post" action="admin/?id=$id&action=$createorupdate">
	<h2>addoredit Product</h2>
	<div class="form-control">
		<label class="form-label" for="title">Title</label>
		<input class="form-input" id="title" name="title" type="text" value="$o->title">
	</div>
	<div class="form-control">
		<label class="form-label" for="price">Price</label>
		<input class="form-input" id="price" name="price" type="number" value="$o->price" min="1" max="1000" step="0.01">
	</div>
	<div class="form-control">
		<label class="form-label" for="category">Category</label>
		<input class="form-input" id="category" name="category" type="text" value="$o->category">
	</div>
	<div class="form-control">
		<label class="form-label" for="description">Description</label>
		<textarea class="form-input" id="description" name="description">$o->description</textarea>
	</div>
	<div class="form-control">
		<label class="form-label" for="main_image">Main Image</label>
		<input class="form-input" id="main_image" name="main_image" type="text" value="$o->main_image">
	</div>
	<div class="form-control">
		<label class="form-label" for="images">Other Images</label>
		<input class="form-input" id="images" name="images" type="text" value="$o->images">
	</div>
	<div class="form-control">
		<label class="form-label" for="quantity">Quantity</label>
		<input class="form-input" id="quantity" name="quantity" type="text" value="$o->quantity">
	</div>
	<div class="form-control">
		<input class="form-input" type="submit" value="Confirm">
	</div>	
</form>
HTML:
}


/* layout */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Product Admin</title>
<? include "../parts/meta.php" ?>
</head>
<body>
	<header class="navbar">
		<div class="container display-flex">
			<div class="flex-stretch">
				<h1>Product Admin</h1>
			</div>
			<nav class="nav nav-flex flex-none">
				<ul>
				
					<li><a href="index.php">Store</a></li>
					<li><a href="admin/">List</a></li>
					<li><a href="admin/?id=new">Add New Products</a></li>
					</li>
				</ul>
			</nav>
		</div>
	</header>
	<div class="container">
		<div class="card">
			<?
			if(isset($_GET['id'])) {
				if($_GET['id']=='new') {
					makeProductForm($empty_product);
				} else{
					$data = getData("SELECT * FROM `products` WHERE `id` = '{$_GET['id']}'");
					makeProductForm($data[0]);
				}
			} else{
				?>
				<h2>Product List</h2>

				<div class="itemList">
					<?
						$data = getData("SELECT * FROM `products`");

						echo array_reduce($data, 'makeListItemTemplate');
					?>
				</div>
			<?
			}
			?>
		</div>
	</div>
</body>
</html>













