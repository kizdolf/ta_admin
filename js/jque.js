
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