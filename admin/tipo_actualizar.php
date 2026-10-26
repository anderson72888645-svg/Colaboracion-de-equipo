<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Actualizar Tipo | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_extras.php");

            if (isset($_REQUEST['actualizarTipo'])) {
                $id_tipo = $_REQUEST['actualizarTipo'];
                $nom = $_REQUEST['nom_tipo'];
                $act = $_REQUEST['act_tipo'];

                $rpta = ActualizarTipo($id_tipo, $nom, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "extras.php?actualizadoTipo=true"
                    </script>
            <?php
                }
            }

            $id_tipo = $_REQUEST['tipo'];

            $tipo = ConsultarTipo($id_tipo);

            foreach ($tipo as $key => $value) {
                $nom_tipo = $value['nom_tipo'];
                $act_tipo = $value['act_tipo'];

                if ($act_tipo == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
                if ($act_tipo == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }
            }

            require("view/v_tipo_actualizar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>