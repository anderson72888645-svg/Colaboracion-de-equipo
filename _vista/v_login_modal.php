<!-- Modal -->
<div class="modal" id="modal">
  <div class="modal-content">
    <button class="modal-button-close">&times;</button>
    <div class="card card__body">
      <!-- Tabs -->
      <div class="center tabs--forms" style="padding: 1rem;">
        <nav class="navbar-tabs" data-tabs="auth-tabs">
          <a href="#login" class="nav-link active">Iniciar Sesión</a>
          <a href="#register" class="nav-link">Registro</a>
        </nav>
        <div class="tabs" id="auth-tabs">
          <div class="tabs-content">
            <section id="login" class="tab-active"><!-- Importante esta clse tab active -->
              <form action="">
                <div class="material-input material-input--primary">
                  <input placeholder="" type="email" id="email" autocomplete="off">
                  <label for="email">Correo electrónico</label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="password" id="pass" autocomplete="off">
                  <label for="pass">Contraseña</label>
                </div>

                <p>
                  <a href="reset_password.php">He olvidado mi contraseña</a>
                </p>

                <p class="t-center">
                  <input placeholder="" type="submit" value="Ingresar" class="btn btn--primary">
                </p>
              </form>
            </section>
            <section id="register">
              <form action="" class="l-form-modal">
                <h3 class="l-form-modal__full">Crea tu cuenta</h3>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="email" id="email" autocomplete="off">
                  <label for="email">Correo electrónico</label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="password" id="pass" autocomplete="off">
                  <label for="pass">Contraseña</label>
                </div>

                <h3 class="l-form-modal__full">Llena tus datos</h3>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="email" id="email" autocomplete="off">
                  <label for="email">Correo electrónico</label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="password" id="pass" autocomplete="off">
                  <label for="pass">Contraseña</label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="email" id="email" autocomplete="off">
                  <label for="email">Correo electrónico</label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="password" id="pass" autocomplete="off">
                  <label for="pass">Contraseña</label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="email" id="email" autocomplete="off">
                  <label for="email">Correo electrónico</label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="password" id="pass" autocomplete="off">
                  <label for="pass">Contraseña</label>
                </div>

                <h3 class="l-form-modal__full">¿Factura?</h3>

                <div class="l-form-modal__full">
                  <label class="d-iflex aic" style="margin-right: 10px;">
                    <input placeholder="" type="radio" name="factura" style="margin-right: 5px;">
                    Si
                  </label>
                  <label class="d-iflex aic">
                    <input placeholder="" type="radio" name="factura" style="margin-right: 5px;">
                    No
                  </label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="password" id="pass" autocomplete="off">
                  <label for="pass">Contraseña</label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="email" id="email" autocomplete="off">
                  <label for="email">Correo electrónico</label>
                </div>

                <div class="material-input material-input--primary">
                  <input placeholder="" type="password" id="pass" autocomplete="off">
                  <label for="pass">Contraseña</label>
                </div>

                <p class="l-form-modal__full">
                  Tus datos personales se utilizarán para procesar tu pedido, mejorar tu experiencia en esta web, gestionar el acceso a tu cuenta y otros propósitos, conoce nuestros <a href="">términos y condiciones</a>
                </p>

                <p class="l-form-modal__full t-center">
                  <input placeholder="" type="submit" value="Crear Cuenta" class="btn btn--primary">
                </p>
              </form>
            </section>
          </div>
        </div>
      </div>
      <!-- End Tabs -->
    </div>
  </div>
</div>
<!-- End Modal -->