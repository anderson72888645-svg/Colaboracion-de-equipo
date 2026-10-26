<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Membresías | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_membresias.php");

            if (isset($_GET['registradoMembresia']) && $_GET['registradoMembresia'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "La membresía se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['actualizadoMembresia']) && $_GET['actualizadoMembresia'] === 'true') {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "La membresía se actualizó correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        history.replaceState(null, null, window.location.pathname);
                    </script>';
            }

            $membresias = Membresias();

            require("view/v_membresias.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>