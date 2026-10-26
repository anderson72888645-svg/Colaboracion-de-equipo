<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Programas | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_programas.php");

            if (isset($_GET['registradoPrograma']) && $_GET['registradoPrograma'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El programa se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['actualizadoPrograma']) && $_GET['actualizadoPrograma'] === 'true') {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El programa se actualizó correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        history.replaceState(null, null, window.location.pathname);
                    </script>';
            }

            $programas = Programas();

            require("view/v_programas.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>