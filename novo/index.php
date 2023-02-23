<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$urlCheckout = "#";
if(isset($_REQUEST["data"])) {
  $data = utf8_encode(base64_decode($_REQUEST["data"]));
  $data = json_decode($data);
  if($data->formaPagamento == "CREDITCARD") {

    $curl = curl_init();

    //$urlApi = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout"; //sandbox
    $urlApi = "https://ws.pagseguro.uol.com.br/v2/checkout";

    $token = '5F09A3CA690A44F4B4296DF2DCC8488C'; //sandbox
    $token = 'CB192F36BEF94C9DB7D596132097DB7D'; //prod

    $value = str_replace(",", ".", str_replace("R$ ", "", $data->valor_adesao));
    $value = number_format($value, 2, '.', '');
    $ddd = substr(preg_replace('/\D/', '', $data->proprietario_telefone), 0, 2);
    $telefone = substr(preg_replace('/\D/', '', $data->proprietario_telefone), 2);
    $redirect = ''; //(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&pay=ok";

    curl_setopt_array($curl, array(
      CURLOPT_URL => $urlApi.'?email=comercial@wabiz.com.br&token='.$token,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'currency=BRL&itemId1=0001&itemDescription1=Adesao%20App&itemAmount1='.$value.'&itemQuantity1=1&senderName='.urlencode(trim($data->proprietario_nome)).'&senderAreaCode='.$ddd.'&senderPhone='.$telefone.'&senderEmail='.urlencode(trim($data->proprietario_email)).'&redirectURL='.urlencode($redirect),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
      ),
    ));

    $response = curl_exec($curl);

    $info = curl_getinfo($curl);
    $error = curl_error($curl);
    $httpCode = $info["http_code"];
    //echo $response;

    curl_close($curl);

    if($httpCode == 200) {      
      // Convert xml string into an object
      $new = simplexml_load_string($response);
        
      // Convert into json
      $con = json_encode($new);
        
      // Convert into associative array
      $newArr = json_decode($con, true);

      //$urlCheckout = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code='.$newArr["code"];
      $urlCheckout = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code='.$newArr["code"];
    }

    /*
    //CIELO======>
    $data->orderNumber = time();
    $valor = str_replace("R$ ", "", $data->valor_adesao);
    $paymentData = array(
      "OrderNumber" => $data->orderNumber,
      "SoftDescriptor" => "WABIZAPP",
      "Cart" => array(  
          "Discount" => array(  
            "Type" => "Amount",
            "Value" => 0
          ),
          "Items" => array(  
            array(  
                "Name" => "Adesão App WAbiz",
                "UnitPrice" => round($valor * 100, 2),
                "Quantity" => 1,
                "Type" => "Asset"
            ),
          )
      ),
      "Customer" => array(  
        "Identity" => preg_replace('/\D/', '', $data->documento),
        "FullName" => $data->proprietario_nome,
        "Email" => $data->proprietario_email,
        "Phone" => preg_replace('/\D/', '', $data->proprietario_telefone)
      ),
      "Options" => array(  
        "AntifraudEnabled" => false,
        "ReturnUrl" =>  ""
      ),
      "Settings" => null
    );

    $paymentData["Shipping"] = array("Type" => "WithoutShippingPickUp");

    
    echo "<pre>";  
    print_r(json_encode($paymentData));
     

    $curl = curl_init();
    $paymentSecretKey = 'd2686904-561e-488b-91d7-ee487e2e218d';
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://cieloecommerce.cielo.com.br/api/public/v1/orders",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($paymentData),
      CURLOPT_HTTPHEADER => array(
        "Content-type: application/json",
        "MerchantId: ".$paymentSecretKey
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);

    $info = curl_getinfo($curl);
    $error = curl_error($curl);
    $httpCode = $info["http_code"];
                      
    
    //echo $paymentSecretKey;
    curl_close($curl);
    //print_r($info);
    //print_r($error);
    //print_r($httpCode);
    //print_r($response);
    //exit;

    if($httpCode == 401) {
      echo "Erro ao criar checkout - Details: Unauthorized";
    } 
    else {
      if(!isset($response->settings->checkoutUrl)) {
        echo "Erro ao criar checkout - Details: ".$response->message;
      }
      else {                      
        $urlCheckout = $response->settings->checkoutUrl;
      }

    }
    //CIELO<========
    */
  }
}

