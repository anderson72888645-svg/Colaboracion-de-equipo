<?php
function ListarDocentes()
{
    require("conexion.php");

    $sql = "SELECT * FROM docente doc INNER JOIN pais pai ON (doc.id_pais = pai.id_pais)";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

function RegistrarDocentes($ape, $nom, $desc, $pais, $dni, $rutaDestino, $act)
{
    require("conexion.php");

    $sql = "INSERT INTO docente() VALUES(NULL, '$pais', '$nom', '$ape', '$dni', '$desc', '$rutaDestino', '$act')";
    mysqli_query($con, $sql);

    return "SI";

    mysqli_close($con);
}

function EliminarDocente($id_docente)
{
    require("conexion.php");

    $sql = "DELETE FROM docente WHERE id_docente = '$id_docente'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}

function ConsultarDocente($id_docente)
{
    require("conexion.php");

    $sql = "SELECT * FROM docente doc INNER JOIN pais pai ON (doc.id_pais = pai.id_pais) WHERE id_docente = '$id_docente'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

function ActualizarDocente($id_docente, $ape, $nom, $desc, $pais, $dni, $foto, $act)
{
    require("conexion.php");

    $sql = "UPDATE docente SET 
    nom_docente = '$nom',
    ape_docente = '$ape',
    dni_docente = '$dni',
    desc_docente = '$desc',
    foto_docente = '$foto',
    id_pais = '$pais',
    act_docente = '$act'
    WHERE id_docente = '$id_docente'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}