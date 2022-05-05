<?php
if(isset($_REQUEST["data"])) {
  $params = base64_decode($_REQUEST["data"]);
  $params = json_decode(html_entity_decode(utf8_decode($params)));
  $confirmationMode = 
    $params->estabelecimento_nome != null &&
    $params->estabelecimento_telefone != null &&
    $params->documento != null &&
    $params->proprietario_nome != null &&
    $params->proprietario_telefone != null &&
    $params->proprietario_email != null;
}

function getName($name, $type) {
  $name = trim($name);
  $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
  $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
  return $type != 'LAST' ? $first_name : $last_name;
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
    </style>

    <script src='forge-sha256.min.js'></script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://gtm.wabiz.com.br/rqpefrxn.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NMFB936');</script>
    <!-- End Google Tag Manager -->

  </head>
  <body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://gtm.wabiz.com.br/ns.html?id=GTM-NMFB936"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!--Hero-->
    <div class="pt-24">
      <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-6/12 justify-center items-start text-center md:text-left">
            
            <p class="uppercase tracking-loose w-full">
              <img src="wabiz_wh.png" width="200" /><br />ACREDITE NO SUCESSO!!!
            </p>
            
            <?php
            if(isset($_REQUEST["vendedor"])) {
              ?>
            <h2 class="my-4 text-3xl font-bold leading-tight">Informe os dados do cliente:</h1>
            <div class="w-full pb-5">              
              <label for="estabelecimento_nome" class="block font-medium">Nome do estabelecimento</label>
              <input type="text" id="estabelecimento_nome" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
            </div>
            <div class="w-full pb-5">              
              <label for="documento" class="block font-medium">CNPJ</label>
              <input type="text" id="documento" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
            </div>
            <div class="w-full pb-5">              
              <label for="estabelecimento_telefone" class="block font-medium">Telefone do Estabelecimento</label>
              <input type="text" id="estabelecimento_telefone" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
            </div>
            <div class="w-full pb-5">              
              <label for="proprietario_nome" class="block font-medium">Nome do Proprietário</label>
              <input type="text" id="proprietario_nome" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
            </div>
            <div class="w-full pb-5">              
              <label for="proprietario_telefone" class="block font-medium">Melhor Telefone para Contato</label>
              <input type="text" id="proprietario_telefone" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
            </div>
            <div class="w-full pb-5">              
              <label for="proprietario_email" class="block font-medium">Melhor E-mail para contato</label>
              <input type="text" id="proprietario_email" class="form-input px-3 py-3 rounded text-black w-full uppercase" />
            </div>
            <button id="buttonLink" onclick="getLink()" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out;" style="text-transform: uppercase;">Gerar link para cliente</button>
          <?php
            }
            else {
              if($confirmationMode) {
                ?>
            <h1 class="my-4 text-5xl font-bold leading-tight">É um prazer ter você como cliente!</h1>
            <p class="leading-normal text-2xl mb-8">Estamos ansiosos para iniciar a produção do seu aplicativo que vai te ajudar alavancar suas vendas.</p>
            <h2 class="my-4 text-3xl font-bold leading-tight">Por favor confirme seus dados:</h1>
            <div class="w-full pb-5">              
              <label for="estabelecimento_nome" class="block font-medium">Nome do estabelecimento</label>
              <div class="text-2xl font-bold"><?php echo $params->estabelecimento_nome; ?></div>
            </div>
            <div class="w-full pb-5">              
              <label for="documento" class="block font-medium">CNPJ</label>
              <div class="text-2xl font-bold"><?php echo $params->documento; ?></div>
            </div>
            <div class="w-full pb-5">              
              <label for="estabelecimento_telefone" class="block font-medium">Telefone do Estabelecimento</label>
              <div class="text-2xl font-bold"><?php echo $params->estabelecimento_telefone; ?></div>
            </div>
            <div class="w-full pb-5">              
              <label for="proprietario_nome" class="block font-medium">Nome do Proprietário</label>
              <div class="text-2xl font-bold"><?php echo $params->proprietario_nome; ?></div>
            </div>
            <div class="w-full pb-5">              
              <label for="proprietario_telefone" class="block font-medium">Melhor Telefone para Contato</label>
              <div class="text-2xl font-bold"><?php echo $params->proprietario_telefone; ?></div>
            </div>
            <div class="w-full pb-5">              
              <label for="proprietario_email" class="block font-medium">Melhor E-mail para contato</label>
              <div class="text-2xl font-bold"><?php echo $params->proprietario_email; ?></div>
            </div>
            <button id="buttonReady" onclick="confirmaDados()" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out;" style="text-transform: uppercase;">TUDO CERTO! Estou pronto para começar</button>
                <?php
              }
              else {
                ?>
                <h2 class="my-4 text-3xl font-bold leading-tight">Nenhuma informação</h1>
                <?php
              }
              ?>
              <?php
            }
            ?>
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
    <section id="welcomeMessage" class="bg-white py-8" style="display: none">
      <div class="container max-w-5xl mx-auto m-8">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">OBRIGADO PELA CONFIANÇA!</h1>
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
    
   
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'GTM-NMFB936');

  function getLink() {
    var params = {
      estabelecimento_nome: document.getElementById("estabelecimento_nome").value.toUpperCase(),
      estabelecimento_telefone: document.getElementById("estabelecimento_telefone").value.toUpperCase(),
      documento: document.getElementById("documento").value.toUpperCase(),
      proprietario_nome: document.getElementById("proprietario_nome").value.toUpperCase(),
      proprietario_telefone: document.getElementById("proprietario_telefone").value.toUpperCase(),
      proprietario_email: document.getElementById("proprietario_email").value.toUpperCase()
    };

    var inputs = document.getElementsByTagName('input');
    inputs = Array.prototype.slice.call(inputs);
    inputs.every(element => {
      if(!element.value) {
        alert('Por favor, informe todos os campos');
        return;
      }
    });

    params = btoa(JSON.stringify(params));

    var link = location.protocol + '://'+location.host+'/?data='+params;

    navigator.clipboard.writeText(link);

    /* Alert the copied text */
    alert("Link gerado e copiado! Envie para o cliente");


  }

  function generateEventId() {
    var gtmData = window.google_tag_manager['GTM-NMFB936'].dataLayer.get('gtm');
    return gtmData.start + '.' + gtmData.uniqueEventId;
  }

  function confirmaDados() {

    var eventId = generateEventId();

    document.getElementById('welcomeMessage').style.display = 'block';
    document.getElementById('buttonReady').style.display = 'none';
    location.href = '#welcomeMessage';

    fbq('track', 'Purchase', {currency: "BRL", value: 650.00}, {eventId: eventId});

    gtag('event', 'purchase',
    {
      'x-fb-event_id': eventId,
      'currency': 'BRL',
      'value': 650.00,
      user_data: {
        email_address: forge_sha256('<?php echo $params->proprietario_email ?>'),
        phone_number: forge_sha256('<?php echo $params->proprietario_telefone ?>'),
        address: {
          first_name: forge_sha256('<?php echo getName($params->proprietario_email, 'FIRST') ?>'),
          last_name: forge_sha256('<?php echo getName($params->proprietario_email, 'LAST') ?>'),
          /*city: forge_sha256('<HASHED DATA>'),
          region: forge_sha256('<HASHED_DATA>'),
          postal_code: forge_sha256('<HASHED_DATA>'),*/
          country: forge_sha256('Brazil')     
        },    
      },
      items: [
        {
          /*item_id: '1',*/
          item_name: 'Adesão',
          quantity: 1,
          price: 650,
          /*item_category: 'bar',
          item_brand: 'baz'*/
        }
      ]
    });
    //
  }

</script>

</body></html>