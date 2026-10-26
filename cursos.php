<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cursos</title>
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

  <!--PAYPAL -->
  <!-- 
      Acceso para prueba:
    -->
  <!-- Test
    -->


  <!-- PAYPAL -->




  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    const script = document.createElement('script');
    script.src = 'assets/js/matricula.js?vc=' + new Date().getTime();
    document.head.appendChild(script);
  </script>

  <script>window.CURSOS_PAYMENT_PUBLIC_KEY = "";</script>
</head>

<body>

  <?php
  require("_modelo/m_curso.php");
  require("_modelo/m_categoria.php");
  $cursos =  MostrarCurso1();
  $categorias =  MostrarCategoria1();

  require("_vista/v_acciones.php");
  //require("_vista/v_carrito_modal.php");
  require("_vista/v_pago_modal.php");
  require("_vista/v_menu2.php");
  ?>

  <main>
    <div class="container">
      <?php
      require("_vista/v_curso_title.php");
      ?>
      <div class="l-courses-layout">
        <?php
        require("_vista/v_categoria.php");
        ?>
        <div class="l-courses-layout__main">
          <?php
          require("_vista/v_curso.php");
          ?>
        </div>
      </div>
    </div>
  </main>

  <?php
  require("_vista/v_footer.php");
  require("_vista/v_script.php");
  ?>


</body>

</html>
