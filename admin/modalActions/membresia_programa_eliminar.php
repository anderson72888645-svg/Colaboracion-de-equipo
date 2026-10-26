<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_membresia_programa = $_POST['id_membresia_programa'];

require("../model/m_membresias.php");

$rpta = EliminarMembresiaPrograma($id_membresia_programa);
if ($rpta == "SI") {
    echo $rpta;
}
