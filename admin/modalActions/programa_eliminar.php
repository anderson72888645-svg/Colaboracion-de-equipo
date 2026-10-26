<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_programa = $_POST['id_programa'];
$foto_programa = $_POST['foto_programa'];

require("../model/m_programas.php");

$rpta = EliminarPrograma($id_programa);
if ($rpta == "SI") {
    if ($foto_programa != "img/programas/programas.svg") {
        unlink('../' . $foto_programa);
    }
    echo $rpta;
}
?>