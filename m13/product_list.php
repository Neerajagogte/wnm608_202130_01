<?php

require_once "lib/php/functions.php";
require_once "parts/template.php";

$pagelimit = 12;
$pageoffset = isset($_GET['page'])?$_GET['page']:0;

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
   <title>Product List</title>

   <?php include "parts/meta.php" ?>

   <script src="js/list.js"></script>
</head>
<body>
   
   <?php include "parts/navbar.php" ?>

   

   <div class="container pad push-down">
       <div class="grid gap">
          <div class="col-xs-12 col-md-3 col-lg-2">
             <div class="card-basic card-flat">
                <div class="card-section">
                   <div>
                      Filter
                   </div>
                </div>
                <div class="card-section">
                   <input type="button" class="form-button filter" 
                   data-type="category" value="chair">
                   <input type="button" class="form-button filter" 
                   data-type="category" value="ottoman">
                </div>
                <div class="card-section">
                   <div>Sort</div>
                </div>
                <div class="card-section">
                   <div class="form-section">
                      <select class="sort">
                         <option value="1">Newest</option>
                         <option value="2">Oldest</option>
                         <option value="3">Most Expensive</option>
                         <option value="4">Least Expensive</option>
                      </select>
                     </div>
                    </div>
              </div>
           </div>
            <div class="col-xs-12 col-md-9 col-lg-10">
                <form class="push-down list-search">
                    <input class="form-input hotdog" type="search" name="search" placeholder="Search">
                </form>
                <div class="product-list"></div>
            </div>
        </div>
    </div>
    
</body>
</html>