const makeProductList = templater(o=>{
return `
<div class="col-xs-6 col-md-4">
	<a href="product_item.php?id=${o.id}" class="display-block">
		<figure class="product-figure soft">
			<div class="product-image card">
				<img src="images/store/${o.main_image}" alt="">
			</div>
			<figcaption class="product-description">
				<div class="product-price">&dollar;${o.price.toFixed(2)}</div>
				<div class="product-title">${o.title}</div>
			</figcaption>
		</figure>
	</a>
</div>
`;
})
