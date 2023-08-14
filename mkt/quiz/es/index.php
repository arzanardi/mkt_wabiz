<?php
$cache = "202306281715";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>WABiz &ndash; Aplicaciones de entrega </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="adopt-website-id" content="30d03d81-f47f-4c43-b56b-df71b5f057ba" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <!--<script src="//tag.goadopt.io/injector.js?website_code=30d03d81-f47f-4c43-b56b-df71b5f057ba" class="adopt-injector"></script>-->
  <link rel="stylesheet" href="style.css?d=<?php echo $cache ?>">

  <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

 <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://load.espanol-mkt.wabiz.delivery/rncxursp.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NLTFMZQ');</script>
<!-- End Google Tag Manager -->
  

</head>
<body> 
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://load.espanol-mkt.wabiz.delivery/ns.html?id=GTM-NLTFMZQ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  
  <div class="container">
    <div class="black">
      <div id="welcome">
        <div class="question">
          <h1>Estás a punto de descubrir la plataforma de delivery que convierte más ventas para tu restaurante.</h1>
          <p style="background: red; border-radius: 10px;  padding: 10px;">SIN PAGAR COMISIÓN</p>
        </div>
        <div class="answer">
          <button id="continua-1" class="btn">¡VAMOS!<br />⇨ CLICK AQUÍ ⇦</button>
        </div>
      </div>
      <div id="perfil" class="hide">
        <div class="question">
          <h1>Perfil</h1>
          <p>¿En cuál de estos perfiles encajas?</p>
        </div>
        <div class="answer">
          <button name="perfil-answer" id="perfil-1" class="btn">Tengo un establecimiento</button>
          <button name="perfil-answer" id="perfil-2" class="btn">Trabajo en casa</button>
          <button name="perfil-answer" id="perfil-0" class="btn">Otro</button>
        </div>
        <div class="footer">
          <a href="javascript:;" onclick="goBack('welcome')">Volver</a>
        </div>
      </div>
      <div id="type" class="hide">
        <div class="question">
          <h1>Tu negocio</h1>
          <p id="question-type">¿Qué tipo de establecimiento?</p>
        </div>
        <div class="answer">
          <button name="type-answer" class="btn">Casa de vino</button>
          <button name="type-answer" class="btn">Pub</button>          
          <button name="type-answer" class="btn">Panadería</button>
          <button name="type-answer" class="btn">Comida Árabe</button>
          <button name="type-answer" class="btn">Comida Oriental</button>
          <button name="type-answer" class="btn">Comida Variada</button>
          <button name="type-answer" class="btn">Confitería</button>
          <button name="type-answer" class="btn">Emporio</button>
          <button name="type-answer" class="btn">Sfiharia</button>
          <button name="type-answer" class="btn">Tienda de hamburguesas</button>
          <button name="type-answer" class="btn">Cafetería</button>
          <button name="type-answer" class="btn">Marmitex</button>
          <button name="type-answer" class="btn">Mercado</button>
          <button name="type-answer" class="btn">Pastelaría</button>
          <button name="type-answer" class="btn">Pizzería</button> 
          <button name="type-answer" class="btn">Heladería</button>
          <hr />
          <button name="type-answer" class="btn">Otro</button>   
        </div>
        <div class="footer">
          <a href="javascript:;" onclick="goBack('perfil')">Volver</a>
        </div>
      </div>
      <div id="orders" class="hide">
        <div class="question">
          <h1>Pedidos</h1>
          <p>¿Cuántos pedidos recibes de media al día?</p>
        </div>
        <div class="answer">
          <button name="orders-answer" id="orders-0" class="btn">Aun no tomo pedidos</button>
          <button name="orders-answer" id="orders-10" class="btn">A 10</button>
          <button name="orders-answer" id="orders-25" class="btn">De 10 a 25</button>
          <button name="orders-answer" id="orders-50" class="btn">De 25 a 50</button>
          <button name="orders-answer" id="orders-100" class="btn">De 50 a 100</button>
          <button name="orders-answer" id="orders-101" class="btn">Mas que 100</button>
        </div>
        <div class="footer">
          <a href="javascript:;" onclick="goBack('type')">Volver</a>
        </div>
      </div>
      <div id="name" class="hide">
        <div class="question">
          <h1>Casi allí...</h1>
          <p>Finalmente, solo necesitamos algunos datos para servirle mejor:</p>
        </div>
        <div class="answer">
          <input type="text" id="name-answer" placeholder="NOMBRE" />
          <input type="email" id="email-answer" placeholder="CORREO ELECTRÓNICO" />
          <input type="tel" id="phone-answer" placeholder="WHATSAPP" />
          <div style="color: #FFF; font-size: .8em;">Al hacer clic en enviar, usted acepta nuestra <a href="#" style="color: #d7ff5b">política de privacidad</a></div>
          <button id="send" class="btn" onclick="send()">
          ⇨ QUIERO HABLAR ⇦<br />CON UN EXPERTO  
          </button> 
          <br />                 
        </div>
        <div class="footer">
          <a href="javascript:;" onclick="goBack('perfil')">Volver</a>
        </div>
      </div>
      <div id="sending" class="hide">
        <div class="question">
          <h1>¡¡¡Espectáculo!!!</h1>
          
          <p>Espere mientras estamos comprobando la disponibilidad de especialistas en este momento...</p>
        </div>
      </div>
      <div id="end" class="hide">
        <div class="question">
          <h1>¡Gracias!</h1>
          
          <p>Su información ha sido enviada y tan pronto como uno de nuestros especialistas esté disponible, será contactado.</p>
          <p>Siéntase libre, haga sus preguntas, vea una demostración y aprenda cómo una aplicación propia puede ayudarlo a crecer mucho con su negocio.</p>
          <p>¡Triunfo!</p>
          
          <br />
          <p>Estos son también nuestros teléfonos:<br />+55 (11) 94751-9926<br />+55 (11) 4216-3417</p>
          <p>Correo electrónico:<br />ventas@wabiz.com.br</p>
        </div>
      </div>
    </div>
    
  </div>
  <!--<div id="fb-root"></div>-->
  
  <!-- Global site tag (gtag.js) - Google Analytics
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-N3LBCTRTJK"></script> -->

  

  <script src='forge-sha256.min.js'></script>
  <script>

    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'GTM-NLTFMZQ');    
  
    function generateEventId() {
      var gtmData = window.google_tag_manager['GTM-NLTFMZQ'].dataLayer.get('gtm');
      return gtmData.start + '.' + gtmData.uniqueEventId;
    }
    
    function getName(fullName, first_or_last) {
      var firstName = fullName.split(' ').slice(0, -1).join(' ');
      var lastName = fullName.split(' ').slice(-1).join(' ');
      return first_or_last != 'LAST' ? firstName : lastName;
    }
    
    function trackContact(event, name, email, phone) {
      gtag('event', event,
      {
        'x-fb-event_id': generateEventId(),
        user_data: {
          email_address: forge_sha256(email),
          phone_number: forge_sha256(phone),
          address: {
            first_name: forge_sha256(getName(name, 'FIRST')),
            last_name: forge_sha256(getName(name, 'LAST')),
            /*city: forge_sha256('<HASHED DATA>'),
            region: forge_sha256('<HASHED_DATA>'),
            postal_code: forge_sha256('<HASHED_DATA>'),
            country: forge_sha256('Brazil')*/     
          }    
        }
      });  
      
    }
    
   

  </script>
  <script type="text/javascript" src="script.js?d=<?php echo $cache ?>"></script>  
  
</html>
