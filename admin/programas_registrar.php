<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Actualizar programa | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_programas.php");

            if (isset($_REQUEST['registrar'])) {
                $nom = $_REQUEST['nom'];
                $prec = $_REQUEST['prec'];
                $desc = $_REQUEST['desc'];
                $act = $_REQUEST['act'];

                $nombreFoto = $_FILES['foto']['name'];
                $rutaTemporal = $_FILES['foto']['tmp_name'];
                $nombreFotoMembresia = "membresia_" . $nom . ".jpg";
                $rutaDestino = "img/programas/" . $nombreFotoMembresia;

                move_uploaded_file($rutaTemporal, $rutaDestino);

                $rpta = RegistrarPrograma($nom, $desc, $prec, $rutaDestino, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "programas.php?registradoPrograma=true"
                    </script>
            <?php
                }
            }

            require("view/v_programas_registrar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>