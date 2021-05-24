<?php


function productListTemplate($r,$o) {
return $r.<<<HTML
<div class="col-xs-6 col-md-4 col-lg-3">
   <a href="product_item.php?id=$o->id" class="product-item card card-soft card-light card-flat">
         <div class="image-square">
            <img src="/images/store/$o->main_image" alt="">
         </div>
         <div class="product-description">
            <div>$o->title</div>
            <div>&dollar;$o->price</div>
         </div>
   </a>
</div>
HTML;
}




function cartListTemplate($r,$o) {
$price = number_format($o->price, 2, '.', '');
$total = number_format($o->total, 2, '.', '');

$amount = selectAmount($o->amount,10,"flex-none");

return $r.<<<HTML
<div class="display-flex">
   <div class="flex-none" style="width:6em">
      <a href="product_item.php?id=$o->id" class="display-block"><div class="image-square">
         <img src="/images/store/$o->main_image" alt="">
      </div></a>
   </div>
   <div class="product-description flex-stretch">
      <div class="display-flex">
         <div class="flex-stretch"><strong style="font-size:1.25em">$o->title</strong> ($o->amount)</div>
         <div><strong>&dollar;$total</strong></div>
      </div>
      <div class="display-flex">
         <form style="font-size:0.8em" method="get" action="form_actions.php">
            <input type="hidden" name="action" value="delete-cart-item">
            <input type="hidden" name="id" value="$o->id">
            <button type="submit" class="form-button">delete</button>
         </form>
         <div class="flex-stretch"></div>
         <form style="align-items:center" method="get" action="form_actions.php" onchange="this.submit()">
            <input type="hidden" name="action" value="update-cart-amount">
            <input type="hidden" name="id" value="$o->id">
            <span>$amount</span>
         </form>
      </div>
   </div>
</div>
HTML;
}




function cartListMinimalTemplate($r,$o) {
$price = number_format($o->price, 2, '.', '');
$total = number_format($o->total, 2, '.', '');

return $r.<<<HTML
<div class="display-flex">
   <div class="flex-stretch"><strong>$o->title</strong> ($o->amount)</div>
   <div>&dollar;$total</div>
</div>
HTML;
}

function cartTotals($tax=false) {
$cartitems = getCartTotalItems();
$cartprice = getCartTotalPrice();

$pricefixed = number_format($cartprice, 2, '.', '');
$taxfixed = number_format($cartprice*0.0725, 2, '.', '');
$taxedfixed = number_format($cartprice*1.0725, 2, '.', '');

$output = <<<HTML
<div class="card-section display-flex">
    <div class="flex-stretch">Subtotal ($cartitems):</div>
    <div class="flex-none">&dollar;$pricefixed</div>
</div>
HTML;
$outputtaxed = <<<HTML
<div class="card-section display-flex">
    <div class="flex-stretch">Taxes:</div>
    <div class="flex-none">&dollar;$taxfixed</div>
</div>
<div class="card-section display-flex">
    <div class="flex-stretch">Total:</div>
    <div class="flex-none">&dollar;$taxedfixed</div>
</div>
HTML;
return $output.($tax?$outputtaxed:'');
}






function selectAmount($amount=1,$total=10,$class="") {
   $output = "<div class='form-select $class'><select name='amount'>";
   for($i=1;$i<=$total;$i++) {
      $output .= "<option ".($i==$amount?"selected":"").">$i</option>";
   }
   $output .= "</select></div>";
   return $output;
}


function makeCartBadge() {
   if(!isset($_SESSION['cart']) || !count($_SESSION['cart'])) {
      return "";
   } else return "(".getCartTotalItems().")";
}





