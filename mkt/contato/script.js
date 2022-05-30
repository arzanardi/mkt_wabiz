

function zap(track) {
	
	document.getElementById("welcome").classList.add("hide");
		
	document.getElementById("end").classList.remove("hide");

	var message = "Olá! Gostaria de mais informações sobre o aplicativo próprio para o meu *#delivery*";

	window.open('https://wa.me/5511986598313?text=' + encodeURI(message));

	if(track)
		trackContact();
}