<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_certificado = $_POST['id_certificado'];
$certificado = $_POST['certificado'];

require("../model/m_api.php");

$rpta = EliminarCertificado($id_certificado);
if ($rpta == "SI") {
    if ($certificado != "img/bx_user.svg") {
        unlink('../' . $certificado);
    }
    echo $rpta;
}
?>