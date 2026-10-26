<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Actualizar País | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_extras.php");

            if (isset($_REQUEST['actualizarPais'])) {
                $id_pais = $_REQUEST['actualizarPais'];
                $nom = $_REQUEST['nom_pais'];
                $act = $_REQUEST['act_pais'];
                $foto_actual = $_REQUEST['foto_actual'];

                $nombreFoto = $_FILES['imagen_pais']['name'];
                $rutaTemporal = $_FILES['imagen_pais']['tmp_name'];
                $rutaDestino = '';

                if (!empty($nombreFoto)) {
                    $nombreFotoPais = "pais_" . $nom . ".jpg";
                    $rutaDestino = "img/pais/" . $nombreFotoPais;

                    if ($foto_actual == 'img/pais/globe-outline.svg') {
                    } else {
                        unlink($foto_actual);
                    }

                    move_uploaded_file($rutaTemporal, $rutaDestino);
                } else {
                    $rutaDestino = $foto_actual;
                }

                $rpta = ActualizarPais($id_pais, $nom, $rutaDestino, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "extras.php?actualizadoPais=true"
                    </script>
            <?php
                }
            }

            $id_pais = $_REQUEST['pais'];

            $pais = ConsultarPais($id_pais);

            foreach ($pais as $key => $value) {
                $nom_pais = $value['nom_pais'];
                $foto_pais = $value['foto_pais'];
                $act_pais = $value['act_pais'];

                if ($act_pais == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
                if ($act_pais == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }

                if (!file_exists($foto_pais)) {
                    $foto_pais = "img/pais/globe-outline.svg";
                }
            }

            require("view/v_pais_actualizar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>