
$('.menu_ul li a').click(function(){
	$('.menu_ul li a').each(function(){
		$(this).removeClass('active');
	});
	$(this).addClass('active');
});

$('#send_msg').click(function(){
	console.log("new message incomming!");
	$mail = $("input[name$='mail']").val();
	$sub = $("input[name$='subject']").val();
	$text = $("textarea[name$='text']").val();
	alert("Mail = " + $mail + "subject = " + $subject + "text = " + $text);
});

$(document).on('click', "#send_msg", function(){
	$c  = $("recaptcha_resposonse_field");
	console.log("test");
	console.log($c);

});

$('.sous_menu').hide();

$('.menu_header').on('mouseenter', function(){
	$('.sous_menu').show();
	setTimeout(function(){
		$('.sous_menu').hide();
	}, 7000);
});

$('.sous_menu li a').click(function(){
	$('.sous_menu').hide();
});
