<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar membresía | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_membresias.php");

            if (isset($_REQUEST['registrar'])) {
                $nom = $_REQUEST['nom'];
                $desc = $_REQUEST['desc'];
                $prec = $_REQUEST['prec'];
                $dscto = $_REQUEST['dscto'];
                $act = $_REQUEST['act'];

                $nombreFoto = $_FILES['foto']['name'];
                $rutaTemporal = $_FILES['foto']['tmp_name'];
                $nombreFotoMembresia = "membresia_" . $nom . ".jpg";
                $rutaDestino = "img/membresias/" . $nombreFotoMembresia;

                move_uploaded_file($rutaTemporal, $rutaDestino);

                $rpta = RegistrarMembresia($nom, $desc, $prec, $dscto, $rutaDestino, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "membresias.php?registradoMembresia=true"
                    </script>
            <?php
                }
            }

            require("view/v_membresias_registrar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>