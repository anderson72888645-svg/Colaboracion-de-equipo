<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Membresía programas| Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php
            require("view/menuh.php");

            require("model/m_membresias.php");
            require("model/m_programas.php");

            if (isset($_GET['actualizado']) && $_GET['actualizado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El programa de la membresía se actualizó correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            } else if (isset($_GET['registrado']) && $_GET['registrado'] === 'true') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "El programa de la membresía se registró correctamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>';
            }

            if (isset($_REQUEST['actualizarMembresiaPrograma'])) {
                $id_membresia_programa = $_REQUEST['actualizarMembresiaPrograma'];
                $id_programa = $_REQUEST['mem-pro' . $id_membresia_programa];
                $act_programa = $_REQUEST['act-pro' . $id_membresia_programa];
                $id_membresia = $_REQUEST['id_membresia'];

                $resp = ActualizarMembresiaPrograma($id_membresia_programa, $id_programa, $act_programa);

                if ($resp === "SI") { ?>
                    <script>
                        location.href = "membresias_programas.php?membresia=<?php echo $id_membresia; ?>&actualizado=true";
                    </script>
                <?php
                }
            } else if (isset($_REQUEST['registrarMembresiaPrograma'])) {
                $id_membresia = $_REQUEST['registrarMembresiaPrograma'];
                $id_programa = $_REQUEST['mem-pro'];
                $act_programa = $_REQUEST['act-pro'];

                $res_pre = RegistrarMembresiaPrograma($id_membresia, $id_programa, $act_programa);

                if ($res_pre == "SI") { ?>
                    <script>
                        location.href = "membresias_programas.php?membresia=<?php echo $id_membresia; ?>&registrado=true";
                    </script>
                <?php
                }
            }

            $id_membresia = $_REQUEST['membresia'];

            $membresia = ConsultarMembresia($id_membresia);
            foreach ($membresia as $key => $value) {
                $nom_membresia = $value['nom_membresia'];
            }
            $total_membresia_programa = TotalMembresiaPrograma($id_membresia);
            $membresia_programa = MembresiaPrograma($id_membresia);
            $programas = Programas();

            require("view/v_membresias_programas.php");
            ?>
        </div>
    </div>

    <script>
        var programas = <?php echo $json_programas; ?>;
    </script>
    
    <?php require("view/scripts.php"); ?>
</body>

</html>