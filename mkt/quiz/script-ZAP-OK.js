const phoneInputField = document.querySelector("#phone-answer");
const phoneInput = window.intlTelInput(phoneInputField, {
	initialCountry: "br",
	utilsScript:
	"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
	
	var result = {
	name: null,
	email: null,
	phone: null,
	perfil: null,
	type: null,
	orders: null, 
	ordersValue: null
}
document.getElementById("continua-1").addEventListener("click", goPerfil);

function goPerfil() {
	document.getElementById("welcome").classList.add("hide");
	document.getElementById("perfil").classList.remove("hide");
}

var perfilButtons = document.getElementsByName("perfil-answer");
for(const b of perfilButtons) {
	b.addEventListener("click", function() { 

		result.perfil = b.innerText;
		goName(b);
	 });
}

function goType(button) {
	if(button.id == 'perfil-0') {
		document.getElementById("question-type").innerText = "Qual tipo de estabelecimento deseja abrir?";
	}
	document.querySelector('body').style.justifyContent = 'normal';
	document.getElementById("perfil").classList.add("hide");
	document.getElementById("name").classList.remove("hide");

	result.perfil = button.innerText;
}

var typeButtons = document.getElementsByName("type-answer");
for(const b of typeButtons) {
	//b.addEventListener("click", function() { goOrders(b) });
	b.addEventListener("click", function() { goName(b) });
}

function goOrders(button) {
	document.querySelector('body').style.justifyContent = 'center';

	document.getElementById("type").classList.add("hide");
	document.getElementById("orders").classList.remove("hide");

	result.type = button.innerText;
}

var ordersButtons = document.getElementsByName("orders-answer");
for(const b of ordersButtons) {
	b.addEventListener("click", function() { goName(b) });
}

function goName(button) {

	//document.querySelector('body').style.justifyContent = 'normal';

	//document.getElementById("orders").classList.add("hide");
	document.getElementById("perfil").classList.add("hide");
	document.getElementById("name").classList.remove("hide");

	/*
	result.orders = result.ordersValue = button.innerText;
	if(button.id != "orders-0") {
		result.orders = "recebo em média " + button.innerText + " pedidos diariamente";
	}
	*/
}

function goBack(fase) {
	document.getElementById("welcome").classList.add("hide");
	document.getElementById("perfil").classList.add("hide");
	document.getElementById("type").classList.add("hide");
	document.getElementById("orders").classList.add("hide");
	document.getElementById("name").classList.add("hide");

	document.querySelector('body').style.justifyContent = (fase == 'type' || fase == 'name') ? 'normal' : 'center';

	document.getElementById(fase).classList.remove("hide");

}
var x = 0;
function send() {

	$("#send").hide();
	setTimeout(function() {

		var name = document.getElementById("name-answer").value;
		var email = document.getElementById("email-answer").value;
		var phone = phoneInput.getNumber();

		if(name != null && email != null && phone != null) {
			if((name.trim() != "" && name.trim().length > 3) && (email.trim() != "" && email.trim().length > 3) && (phoneInput.isValidNumber())) {

				document.getElementById("name").classList.add("hide");
				document.getElementById("sending").classList.remove("hide");

				result.name = name;
				result.email = email;
				result.phone = phone;							
				
				var obrigadoPage = 'obrigado.html';
				var qs = new URLSearchParams(window.location.search);
				var customParam = qs.get('c_p');
				if(customParam == null) {
					var pathParts = window.location.pathname.split("/");
					if(pathParts[pathParts.length-1] == "estrategia-davi.html") {
						customParam = "[estrategia-davi]";
						obrigadoPage = "obrigado-estrategia-davi.html";
					}
				}
				
				/*
				var utm_source = qs.get('utm_source');
				var utm_medium = qs.get('utm_medium');
				var utm_content = qs.get('utm_content');
				var utm_campaign = qs.get('utm_campaign');
				var utm_term = qs.get('utm_term');

				$.ajax({
					type: "GET",
					url: "https://appdelivery.wabiz.com.br/mkt/send.php?p=" + JSON.stringify(result) + "&c_p=" + customParam + "&utm_source="+utm_source+"&utm_medium="+utm_medium+"&utm_content="+utm_content+"&utm_campaign="+utm_campaign+"&utm_term="+utm_term,
					async: false,
					crossDomain: true,
					success: function (data) {
						setTimeout(function() {
							window.location.href=obrigadoPage;
						}, 1000);
					},
					error: function(data) {
					//alert("Não foi possível enviar sua solicitação, por favor, tente novamente!");
					setTimeout(function() {
						window.location.href=obrigadoPage;
					}, 1000);
					}
				});
				

				trackContact('Contact', result.name, result.email, result.phone);	*/			
				zap(result);
				
			}
			else {
				if(phoneInput.isValidNumber()) {
					alert("Por favor, informe seus dados corretamente!");
				}
				else {
					alert("Por favor, informe o número do seu WhatsApp com DDD!");
				}
				$("#send").show();
			}
		}
		else {
			alert("Por favor, informe seus dados!");
			$("#send").show();
		}
	}, 1000);
	
}

function zap(result) {
	
	var message = "Olá! Sou " + result.name + ", " + result.perfil.toLowerCase() + ". Gostaria de mais informações.";
	var obrigadoPage = 'obrigado.html';
	var qs = new URLSearchParams(window.location.search);
	var customParam = qs.get('c_p');
	if(customParam != null) {
		message += " " + customParam;
	}
	else {
		var pathParts = window.location.pathname.split("/");
		if(pathParts[pathParts.length-1] == "estrategia-davi.html") {
			message += " [estrategia-davi]";
			obrigadoPage = "obrigado-estrategia-davi.html";
		}
	}	
	
	window.open('https://wa.me/5511986598313?text=' + encodeURI(message));

	trackContact('Contact', result.name, result.email, result.phone);

	setTimeout(function() {
		window.location.href=obrigadoPage;
	}, 1000);
}