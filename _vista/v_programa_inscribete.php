<div class="l-page-generic__aside">
  <div class="hero-form fixed-sticky">
    <div class="hero-form__body">
      <h2 style="line-height: 1; font-size: 25px">Inscríbete aquí</h2>
      <!-- <form action="#"> -->

      <div class="material-input">
        <input type="number" id="dni_" autocomplete="off" oninput="validarNumeroDNI(this)">
        <label for="dni">DNI</label>
      </div>

      <div class="material-input">
        <input type="text" id="nom_" autocomplete="off">
        <label for="nom">Nombres</label>
      </div>


      <div class="material-input">
        <input type="number" id="cel_" autocomplete="off" oninput="validarNumeroCel(this)">
        <label for="cel">Celular</label>
      </div>

      <div class="material-input">
        <input type="email" id="correo_" autocomplete="off">
        <label for="correo">Email</label>
      </div>

      <!-- <label class="checkbox">
        <input type="checkbox">
        <span>
          Acepto haber leído las <a href="#">políticas de privacidad</a> y los <a href="#">términos y condiciones</a>
        </span>.
      </label> -->

      <div class="t-center">
        <input type="hidden" id="idpro" value="<?php echo $id_programa; ?>">
        <input class="btn btn--primary" type="submit" value="Inscribirme" onclick="Inscribirse();">
        <input type="hidden" id="prepro" value="<?php echo $precio; ?>">
        <input type="hidden" id="nompro" value="<?php echo $nom_programa; ?>">
      </div>
      <!-- </form> -->
    </div>
  </div>
</div>