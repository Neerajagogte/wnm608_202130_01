$(()=>{

	$(".product-thumbs img").on("click", function(e){
		let s = $(this).attr("src");
		$(".product-main img").attr("src",s);
	});
});