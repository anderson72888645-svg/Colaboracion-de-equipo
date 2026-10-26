<?php
/* País */
function ListarPaises() {
    require("conexion.php");

    $sql = "SELECT * FROM pais";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

function RegistrarPais($nom, $foto, $est) {
    require("conexion.php");

    $sql = "INSERT INTO pais() VALUES(NULL, '$nom', '$foto', '$est')";
    mysqli_query($con, $sql);

    return "SI";

    mysqli_close($con);
}

function EliminarPais($id_pais) {
    require("conexion.php");

    $sql = "DELETE FROM pais WHERE id_pais = '$id_pais'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI"; else return "NO";

    mysqli_close($con);
}

function ActualizarPais($id_pais, $nom, $foto, $est) {
    require("conexion.php");

    $sql = "UPDATE pais SET nom_pais = '$nom', foto_pais = '$foto', act_pais = '$est' WHERE id_pais = '$id_pais'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI"; else return "NO";

    mysqli_close($con);
}

function ConsultarPais($id_pais) {
    require("conexion.php");

    $sql = "SELECT * FROM pais WHERE id_pais = '$id_pais'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

/* Categoría */
function ListarCategorias(){
    require("conexion.php");

    $sql = "SELECT * FROM categoria";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

function RegistrarCategorias($nom, $est) {
    require("conexion.php");

    $sql = "INSERT INTO categoria() VALUES(NULL, '$nom', '$est')";
    mysqli_query($con, $sql);

    return "SI";

    mysqli_close($con);
}

function EliminarCategoria($id_categoria) {
    require("conexion.php");

    $sql = "DELETE FROM categoria WHERE id_categoria = '$id_categoria'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI"; else return "NO";

    mysqli_close($con);
}

function ActualizarCategoria($id_categoria, $nom, $est) {
    require("conexion.php");

    $sql = "UPDATE categoria SET nom_categoria = '$nom', act_categoria = '$est' WHERE id_categoria = '$id_categoria'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI"; else return "NO";

    mysqli_close($con);
}

function ConsultarCategoria($id_categoria) {
    require("conexion.php");

    $sql = "SELECT * FROM categoria WHERE id_categoria = '$id_categoria'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

/* Tipo */
function ListarTipo(){
    require("conexion.php");

    $sql = "SELECT * FROM tipo";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

function RegistrarTipo($nom, $act) {
    require("conexion.php");

    $sql = "INSERT INTO tipo() VALUES(NULL, '$nom', '$act')";
    mysqli_query($con, $sql);

    return "SI";

    mysqli_close($con);
}

function EliminarTipo($id_tipo) {
    require("conexion.php");

    $sql = "DELETE FROM tipo WHERE id_tipo = '$id_tipo'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI"; else return "NO";

    mysqli_close($con);
}

function ActualizarTipo($id_tipo, $nom, $act) {
    require("conexion.php");

    $sql = "UPDATE tipo SET nom_tipo = '$nom', act_tipo = '$act' WHERE id_tipo = '$id_tipo'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI"; else return "NO";

    mysqli_close($con);
}

function ConsultarTipo($id_tipo) {
    require("conexion.php");

    $sql = "SELECT * FROM tipo WHERE id_tipo = '$id_tipo'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

/* Nivel */
function ListarNivel(){
    require("conexion.php");

    $sql = "SELECT * FROM nivel";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

function RegistrarNivel($nom, $act) {
    require("conexion.php");

    $sql = "INSERT INTO nivel() VALUES(NULL, '$nom', '$act')";
    mysqli_query($con, $sql);

    return "SI";

    mysqli_close($con);
}

function EliminarNivel($id_nivel) {
    require("conexion.php");

    $sql = "DELETE FROM nivel WHERE id_nivel = '$id_nivel'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI"; else return "NO";

    mysqli_close($con);
}

function ActualizarNivel($id_nivel, $nom, $act) {
    require("conexion.php");

    $sql = "UPDATE nivel SET nom_nivel = '$nom', act_nivel = '$act' WHERE id_nivel = '$id_nivel'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI"; else return "NO";

    mysqli_close($con);
}

function ConsultarNivel($id_nivel) {
    require("conexion.php");

    $sql = "SELECT * FROM nivel WHERE id_nivel = '$id_nivel'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}