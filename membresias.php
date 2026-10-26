<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Membresias</title>
  <?php require("_vista/v_estilos.php"); ?>

  <!-- IZIPAY -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="assets/css/classic.css">
  <link rel="stylesheet" href="https://api.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic-reset.css">
  <script src="https://api.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.js"></script>
  <!--IZIPAY -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script type="text/javascript">
    function abrirModal(id, nom, prec) {
      document.getElementById('datos').click();

      var miEnlace = document.getElementById('pago');
      miEnlace.href = 'javascript:void(0)';

      var miEnlace2 = document.getElementById('fin');
      miEnlace2.href = 'javascript:void(0)';

      document.getElementById('membresia_modal').value = id;
      document.getElementById('id_membresia').value = id;
      document.getElementById('text_membresia').innerHTML = nom + " (" + prec + ")";

      if (prec == "Free") {
        var seccion = document.getElementById("nofree");
        seccion.style.display = "none";

        var seccion2 = document.getElementById("free");
        seccion2.style.display = "block";
      } else {
        var seccion = document.getElementById("nofree");
        seccion.style.display = "block";

        var seccion2 = document.getElementById("free");
        seccion2.style.display = "none";
      }

      document.getElementById('comprar').click();
      var prec = prec.replace("S/ ", "");
      document.getElementById('prech').value = prec;
    }

    function Continuar() {
      var nom = $("#nom").val();
      var dni = $("#dni").val();
      var cel = $("#cel").val();
      var correo = $("#correo").val();
      var membresia = $("#membresia_modal").val();
      var prech = $("#prech").val();
      var id_membresia = $("#id_membresia").val();

      if (nom == "" || dni == "" || cel == "" || correo == "") {
        //alert("Complete todos los campos");
        Swal.fire({
          icon: "warning",
          title: "Campos vacíos",
          text: "Debe completar todos sus datos",
          confirmButtonColor: "#bf0e09",
        });
      } else {
        /* var response = 1; //Pruebas sin captcha */
        var response = grecaptcha.getResponse();

        if (response.length == 0) {
          //alert("Captcha no verificado")
          Swal.fire({
            icon: "warning",
            title: "Captcha no verificado",
            text: "Verificar código Captcha",
            confirmButtonColor: "#bf0e09",
          });
        } else {
          //bloquear para ver pestaa de datos
          var miEnlace = document.getElementById('datos');
          miEnlace.href = 'javascript:void(0)';

          var form = new FormData();
          form.append('amount', prech);
          form.append('email', correo);

          $.ajax({
            url: "izipay.php",
            type: "POST",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            success: function(data) {

              var formToken = data.formToken;

              var script = document.createElement('script');
              script.src = "https://api.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js";
              script.setAttribute("kr-public-key", window.CURSOS_PAYMENT_PUBLIC_KEY || "");

              document.body.appendChild(script);

              var htmlCode = '<div class="formulario">' +
                '<div class="kr-embedded" kr-form-token="' + formToken + '">' +
                '<!-- payment form fields -->' +
                '<div class="kr-pan"></div>' +
                '<div class="kr-expiry"></div>' +
                '<div class="kr-security-code"></div>' +
                '<!-- payment form submit button -->' +
                '<button class="kr-payment-button"></button>' +
                '<!-- error zone -->' +
                '<div class="kr-form-error"></div>' +
                '</div>' +
                '</div>';

              console.log("formToken recibido:", formToken);
              $('#nofree_tarjeta').html(htmlCode);

              script.onload = function() {
                $(document).ready(function() {
                  KR.onSubmit(function(event) {
                    $(".kr-payment-button > span:first").html(event.clientAnswer.orderStatus);
                    $(".kr-spinner").hide();
                    $(".kr-payment-button > span:first").show();

                    if (event.clientAnswer.orderStatus == 'PAID') {
                      //Registrar al usuario e inscribir al curso
                      //mandarlo como free para que matricule ya que se ha pagado con tarjeta
                      $.post("api_inscripcion_membresia.php", {
                        free: 0,
                        nom: nom,
                        dni: dni,
                        cel: cel,
                        correo: correo,
                        id_membresia: id_membresia
                      }, function(mensaje) {});

                      Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "¡Pago exitoso!",
                        showConfirmButton: false,
                        timer: 2000
                      }).then((result) => {
                        var miEnlace = document.getElementById('fin');
                        miEnlace.href = '#fin';
                        document.getElementById('fin').click();

                        //bloquear para ver pestaa de pago
                        var miEnlace2 = document.getElementById('pago');
                        miEnlace2.href = 'javascript:void(0)';
                      });
                    }
                    return false;
                  });
                });
              };
            }
          });

          //alert("Captcha verificado");
          var miEnlace = document.getElementById('pago');
          miEnlace.href = '#pago';

          document.getElementById('pago').click();
        }
      }
    }

    function Continuar2(free) {
      var nom = $("#nom").val();
      var dni = $("#dni").val();
      var cel = $("#cel").val();
      var correo = $("#correo").val();
      var membresia = $("#membresia_modal").val();

      var id_membresia = $("#id_membresia").val();

      if (nom == "" || dni == "" || cel == "" || correo == "") {
        //alert("Complete todos los campos");
        Swal.fire({
          icon: "warning",
          title: "Campos vacíos",
          text: "Debe completar todos sus datos",
          confirmButtonColor: "#bf0e09",
        });
      } else {
        //Registrar al usuario
        $.post("api_inscripcion_membresia.php", {
          free: free,
          nom: nom,
          dni: dni,
          cel: cel,
          correo: correo,
          id_membresia: id_membresia
        }, function(mensaje) {});

        var miEnlace = document.getElementById('fin');
        miEnlace.href = '#fin';
        document.getElementById('fin').click();

        if (free == "1") {
          var ref_wsp = "https://cursos.gruporysoft.com/membership.php?i=" + membresia + "%0A%0AHola, he comprado la membresia y envío la captura del pago correspondiente." + "%0A%0ANombres: " + nom + "%0ADNI: " + dni + "%0ACelular: " + cel + "%0AEmail: " + correo + "";

          window.open('#?text=' + ref_wsp, '_blank');
        }
      }
    }
  </script>
</head>

<body>

  <?php
  require("_modelo/m_membresias.php");
  $membresias = MostrarMembresias();

  require("_vista/v_acciones.php");
  require("_vista/v_pago_modal_membresia.php");
  require("_vista/v_menu2.php");
  ?>

  <main>
    <div class="container">

      <?php
      require("_vista/v_membresias_title.php");
      require("_vista/v_membresias.php");
      ?>

    </div><!-- .container -->
  </main>
  <br>

  <?php
  require("_vista/v_footer.php");
  require("_vista/v_script.php");
  ?>

</body>

</html>
