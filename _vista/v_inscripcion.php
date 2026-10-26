<div class="hero l-hero-form">
  <div class="img-bg img-bg-seguro" aria-hidden="true"></div>

  <div class="container">
    <div class="grid">

      <div class="col-12 col-md-4">

        <div class="hero-form" id="hero-formulario">
          <div class="hero-form__body">

            <h2>Inscríbete aquí</h2>
            <!-- <form action="#"> -->
            <div class="select">

              <select id="course" class="form-control">
                <option selected value="">¿Qué quieres estudiar?</option>
                <?php
                foreach ($curso as $key) {
                  $id_curso = $key['id_curso'];
                  $nom_curso = $key['nom_curso'];
                  $prec_curso = $key['prec_curso'];
                  $dscto_curso = $key['dscto_curso'];
                  $prec = $prec_curso - ($prec_curso * $dscto_curso / 100);
                  if ($prec == 0) {
                    $prec = "Free";
                  } else {
                    $prec = "S/" . $prec;
                  }

                  $id_horario = $key['id_horario'];

                  $opcionConcatenada = $id_curso . "|" . $nom_curso . "|" . $prec . "|" . $id_horario;

                ?>
                  <option value="<?php echo $opcionConcatenada; ?>"><?php echo $nom_curso . " (" . $prec . ")"; ?></option>
                <?php

                }
                ?>
              </select>

              <i class="fa fa-angle-down"></i>
            </div>

            <div class="material-input material-input--plomo">
              <input placeholder="" type="number" id="dni_" autocomplete="off" oninput="validarNumeroDNI(this)">
              <label for="dni">DNI</label>
            </div>

            <div class="material-input material-input--plomo">
              <input placeholder="" type="text" id="nom_" autocomplete="off">
              <label for="nom">Nombres y Apellidos</label>
            </div>

            <div class="material-input material-input--plomo">
              <input placeholder="" type="number" id="cel_" autocomplete="off" oninput="validarNumeroCel(this)">
              <label for="cel">Celular</label>
            </div>

            <div class="material-input material-input--plomo">
              <input placeholder="" type="email" id="correo_" autocomplete="off">
              <label for="email">Email</label>
            </div>

            <!--
                    <label class="checkbox">
                    <input type="checkbox">
                    <span>
                      Acepto haber leído las <a href="#">políticas de privacidad</a> y los <a href="#">términos y condiciones</a>
                    </span>.
                  </label>
                  -->

            <div class="t-center">
              <input placeholder="" class="btn btn--primary" type="submit" value="Inscribirme" onclick="Inscribirse();">
              <!-- 
                    <input type="hidden" id="prect" value="<?php echo $prec; ?>">
                    <input type="hidden" id="nomt" value="<?php echo $nom_curso; ?>">
                    -->
            </div>
            <!-- </form> -->

          </div>
        </div>

      </div>

    </div><!-- .grid -->
  </div><!-- .cotainer -->


</div>