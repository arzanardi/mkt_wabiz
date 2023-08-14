const phoneInputField = document.querySelector("#phone-answer");
const phoneInput = window.intlTelInput(phoneInputField, {
	initialCountry: "auto",
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
		document.getElementById("question-type").innerText = "¿Qué tipo de establecimiento quieres abrir?";
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

var qs = new URLSearchParams(window.location.search);
var utm_source = qs.get('utm_source');
var utm_medium = qs.get('utm_medium');
var utm_content = qs.get('utm_content');
var utm_campaign = qs.get('utm_campaign');
var utm_term = qs.get('utm_term');
var customParam = qs.get('c_p');

var channelBotConversa = 33280;
var channelFacebook = 84915;
var channelGoogle = 93961;

var currentChannel = channelBotConversa;
if(utm_source !== null) {
	if(utm_source.toLowerCase() == "fbads") currentChannel = channelFacebook;
	else if(utm_source.toLowerCase() == "goads") currentChannel = channelGoogle;
}

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

				var opps = {
					"oportunidades": [
						{
							"titulo": result.name,
							"valor": 650,
							"codigo_vendedor": 57649, //Neto | Wildes: 16343,
							"codigo_metodologia": 18959,
							"codigo_canal_venda": currentChannel,
							"personalizados": [
								{
									"titulo": "Perfil",
									"valor": result.perfil
								},
								/*{
									"titulo": "Tipo de Estabelecimento",
									"valor": result.type
								}
								,
								{
									"titulo": "Pedidos",
									"valor": result.ordersValue
								},
								*/
								{
									"titulo": "Campanha",
									"valor": customParam
								},
								{
									"titulo": "utm_source",
									"valor": utm_source
								},
								{
									"titulo": "utm_medium",
									"valor": utm_medium
								},
								{
									"titulo": "utm_content",
									"valor": utm_content
								},
								{
									"titulo": "utm_campaign",
									"valor": utm_campaign
								},
								{
									"titulo": "utm_term",
									"valor": utm_term
								}
							],
							"empresa": {
								"nome": result.name
							},
							"contato": {
							"nome": result.name,
							"email": result.email,
							"telefone1": result.phone
							}
						}
					]
				}

				/*

				var qs = new URLSearchParams(window.location.search);
				var customParam = qs.get('c_p');
				if(customParam != null) {
					opps.oportunidades[0].personalizados.push(
						{
							"titulo": "Campanha",
							"valor": customParam
						}
					);
				}

				*/
								
				$.ajax({
					type: "POST",
					url: "https://app.funildevendas.com.br/api/Opportunity?IntegrationKey=c8cbef34-9d30-48fc-8fee-f6ae17f21de2",
					dataType: "json",
					contentType: "application/json",
					data: JSON.stringify(opps),
					async: false,
					success: function (data) {
						//document.getElementById("name").classList.add("hide");
			
						//document.getElementById("end").classList.remove("hide");

						//trackContact('Lead', name, email, phone);
						zap(data);
					},
					error: function(data) {
						document.getElementById("name").classList.remove("hide");
						document.getElementById("sending").classList.add("hide");
						$("#send").show();
						alert("Su solicitud no pudo ser enviada, por favor inténtelo de nuevo!");
					}
				});

				

				
			}
			else {
				if(phoneInput.isValidNumber()) {
					alert("¡Por favor ingrese sus datos correctamente!");
				}
				else {
					alert("¡Por favor ingrese su número de WhatsApp correctamente!");
				}
				$("#send").show();
			}
		}
		else {
			alert("Por favor ingrese sus datos!");
			$("#send").show();
		}
	}, 1000);
	
}

function zap(data) {
	
	var obrigadoPage = 'gracias.html';
	trackContact('Contact', result.name, result.email, result.phone);

	/*
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
	*/

	window.open("https://wa.me/5511947519926");

	setTimeout(function() {
		window.location.href=obrigadoPage;
	}, 1000);
	
}