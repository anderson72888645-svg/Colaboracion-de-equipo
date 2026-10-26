<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">

    <title>Actualizar Curso | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_docentes.php");
            require("model/m_cursos.php");

            if (isset($_REQUEST['actualizarCurso'])) {
                $id_curso = $_REQUEST['actualizarCurso'];
                $nom = $_REQUEST['nom'];
                $cat = $_REQUEST['cat'];
                $doc = $_REQUEST['doc'];
                $prec = $_REQUEST['prec'];
                $dur = $_REQUEST['dur'];
                $dscto = $_REQUEST['dscto'];
                $vid = $_REQUEST['vid'];
                $act = $_REQUEST['act'];
                $desc = $_REQUEST['desc'];
                $tip = $_REQUEST['tip'];
                if (isset($_REQUEST['niv'])) {
                    $niv = $_REQUEST['niv'];
                } else {
                    $niv = '';
                }
                $foto_actual = $_REQUEST['foto_actual'];

                $nombreFoto = $_FILES['foto']['name'];
                $rutaTemporal = $_FILES['foto']['tmp_name'];
                $rutaDestino = '';

                if (!empty($nombreFoto)) {
                    $nombreFotoCurso = "curso_" . $nom . ".jpg";
                    $rutaDestino = "img/cursos/" . $nombreFotoCurso;

                    if ($foto_actual == 'img/cursos/rysoft.png') {
                    } else {
                        unlink($foto_actual);
                    }

                    move_uploaded_file($rutaTemporal, $rutaDestino);
                } else {
                    $rutaDestino = $foto_actual;
                }

                $rpta = ActualizarCursos($id_curso, $doc, $cat, $nom, $desc, $dur, $prec, $dscto, $vid, $rutaDestino, $act, $tip, $niv);
            ?>
                <script type="text/javascript">
                    location.href = "cursos.php?actualizadoCurso=true"
                </script>
            <?php
            } else if (isset($_REQUEST['registrarHorario'])) {
                $id_curso = $_REQUEST['registrarHorario'];
                $id_horario = $_REQUEST['hor'];
                $hor_principal = $_REQUEST['pri'];
                $act_horario = $_REQUEST['act'];

                RegistrarHorarios($id_curso, $id_horario, $hor_principal, $act_horario);
            ?>
                <script type="text/javascript">
                    location.href = "cursos_actualizar.php?curso=<?php echo $id_curso; ?>&registradoHorario=true"
                </script>
            <?php
            } else if (isset($_REQUEST['actualizarHorario'])) {
                $id_relacion = $_REQUEST['actualizarHorario'];
                $id_horario = $_REQUEST['hor'. $id_relacion];
                $hor_principal = $_REQUEST['pri'. $id_relacion];
                $act_horario = $_REQUEST['act'. $id_relacion] ;
                $id_curso = $_REQUEST['id_curso'];

                ActualizarHorario($id_relacion, $id_horario, $hor_principal, $act_horario);
            ?>
                <script type="text/javascript">
                    location.href = "cursos_actualizar.php?curso=<?php echo $id_curso; ?>&actualizadoHorario=true"
                </script>
            <?php
            }
            
            if (isset($_GET['registradoHorario']) && $_GET['registradoHorario'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El horario se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            } else if (isset($_GET['actualizadoHorario']) && $_GET['actualizadoHorario'] === 'true') {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El horario se actualizó correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>';
            }

            $id_curso = $_REQUEST['curso'];

            $curso = ConsultarCurso($id_curso);

            foreach ($curso as $key => $value) {
                $nom_curso = $value['nom_curso'];
                $id_docente = $value['id_docente'];
                $id_categoria = $value['id_categoria'];
                $desc_curso = $value['desc_curso'];
                $dur_curso = $value['dur_curso'];
                $prec_curso = $value['prec_curso'];
                $dscto_curso = $value['dscto_curso'];
                $vid_curso = $value['vid_curso'];
                $foto_curso = $value['foto_curso'];
                $act_curso  = $value['act_curso'];
                $tipo  = $value['id_tipo'];
                $nivel  = $value['id_nivel'];

                if ($act_curso == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
                if ($act_curso == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }

                if (!file_exists($foto_curso)) {
                    $foto_curso = "img/cursos/rysoft.png";
                }
            }

            $total_modulos = ConsultarCantidadModulos($id_curso);

            $modulos = ConsultarModulos($id_curso);

            $total_preguntas = ConsultarCantidadPreguntas($id_curso);

            $preguntas = ConsultarPreguntas($id_curso);

            require("model/m_extras.php");

            $categorias = ListarCategorias();
            $docentes = ListarDocentes();
            $tipos = ListarTipo();
            $niveles = ListarNivel();

            require("view/v_cursos_actualizar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>