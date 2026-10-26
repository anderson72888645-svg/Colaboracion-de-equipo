<?php
require_once './_modelo/m_config.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <?php
  require("_vista/v_estilos.php");
  ?>

  <!-- IZIPAY -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <link rel="stylesheet" href="assets/css/classic.css">

  <link rel="stylesheet" href="https://api.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic-reset.css">
  <script src="https://api.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.js">
  </script>
  <!--IZIPAY -->

  <!-- La clave pública de PayPal se configura solo en el servidor. -->


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>
    const script = document.createElement('script');
    script.src = 'assets/js/matricula.js?v=' + new Date().getTime();
    document.head.appendChild(script);
  </script>


</head>

<body>

  <?php
  //Modelo
  require("_modelo/m_categoria.php");
  require("_modelo/m_curso.php");
  $curso =  MostrarCurso1();
  $categoria =  MostrarCategoria1();


  //require("_vista/v_login_modal.php");
  require("_vista/v_acciones.php");
  //require("_vista/v_carrito_modal.php");
  require("_vista/v_pago_modal.php");
  //require("_vista/v_inscripcion_modal.php");
  //require("_vista/v_menu_oferta.php");
  require("_vista/v_menu2.php");
  ?>

  <main>
    <?php
    require("_vista/v_inscripcion.php");
    ?>
    <div class="main">
      <div class="container">
        <?php
        //Vistas
        require("_vista/v_curso_home.php");
        //require("_vista/v_programa_home.php");
        //require("_vista/v_membresia_home.php");
        //require("_vista/v_insignias_home.php");
        ?>
      </div>
    </div>
  </main>

  <?php
  require("_vista/v_footer.php");
  require("_vista/v_script.php");
  ?>

</body>
</html>