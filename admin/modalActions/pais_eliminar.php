<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_pais = $_POST['id_pais'];
$foto_pais = $_POST['foto_pais'];

require("../model/m_extras.php");

$rpta = EliminarPais($id_pais);
if ($rpta == "SI") {
    if ($foto_pais != "img/pais/globe-outline.svg") {
        unlink('../' . $foto_pais);
    }
    echo $rpta;
}
?>