<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_docente = $_POST['id_docente'];
$foto_docente = $_POST['foto_docente'];

require("../model/m_docentes.php");

$rpta = EliminarDocente($id_docente);
if ($rpta == "SI") {
    if ($foto_docente != 'img/bx_user.svg') {
        unlink('../' . $foto_docente);
    }
    echo $rpta;
}
?>