<?php


session_start();


// print pretty
function print_p($v) {
   echo "<pre>",print_r($v),"</pre>";
}


function getFileData($url) {
   $file = file_get_contents($url);
   $data = json_decode($file);
   return $data;
}


include_once "auth.php";  // ************ authorization ***************
function makeConn() {
    if(!function_exists('makeAuth')) die("No makeAuth, check in auth.php");
    
    @$conn = new mysqli(...makeAuth());

    if($conn->connect_errno) die($conn->connect_error);

    $conn->set_charset("utf8");

    return $conn;
}


function makePDOConn() {
    if(!function_exists('makePDOAuth')) die("No makeAuth, check in auth.php");

    try {
        $conn = new PDO(...makePDOAuth());
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    return $conn;
}


function getData($sql) {
   $conn = makeConn();

   $result = $conn->query($sql);

   if($conn->errno) die($conn->error);

   $arr = [];
   while($row = $result->fetch_object()) $arr[]=$row;

   $conn->close();

   return $arr;
}





//  CART FUNCTIONS

function array_find($array,$fn) {
   foreach($array as $o) if($fn($o)) return $o;
   return false;
}

function addToCart($id,$amount,$price) {
   $cart = isset($_SESSION['cart'])?$_SESSION['cart']:[];
   $p = array_find(
      $cart,
      function($o) use ($id) { return $o->id==$id; }
   );

   if($p) {
      $p->amount += $amount;
   } else {
      $_SESSION['cart'][] = (object) ["id"=>$id,"amount"=>$amount,"price"=>$price];
   }
}

function getCartTotal($fn) {
   $cart = isset($_SESSION['cart'])?$_SESSION['cart']:[];
   return array_reduce($cart,function($r,$o) use ($fn) {return $fn($r,$o);},0);
}
function getCartTotalItems() {
   return getCartTotal(function($r,$o){ return $r+$o->amount; });
}
function getCartTotalPrice() {
   $cart = isset($_SESSION['cart'])?$_SESSION['cart']:[];
   return array_reduce($cart,function($r,$o){ return $r+($o->amount*$o->price); });
}



function getCartItems() {
   $cart = isset($_SESSION['cart'])?$_SESSION['cart']:[];

   if(empty($cart)) return [];

   $ids = implode(",",array_map(function($o){return $o->id;},$cart));

   $data = getData("SELECT * FROM `products` WHERE id IN ($ids)");

   return array_map(function($dp) use ($cart){
      $p = array_find($cart,function($cp) use ($dp) { return $cp->id==$dp->id; });
      $dp->amount = $p->amount;
      $dp->total = $p->amount * $dp->price;
      return $dp;
   },$data);
}


/* 
function makeCartBadge() {
   $cart = getCart();
   if(count($cart)==0) {
      return "";
   } else {
      // return count($cart);
      return array_reduce($cart,function($r,$o){return $r+$o->amount;});
   }
}
*/