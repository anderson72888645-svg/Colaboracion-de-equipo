<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_nivel = $_POST['id_nivel'];

require("../model/m_extras.php");

$rpta = EliminarNivel($id_nivel);
if ($rpta == "SI") {
    echo $rpta;
}
?>