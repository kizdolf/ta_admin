

$("#artistesListe").hide();

$("#artistesMenu").mouseenter(function(){
	$("#artistesListe").show();
	$("#quartiersListe").hide();
});

$("#artistesListe").mouseleave(function(){
	$(this).hide();
});

$("#quartiersListe").hide();

$("#quartiersMenu").mouseenter(function(){
	$("#artistesListe").hide();
	$("#quartiersListe").show();
});

$("#quartiersListe").mouseleave(function(){
	$(this).hide();
});
