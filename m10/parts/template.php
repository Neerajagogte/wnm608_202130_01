<?
function productListTemplate($r,$o) {
	return $r.<<<HTML
	<div class = "col-xs-6 col-md-4 col-lg-3">
	<a href="product_item.php?id=$o->id" class="product-item card card-soft card-light card-flat">
	<div class="image-square">
		<img src="/images/store/$o->thumbnai" alt="">
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
	$price = number_format($o->price,2,'.','');
	$total = number_format($o->total,2,'.','');
return $r.<<<HTML
<div class="display-flex">
	<div class="flex-none" style="width:6em;">
	<a href="product_item.php?id=$o->id" class="display-block">
		<div class="image-square">
			<img src="/images/store/$o->thumbnail" alt="">
		</div>
	</a>
	</div>
	<div class="product-description flex-stretch">
		<div class="display-flex">
			<div class="flex-stretch">
				<strong style="font-size: 1.25em;">$o->title
				</strong>
			</div>
		</div>
		<div><strong>Amount</strong> $o->amount</div>
		<div><strong>Price</strong> &dollar;$price</div>
	</div>
</div>
HTML;
}



?>