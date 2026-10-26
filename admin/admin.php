<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
        <?php
            require("view/menuh.php");

            require("model/m_admins.php");

            if (isset($_GET['registradoAdmin']) && $_GET['registradoAdmin'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El administrador se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['actualizadoAdmin']) && $_GET['actualizadoAdmin'] === 'true') {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El administrador se actualizó correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        history.replaceState(null, null, window.location.pathname);
                    </script>';
            }

            $admins = ListarAdmins();
            require("view/v_admins.php");
            ?>

        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>