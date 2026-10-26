<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">

    <title>Cursos | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php 
            require("view/menuh.php");

            require("model/m_cursos.php");

            if (isset($_GET['registradoCurso']) && $_GET['registradoCurso'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El curso se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['actualizadoCurso']) && $_GET['actualizadoCurso'] === 'true') {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El curso se actualizó correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        history.replaceState(null, null, window.location.pathname);
                    </script>';
            }

            $cursos = ListarCursos();
            require("view/v_cursos.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>