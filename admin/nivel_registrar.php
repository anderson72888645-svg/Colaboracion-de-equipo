<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar Nivel | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_extras.php");

            if (isset($_REQUEST['registrar'])) {
                $nom = $_REQUEST['nom'];
                $act = $_REQUEST['act_nivel'];

                $rpta = RegistrarNivel($nom, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "extras.php?registradoNivel=true"
                    </script>
            <?php
                }
            }

            require("view/v_nivel_registrar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>