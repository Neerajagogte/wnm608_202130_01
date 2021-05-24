<?php 

require_once "lib/php/functions.php";


if(!isset($_GET['action'])) die("No Action Set");


switch($_GET['action']) {
    case "add-to-cart":
        addToCart($_GET['id'],$_GET['amount'],$_GET['price']);
        header("location:product_addedtocart.php?id={$_GET['id']}");
        break;
    case "update-cart-amount":
        cartItemByID($_GET['id'])->amount = $_GET['amount'];
        header("location:product_cart.php");
        break;
    case "delete-cart-item":
        $_SESSION['cart'] = array_filter($_SESSION['cart'],function($o){ return $o->id!=$_GET['id']; });
        header("location:product_cart.php");
        break;
    case "update-cart-choice": break;
}

