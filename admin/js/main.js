$(function() {
	$("a#main-button").on("click", function(){
		$(this).next().slideToggle();
	});

	$("nav.movil-nav").on("click", function(){
		$(".logo-admin").show();
		$("aside.aside-admin").show();
	});

	$("section.main").on("click", function(){
		$(".logo-admin").hide();
		$("aside.aside-admin").hide();	
	});
});