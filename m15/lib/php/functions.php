<?php


session_start();



function print_p($v) {
   echo "<pre>",print_r($v),"</pre>";
}


function getData($str) {
   return json_decode(file_get_contents($str));
}


// include, require, include_once, require_once
include_once "auth.php";
function makeConn() {
   @$conn = new mysqli(...makeAuth());

   if($conn->connect_errno) die($conn->connect_error);

   $conn->set_charset('utf8');

   return $conn;
}
function makePDOConn() {
   try {
      $conn = new PDO(...makePDOAuth());
   } catch(PDOException $e) {
      die($e->getMessage());
   }
   return $conn;
}


function getRows($conn,$sql) {
   $a = [];

   $result = $conn->query($sql);

   if($conn->errno) die($conn->error);

   while($row = $result->fetch_object()) {
      $a[] = $row;
   }

   return $a;
}









// CART FUNCTIONS

function array_find($array,$fn) {
   foreach($array as $o) if($fn($o)) return $o;
   return false;
}


function getCart() {
   if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) $_SESSION['cart'] = [];
   return $_SESSION['cart'];
}

function addToCart($id,$amount,$price) {
   $cart = getCart();

   $p = cartItemByID($id);

   if($p) {
      $p->amount += $amount;
   } else {
      $price = getRows(makeConn(),"SELECT `price` FROM `products` WHERE `id` = $id")[0]->price;
      $_SESSION['cart'][] = (object) [
         "id"=>$id,
         "amount"=>$amount,
         "price"=>$price
      ];
   }

}


function getCartItems() {
   $cart = getCart();

   $ids = empty($cart) ? 0 : implode(",",array_map(function($o){return $o->id;},$cart));
   $sql = "SELECT *
      FROM `products`
      WHERE `id` IN ($ids)
      ";

   $database_result = getRows(
      makeConn(),
      $sql
   );

   return array_map(function($o) use ($cart){
      $cart_o = array_find($cart,function($c) use($o) { return $c->id==$o->id; });
      $o->amount = $cart_o->amount;
      $o->total = $o->price * $cart_o->amount;
      return $o;
   },$database_result);
}

function cartItemByID($id) {
   return array_find(getCart(),function($o) use ($id){return $o->id==$id;});
}