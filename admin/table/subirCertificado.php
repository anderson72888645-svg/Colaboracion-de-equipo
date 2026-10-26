<?php
require("../seguridad.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"]) && isset($_POST["matricula"]) && isset($_POST["idalumno"])) {
    $matricula = $_POST["matricula"];
    $id_alumno = $_POST["idalumno"];
    $act = 1;

    $nombreFoto = $_FILES['imagen']['name'];
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $nombreCertificado = "certificado_" . $matricula . "_" . $id_alumno . ".jpg";
    $rutaDestino = "../img/certificados/" . $nombreCertificado;
    $rutaBD = "img/certificados/" . $nombreCertificado;

    move_uploaded_file($rutaTemporal, $rutaDestino);

    $rpta = RegistrarCertificado($matricula, $rutaBD, $act);

    if ($rpta == "SI") {
        echo json_encode(array("status" => "OK", "redirectURL" => "../certificado_alumno.php?alumno=$id_alumno&registradoCertificado=true"));
        exit();
    } else {
        echo json_encode(array("status" => "Error"));
        exit();
    }
}

function RegistrarCertificado($id_mat, $img_cert, $act)
{
    require("../model/conexionAPI.php");

    $sql = "INSERT INTO certificado() VALUES(NULL, '$id_mat', '$img_cert', '$act')";
    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        return "SI";
    } else {
        $error = mysqli_error($con);
        mysqli_close($con);
        return "Error al insertar en la base de datos: $error";
    }
}