<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_curso = $_POST['id_curso'];
$foto_curso = $_POST['foto_curso'];

require("../model/m_cursos.php");

$rpta = EliminarCurso($id_curso);
if ($rpta == "SI") {
    if ($foto_curso != "img/cursos/rysoft.png") {
        unlink('../' . $foto_curso);
    }
    echo $rpta;
}
?>