<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Extras | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_extras.php");

            if (isset($_GET['registradoPais']) && $_GET['registradoPais'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El país se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['registradoCategoria']) && $_GET['registradoCategoria'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "La categoría se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['registradoTipo']) && $_GET['registradoTipo'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El tipo se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['registradoNivel']) && $_GET['registradoNivel'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "La nivel se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['actualizadoPais']) && $_GET['actualizadoPais'] === 'true') {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "El país se actualizó correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        history.replaceState(null, null, window.location.pathname);
                    </script>';
            } else if (isset($_GET['actualizadoCategoria']) && $_GET['actualizadoCategoria'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "La categoría se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['actualizadoTipo']) && $_GET['actualizadoTipo'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El tipo se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            } else if (isset($_GET['actualizadoNivel']) && $_GET['actualizadoNivel'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El nivel se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>';
            }

            $paises = ListarPaises();
            $categorias = ListarCategorias();
            $tipo = ListarTipo();
            $nivel = ListarNivel();
            require("view/v_extras.php");
            ?>

        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>