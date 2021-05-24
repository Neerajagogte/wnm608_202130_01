<!DOCTYPE html>
<html lang="en">
<head>
    <title>Furniture Store: Checkout</title>

    <?php include "parts/meta.php" ?>
</head>
<body>
    <div class="container">
        
        <nav class="nav-crumbs" style="margin:1em 0">
            <ul>
                <li><a href="product_list.php">Back</a></li>
            </ul>
        </nav>
        <div class="grid gap">
            <div class="col-xs-12 col-md-8">
                <div class="card soft">

                        <h2>Checkout Information</h2>

                        <form>
                            <div class="form-control">
                            <label for="checkout-card-name" class="form-label">Name On Card</label>
                            <input type="text" class="form-input" id="checkout-card-name" name="checkout-card-name">
                        </div>
                        <div class="form-control">
                            <label for="checkout-card-number" class="form-label">Card Number</label>
                            <input type="text" class="form-input" id="checkout-card-number" name="checkout-card-number">
                        </div>
                        <div class="form-control">
                            <label for="checkout-card-expiration-month" class="form-label">Expiration Month</label>
                            <input type="text" class="form-input" id="checkout-card-expiration-month" name="checkout-card-expiration-month">
                        </div>
                        <div class="form-control">
                            <label for="checkout-card-expiration-year" class="form-label">Expiration Year</label>
                            <input type="text" class="form-input" id="checkout-card-expiration-year" name="checkout-card-expiration-year">
                        </div>
                        <div class="form-control">
                            <label for="checkout-card-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-input" id="checkout-card-cvv" name="checkout-card-cvv">
                        </div>
                        
                        <h3>Billing Address</h3>

                        <div class="form-control">
                            <label for="checkout-address-name" class="form-label">Full Name</label>
                            <input type="text" class="form-input" id="checkout-address-name" name="checkout-address-name">
                        </div>
                        <div class="form-control">
                            <label for="checkout-address-email" class="form-label">Email Address</label>
                            <input type="email" class="form-input" id="checkout-address-email" name="checkout-address-email">
                        </div>
                        <div class="form-control">
                            <label for="checkout-address-street" class="form-label">Street</label>
                            <input type="text" class="form-input" id="checkout-address-street" name="checkout-address-street">
                        </div>
                        <div class="form-control">
                            <label for="checkout-address-city" class="form-label">City</label>
                            <input type="text" class="form-input" id="checkout-address-city" name="checkout-address-city">
                        </div>
                        <div class="form-control">
                            <label for="checkout-address-state" class="form-label">State</label>
                            <input type="text" class="form-input" id="checkout-address-state" name="checkout-address-state">
                        </div>
                        <div class="form-control">
                            <label for="checkout-address-zip" class="form-label">Zip</label>
                            <input type="text" class="form-input" id="checkout-address-zip" name="checkout-address-zip">
                        </div>

                    </form>


                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="card soft">
                    
                    <div>
                        <a href="product_confirmation.php" class="form-button">Complete Payment</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</body>
</html>