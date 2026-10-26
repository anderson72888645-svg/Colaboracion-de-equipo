<!-- Modal -->
  <div class="modal" id="modal">
    <div class="modal-content">
      <button class="modal-button-close">&times;</button>
      <div class="card card__body">
        <!-- Tabs -->
        <div class="center tabs--forms" style="padding: 1rem;">
          <nav class="navbar-tabs" data-tabs="auth-tabs">
            <a href="#datos" id="datos" class="nav-link">Ingresar datos</a>
          </nav>
          <div class="tabs" id="auth-tabs">
            <div class="tabs-content">


              <section id="datos" class="tab">
                <form action="">

                <div class="material-input material-input--primary">
                    <input type="email" id="nom" autocomplete="off">
                    <label for="email">Nombres y Apellidos</label>
                  </div>

                  <div class="material-input material-input--primary">
                    <input type="number" id="dni" autocomplete="off">
                    <label for="dni">DNI</label>
                  </div>

                  <div class="material-input material-input--primary">
                    <input type="number" id="cel" autocomplete="off">
                    <label for="cel">Celular</label>
                  </div>

                  <div class="material-input material-input--primary">
                    <input type="email" id="correo" autocomplete="off">
                    <label for="email">Email</label>
                  </div>

                  <p class="t-center">
                    <input type="button" value="Comprar" class="btn btn--primary" onclick="InscribirseModal();">
                    <input type="hidden" id="course_modal">
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