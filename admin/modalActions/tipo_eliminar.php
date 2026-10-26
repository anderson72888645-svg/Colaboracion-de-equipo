<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_tipo = $_POST['id_tipo'];

require("../model/m_extras.php");

$rpta = EliminarTipo($id_tipo);
if ($rpta == "SI") {
    echo $rpta;
}
?>