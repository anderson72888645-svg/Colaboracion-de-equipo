<!-- Course -->
<article class="card card--course-desc">
  <div class="card__img">
    <img src="<?php echo $foto_programa; ?>" alt="Imagen de programa">
  </div><!-- .card__img -->
  <div class="card__body">
    <h4 class="card__title"><?php echo $nom_programa; ?></h4>

    <p class="card__text"><?php echo $desc_programa; ?></p>

    <div class="d-flex justify-content-between prices">
      <div>
        <p class="discount">
          <?php echo $descuento; ?>% de dscto.
        </p>
      </div>

      <p class="price">
        <span><?php echo $costoTotal; ?></span>
        <span><?php echo $precio; ?></span>
      </p>
    </div>

    <div class="d-flex justify-content-between prices align-items-center course-icons">
      <!-- <p>
        <i class="far fa-clock"></i>
        22 horas
      </p> -->

      <p>
        <i class="far fa-file"></i>
        <?php echo $cantidadCursos; ?> cursos
      </p>

      <!-- <p>
        <i class="far fa-star"></i>
        4.2
      </p> -->
    </div>

    <div class="card__buttons">
      <!-- <a class="btn btn--outline btn--outline-primary btn--rounded" href="#">
        <i class="fa fa-shopping-cart"></i>
      </a> -->
      <a class="btn btn--outline btn--outline-primary btn--full" onclick="abrirModal('<?php echo $id_programa; ?>','<?php echo $nom_programa; ?>','<?php echo $precio; ?>')">
      <!-- <a class="btn btn--outline btn--outline-primary btn--full" href="comprar-ahora.html"> -->
        Comprar ahora
      </a>
      <a href="#" id="comprar" data-modal="#modal"></a>
    </div>
  </div><!-- .card__body -->
</article><!-- .card -->