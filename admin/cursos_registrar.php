<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar Curso | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_docentes.php");
            require("model/m_cursos.php");

            if (isset($_REQUEST['registrar'])) {
                $nom = $_REQUEST['nom'];
                $cat = $_REQUEST['cat'];
                $doc = $_REQUEST['doc'];
                $prec = $_REQUEST['prec'];
                $dur = $_REQUEST['dur'];
                $dscto = $_REQUEST['dscto'];
                $vid = $_REQUEST['vid'];
                $act = $_REQUEST['act'];
                $desc = $_REQUEST['desc'];
                $hor = $_REQUEST['hor'];
                $tip = $_REQUEST['tip'];
                if (isset($_REQUEST['niv'])) {
                    $niv = $_REQUEST['niv'];
                } else {
                    $niv = '';
                }

                $nombreFoto = $_FILES['foto']['name'];
                $rutaTemporal = $_FILES['foto']['tmp_name'];
                $nombreFotoCurso = "curso_" . $nom . ".jpg";
                $rutaDestino = "img/cursos/" . $nombreFotoCurso;

                move_uploaded_file($rutaTemporal, $rutaDestino);

                $rpta = RegistrarCursos($doc, $cat, $nom, $desc, $dur, $prec, $dscto, $vid, $rutaDestino, $act, $hor, $tip, $niv);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "cursos.php?registradoCurso=true"
                    </script>
            <?php
                }
            }

            require("model/m_extras.php");

            $categorias = ListarCategorias();
            $docentes = ListarDocentes();
            $tipos = ListarTipo();
            $niveles = ListarNivel();

            require("../api.php");

            $horarios = Horarios();

            require("view/v_cursos_registrar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>