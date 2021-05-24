$(()=>{
	$(".image-thumbs img").on("mouseenter", function(e){
		let s = $(this).attr("src");
		$(".image-main img").attr("src",s);
	})

	});