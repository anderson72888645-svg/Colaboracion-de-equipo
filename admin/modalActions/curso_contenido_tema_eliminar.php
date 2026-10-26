<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_curso_contenido_tema = $_POST['id_curso_contenido_tema'];

require("../model/m_cursos.php");

$rpta = EliminarTema($id_curso_contenido_tema);;
if ($rpta == "SI") {
    echo $rpta;
}
?>