$(()=>{

	$(".product-thumbs img").on("mouseenter", function(e){
		let s = $(this).attr("src");
		$(".product-imagemain img").attr("src",s);
	});
});