<article class="card card--course-desc card--program">
  <div class="card__img">
    <img src="<?php echo $foto_membresia; ?>" alt="Imágen">
    <!-- <h3 class="card__img-title">¡Aprende sin limitaciones durante un año!</h3> -->
  </div><!-- .card__img -->
  <div class="card__body">
    <h4 class="card__title"><?php echo $nom_membresia; ?></h4>

    <!-- <p style="font-weight: 700; font-size: 18px !important;">
      <strong>
        ¿Qué es Zegel Virtual?
      </strong>
    </p>

    <p class="card__text">
      <strong>
        Todo lo que necesitas para especializarte, en un solo lugar. Sin horarios fijos y a tu ritmo.
      </strong>
    </p> -->

    <p class="card__text">
      <?php echo $desc_membresia; ?>
    </p>

    <div class="d-flex justify-content-between prices">
      <div>
        <p class="discount">
          <?php echo $dscto_membresia; ?>% de dscto.
        </p>
      </div>

      <p class="price">
        <span><?php echo $precioInicial; ?></span>
        <span><?php echo $precio; ?></span>
      </p>
    </div>

    <div class="card__buttons">
      <!-- <a class="btn btn--outline btn--outline-primary btn--rounded" href="#">
        <i class="fa fa-shopping-cart"></i>
      </a> -->
      <a class="btn btn--outline btn--outline-primary btn--full" onclick="abrirModal('<?php echo $id_membresia; ?>','<?php echo $nom_membresia; ?>','<?php echo $precio; ?>')">
            Comprar ahora
          </a>
          <a href="#" id="comprar" data-modal="#modal"></a>
    </div>
  </div><!-- .card__body -->
</article><!-- .card -->