<?php
require("_modelo/m_curso.php");

$i = $_GET['i'];

$curso = ConsultarCurso($i);
foreach ($curso as $key) {
  $id_curso = $key['id_curso'];
  $nom_curso = $key['nom_curso'];
  $desc_curso = $key['desc_curso'];
  $dur_curso = $key['dur_curso'];
  $prec_curso = $key['prec_curso'];
  $dscto_curso = $key['dscto_curso'];
  $prec = $prec_curso - ($prec_curso * $dscto_curso / 100);
  if ($prec == 0) {
    $prec = "Free";
  } else {
    $prec = "S/ " . $prec;
  }
  $foto_curso = "admin/" . $key['foto_curso'];
  $url_foto = "https://cursos.gruporysoft.com/$foto_curso";
  $vid_curso = $key['vid_curso'];
  $act_curso = $key['act_curso'];

  $id_categoria = $key['id_categoria'];
  $nom_categoria = $key['nom_categoria'];
  $nom_docente = $key['nom_docente'] . " " . $key['ape_docente'];
  $ruta_foto = "admin/";
  $foto_docente = $ruta_foto . $key['foto_docente'];
  $desc_docente = $key['desc_docente'];
  $nom_pais = $key['nom_pais'];

  $id_horario = $key['id_horario'];

  $ref_wsp = "https://cursos.gruporysoft.com/course.php?i=" . $id_curso;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta property="og:url" content="https://cursos.gruporysoft.com/course.php?i=<?php echo $id_curso; ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?php echo $nom_curso; ?>" />
  <meta property="og:description" content="<?php echo $desc_curso; ?>" />
  <meta property="og:image" content="<?php echo $url_foto; ?>" />
  <meta property="og:image:width" content="200" />
  <meta property="og:image:height" content="200" />


  <title>Curso</title>
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
    script.src = 'assets/js/matricula.js?vci=' + new Date().getTime();
    document.head.appendChild(script);
  </script>


  <script>window.CURSOS_PAYMENT_PUBLIC_KEY = "";</script>
</head>

<body>

  <?php
  require("_vista/v_acciones.php");
  require("_vista/v_menu2.php");

  $curso_contenido = ConsultarCursoContenido($i);
  $curso_pregunta  = ConsultarCursoPregunta($i);
  ?>

  <main>
    <div class="container">
      <?php
      require("_vista/v_course_title.php");
      ?>
      <div class="l-page-generic">
        <section class="l-page-generic__main">
          <?php
          require("_vista/v_course_detalle.php");
          require("_vista/v_course_contenido.php");
          require("_vista/v_pago_modal.php");
          ?>
        </section>
        <?php
        require("_vista/v_course_inscribete.php");
        ?>
      </div>
      <?php
      require("_vista/v_course_cursos.php");
      //require("_vista/v_insignias_home.php");
      ?>
    </div>
  </main>

  <?php
  require("_vista/v_footer.php");
  require("_vista/v_script.php");
  ?>

</body>

</html>
