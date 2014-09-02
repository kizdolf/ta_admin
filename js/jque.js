
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