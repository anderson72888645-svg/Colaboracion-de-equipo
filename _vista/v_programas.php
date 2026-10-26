<div class="l-grid-page">
  <?php
  foreach ($programas as $key) {
    $id_programa = $key['id_programa'];
    $nom_programa = $key['nom_programa'];
    $prec_programa = $key['prec_programa'];
    if ($prec_programa == 0) {
      $prec_programa = "Free";
    } else {
      $prec_programa = "S/ " . $prec_programa;
    }
    $desc_programa = $key['desc_programa'];
    $foto_programa = "admin/" . $key['foto_programa'];
    $act_programa = $key['act_programa'];

    $horasVideo = HorasVideo($id_programa);
    $cantidadCursos = CantidadCursos($id_programa);
    $costoTotal = CostoTotal($id_programa);
    if ($costoTotal == 0) {
      $costoTotal = "";
    } else {
      $costoTotal = "S/ " . $costoTotal;
    }

    if (!file_exists($foto_programa)) {
      $foto_programa = "admin/img/programas/rysoft.png";
    }
  ?>
    <article class="card card--program">
      <a class="card__img" href="programa.php?i=<?php echo $id_programa; ?>">
      <div class="img-container-programa"><img src="<?php echo $foto_programa; ?>" alt="Imágen de programa"></div>
        <h3 class="card__img-title"><?php echo $nom_programa; ?></h3>
      </a><!-- .card__img -->
      <div class="card__body">
        <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 15px">
          <span>
            <i class="far fa-clock"></i>
            <?php echo $horasVideo; ?> horas
          </span>
          <span><?php echo $cantidadCursos; ?> Cursos</span>
        </div>

        <p class="card__text">
          <?php echo $desc_programa; ?>
        </p>

        <div class="d-flex justify-content-between prices">
          <p>
            <a href="programa.php?i=<?php echo $id_programa; ?>" class="card__link">ver más</a>
          </p>

          <p class="price">
            <span><?php echo $costoTotal; ?></span>
            <span><?php echo $prec_programa; ?></span>
          </p>
        </div>

        <div class="card__buttons">
          <!-- <a class="btn btn--outline btn--outline-primary btn--rounded" href="#" data-modal="#modal-cart">
            <i class="fa fa-shopping-cart"></i>
          </a> -->
          <a class="btn btn--outline btn--outline-primary btn--full" onclick="abrirModal('<?php echo $id_programa; ?>','<?php echo $nom_programa; ?>','<?php echo $prec_programa; ?>')">
            Comprar ahora
          </a>
          <a href="#" id="comprar" data-modal="#modal"></a>
        </div>
      </div><!-- .card__body -->
    </article><!-- .card -->
  <?php } ?>
</div>