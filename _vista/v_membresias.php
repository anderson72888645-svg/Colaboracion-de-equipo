<div class="l-grid-page">
  <?php
  foreach ($membresias as $key) {
    $id_membresia = $key['id_membresia'];
    $nom_membresia = $key['nom_membresia'];
    $desc_membresia = $key['desc_membresia'];
    $prec_membresia = $key['prec_membresia'];
    if ($prec_membresia == 0) {
      $precio = "Free";
    } else {
      $precio = "S/ " . $prec_membresia;
    }
    $dscto_membresia = $key['dscto_membresia'];
    $foto_membresia = "admin/" . $key['foto_membresia'];

    $final = $prec_membresia - ($prec_membresia * $dscto_membresia / 100);
    if ($final == 0) {
      $final = "Free";
    } else {
      $final = "S/ " . $final;
    }

    if (!file_exists($foto_membresia)) {
      $foto_membresia = "admin/img/membresias/rysoft.png";
    }
  ?>
    <article class="card card--program">
      <a class="card__img" href="membership.php?i=<?php echo $id_membresia; ?>">
        <img src="<?php echo $foto_membresia; ?>" alt="Imágen">
        <h3 class="card__img-title"><?php echo $nom_membresia; ?></h3>
      </a><!-- .card__img -->
      <div class="card__body">
        <p class="card__text"><?php echo $desc_membresia; ?></p>

        <div class="d-flex justify-content-between prices">
          <p>
            <a href="membership.php?i=<?php echo $id_membresia; ?>" class="card__link">ver más</a>
          </p>

          <p class="price">
            <span><?php echo $precio; ?></span>
            <span><?php echo $final; ?></span>
          </p>
        </div>

        <div class="card__buttons">
          <a class="btn btn--outline btn--outline-primary btn--full" onclick="abrirModal('<?php echo $id_membresia; ?>','<?php echo $nom_membresia; ?>','<?php echo $final; ?>')">
            Comprar ahora
          </a>
          <a href="#" id="comprar" data-modal="#modal"></a>
        </div>
      </div><!-- .card__body -->
    </article><!-- .card -->
  <?php } ?>
</div>