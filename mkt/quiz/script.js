var result = {
	name: null,
	perfil: null,
	type: null,
	orders: null
}
document.getElementById("continua-1").addEventListener("click", goPerfil)

function goPerfil() {
	document.getElementById("welcome").classList.add("hide")
	document.getElementById("perfil").classList.remove("hide")
}

var perfilButtons = document.getElementsByName("perfil-answer")
for(const b of perfilButtons) {
	b.addEventListener("click", function() { goType(b) })
}

function goType(button) {
	if(button.id == 'perfil-0') {
		document.getElementById("question-type").innerText = "Qual tipo de estabelecimento deseja abrir?"
	}
	document.querySelector('body').style.justifyContent = 'normal'
	document.getElementById("perfil").classList.add("hide")
	document.getElementById("type").classList.remove("hide")	

	result.perfil = button.innerText
}

var typeButtons = document.getElementsByName("type-answer")
for(const b of typeButtons) {
	b.addEventListener("click", function() { goOrders(b) })
}

function goOrders(button) {
	document.querySelector('body').style.justifyContent = 'center'

	document.getElementById("type").classList.add("hide")
	document.getElementById("orders").classList.remove("hide")

	result.type = button.innerText
}

var ordersButtons = document.getElementsByName("orders-answer")
for(const b of ordersButtons) {
	b.addEventListener("click", function() { goName(b) })
}

function goName(button) {

	document.querySelector('body').style.justifyContent = 'normal'

	document.getElementById("orders").classList.add("hide")
	document.getElementById("name").classList.remove("hide")

	result.orders = button.innerText
	if(button.id != "orders-0") {
		result.orders = "recebo em média " + button.innerText + " pedidos diariamente"
	}
	
}

function goBack(fase) {
	document.getElementById("welcome").classList.add("hide")
	document.getElementById("perfil").classList.add("hide")
	document.getElementById("type").classList.add("hide")
	document.getElementById("orders").classList.add("hide")
	document.getElementById("name").classList.add("hide")

	document.querySelector('body').style.justifyContent = (fase == 'type' || fase == 'name') ? 'normal' : 'center'

	document.getElementById(fase).classList.remove("hide")

}

function send() {
	var name = document.getElementById("name-answer").value
	if(name != null) {
		if(name.trim() != "" && name.trim().length > 3) {

			result.name = name

			var message = "Olá! Sou " + result.name + ", " + result.perfil.toLowerCase() + " (" + result.type + ") e " + result.orders.toLowerCase() + ". Gostaria de mais informações."

			document.getElementById("name").classList.add("hide")
		
			document.getElementById("end").classList.remove("hide")

			trackContact('https://wa.me/5511986598313?text=' + encodeURI(message))
		}
		else {
			alert("Por favor, informe seu nome corretamente!")
		}
	}
	else {
		alert("Por favor, informe seu nome!")
	}
	
}

