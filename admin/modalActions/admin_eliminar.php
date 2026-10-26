<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_admin = $_POST['id_admin'];
$foto_admin = $_POST['foto_admin'];

require("../model/m_admins.php");

$rpta = EliminarAdmin($id_admin);
if ($rpta == "SI") {
    if ($foto_admin != "img/bx_user.svg") {
        unlink('../' . $foto_admin);
    }
    echo $rpta;
}
?>