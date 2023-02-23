<!DOCTYPE html>
<html lang="pt-br"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
      WABiz - Cadastro do Cliente!
    </title>
    <meta name="description" content="Bem vindo(a) a WABiz">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!--Replace with your tailwind.css once created-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/intlTelInput.css">
    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <style>
      .gradient {
        background: linear-gradient(90deg, #3f8b8c 0%, #5bb75b 100%);
      }

      .pt-24 {
        padding-top: 0rem;
        padding-bottom: 100px;
      }

      .iti__flag-box, .iti__country-name {
        color: black;
      }
    </style>

    <script src='cidades-estados.js'></script>

  </head>
  <body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">

    <div class="pt-24">
      <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-6/12 justify-center items-start text-center md:text-left px-5">
            
            <p class="uppercase tracking-loose w-full">
              <img src="wabiz_wh.png" width="200" /><br />ACREDITE NO SUCESSO!!!
            </p>
            
            <div id="form" style="width: 100%;">
              <h2 class="my-4 text-3xl font-bold leading-tight">Informe os dados do cliente:</h2>
              <div class="w-full pb-5">              
                <label for="estabelecimento_nome" class="block font-medium">Nome do estabelecimento</label>
                <input type="text" id="estabelecimento_nome" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="documentoCNPJ" class="block font-medium">CNPJ</label>
                <input type="text" id="documentoCNPJ" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="documentoCPF" class="block font-medium">CPF</label>
                <input type="text" id="documentoCPF" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="documentoRG" class="block font-medium">RG</label>
                <input type="text" id="documentoRG" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="estabelecimento_telefone" class="block font-medium">Telefone do Estabelecimento</label>
                <input type="tel" id="estabelecimento_telefone" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="proprietario_nome" class="block font-medium">Nome do Proprietário</label>
                <input type="text" id="proprietario_nome" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="proprietario_telefone" class="block font-medium">Melhor Telefone para Contato (WhatsApp)</label>
                <input type="tel" id="proprietario_telefone" class="form-input px-3 py-3 rounded text-black w-full uppercase"/>
              </div>
              <div class="w-full pb-5">              
                <label for="proprietario_email" class="block font-medium">Melhor E-mail para contato</label>
                <input type="text" id="proprietario_email" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="endereco" class="block font-medium">Endereço</label>
                <input type="text" id="endereco" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="endereco_num" class="block font-medium">Número</label>
                <input type="text" id="endereco_num" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>              
              <div class="w-full pb-5">              
                <label for="endereco_compl" class="block font-medium">Complemento</label>
                <input type="text" id="endereco_compl" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>          
              <div class="w-full pb-5">              
                <label for="endereco_bairro" class="block font-medium">Bairro</label>
                <input type="text" id="endereco_bairro" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="estado" class="block font-medium">Estado</label>
                <select id="estado" class="form-input px-3 py-3 rounded text-black w-full uppercase"></select>
              </div>
              <div class="w-full pb-5">              
                <label for="cidade" class="block font-medium">Cidade</label>
                <select id="cidade" class="form-input px-3 py-3 rounded text-black w-full uppercase"></select>
              </div>
              <h2 class="my-4 text-3xl font-bold leading-tight">Produtos:</h2>
              <div class="w-full pb-5">              
                <label for="produtos" class="block font-medium">Selecione os produtos adquiridos</label>
                <input type="checkbox" id="produto_weblink" value="S" class="w-4 h-4 text-blue-600 bg-gray-100 rounded" /> WebLink<br />
                <input type="checkbox" id="produto_android" value="S" class="w-4 h-4 text-blue-600 bg-gray-100 rounded" /> Android<br />
                <input type="checkbox" id="produto_ios" value="S" class="w-4 h-4 text-blue-600 bg-gray-100 rounded" /> iOS (Apple)<br />                
              </div>              
              <h2 class="my-4 text-3xl font-bold leading-tight">Financeiro:</h2>
              <div class="w-full pb-5">              
                <label for="valor_adesao" class="block font-medium">Valor da Adesão</label>
                <input type="text" id="valor_adesao" class="currency form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <div class="w-full pb-5">              
                <label for="formPagamento" class="block font-medium">Forma de Pagamento</label>
                <select id="formPagamento" class="form-input px-3 py-3 rounded text-black w-full uppercase">
                  <option value="PIX" selected="selected">PIX</option>
                  <option value="CreditCard">Cartão de Crédito</option>                  
                  <option value="Boleto">Boleto</option>
                  <option value="Boleto 2x">Boleto 2x</option>
                </select>
              </div>
              <div class="w-full pb-5">              
                <label for="valor_mensalidade" class="block font-medium">Valor da Mensalidade</label>
                <input type="text" id="valor_mensalidade" class="currency form-input px-3 py-3 rounded text-black w-full uppercase" />
              </div>
              <!--
              <div class="w-full pb-5">              
                <label for="proprietario_genero" class="block font-medium">Gênero</label>
                <select id="proprietario_genero" class="form-input px-3 py-3 rounded text-black w-full uppercase">
                  <option value="M">Masculino</option>
                  <option value="F">Feminino</option>
                </select>
              </div>-->
              <button id="buttonLink" onclick="getLink()" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out;" style="text-transform: uppercase;">Gerar link para cliente</button>
          </div>
          <div id="dados" style="display: none; width: 100%;">
             <h2 class="my-4 text-3xl font-bold leading-tight" id="confirmDataText">Dados do Cliente:</h1>
            <div class="w-full pb-3">              
              <label for="estabelecimento_nome" class="block font-medium">Nome do estabelecimento</label>
              <div class="text-2xl font-bold dataValue" id="estabelecimento_nome"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="documentoCNPJ" class="block font-medium">CNPJ</label>
              <div class="text-2xl font-bold dataValue" id="documentoCNPJ"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="documentoCPF" class="block font-medium">CPF</label>
              <div class="text-2xl font-bold dataValue" id="documentoCPF"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="documentoRG" class="block font-medium">RG</label>
              <div class="text-2xl font-bold dataValue" id="documentoRG"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="estabelecimento_telefone" class="block font-medium">Telefone do Estabelecimento</label>
              <div class="text-2xl font-bold dataValue" id="estabelecimento_telefone"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="proprietario_nome" class="block font-medium">Nome do Proprietário</label>
              <div class="text-2xl font-bold dataValue" id="proprietario_nome"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="proprietario_telefone" class="block font-medium">Melhor Telefone para Contato</label>
              <div class="text-2xl font-bold dataValue" id="proprietario_telefone"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="proprietario_email" class="block font-medium">Melhor E-mail para contato</label>
              <div class="text-2xl font-bold dataValue" id="proprietario_email"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="endereco" class="block font-medium">Endereço</label>
              <div class="text-2xl font-bold dataValue" id="endereco"></div>
            </div>    
            <div class="w-full pb-3">              
              <label for="cidade" class="block font-medium">Cidade</label>
              <div class="text-2xl font-bold dataValue" id="cidade"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="produtos" class="block font-medium">Produtos</label>
              <div class="text-2xl font-bold dataValue" id="produtos"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="valor_adesao" class="block font-medium">Valor Adesão</label>
              <div class="text-2xl font-bold dataValue" id="valor_adesao"></div>
            </div>
            <div class="w-full pb-3">              
              <label for="valor_mensalidade" class="block font-medium">Valor Mensalidade</label>
              <div class="text-2xl font-bold dataValue" id="valor_mensalidade"></div>
            </div>
            <button id="buttonReady" onclick="editar()" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out;" style="text-transform: uppercase;">Editar</button>
            <button id="buttonReady" onclick="sendMail()" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out;" style="text-transform: uppercase;">Enviar por E-mail</button>
          </div>
        </div>
        <!--Right Col-->
        <div class="w-full md:w-6/12 py-6 px-6 text-center">
          <img class="w-full z-50" src="launch.png">
        </div>
      </div>
    </div>
    <div class="relative -mt-12 lg:-mt-24">
      <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
            <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
            <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
            <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
          </g>
          <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
            <path d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"></path>
          </g>
        </g>
      </svg>
    </div>    
    
    <!-- Change the colour #f8fafc to match the previous section colour -->
    <svg class="wave-top" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
          <g class="wave" fill="#f8fafc">
            <path d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z"></path>
          </g>
          <g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
            <g transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) ">
              <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
              <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
              <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" opacity="0.200000003"></path>
            </g>
          </g>
        </g>
      </g>
    </svg>
    <section class="container mx-auto text-center py-6 mb-12">
      <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">Aplicativo Personalizado WABiz</h1>
      <div class="w-full mb-4">
        <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
      </div>      
      
    </section>
    <!--Footer-->
    
   
