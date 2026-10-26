<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Programas cursos| Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_programas.php");
            require("model/m_cursos.php");

            if (isset($_GET['actualizado']) && $_GET['actualizado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El curso del programa se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            } else if (isset($_GET['registrado']) && $_GET['registrado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El curso del programa se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            }

            if (isset($_REQUEST['actualizarProgramaCurso'])) {
                $id_programa_curso = $_REQUEST['actualizarProgramaCurso'];
                $id_curso = $_REQUEST['pro_cur' . $id_programa_curso];
                $act_curso = $_REQUEST['act-cur' . $id_programa_curso];
                $id_programa = $_REQUEST['id_programa'];

                $resp = ActualizarProgramaCurso($id_programa_curso, $id_curso, $act_curso);

                if ($resp === "SI") { ?>
                    <script>
                        location.href = "programas_cursos.php?programa=<?php echo $id_programa; ?>&actualizado=true";
                    </script>
                <?php
                }
            } else if (isset($_REQUEST['eliminarProgramaCurso'])) {
                $id_programa_curso = $_REQUEST['eliminarProgramaCurso'];
                $id_programa = $_REQUEST['id_programa'];

                $rpta = EliminarProgramaCurso($id_programa_curso);
                if ($rpta == "SI") { ?>
                    <script>
                        location.href = "programas_cursos.php?programa=<?php echo $id_programa; ?>&eliminado=true";
                    </script>
                <?php
                }
            } else if (isset($_REQUEST['registrarProgramaCurso'])) {
                $id_programa = $_REQUEST['registrarProgramaCurso'];
                $id_curso = $_REQUEST['pro_cur'];
                $act_curso = $_REQUEST['act-cur'];

                $res_cur = RegistrarProgramaCurso($id_programa, $id_curso, $act_curso);

                if ($res_cur == "SI") { ?>
                    <script>
                        location.href = "programas_cursos.php?programa=<?php echo $id_programa; ?>&registrado=true";
                    </script>
                <?php
                }
            }

            $id_programa = $_REQUEST['programa'];

            $programa = ConsultarPrograma($id_programa);
            foreach ($programa as $key => $value) {
                $nom_programa = $value['nom_programa'];
            }
            $total_programas_cursos = TotalProgramasCursos($id_programa);
            $programa_cursos = ProgramasCursos($id_programa);
            $cursos = ListarCursos();

            require("view/v_programas_cursos.php");
            ?>
        </div>
    </div>

    <script>
        var cursos = <?php echo $json_cursos; ?>;
    </script>
    
    <?php require("view/scripts.php"); ?>
</body>

</html>