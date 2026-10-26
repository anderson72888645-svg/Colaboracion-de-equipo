<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Programas preguntas| Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_programas.php");

            if (isset($_GET['actualizado']) && $_GET['actualizado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "La pregunta del programa se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            } else if (isset($_GET['registrado']) && $_GET['registrado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "La pregunta del programa se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            }

            if (isset($_REQUEST['actualizarProgramaPregunta'])) {
                $id_programa_pregunta = $_REQUEST['actualizarProgramaPregunta'];
                $preg_pro_pre = $_REQUEST['preg_pro_pre' . $id_programa_pregunta];
                $rpta_pro_pre = $_REQUEST['rpta_pro_pre' . $id_programa_pregunta];
                $act_pro_pre = $_REQUEST['act_pro_pre' . $id_programa_pregunta];
                $id_programa = $_REQUEST['id_programa'];

                $resp = ActualizarProgramaPregunta($id_programa_pregunta, $preg_pro_pre, $rpta_pro_pre, $act_pro_pre);

                if ($resp === "SI") { ?>
                    <script>
                        location.href = "programas_preguntas.php?programa=<?php echo $id_programa; ?>&actualizado=true";
                    </script>
                <?php
                }
            } else if (isset($_REQUEST['registrarProgramaPregunta'])) {
                $id_programa = $_REQUEST['registrarProgramaPregunta'];
                $preg_pro_pre = $_REQUEST['preg_pro_pre'];
                $rpta_pro_pre = $_REQUEST['rpta_pro_pre'];
                $act_pro_pre = $_REQUEST['act_pro_pre'];

                $res_cur = RegistrarProgramaPregunta($id_programa, $preg_pro_pre, $rpta_pro_pre, $act_pro_pre);

                if ($res_cur == "SI") { ?>
                    <script>
                        location.href = "programas_preguntas.php?programa=<?php echo $id_programa; ?>&registrado=true";
                    </script>
            <?php
                }
            }

            $id_programa = $_REQUEST['programa'];

            $programa = ConsultarPrograma($id_programa);
            foreach ($programa as $key => $value) {
                $nom_programa = $value['nom_programa'];
            }
            $total_programas_preguntas = TotalProgramasPreguntas($id_programa);
            $programa_preguntas = ProgramasPreguntas($id_programa);

            require("view/v_programas_preguntas.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>