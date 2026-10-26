<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compra Realizada</title>
  <?php 
  require("_vista/v_estilos.php");
  ?>
</head>
<body>

  <?php 
  require("_vista/v_acciones.php");
  require("_vista/v_menu2.php");
  ?>

  <main>
    <div class="container">
      <?php 
      require("_vista/v_carrito_title.php");
      $active1="";
      $active2="";
      $active3="class='active'";
      require("_vista/v_carrito_pasos.php");
      require("_vista/v_detalle_pago2.php");
      ?>
    </div><!-- .container -->
  </main>

  <?php 
  require("_vista/v_footer.php");
  require("_vista/v_script.php");
  ?>

</body>
</html>