?>
<!DOCTYPE html>
<html lang="pt-br"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
      WABiz - Seja Bem-vindo(a)!
    </title>
    <meta name="description" content="Bem vindo(a) a WABiz">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!--Replace with your tailwind.css once created-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <style>
      .gradient {
        background: linear-gradient(90deg, #3f8b8c 0%, #5bb75b 100%);
      }

        .pt-24 {
         padding-top: 0rem;
         padding-bottom: 100px;
        }

        .dataValue {
          color: #d0f118;
        }

        #qrCodePix {
          display: table;
          margin: 20px auto;
        }

        #payloadPix {
          color: black;
          text-align: center;
          padding: 20px;
          border: 1px solid #CCC;
          border-radius: 20px;
          background: #f3f3f3;
          font-size: .8em;
          word-break: break-all;
        }
    </style>

    <script src='forge-sha256.min.js'></script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://gtm.wabizdelivery.com/pyowbivt.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-P2GHVPB');</script>
    <!-- End Google Tag Manager -->

  </head>
  <body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://gtm.wabizdelivery.com/ns.html?id=GTM-P2GHVPB"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!--Hero-->
    <div class="pt-24">
      <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-6/12 justify-center items-start text-center md:text-left px-5">
            
            <p class="uppercase tracking-loose w-full">
              <img src="wabiz_wh.png" width="200" /><br />ACREDITE NO SUCESSO!!!
            </p>
            
            <div id="dados" style="display: none;">
              <h1 class="my-4 text-5xl font-bold leading-tight">É um prazer ter você como cliente!</h1>
              <p class="leading-normal text-2xl mb-8">Estamos ansiosos para iniciar a produção do seu aplicativo que vai te ajudar alavancar suas vendas.</p>
              <h2 class="my-4 text-3xl font-bold leading-tight" id="confirmDataText">Por favor confirme seus dados:</h2>
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
              <button id="buttonReady" onclick="confirmData()" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out;" style="text-transform: uppercase;background: #00ff72;color: #183606;font-size: 1.2em;">Clique aqui para confirmar os dados</button>
            </div>
            <h2 id="semDados" class="my-4 text-3xl font-bold leading-tight" style="display: none;">Nenhuma informação</h1>             
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
    <section id="paymentPix" class="bg-white py-8" style="display: none">
      <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Muito Bom! Falta pouco agora...</h1>
        <h2 class="w-full my-2 text-3xl font-bold leading-tight text-center text-gray-800" style="font-size: 1.5em">Você pode efetuar o pagamento via PIX</h2>
        <div id="qrCodePix">

        </div>
        <div id="payloadPix"></div>
        <button onclick="copyPix()" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out;" style="text-transform: uppercase;background: #00ff72;color: #183606;font-size: 1.2em; display:block; margin: 10px auto">Pix Copia & Cola</div>
        <div style="color: #ff6a00; text-align: center;">Ao efetuar o pagamento, envie-nos o comprovante e daremos sequência nos próximos passos.</div>
      </div>
    </section>
    <section id="paymentCreditCard" class="bg-white py-8" style="display: none">
      <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Muito Bom! Falta pouco agora...</h1>
        <h2 class="w-full my-2 text-3xl font-bold leading-tight text-center text-gray-800" style="font-size: 1.5em">Você pode efetuar o pagamento com cartão de crédito</h2>
        <div id="">
          <button onclick="payCreditCard()" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out;" style="text-transform: uppercase;background: #00ff72;color: #183606;font-size: 1.2em; display:block; margin: 10px auto">Pagar Agora</div>
        </div>
        <div style="color: #ff6a00; text-align: center;">Ao efetuar o pagamento, envie-nos o comprovante e daremos sequência nos próximos passos.</div>
      </div>
    </section>
    <section id="welcomeMessage" class="bg-white py-8" style="display: none">
      <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Muito Bom! Obrigado pela confiança!</h1>
        <h2 class="w-full my-2 text-3xl font-bold leading-tight text-center text-gray-800" style="font-size: 1.5em">Seguiremos com os próximos passos...</h2>
      </div>
    </section>
    <section id="paymentBoleto" class="bg-white py-8" style="display: none">
      <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Muito Bom! Falta pouco agora...</h1>
        <h2 class="w-full my-2 text-3xl font-bold leading-tight text-center text-gray-800" style="font-size: 1.5em">Aguarde que em breve enviaremos o boleto para você!</h2>
        <div style="color: #ff6a00; text-align: center;">Ao efetuar o pagamento, envie-nos o comprovante e daremos sequência nos próximos passos.</div>
      </div>
    </section>
    <section id="welcomeMessage" class="bg-white py-8" style="display: none">
      <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Muito Bom! Obrigado pela confiança!</h1>
        <h2 class="w-full my-2 text-3xl font-bold leading-tight text-center text-gray-800" style="font-size: 1.5em">Seguiremos com os próximos passos...</h2>
      </div>
    </section>
    
    
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
      <h3 class="my-4 text-3xl leading-tight">Estaremos sempre a disposição</h3>
      
    </section>
    <!--Footer-->
    
 