<script>
  var params = {};
  
  new dgCidadesEstados({
    cidade: document.getElementById('cidade'),
    estado: document.getElementById('estado'),
    estadoVal: 25,
    cidadeVal: 'São Paulo-SP'
  });

  function getLink() {
    params = {
      estabelecimento_nome: document.querySelector("input#estabelecimento_nome").value.toUpperCase(),
      estabelecimento_telefone: document.querySelector("input#estabelecimento_telefone").value.toUpperCase(),
      documentoCNPJ: document.querySelector("input#documentoCNPJ").value.toUpperCase(),
      documentoCPF: document.querySelector("input#documentoCPF").value.toUpperCase(),
      documentoRG: document.querySelector("input#documentoRG").value.toUpperCase(),
      proprietario_nome: document.querySelector("input#proprietario_nome").value.toUpperCase(),
      proprietario_telefone: document.querySelector("input#proprietario_telefone").value.toUpperCase(),
      proprietario_email: document.querySelector("input#proprietario_email").value.toUpperCase(),
      endereco: document.querySelector("input#endereco").value.toUpperCase(),
      endereco_num: document.querySelector("input#endereco_num").value.toUpperCase(),
      endereco_compl: document.querySelector("input#endereco_compl").value.toUpperCase(),
      endereco_bairro: document.querySelector("input#endereco_bairro").value.toUpperCase(),
      cidade: document.querySelector("select#cidade").value.toUpperCase(),
      produto_weblink: document.querySelector("input#produto_weblink").checked ? "S" : "N",
      produto_android: document.querySelector("input#produto_android").checked ? "S" : "N",
      produto_ios: document.querySelector("input#produto_ios").checked ? "S" : "N",
      formaPagamento: document.querySelector("select#formPagamento").value.toUpperCase(),
      valor_adesao: document.querySelector("input#valor_adesao").value.toUpperCase(),
      valor_mensalidade: document.querySelector("input#valor_mensalidade").value.toUpperCase(),
      /*proprietario_genero: document.querySelector("select#proprietario_genero").value.toUpperCase()*/
    };

    var inputs = document.getElementsByTagName('input');
    inputs = Array.prototype.slice.call(inputs);
    inputs.every(element => {
      if(!element.value) {
        alert('Por favor, informe todos os campos');
        return;
      }
    });

    var data = btoa(JSON.stringify(params));

    var link = location.protocol + '//'+location.host+'/app/novo/?data='+data;

    navigator.clipboard.writeText(link);

    /* Alert the copied text */
    alert("Link gerado e copiado! Envie para o cliente");

    document.getElementById('form').style.display = 'none';

    document.querySelector("div#estabelecimento_nome").innerHTML = params.estabelecimento_nome;
    document.querySelector("div#estabelecimento_telefone").innerHTML = params.estabelecimento_telefone;
    document.querySelector("div#documentoCNPJ").innerHTML = params.documentoCNPJ;
    document.querySelector("div#documentoCPF").innerHTML = params.documentoCPF;
    document.querySelector("div#documentoRG").innerHTML = params.documentoRG;
    document.querySelector("div#proprietario_nome").innerHTML = params.proprietario_nome;
    document.querySelector("div#proprietario_telefone").innerHTML = params.proprietario_telefone;
    document.querySelector("div#proprietario_email").innerHTML = params.proprietario_email;
    document.querySelector("div#endereco").innerHTML = params.endereco + ", " + params.endereco_num + (params.endereco_compl != "" ? " " + params.endereco_compl : "") + " - " + params.endereco_bairro;
    document.querySelector("div#cidade").innerHTML = params.cidade;
    document.querySelector("div#valor_adesao").innerHTML = params.valor_adesao + " (" + params.formaPagamento + ")";
    document.querySelector("div#valor_mensalidade").innerHTML = params.valor_mensalidade;

    var produtos = [];
    if(params.produto_weblink == "S") produtos.push("WEBLINK");
    if(params.produto_android == "S") produtos.push("ANDROID");
    if(params.produto_ios == "S") produtos.push("IOS");

    document.querySelector("div#produtos").innerHTML = produtos.join(" + ");

    document.getElementById("dados").style.display = 'block';

  }

  function editar() {
    document.getElementById('form').style.display = 'block';    

    document.getElementById("dados").style.display = 'none';
  }

