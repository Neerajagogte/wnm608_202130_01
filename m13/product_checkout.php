<?php 

include_once "lib/php/functions.php";
include_once "parts/template.php";

$cartItems = getCartItems();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Furniture Store: <?= $product->title ?></title>

    <?php include "parts/meta.php" ?>
</head>
<body>
    <div class="container pad push-down">
        
        <nav class="nav-crumbs">
            <ul>
                <li><a href="product_cart.php">Back</a></li>
            </ul>
        </nav>
        <div class="grid gap">
            <div class="col-xs-12 col-md-8">
                <form action="/action_page.php" class="card-basic">

                    <div class="grid gap">
                        <div class="col-xs-12 col-md-6">
                            <h3>Billing Address</h3>
                            <div class="form-control">
                                <label class="form-label" for="name">Full Name</label>
                                <input class="form-input" type="text" id="fullname" name="firstname" placeholder="John Doe">
                            </div>
                            <div class="form-control">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-input" type="text" id="email" name="email" placeholder="john@doe.com">
                            </div>
                            <div class="form-control">
                                <label class="form-label" for="adr">Address</label>
                                <input class="form-input" type="text" id="address" name="address" placeholder="555 Street Name">
                            </div>
                            <div class="form-control">
                                <label class="form-label" for="city">City</label>
                                <input class="form-input" type="text" id="city" name="city" placeholder="San Francisco">
                            </div>

                            <div class="grid gap">
                                <div class="col-xs-12 col-md-6">
                                    <label class="form-label" for="state">State</label>
                                    <input class="form-input" type="text" id="state" name="state" placeholder="CA">
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label class="form-label" for="zip">Zip</label>
                                    <input class="form-input" type="text" id="zip" name="zip" placeholder="10001">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <h3>Payment</h3>
                            <div class="form-control">
                                <label class="form-label" for="cname">Name on Card</label>
                                <input class="form-input" type="text" id="cname" name="cardname" placeholder="Hugely McCracken">
                            </div>
                            <div class="form-control">
                                <label class="form-label" for="ccnum">Credit card number</label>
                                <input class="form-input" type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                            </div>
                            <div class="form-control">
                                <label class="form-label" for="expmonth">Exp Month</label>
                                <input class="form-input" type="text" id="expmonth" name="expmonth" placeholder="12">
                            </div>

                            <div class="grid gap">
                                <div class="col-xs-12 col-md-6">
                                    <label class="form-label" for="expyear">Exp Year</label>
                                    <input class="form-input" type="text" id="expyear" name="expyear" placeholder="2020">
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label class="form-label" for="cvv">CVV</label>
                                    <input class="form-input" type="text" id="cvv" name="cvv" placeholder="519">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-control">
                        <label><input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing</label>
                    </div>
                </form>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="card-basic card-flat">
                    <div class="card-section">
                        <?=
                        count($cartItems)?
                        array_reduce($cartItems,'cartListMinimalTemplate'):
                        "No items in cart."
                        ?>
                    </div>
                    <?= cartTotals(true) ?>
                    <div class="card-section">
                        <a href="product_confirmation.php" class="form-button confirm">Complete Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>