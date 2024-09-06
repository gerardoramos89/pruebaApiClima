<?php
include("../connect/config.php");
include '../vendor/autoload.php';

$message = "";

session_start();

if (isset( $_SESSION['usuario'] ) ) {
   header("location: ../auction/index.php");
} 
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta http-equiv="Expires" content="0">
   <meta http-equiv="Last-Modified" content="0">
   <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
   <meta http-equiv="Pragma" content="no-cache">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="css/style_login.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <!-- <link rel="stylesheet" href="css/all.min.css"> -->
   <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
   <title>Inicio de sesión</title>
</head>

<body>
   <img class="wave" src="img/wave.png">
   <div class="container">
   <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">

<!-- Then put toasts within -->

      <div class="img">
      <img src="img/mula.png">
      </div>
      <div class="login-content">
         <form action="" method="post" name="signin-form">
            <img src="img/avatar.svg">
            <p>V: <span id="version"></span></p>
            <select id="language" name="language" onchange="translatefun()">
            <option value="" selected></option>
            <?php
               foreach ($lenguaje_array as $valores):
                  echo '<option value="'.$valores["Lang"].'">'.$valores["LangName"].'</option>';
               endforeach;
            ?>            >     
               <!-- Agrega más opciones según tus necesidades -->
            </select>
            <h2><span class="title" for="language" id="tittlesign" data-translate-key="textbtnsing"></span></h2>
            <div class="input-div one">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <!-- <h5 for="language" data-translate-key="textuser">Usuario</h5> -->
                  <input type="text" name="username" id="username" required />
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <!-- <h5 for="language" data-translate-key="textwpass">Contraseña</h5> -->
                  <input type="password" name="password" id="password" required />
               </div>
            </div>
            <div class="view">
               <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
            </div>
            <div class="text-center" id="notificacion">
            <div id="mensaje_not" className="mensaje_not"></div>
            </div>

            <button type="submit" name="login" id="login" class="btn"  value="login"  onclick="validarUsuario();" for="language" data-translate-key="textbtnsing">INICIAR SESION</button>
            <div class="text-center">
               <a class="font-italic isai5" href="recovery.php" for="language" data-translate-key="textwforgot">>Olvidé mi contraseña</a>
               <a class="font-italic isai5" href="register.php" for="language" data-translate-key="textsregister">>Registrarse</a>
               <a class="font-italic isai5" href="./" for="language" data-translate-key="textreturn">Regresar</a>
            </div>
            <div class="text-center" id="languageSelect" name="languageSelect">
                  <?php echo $message;?>
            </div>
                              <!-- loader  -->
                              <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      </div>
         </form>

   </div>
   <script type="text/javascript" src="js/translations.js"></script>
   <script src="js/version.js"></script>

<script>
         // Muestra la versión en el elemento con id 'version'
         document.getElementById('version').innerText = siteVersion;

         // Verifica si la versión en el navegador coincide con la versión actual
         window.onload = function() {
               const storedVersion = localStorage.getItem('siteVersion');
               if (storedVersion !== siteVersion) {
                  document.getElementById("notificacion").style.display = "block";
                  document.getElementById('mensaje_not').style.color = "white";
                  document.getElementById("notificacion").style.display = "block";
                  document.getElementById('mensaje_not').innerHTML = '<p class="error" for="language" data-translate-key="texterrorversion" translate="yes">¡La versión del sitio ha sido actualizada! Por favor, actualiza tu navegador.</p>';
                  localStorage.setItem('siteVersion', siteVersion);
               }
         };

         function enviarPeticion(bool) {
            // Deshabilitar el botón después de hacer clic en él
            document.getElementById('login').disabled = bool;
         }

         async function validarUsuario() {
            enviarPeticion(true);

            document.getElementById("notificacion").style.display = "none";
            var username = document.getElementById("username").value;
            // Using test we can check if the text match the pattern
            if(username == '' || username == null){
               document.getElementById("notificacion").style.display = "block";
               document.getElementById('mensaje_not').style.color = "white";
               document.getElementById("notificacion").style.display = "block";
               document.getElementById('mensaje_not').innerHTML = '<p class="error" for="language" data-translate-key="text_reg_error_username" translate="yes"></p>';
               document.getElementById("username").focus();
               translate();
               return;
            }

            document.getElementById("notificacion").style.display = "none";
            var password = document.getElementById("password").value;
            if(password == '' || password == null){
            document.getElementById("notificacion").style.display = "block";
            document.getElementById('mensaje_not').style.color = "white";
            document.getElementById("notificacion").style.display = "block";
            document.getElementById('mensaje_not').innerHTML = '<p class="error" for="language"  data-translate-key="text_reg_error_pass" translate="yes"></p>';
            document.getElementById("password").focus();
            enviarPeticion(false);

            translate();
            return;
            }

            // Enviamos la variable de javascript a archivo.php		
            $.post("app/controller/logincontroller.php",{"username": username,"password":password},function(respuesta){
               document.getElementById("notificacion").style.display = "block";
               document.getElementById('mensaje_not').style.color = "Green";
               document.getElementById("notificacion").style.display = "block";
               document.getElementById('mensaje_not').innerHTML = respuesta;
               translate();
               enviarPeticion(false);

               if(respuesta == '<p class="success"  for="language"  data-translate-key="textcongrats" translate="yes">Congratulations, you are logged in!</p>'){
                  MiFuncionRedirect();
                  return;
               }

            });
         }

         async function MiFuncionRedirect(){
               setTimeout( function() { window.location.href = "../auction/profile.php"; }, 1000 );
         }


         var selectedLanguage = localStorage.getItem('lang');
         if(localStorage.getItem('lang') === null)
         {
            selectedLanguage = window.navigator.language || navigator.browserLanguage;
            selectedLanguage = selectedLanguage.split('-');
            selectedLanguage = selectedLanguage[0];
         }


         const elementsToTranslate = document.querySelectorAll('[data-translate-key]');
         elementsToTranslate.forEach(element => {
         const translationKey = element.getAttribute('data-translate-key');

         const translation = translations[selectedLanguage.toLowerCase()][translationKey];

         if (translation) {
            element.innerHTML = translation;
         }
         });

         function translate() {

         if(localStorage.getItem('lang') === null)
         {
            selectedLanguage = window.navigator.language || navigator.browserLanguage;
            selectedLanguage = selectedLanguage.split('-');
            selectedLanguage = selectedLanguage[0];
         }else{
            selectedLanguage = localStorage.getItem('lang');
         }

         const elementsToTranslate = document.querySelectorAll('[data-translate-key]');

         elementsToTranslate.forEach(element => {
         const translationKey = element.getAttribute('data-translate-key');

         const translation = translations[selectedLanguage.toLowerCase()][translationKey];

         localStorage.setItem('lang', selectedLanguage.toLowerCase());

         if (translation) {
            element.innerHTML = translation;
         }
         });
      }

function translatefun() {
      const selectedLanguage = document.getElementById('language').value;



      const elementsToTranslate = document.querySelectorAll('[data-translate-key]');
      localStorage.setItem('lang', selectedLanguage);

      elementsToTranslate.forEach(element => {
        const translationKey = element.getAttribute('data-translate-key');
        const translation = translations[selectedLanguage][translationKey];
        if (translation) {
          element.innerHTML = translation;
        }
      });
    }
</script>

   <script src="js/fontawesome.js"></script>
   <script src="js/main.js"></script>
   <script src="js/main2.js"></script>
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.js"></script>
   <script src="js/bootstrap.bundle.js"></script>
   <script src="js/custom.js"></script>

</body>

</html>