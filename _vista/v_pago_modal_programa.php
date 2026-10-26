<!-- Modal -->
<html>

<head>
  <style>
    ol {
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }
  </style>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    function validarNumeroDNI(input) {
      // Limpiar cualquier caracter no numérico
      var dni = input.value.replace(/[^0-9]/g, '');

      // Limitar a 8 dígitos
      if (input.value.length > 8) {
        input.value = input.value.slice(0, 8);
      }

      //Consulta datos del alumno
      var form = new FormData();
      form.append('dni', dni);

      $.ajax({
        url: "../api_alumno.php",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: form,
        dataType: 'JSON',
        success: function(mensaje) {
          var nom = mensaje.nom;
          var cel = mensaje.cel;
          var correo = mensaje.email;

          $("#nom").val(nom);
          $("#cel").val(cel);
          $("#correo").val(correo);

          $("#nom_").val(nom);
          $("#cel_").val(cel);
          $("#correo_").val(correo);
        }
      });
    }

    function validarNumeroCel(input) {
      // Limpiar cualquier caracter no numérico
      input.value = input.value.replace(/[^0-9]/g, '');

      // Limitar a 9 dígitos
      if (input.value.length > 9) {
        input.value = input.value.slice(0, 9);
      }
    }
  </script>

  <div class="modal" id="modal">
    <div class="modal-content">
      <button class="modal-button-close">&times;</button>
      <div class="card card__body">
        <h3 id="text_curso" class="l-courses-layout__aside" align="center"></h3>
        <!-- Tabs -->
        <div class="center tabs--forms" style="padding: 1rem;">
          <nav class="navbar-tabs" data-tabs="auth-tabs">
            <a href="#datos" id="datos" class="nav-link active">1. Ingresar datos</a>
            <a href="#pago" id="pago" class="nav-link">2. Realizar Pago</a>
            <a href="#fin" id="fin" class="nav-link">3. Finalizar Compra</a>
          </nav>

          <div class="tabs" id="auth-tabs">
            <div class="tabs-content">
              <section id="datos" class="tab-active">
                <form action="">
                  <div class="material-input material-input--primary">
                    <input type="number" id="dni" autocomplete="off" oninput="validarNumeroDNI(this)">
                    <label for="dni">DNI</label>
                  </div>

                  <div class="material-input material-input--primary">
                    <input type="email" id="nom" autocomplete="off">
                    <label for="nom">Nombres y Apellidos</label>
                  </div>

                  <div class="material-input material-input--primary">
                    <input type="number" id="cel" autocomplete="off" oninput="validarNumeroCel(this)">
                    <label for="cel">Celular</label>
                  </div>

                  <div class="material-input material-input--primary">
                    <input type="email" id="correo" autocomplete="off">
                    <label for="correo">Email</label>
                  </div>

                  <!-- Captcha -->
                  <div class="material-input material-input--primary">
                    <center> <div class="g-recaptcha" data-sitekey="6LeXETQpAAAAAKyKXLEeLDWeoKaY6W4WaOj3yIfa"></div></center>
                  </div>

                  <p class="t-center">
                    <a class="btn btn--outline btn--primary btn--full" onclick="Continuar(pago);">Continuar</a>
                  </p>
                </form>
              </section>

              <section id="pago" class="tab">
                <div class="accordion-bral" id="nofree" style="display: block;">
                  <div>
                    <input class="ac-input" id="ac-1" name="accordion-1" type="checkbox" checked />
                    <label class="ac-label" for="ac-1">Yape o Plin<i></i></label>
                    <div class="article ac-content">
                      <div class="material-input material-input--primary">
                        <p align="center">
                          <img src="admin/img/mediopago/plinyape.png" class="img-fluid" width="20%">
                          <strong>al CONTACTO_CONFIGURABLE</strong> a nombre de la persona autorizada.
                        </p>
                        <br>
                        <a class="btn btn--outline btn--primary btn--full" onclick="Continuar2('1');">Enviar captura</a>
                        <!-- <img src="admin/img/mediopago/yape.jpeg" class="img-fluid"> -->
                      </div>
                      <p class="t-center">
                        <input type="hidden" id="programa_modal">
                        <input type="hidden" id="id_programa">
                        <input type="hidden" id="prech" value="0">
                      </p>
                    </div>
                  </div>

                  <div>
                    <input class="ac-input" id="ac-2" name="accordion-2" type="checkbox" />
                    <label class="ac-label" for="ac-2">Tarjeta Débito/Crédito<i></i></label>
                    <div class="article ac-content">
                      <div id="nofree_tarjeta">
                        <!-- aqui va el formulario IZIPAY -->
                      </div>
                    </div>
                  </div>

                  <div>
                      <input class="ac-input" id="ac-3" name="accordion-3" type="checkbox"/>
                      <label class="ac-label" for="ac-3">Paypal<i></i></label>
                      <div class="article ac-content">  
                        <div id="paypal">
                          <!-- aqui va el formulario PAYPAL -->
                          <br>
                          <div id="paypal-button-container"></div>
                         </div>  
                      </div>
                  </div> 


                </div>

                <div id="free" style="display: none;">
                  <br><br>
                  <article class="card card--course-desc">
                    <h4 align="center" class="card__title">PROGRAMA GRATUITO</h4>
                    <p align="center">No requiere realizar pago.
                    <p>
                  </article>
                  <br><br>
                  <a class="btn btn--outline btn--primary btn--full" onclick="Continuar2('0');">Continuar</a></p>
                </div>
              </section>

              <section id="fin" class="tab">
                <br>
                <h1 align="center">¡Listo!</h1>
                <br>
                <h3 align="center">Ahora sigue los siguientes pasos:</h3>
                <br>
                <ol align="center">
                  <li>Ingresa a <strong><a href="https://educatecvirtual.com" target="_blank">www.educatecvirtual.com</a></strong></li>
                  <li>Ingresa tu <strong>DNI como usuario y contraseña</strong>.</li>
                  <li>Seleccionar la institución <strong>Rysoft</strong>.</li>
                  <li>Dale clic a <strong>Ingresar</strong>.</li>
                  <li>Ingresa a la sección <strong>Anuncios.</strong></li>
                </ol>
                <br>
                <h1 align="center">¡Y comienza este nuevo aprendizaje!</h1>
                <p class="t-center">
                  <a href="https://educatecvirtual.com" target="_blank" class="btn btn--outline btn--primary btn--full">Comenzar</a>
                </p>
              </section>
            </div>
          </div>
        </div>
        <!-- End Tabs -->
      </div>
    </div>
  </div>
  <!-- <br> -->
  <!-- End Modal -->
</head>

</html>