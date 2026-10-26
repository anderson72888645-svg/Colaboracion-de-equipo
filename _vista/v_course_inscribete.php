<div class="l-page-generic__aside">
  <div class="hero-form fixed-sticky">
    <div class="hero-form__body">
      <h2 style="line-height: 1; font-size: 25px">Inscríbete aquí</h2>
      <!-- <form action="#"> -->

      <div class="material-input">
        <input placeholder="" type="number" id="dni_" autocomplete="off" oninput="validarNumeroDNI(this)">
        <label for="dni_">DNI</label>
      </div>

      <div class="material-input">
        <input placeholder="" type="text" id="nom_" autocomplete="off">
        <label for="nom_">Nombres</label>
      </div>


      <div class="material-input">
        <input placeholder="" type="number" id="cel_" autocomplete="off" oninput="validarNumeroCel(this)">
        <label for="cel_">Celular</label>
      </div>

      <div class="material-input">
        <input placeholder="" type="email" id="correo_" autocomplete="off">
        <label for="correo_">Email</label>
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
        <input type="hidden" id="course" value="<?php echo $id_curso; ?>">
        <input class="btn btn--primary" type="submit" value="Inscribirme" onclick="Inscribirse();">
        <input type="hidden" id="prect" value="<?php echo $prec; ?>">
        <input type="hidden" id="nomt" value="<?php echo $nom_curso; ?>">
        <input type="hidden" id="hort" value="<?php echo $id_horario; ?>">
      </div>
      <!-- </form> -->
    </div>
  </div>
</div>