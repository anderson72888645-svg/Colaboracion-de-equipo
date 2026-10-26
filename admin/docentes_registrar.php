<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar Docente | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_docentes.php");

            if (isset($_REQUEST['registrar'])) {
                $nom = $_REQUEST['nom'];
                $ape = $_REQUEST['ape'];
                $pais = $_REQUEST['pais'];
                $dni = $_REQUEST['dni'];
                $act = $_REQUEST['act'];
                $desc = $_REQUEST['desc'];

                $nombreFoto = $_FILES['foto_docente']['name'];
                $rutaTemporal = $_FILES['foto_docente']['tmp_name'];
                $nombreFotoDocente = "admin_" . $nom . "_" . $ape . ".jpg";
                $rutaDestino = "img/docentes/" . $nombreFotoDocente;

                move_uploaded_file($rutaTemporal, $rutaDestino);

                $rpta = RegistrarDocentes($ape, $nom, $desc, $pais, $dni, $rutaDestino, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "docentes.php?registradoDocente=true"
                    </script>
            <?php
                }
            }

            require("model/m_extras.php");

            $paises = ListarPaises();

            require("view/v_docentes_registrar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>