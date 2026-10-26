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

            require("model/m_docentes.php");

            if (isset($_REQUEST['actualizarDocente'])) {
                $id_docente = $_REQUEST['actualizarDocente'];
                $nom = $_REQUEST['nom'];
                $ape = $_REQUEST['ape'];
                $pais = $_REQUEST['pais'];
                $dni = $_REQUEST['dni'];
                $act = $_REQUEST['act'];
                $desc = $_REQUEST['desc'];
                $foto_actual = $_REQUEST['foto_actual'];

                $nombreFoto = $_FILES['foto_docente']['name'];
                $rutaTemporal = $_FILES['foto_docente']['tmp_name'];
                $rutaDestino = '';

                if (!empty($nombreFoto)) {
                    $nombreFotoDocente = "docente_" . $nom . "_" . $ape . ".jpg";
                    $rutaDestino = "img/docentes/" . $nombreFotoDocente;

                    if ($foto_actual == 'img/bx_user.svg') {
                    } else {
                        unlink($foto_actual);
                    }

                    move_uploaded_file($rutaTemporal, $rutaDestino);
                } else {
                    $rutaDestino = $foto_actual;
                }

                $rpta = ActualizarDocente($id_docente, $ape, $nom, $desc, $pais, $dni, $rutaDestino, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "docentes.php?actualizadoDocente=true"
                    </script>
            <?php
                }
            }

            $id_docente = $_REQUEST['docente'];

            $docente = ConsultarDocente($id_docente);

            foreach ($docente as $key => $value) {
                $pais = $value['id_pais'];
                $nom_docente = $value['nom_docente'];
                $ape_docente = $value['ape_docente'];
                $dni_docente = $value['dni_docente'];
                $desc_docente = $value['desc_docente'];
                $foto = $value['foto_docente'];
                $act_docente  = $value['act_docente'];

                if ($act_docente == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
                if ($act_docente == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }

                if (!file_exists($foto)) {
                    $foto = "img/bx_user.svg";
                }
            }

            require("model/m_extras.php");

            $paises = ListarPaises();

            require("view/v_docentes_actualizar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>