</script>
<script src="js/intlTelInput.js"></script>
<script src="js/utils.js"></script>
<script src="https://unpkg.com/imask"></script>
<script>
  var telEstabelecimento = document.querySelector("input#estabelecimento_telefone");
  var telProprietario = document.querySelector("input#proprietario_telefone");
  window.intlTelInput(telEstabelecimento, {
    initialCountry: 'br'
  });
  window.intlTelInput(telProprietario, {
    initialCountry: 'br'
  });

  IMask(telEstabelecimento, {
    mask: [
      {
        mask: '(00) 0000-0000',
        maxLength: 10
      },
      {
        mask: '(00) 00000-0000'
      }
    ]
  });

  IMask(telProprietario, {
    mask: [
      {
        mask: '(00) 0000-0000',
        maxLength: 10
      },
      {
        mask: '(00) 00000-0000'
      }
    ]
  });

  var maskCpfOuCnpj = IMask(document.getElementById('documentoCNPJ'), {
			mask:[				
				{
					mask: '00.000.000/0000-00',
          maxLength: 14
				}
			]
  });

  var maskCpfOuCnpj = IMask(document.getElementById('documentoCPF'), {
			mask:[
				{
					mask: '000.000.000-00',
					maxLength: 11
				}
			]
  });

  var maskCpfOuCnpj = IMask(document.getElementById('documento'), {
			mask:[
				{
					mask: '000.000.000-00',
					maxLength: 11
				},
				{
					mask: '00.000.000/0000-00'
				}
			]
  });

  var currencyMask = [{
    mask: 'R$ num{,}`cents',
    blocks: {
      num: {
        mask: Number,
        signed: true,
        scale: 0
      },
      cents: {
        mask: '`0`0',
        normalizeZeros: true,
        padFractionalZeros: true,
      }
    },
    overwrite: true
  }];
  var valor_adesao = IMask(document.getElementById("valor_adesao"), {
    mask:currencyMask
  });

  var valor_mensalidade = IMask(document.getElementById("valor_mensalidade"), {
    mask:currencyMask
  });

  function sendMail() {
    var mensagem = "Dados do Cliente\n\n";
    var assunto = "Venda";
    var partes = document.querySelector("#dados").innerText.split("\n").slice(1).slice(0, -1);
    var i = 0;
    while(i < partes.length) {
      mensagem += "▶ " + partes[i] + ": " + partes[i+1] + "\n";
      i = i + 2;
    }

    window.open("mailto:dev@wabiz.com.br?subject="+assunto+"&body=" + encodeURIComponent(mensagem));
  }

</script>

</body></html>