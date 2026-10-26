<section class="l-page-generic__main">
  <form action="" class="detail__form">
    <div class="hero-form shadow">
      <div class="hero-form__body">
        <h2 style="line-height: 1; font-size: 25px; text-align: left; color: var(--black)">Detalles de facturacion</h2>

        <div class="material-input material-input--primary">
          <input placeholder="" type="text" id="names" autocomplete="off">
          <label for="names">Nombres</label>
        </div>

        <div class="material-input material-input--primary">
          <input placeholder="" type="text" id="lastname" autocomplete="off">
          <label for="lastname">Apellidos</label>
        </div>

        <div class="material-input material-input--primary">
          <input placeholder="" type="tel" id="phone" autocomplete="off">
          <label for="phone">Celular</label>
        </div>

        <div class="material-input material-input--primary">
          <input placeholder="" type="email" id="email" autocomplete="off">
          <label for="email">Email</label>
        </div>

        <div class="select">
          <select id="course" class="form-control">
            <option selected disabled>¿Qué quieres estudiar?</option>
            <option value="1">Curso 1</option>
            <option value="2">Curso 2</option>
            <option value="3">Curso 3</option>
          </select>
          <i class="fa fa-angle-down"></i>
        </div>

        <div class="material-input material-input--primary">
          <input placeholder="" type="document" id="document" autocomplete="off">
          <label for="document">Documento</label>
        </div>

        <div class="material-input material-input--primary">
          <input placeholder="" type="other" id="other" autocomplete="off">
          <label for="other">Dato Necesario *</label>
        </div>

        <p class="fw5" style="margin-bottom: .5rem;">¿Factura?</p>
        <div style="margin-bottom: 1rem;">
          <label style="margin-right: 10px">
            <input placeholder="" type="radio" name="factura">
            Si
          </label>
          <label>
            <input placeholder="" type="radio" name="factura" checked>
            No
          </label>
        </div>

        <div class="factura">
          <div class="material-input material-input--primary">
            <input placeholder="" type="document" id="document" autocomplete="off">
            <label for="document">Documento</label>
          </div>

          <div class="material-input material-input--primary">
            <input placeholder="" type="other" id="other" autocomplete="off">
            <label for="other">Dato Necesario *</label>
          </div>
        </div>
      </div>
    </div><!-- .card -->
  </form>
</section><!-- .l-page-generic__main -->