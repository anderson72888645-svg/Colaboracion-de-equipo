<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Actualizar administrador | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_admins.php");

            if (isset($_REQUEST['actualizarAdmin'])) {
                $id_admin = $_REQUEST['actualizarAdmin'];
                $nom = $_REQUEST['nom'];
                $ape = $_REQUEST['ape'];
                $dni = $_REQUEST['dni'];
                $ema = $_REQUEST['ema'];
                $pas = $_REQUEST['pas'];
                $act = $_REQUEST['act'];
                $foto_actual = $_REQUEST['foto_actual'];

                $nombreFoto = $_FILES['foto_admin']['name'];
                $rutaTemporal = $_FILES['foto_admin']['tmp_name'];
                $rutaDestino = '';

                if (!empty($nombreFoto)) {
                    $nombreFotoAdmin = "admin_" . $nom . "_" . $ape . ".jpg";
                    $rutaDestino = "img/admins/" . $nombreFotoAdmin;

                    if ($foto_actual == 'img/bx_user.svg') {
                    } else {
                        unlink($foto_actual);
                    }

                    move_uploaded_file($rutaTemporal, $rutaDestino);
                } else {
                    $rutaDestino = $foto_actual;
                }

                $rpta = ActualizarAdmin($id_admin, $nom, $ape, $dni, $ema, $pas, $rutaDestino, $act);

                if ($rpta == "SI") {
            ?>
                    <script type="text/javascript">
                        location.href = "admin.php?actualizadoAdmin=true"
                    </script>
            <?php
                }
            }

            $id_admin = $_REQUEST['admin'];

            $admin = ConsultarAdmin($id_admin);

            foreach ($admin as $key => $value) {
                $nom_admin = $value['nom_admin'];
                $ape_admin = $value['ape_admin'];
                $dni_admin = $value['dni_admin'];
                $email_admin = $value['email_admin'];
                $pass_admin = $value['pass_admin'];
                $foto_administrador = $value['foto_admin'];
                $act_admin  = $value['est_admin'];

                if ($act_admin == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
                if ($act_admin == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }

                if (!file_exists($foto_administrador)) {
                    $foto_administrador = "img/bx_user.svg";
                }
            }

            require("view/v_admins_actualizar.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>