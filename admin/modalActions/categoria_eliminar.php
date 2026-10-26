<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_categoria = $_POST['id_categoria'];

require("../model/m_extras.php");

$rpta = EliminarCategoria($id_categoria);
if ($rpta == "SI") {
    echo $rpta;
}
?>