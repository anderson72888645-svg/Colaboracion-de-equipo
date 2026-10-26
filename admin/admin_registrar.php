<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar administrador | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_admins.php");

            if (isset($_REQUEST['registrar'])) {
                $nom = $_REQUEST['nom'];
                $ape = $_REQUEST['ape'];
                $dni = $_REQUEST['dni'];
                $ema = $_REQUEST['ema'];
                $pas = $_REQUEST['pas'];
                $act = $_REQUEST['act'];

                $nombreFoto = $_FILES['foto_admin']['name'];
                $rutaTemporal = $_FILES['foto_admin']['tmp_name'];
                $nombreFotoAdmin = "admin_" . $nom . "_" . $ape . ".jpg";
                $rutaDestino = "img/admins/" . $nombreFotoAdmin;

                move_uploaded_file($rutaTemporal, $rutaDestino);

                $rpta = Registraradmins($nom, $ape, $dni, $ema, $pas, $rutaDestino, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "admin.php?registradoAdmin=true"
                    </script>
            <?php
                }
            }

            require("model/m_extras.php");

            $paises = ListarPaises();

            require("view/v_admins_registrar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>