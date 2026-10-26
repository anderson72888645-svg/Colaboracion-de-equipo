<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_programa_curso = $_POST['id_programa_curso'];

require("../model/m_programas.php");

$rpta = EliminarProgramaCurso($id_programa_curso);

if ($rpta == "SI") {
    echo $rpta;
}
?>