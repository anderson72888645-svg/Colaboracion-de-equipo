<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Actualizar Nivel | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_extras.php");

            if (isset($_REQUEST['actualizarNivel'])) {
                $id_nivel = $_REQUEST['actualizarNivel'];
                $nom = $_REQUEST['nom_nivel'];
                $act = $_REQUEST['act_nivel'];

                $rpta = ActualizarNivel($id_nivel, $nom, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "extras.php?actualizadoNivel=true"
                    </script>
            <?php
                }
            }

            $id_nivel = $_REQUEST['nivel'];

            $nivel = ConsultarNivel($id_nivel);

            foreach ($nivel as $key => $value) {
                $nom_nivel = $value['nom_nivel'];
                $act_nivel = $value['act_nivel'];

                if ($act_nivel == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
                if ($act_nivel == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }
            }

            require("view/v_nivel_actualizar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>