<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Actualizar Categoría | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_extras.php");

            if (isset($_REQUEST['actualizarCategoria'])) {
                $id_categoria = $_REQUEST['actualizarCategoria'];
                $nom = $_REQUEST['nom_categoria'];
                $act = $_REQUEST['act_categoria'];

                $rpta = ActualizarCategoria($id_categoria, $nom, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "extras.php?actualizadoCategoria=true"
                    </script>
            <?php
                }
            }

            $id_categoria = $_REQUEST['categoria'];

            $categoria = ConsultarCategoria($id_categoria);

            foreach ($categoria as $key => $value) {
                $nom_categoria = $value['nom_categoria'];
                $act_categoria = $value['act_categoria'];

                if ($act_categoria == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
                if ($act_categoria == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }
            }

            require("view/v_categoria_actualizar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>