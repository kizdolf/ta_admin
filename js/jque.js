
$('.menu_ul li a').click(function(){
	$('.menu_ul li a').each(function(){
		$(this).removeClass('active');
	});
	$(this).addClass('active');
})