<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modulos cursos | Rysoft</title>

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
                        title: "El módulo del curso se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            } else if (isset($_GET['registrado']) && $_GET['registrado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El módulo del curso se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            }

            if (isset($_GET['actualizadoTema']) && $_GET['actualizadoTema'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El tema del curso se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            } else if (isset($_GET['registradoTema']) && $_GET['registradoTema'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El tema del curso se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            }

            if (isset($_REQUEST['registrarModulo'])) {
                $id_curso = $_REQUEST['registrarModulo'];
                $cod_con = $_REQUEST['cod-con'];
                $nom_con = $_REQUEST['nom-con'];
                $est_con = $_REQUEST['est-con'];
                $des_con = $_REQUEST['des-con'];

                $rpta_con = RegistrarModulo($id_curso, $cod_con, $nom_con, $des_con, $est_con);

                if ($rpta_con == "SI") { ?>
                    <script>
                        location.href = "modulos.php?curso=<?php echo $id_curso; ?>&registrado=true";
                    </script>
                <?php
                }
            } else if (isset($_REQUEST['actualizarModulo'])) {
                $id_modulo = $_REQUEST['actualizarModulo'];
                $cod_con = $_REQUEST['cod-con' . $id_modulo];
                $nom_con = $_REQUEST['nom-con' . $id_modulo];
                $est_con = $_REQUEST['est-con' . $id_modulo];
                $des_con = $_REQUEST['des-con' . $id_modulo];
                $id_curso = $_REQUEST['id_curso'];

                $rpta_con = ActualizarModulo($id_modulo, $cod_con, $nom_con, $des_con, $est_con);

                if ($rpta_con == "SI") { ?>
                    <script>
                        location.href = "modulos.php?curso=<?php echo $id_curso; ?>&actualizado=true";
                    </script>
                <?php
                }
            }

            if (isset($_REQUEST['registrarTema'])) {
                $id_modulo = $_REQUEST['registrarTema'];
                $id_curso = $_REQUEST['id_curso'];
                $nom_tem = $_REQUEST['nom-tema'];
                $est_tem = $_REQUEST['est-tema'];

                $rpta_con = RegistrarTema($id_modulo, $nom_tem, $est_tem);

                if ($rpta_con == "SI") { ?>
                    <script>
                        location.href = "modulos.php?curso=<?php echo $id_curso; ?>&registradoTema=true";
                    </script>
                <?php
                }
            } else if (isset($_REQUEST['actualizarTema'])) {
                $id_tema = $_REQUEST['actualizarTema'];
                $id_curso = $_REQUEST['id_curso'];
                $nom_tem = $_REQUEST['nom-tema' . $id_tema];
                $est_tem = $_REQUEST['est-tema' . $id_tema];

                $rpta_con = ActualizarTema($id_tema, $nom_tem, $est_tem);

                if ($rpta_con == "SI") { ?>
                    <script>
                        location.href = "modulos.php?curso=<?php echo $id_curso; ?>&actualizadoTema=true";
                    </script>
                <?php
                }
            }

            $id_curso = $_REQUEST['curso'];

            $curso = ConsultarCurso($id_curso);

            foreach ($curso as $key => $value) {
                $nom_curso = $value['nom_curso'];
            }

            $total_modulos = ConsultarCantidadModulos($id_curso);

            $modulos = ConsultarModulos($id_curso);

            require("view/v_cursos_modulos.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>