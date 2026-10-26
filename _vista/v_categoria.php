<aside class="l-courses-layout__aside">
  <form action="" class="fixed-sticky">
    <div class="material-input material-input--plomo">
      <input placeholder="" type="search" id="search">
      <label for="search">Buscar</label>
    </div>
    <h3>Categorías</h3>

    <?php
    foreach ($categorias as $key) {
      $nom_categoria = $key['nom_categoria'];
    ?>
      <label class="checkbox">
        <input placeholder="" type="checkbox">
        <span><?php echo $nom_categoria; ?></span>
      </label>
    <?php
    }
    ?>


  </form>
</aside>