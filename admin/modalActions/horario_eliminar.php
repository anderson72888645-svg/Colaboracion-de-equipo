<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_relacion = $_POST['id_relacion'];

require("../model/m_cursos.php");

$rpta = EliminarHorario($id_relacion);
if ($rpta == "SI") {
    echo $rpta;
}
?>