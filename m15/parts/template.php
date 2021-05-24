<?php


function productListTemplate($r,$o) {
return $r.<<<HTML
<div class="col-xs-6 col-md-4">
   <a href="product_item.php?id=$o->id" class="display-block">
      <figure class="product-figure soft">
         <div class="product-image">
            <img src="images/store/$o->main_image" alt="">
         </div>
         <figcaption class="product-description">
            <div class="product-price">&dollar;$o->price</div>
            <div class="product-title">$o->title</div>
         </figcaption>
      </figure>
   </a>
</div>
HTML;
}




function cartListTemplate($r,$o) {
// $hascase = rand(0,1) ? "case: big" : "";
// $amount = rand(1,5);
$pricefixed = number_format($o->total,2,'.','');
$selectAmount = selectAmount($o->amount);
return $r.<<<HTML
<div class="display-flex card-section">
   <div class="flex-none product-thumbs">
      <img src="images/store/$o->main_image">
   </div>
   <div class="flex-stretch">
      <div class="display-flex">
         <div class="flex-stretch">
            <strong>$o->title ($o->amount)</strong>
         </div>
         <div class="flex-none">
            &dollar;$pricefixed
         </div>
      </div>
      <div class="display-flex" style="font-size:0.8em">
         <form class="flex-none" method="get" action="form_actions.php">
            <input type="hidden" name="action" value="delete-cart-item">
            <input type="hidden" name="id" value="$o->id">
            <button type="submit" class="form-button">Delete</button>
         </form>
         <div class="flex-stretch"></div>
         <form class="flex-none" method="get" action="form_actions.php" onchange="this.submit()">
            <input type="hidden" name="action" value="update-cart-amount">
            <input type="hidden" name="id" value="$o->id">
            $selectAmount
         </form>
      </div>
   </div>
</div>
HTML;
}



function selectAmount($amount=1,$total=10) {
   $output = "<select name='amount' class='form-button'>";
   for($i=1;$i<=$total;$i++) {
      $output .= "<option ".($i==$amount?"selected":"").">$i</option>";
   }
   $output .= "</select>";
   return $output;
}





function cartTotals() {
$cart = getCart();

$cartprice = array_reduce($cart,function($r,$o){return $r + ($o->amount*$o->price);},0);

$pricefixed = number_format($cartprice,2,'.','');
$taxfixed = number_format($cartprice*0.0725,2,'.','');
$taxedfixed = number_format($cartprice*1.0725,2,'.','');

return <<<HTML
<div class="card-section">
   <h2>Totals</h2>
   <div class="display-flex">
      <div class="flex-stretch">
         <strong>Sub Total</strong>
      </div>
      <div class="flex-none">
         <span>&dollar;$pricefixed</span>
      </div>
   </div>
   <div class="display-flex">
      <div class="flex-stretch">
         <strong>Tax</strong>
      </div>
      <div class="flex-none">
         <span>&dollar;$taxfixed</span>
      </div>
   </div>
</div>
<div class="card-section">
   <div class="display-flex">
      <div class="flex-stretch">
         <strong>Total</strong>
      </div>
      <div class="flex-none">
         <span>&dollar;$taxedfixed</span>
      </div>
   </div>
</div>
HTML;
}




function makeCartBadge() {
   if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
      return "";
   } else return "(".array_reduce($_SESSION['cart'],function($r,$o){ return $r + $o->amount; },0).")";
}




function makeListItemTemplate($r,$o) {
return $r.<<<HTML
<div class="itemlist-item display-flex">
   <div class="flex-none">
      <div class="image-square">
         <img src="images/store/$o->main_image">
      </div>
   </div>
   <div class="flex-stretch">
      <div><strong>$o->title</strong></div>
      <div><span>$o->category</span></div>
   </div>
   <div class="flex-none">
      <div><a href="admin/?id=$o->id" class="form-button">Edit</a></div>
      <div><a href="product_item.php?id=$o->id" class="form-button">Visit</a></div>
   </div>
</div>
HTML;
}





function productList($rows) {
   $products = array_reduce($rows,'productListTemplate');
   echo "<div class='grid gap productlist'>$products</div>";
}

function recommendedCategory($cat,$limit=3) {
   $sql = "SELECT * FROM `products` WHERE `category`='$cat' ORDER BY `date_create` DESC LIMIT $limit";
   productList(getRows(makeConn(),$sql));
}

function recommendedProducts($cat,$id=0,$limit=3) {
   $sql = "SELECT * FROM `products` WHERE `category`='$cat' AND `id`<>$id ORDER BY rand() DESC LIMIT $limit";
   productList(getRows(makeConn(),$sql));
}





