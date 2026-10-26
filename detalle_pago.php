<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles de Pago</title>
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
      $active2="class='active'";
      $active3="";
      require("_vista/v_carrito_pasos.php");
      require("_vista/v_carrito_login.php");
      ?>

      <div class="l-page-generic" style="margin-bottom: 40px;">
        <?php
        require("_vista/v_carrito_facturacion.php");
        ?>
        <div class="l-page-generic__aside">
          <?php
          require("_vista/v_carrito_descuento.php");
          require("_vista/v_carrito_pagar.php");
          ?>
        </div>
      </div>
      <!-- </div> -->
    </div>
  </main>

  
  <?php 
   require("_vista/v_footer.php");
   require("_vista/v_script.php");
   ?>

</body>
</html>