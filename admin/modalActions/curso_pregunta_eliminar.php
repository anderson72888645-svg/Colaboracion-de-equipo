<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_curso_pregunta = $_POST['id_curso_pregunta'];

require("../model/m_cursos.php");

$rpta = EliminarPregunta($id_curso_pregunta);
if ($rpta == "SI") {
    echo $rpta;
}
?>