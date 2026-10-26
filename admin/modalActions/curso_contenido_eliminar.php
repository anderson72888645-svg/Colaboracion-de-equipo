<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_curso_contenido = $_POST['id_curso_contenido'];

require("../model/m_cursos.php");

$rpta = EliminarModulo($id_curso_contenido);;
if ($rpta == "SI") {
    echo $rpta;
}
?>