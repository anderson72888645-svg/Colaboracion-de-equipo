<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_programa_pregunta = $_POST['id_programa_pregunta'];

require("../model/m_programas.php");

$rpta = EliminarProgramaPregunta($id_programa_pregunta);
if ($rpta == "SI") {
    echo $rpta;
}
?>