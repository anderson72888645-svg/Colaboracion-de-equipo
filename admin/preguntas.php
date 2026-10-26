<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Preguntas Curso | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_cursos.php");

            if (isset($_GET['actualizado']) && $_GET['actualizado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "La pregunta del curso se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            } else if (isset($_GET['registrado']) && $_GET['registrado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "La pregunta del curso se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            }

            if (isset($_REQUEST['actualizarPregunta'])) {
                $id_pregunta = $_REQUEST['actualizarPregunta'];
                $pre_pre = $_REQUEST['pre' . $id_pregunta];
                $act_pre = $_REQUEST['act-pre' . $id_pregunta];
                $res_pre = $_REQUEST['desc-pre' . $id_pregunta];
                $id_curso = $_REQUEST['id_curso'];

                $resp = ActualizarPreguntas($id_pregunta, $pre_pre, $res_pre, $act_pre);

                if ($resp === "SI") { ?>
                    <script>
                        location.href = "preguntas.php?curso=<?php echo $id_curso; ?>&actualizado=true";
                    </script>
                <?php
                }
            } else if (isset($_REQUEST['registrarPregunta'])) {
                $id_curso = $_REQUEST['registrarPregunta'];
                $pre_pre = $_REQUEST['pre'];
                $act_pre = $_REQUEST['act-pre'];
                $res_pre = $_REQUEST['desc-pre'];

                $res_pre = RegistrarPregunta($id_curso, $pre_pre, $res_pre, $act_pre);

                if ($res_pre == "SI") { ?>
                    <script>
                        location.href = "preguntas.php?curso=<?php echo $id_curso; ?>&registrado=true";
                    </script>
                <?php
                }
            }

            $id_curso = $_REQUEST['curso'];

            $curso = ConsultarCurso($id_curso);

            foreach ($curso as $key => $value) {
                $nom_curso = $value['nom_curso'];
            }

            $total_preguntas = ConsultarCantidadPreguntas($id_curso);

            $preguntas = ConsultarPreguntas($id_curso);

            require("view/v_cursos_preguntas.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>