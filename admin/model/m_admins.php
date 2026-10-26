<?php
function ListarAdmins()
{
    require("conexion.php");

    $sql = "SELECT * FROM administrador";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

function RegistrarAdmins($nom, $ape, $dni, $ema, $pas, $foto, $est)
{
    require("conexion.php");

    $sql = "INSERT INTO administrador() VALUES(NULL, '$nom', '$ape', '$dni', '$ema', '$pas', '$foto', '$est', current_timestamp())";
    mysqli_query($con, $sql);

    return "SI";

    mysqli_close($con);
}

function EliminarAdmin($id_admin)
{
    require("conexion.php");

    $sql = "DELETE FROM administrador WHERE id_admin = '$id_admin'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}

function ConsultarAdmin($id_admin)
{
    require("conexion.php");

    $sql = "SELECT * FROM administrador WHERE id_admin = '$id_admin'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

function ActualizarAdmin($id_admin, $nom, $ape, $dni, $ema, $pas, $foto, $est)
{
    require("conexion.php");

    $sql = "UPDATE administrador SET 
    nom_admin = '$nom',
    ape_admin = '$ape',
    dni_admin = '$dni',
    email_admin = '$ema',
    foto_admin = '$foto',
    pass_admin = '$pas',
    est_admin = '$est'
    WHERE id_admin = '$id_admin'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}

function ValidarAdmin($user, $pass) {
    require("conexion.php");

    $sql = "SELECT * FROM administrador WHERE email_admin = '$user' AND pass_admin = '$pass' AND est_admin = 1";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}