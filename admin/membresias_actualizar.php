<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Actualizar membresia | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_membresias.php");

            if (isset($_REQUEST['actualizarMembresia'])) {
                $id_membresia = $_REQUEST['actualizarMembresia'];
                $nom = $_REQUEST['nom'];
                $desc = $_REQUEST['desc'];
                $prec = $_REQUEST['prec'];
                $dscto = $_REQUEST['dscto'];
                $act = $_REQUEST['act'];
                $foto_actual = $_REQUEST['foto_actual'];

                $nombreFoto = $_FILES['foto']['name'];
                $rutaTemporal = $_FILES['foto']['tmp_name'];
                $rutaDestino = '';

                if (!empty($nombreFoto)) {
                    $nombreFotoMembresia = "membresia_" . $nom . ".jpg";
                    $rutaDestino = "img/membresias/" . $nombreFotoMembresia;

                    if ($foto_actual == 'img/membresias/rysoft.png') {
                    } else {
                        unlink($foto_actual);
                    }

                    move_uploaded_file($rutaTemporal, $rutaDestino);
                } else {
                    $rutaDestino = $foto_actual;
                }

                $rpta = ActualizarMembresia($id_membresia, $nom, $desc, $prec, $dscto, $rutaDestino, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "membresias.php?actualizadoMembresia=true"
                    </script>
            <?php
                }
            }

            $id_membresia = $_REQUEST['membresia'];

            $membresia = ConsultarMembresia($id_membresia);

            foreach ($membresia as $key => $value) {
                $nom_membresia = $value['nom_membresia'];
                $desc_membresia = $value['desc_membresia'];
                $prec_membresia = $value['prec_membresia'];
                $dscto_membresia = $value['dscto_membresia'];
                $foto_membresia = $value['foto_membresia'];
                $act_membresia  = $value['act_membresia'];

                if (!file_exists($foto_membresia)) {
                    $foto_membresia = "img/membresias/rysoft.png";
                }

                if ($act_membresia == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
                if ($act_membresia == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }
            }

            require("view/v_membresias_actualizar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>