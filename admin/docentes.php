<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Docentes | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_docentes.php");

            if (isset($_GET['registradoDocente']) && $_GET['registradoDocente'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El docente se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['actualizadoDocente']) && $_GET['actualizadoDocente'] === 'true') {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El docente se actualizó correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        history.replaceState(null, null, window.location.pathname);
                    </script>';
            }

            $docentes = ListarDocentes();
            require("view/v_docentes.php");
            ?>

        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>