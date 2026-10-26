<?php
require("../seguridad.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"]) && isset($_POST["matricula"]) && isset($_POST["idalumno"]) && isset($_POST["idcertificado"])) {
    $matricula = $_POST["matricula"];
    $id_alumno = $_POST["idalumno"];
    $id_certificado = $_POST["idcertificado"];
    $act = 1;

    $nombreFoto = $_FILES['imagen']['name'];
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $nombreCertificado = "certificado_" . $matricula . "_" . $id_alumno . ".jpg";
    $rutaDestino = "../img/certificados/" . $nombreCertificado;
    $rutaBD = "img/certificados/" . $nombreCertificado;

    move_uploaded_file($rutaTemporal, $rutaDestino);

    $rpta = RegistrarCertificado($id_certificado, $rutaBD, $act);

    if ($rpta == "SI") {
        echo json_encode(array("status" => "OK", "redirectURL" => "../certificado_alumno.php?alumno=$id_alumno&actualizadoCertificado=true"));
        exit();
    } else {
        echo json_encode(array("status" => "Error"));
        exit();
    }
}

function RegistrarCertificado($id_certificado, $img_cert, $act)
{
    require("../model/conexionAPI.php");

    $sql = "UPDATE certificado SET 
	link_certificado = '$img_cert',
	act_certificado = '$act'
	WHERE id_certificado = '$id_certificado'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}