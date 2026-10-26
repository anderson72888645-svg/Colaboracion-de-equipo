<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_membresia = $_POST['id_membresia'];
$foto_membresia = $_POST['foto_membresia'];

require("../model/m_membresias.php");

$rpta = EliminarMembresia($id_membresia);
if ($rpta == "SI") {
    if ($foto_membresia != "img/membresias/membresias.svg") {
        unlink('../' . $foto_membresia);
    }
    echo $rpta;
}
