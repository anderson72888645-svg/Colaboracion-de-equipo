<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">

    <title>Certificados alumnos | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_api.php");

            if (isset($_GET['registradoCertificado']) && $_GET['registradoCertificado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El certificado se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            } else if (isset($_GET['actualizadoCertificado']) && $_GET['actualizadoCertificado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El certificado se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            }

            if (isset($_REQUEST['actualizar'])) {
                $id_certificado = $_REQUEST['actualizar'];
                $mat = $_REQUEST['mat' . $id_certificado];
                $act = $_REQUEST['act' . $id_certificado];
                $id_alumno = $_REQUEST['id_alu'];
                $ape1 = $_REQUEST['ape1'];
                $ape2 = $_REQUEST['ape2'];
                $nom = $_REQUEST['nom'];
                $certificado_actual = $_REQUEST['certificado_actual' . $id_certificado];

                $nombreFoto = $_FILES['cert' . $id_certificado]['name'];
                $rutaTemporal = $_FILES['cert' . $id_certificado]['tmp_name'];
                $rutaDestino = '';

                if (!empty($nombreFoto)) {

                    $nombreCertificado = "certificado_" . $mat . "_" . $id_alumno . ".jpg";
                    $rutaDestino = "img/certificados/" . $nombreCertificado;

                    if ($certificado_actual == 'img/bx_user.svg') {
                    } else {
                        unlink($certificado_actual);
                    }

                    move_uploaded_file($rutaTemporal, $rutaDestino);
                } else {
                    $rutaDestino = $certificado_actual;
                }

                $rpta = ActualizarCertificado($id_certificado, $rutaDestino, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "certificado_alumno.php?alumno=<?php echo $id_alumno; ?>&actualizadoCertificado=true"
                    </script>
                <?php
                }
            }

            $id_alumno = $_REQUEST['alumno'];

            $certificados = Certificados($id_alumno);
            $alumno = ConsultarAlumnos($id_alumno);
            $cursos_registrados = CursosRegistrados($id_alumno);
            $cursos_matriculados = ConsultarMatriculas($id_alumno);

            foreach ($alumno as $key => $value) {
                $nom_alum = $value['nom_alum'];
                $ape1_alum = $value['ape1_alum'];
                $ape2_alum = $value['ape2_alum'];
            }

            require("view/v_certificados_alumnos.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>