<script src="js/Pix.js"></script>  
<script src="js/qrcode.min.js"></script> 
<script>

  var params = (new URL(document.location)).searchParams;
  var hasData = params.has('data');
  var valorAdesao = 0;
  var formaPagamento =  "PIX";
  var payload = '';
  

  if(hasData) {
    params = atob(params.get('data'));
    params = JSON.parse(params);

    document.getElementById("estabelecimento_nome").innerHTML = params.estabelecimento_nome;
    document.getElementById("estabelecimento_telefone").innerHTML = params.estabelecimento_telefone;
    document.getElementById("documentoCNPJ").innerHTML = params.documentoCNPJ == '' ? '-' : params.documentoCNPJ;
    document.getElementById("documentoCPF").innerHTML = params.documentoCPF == '' ? '-' : params.documentoCPF;
    document.getElementById("documentoRG").innerHTML = params.documentoRG == '' ? '-' : params.documentoRG;
    document.getElementById("proprietario_nome").innerHTML = params.proprietario_nome;
    document.getElementById("proprietario_telefone").innerHTML = params.proprietario_telefone;
    document.getElementById("proprietario_email").innerHTML = params.proprietario_email;
    document.getElementById("endereco").innerHTML = params.endereco + ", " + params.endereco_num + (params.endereco_compl != "" ? " " + params.endereco_compl : "") + " - " + params.endereco_bairro;
    document.getElementById("cidade").innerHTML = params.cidade;

    formaPagamento = params.formaPagamento;

    valorAdesao = parseFloat(params.valor_adesao.replace("R$ ", "").replace(",", "."));
    if(isNaN(valorAdesao)) valorAdesao = 0;

    document.querySelector("div#valor_adesao").innerHTML = "R$ " + params.valor_adesao + " (" + params.formaPagamento + ")";
    document.querySelector("div#valor_mensalidade").innerHTML = "R$ " + params.valor_mensalidade;

    var produtos = [];
    if(params.produto_weblink == "S") produtos.push("WEBLINK");
    if(params.produto_android == "S") produtos.push("ANDROID");
    if(params.produto_ios == "S") produtos.push("IOS");

    document.querySelector("div#produtos").innerHTML = produtos.join(" + ");

    document.getElementById("dados").style.display = 'block';

    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'GTM-P2GHVPB');
  }
  else {
    document.getElementById("semDados").style.display = 'block';
  }

  
  
  function generateEventId() {
    var gtmData = window.google_tag_manager['GTM-P2GHVPB'].dataLayer.get('gtm');
    return gtmData.start + '.' + gtmData.uniqueEventId;
  }

  
  function getName(fullName, first_or_last) {
    var firstName = fullName.split(' ').slice(0, -1).join(' ');
    var lastName = fullName.split(' ').slice(-1).join(' ');
    return first_or_last != 'LAST' ? firstName : lastName;
  }

  function removeAccentsAndSpaces(str) {
    return str.replace(/[^a-zA-Zs]/g, "");
  }

  function hashString(str, removeSpaces) {
    
    if(typeof removeSpaces === 'undefined') removeSpaces = true;

    str = str.normalize("NFD").toLowerCase().replace(/[^a-zA-Z0-9\s]/g, "");;
    if(removeSpaces) {
      str = str.replace(/\s/g, '');
    }

    return forge_sha256(str);
  }

  function copyPix() {
    navigator.clipboard.writeText(payload);
    alert('Pix copiado!');
  }

  function payCreditCard() {
    window.open('<?php echo $urlCheckout ?>');
  }

  function confirmData() {

    var eventId = generateEventId();

    
    document.getElementById('confirmDataText').style.display = 'none';
    document.getElementById('buttonReady').style.display = 'none';
    if(valorAdesao == 0) {
      document.getElementById('welcomeMessage').style.display = 'block';    
      document.getElementById("welcomeMessage").scrollIntoView();
    }
    else {
      if(formaPagamento == "PIX") {
        document.getElementById('paymentPix').style.display = 'block';
        document.getElementById("paymentPix").scrollIntoView();

        var pix = new Pix(
          "22694312000185",
          "SETUP APP WABIZ",
          "WABIZ NEGOCIOS INTELIGENT",
          "JUNDIAI",
          "APPDELIVERY",
          valorAdesao
        );

        payload = pix.getPayload();

        document.getElementById("payloadPix").innerHTML = payload;

        var qrcode = new QRCode("qrCodePix", {
            text: payload,
            width: 256,
            height: 256,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
      }
      else if(formaPagamento == "CREDITCARD") {
        document.getElementById('paymentCreditCard').style.display = 'block';
        document.getElementById("paymentCreditCard").scrollIntoView();
      }
      else if(formaPagamento.startsWith("BOLETO")) {
        document.getElementById('paymentBoleto').style.display = 'block';
        document.getElementById("paymentBoleto").scrollIntoView();
      }
    }       

    //fbq('track', 'Purchase', {currency: "BRL", value: 650.00}, {eventId: eventId});

    var city = params.cidade.split("-")[0];
    var state = params.cidade.split("-")[1];
        
    gtag('event', 'adesao',
    {
      'x-fb-event_id': eventId,
      'currency': 'BRL',
      'value': valorAdesao,
      user_data: {
        email_address: forge_sha256(params.proprietario_email.toLowerCase().trim()),
        phone_number: hashString(params.proprietario_telefone),
        /*genre: hashString(params.proprietario_genero),*/
        address: {
          first_name: hashString(getName(params.proprietario_nome, 'FIRST'), false),
          last_name: hashString(getName(params.proprietario_nome, 'LAST'), false),
          city: hashString(city),
          region: hashString(state),
          /*postal_code: forge_sha256('<HASHED_DATA>'),*/
          country: forge_sha256('br')     
        },    
      },
      items: [
        {
          item_id: '1',
          item_name: 'Adesão',
          quantity: 1,
          price: valorAdesao,
          /*item_category: 'bar',
          item_brand: 'baz'*/
        }
      ]
    });
    //
  }

</script>

</body></html>