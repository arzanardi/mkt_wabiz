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
	b.addEventListener("click", function() { goType(b) });
}

function goType(button) {
	if(button.id == 'perfil-0') {
		document.getElementById("question-type").innerText = "Qual tipo de estabelecimento deseja abrir?";
	}
	document.querySelector('body').style.justifyContent = 'normal';
	document.getElementById("perfil").classList.add("hide");
	document.getElementById("type").classList.remove("hide");

	result.perfil = button.innerText;
}

var typeButtons = document.getElementsByName("type-answer");
for(const b of typeButtons) {
	b.addEventListener("click", function() { goOrders(b) });
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

	document.querySelector('body').style.justifyContent = 'normal';

	document.getElementById("orders").classList.add("hide");
	document.getElementById("name").classList.remove("hide");

	result.orders = result.ordersValue = button.innerText;
	if(button.id != "orders-0") {
		result.orders = "recebo em média " + button.innerText + " pedidos diariamente";
	}
	
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

function send() {
	var name = document.getElementById("name-answer").value;
	var email = document.getElementById("email-answer").value;
	var phone = phoneInput.getNumber();
	if(name != null && email != null && phone != null) {
		if((name.trim() != "" && name.trim().length > 3) && (email.trim() != "" && email.trim().length > 3) && (phoneInput.isValidNumber())) {

			result.name = name;
			result.email = email;
			result.phone = phone;

			var opps = {
				"oportunidades": [
				  {
					"titulo": result.name,
					"valor": 650,
					"codigo_vendedor": 16343,
					"codigo_metodologia": 5341,
					"codigo_canal_venda": 88657,
					"personalizados": [
					  {
						"titulo": "Perfil",
						"valor": result.perfil
					  },
					  {
						  "titulo": "Tipo de Estabelecimento",
						  "valor": result.type
					  },
					  {
						  "titulo": "Pedidos",
						  "valor": result.ordersValue
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
					alert("Não foi possível enviar sua solicitação, por favor, tente novamente!");
				  }
			  });

			

			
		}
		else {
			alert("Por favor, informe seus dados corretamente!");
		}
	}
	else {
		alert("Por favor, informe seus dados!");
	}
	
}

function zap(data) {
	
	var obrigadoPage = 'obrigado.html';
	var qs = new URLSearchParams(window.location.search);
	var customParam = qs.get('c_p');
	if(customParam != null) {
		
	}
	else {
		var pathParts = window.location.pathname.split("/");
		if(pathParts[pathParts.length-1] == "estrategia-davi.html") {
			obrigadoPage = "obrigado-estrategia-davi.html";
		}
	}	

	$.ajax({
		type: "GET",
		url: "https://appdelivery.wabiz.com.br/mkt/send.php?p=" + JSON.stringify(data.value[0]["contact"]),
		async: false,
		crossDomain: true,
		success: function (data) {
			setTimeout(function() {
				window.location.href=obrigadoPage;
			}, 1000);
		},
		error: function(data) {
		  alert("Não foi possível enviar sua solicitação, por favor, tente novamente!");
		}
	});

	trackContact('Contact', result.name, result.email, result.phone);

	
}