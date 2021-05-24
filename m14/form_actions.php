<?php 

require_once "lib/php/functions.php";


switch($_GET['action']) {
    case "add-to-cart":

        $product = getData("SELECT * FROM `products` WHERE `id`='{$_GET['id']}'")[0];
        addToCart($_GET['id'],$_GET['amount'],$product->price);
        header("location:product_addedtocart.php?id={$_GET['id']}");
        break;

    case "update-cart-amount":

        $p = array_find($_SESSION['cart'],function($o){ return $o->id==$_GET['id']; });
        $p->amount = $_GET['amount'];
        header("location:product_cart.php");
        break;

    case "delete-cart-item":

        $_SESSION['cart'] = array_filter($_SESSION['cart'],function($o){ return $o->id!=$_GET['id']; });
        header("location:product_cart.php");
        break;

    default:
        die("Action incorrect or not set.");
}
