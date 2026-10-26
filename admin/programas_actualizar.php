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

            if (isset($_REQUEST['actualizarPrograma'])) {
                $id_programa = $_REQUEST['actualizarPrograma'];
                $nom = $_REQUEST['nom'];
                $prec = $_REQUEST['prec'];
                $desc = $_REQUEST['desc'];
                $act = $_REQUEST['act'];
                $foto_actual = $_REQUEST['foto_actual'];

                $nombreFoto = $_FILES['foto']['name'];
                $rutaTemporal = $_FILES['foto']['tmp_name'];
                $rutaDestino = '';

                if (!empty($nombreFoto)) {
                    $nombreFotoPrograma = "programa_" . $nom . ".jpg";
                    $rutaDestino = "img/programas/" . $nombreFotoPrograma;

                    if ($foto_actual == 'img/programas/rysoft.png') {
                    } else {
                        unlink($foto_actual);
                    }

                    move_uploaded_file($rutaTemporal, $rutaDestino);
                } else {
                    $rutaDestino = $foto_actual;
                }

                $rpta = ActualizarPrograma($id_programa, $nom, $desc, $prec, $rutaDestino, $act);
            ?>
                <script type="text/javascript">
                    location.href = "programas.php?actualizadoPrograma=true"
                </script>
            <?php
            }

            $id_programa = $_REQUEST['programa'];

            $programa = ConsultarPrograma($id_programa);

            foreach ($programa as $key => $value) {
                $nom_programa = $value['nom_programa'];
                $prec_programa = $value['prec_programa'];
                $desc_programa = $value['desc_programa'];
                $foto_programa = $value['foto_programa'];
                $act_programa  = $value['act_programa'];

                if ($act_programa == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
                if ($act_programa == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }

                if (!file_exists($foto_programa)) {
                    $foto_programa = "img/programas/rysoft.png";
                }
            }

            require("view/v_programas_actualizar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>