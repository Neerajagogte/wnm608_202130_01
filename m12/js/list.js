const showResults = (d) => {
	$(".product-list").html(
		d.result.length==0?"No Results":
		productListTemplate(d.result)
		);
}

getData('products-all',{}).then(showResults);

$(() =>{
	$(".list-search").on("submit", function(e){
		e.preventDefault();
		getData('products-search', {
			search:$(".list-search>input").val()
		}).then(showResults);
	});

	$(".form-button.filter").on("click", function(e){
		getData('products-filter',{
			type:$(this).data("type"),
			value:this.value
			}).then(showResults);
	})

	$(".sort").on("change", function(e){
		(
			this.value==1 ?
				getData("products-sort", {type:"date_create",dir:"DESC"}) :
			this.value==2 ?
				getData("products-sort", {type:"date_create",dir:"ASC"}) :
			this.value==3 ?
				getData("products-sort", {type:"price",dir:"DESC"}) :
			this.value==4 ?
				getData("products-sort", {type:"price",dir:"ASC"}) :
			getData('products-all')
			).then(showResults);
	})


});