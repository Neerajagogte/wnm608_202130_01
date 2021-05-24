<?
include_once "lib/php/functions.php";

$_SESSION['cart'] = [];
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Furniture Store: <?= $product->title ?></title>

	<? include "parts/meta.php" ?>
</head>
<body>

	<? include "parts/navbar.php" ?>

	<div class="container">
        <div class="card-basic">Thank you for your order.</div>
    </div>

	
</body>
</html>