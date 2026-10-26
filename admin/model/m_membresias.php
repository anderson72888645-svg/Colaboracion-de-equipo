<?php
/* Lista de membresias */
function Membresias() {
    require("conexion.php");

    $sql = "SELECT * FROM membresia";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

function MembresiaPrograma($id_membresia){
    require("conexion.php");

    $sql = "SELECT * FROM membresia_programa mem_pro INNER JOIN programa pro ON (mem_pro.id_programa = pro.id_programa) WHERE id_membresia = '$id_membresia' ORDER BY id_membresia_programa ASC";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

/* Cantidad de membresias y preguntas por membresia */
function TotalMembresiaPrograma($id_membresia) {
    require("conexion.php");

    $sql = "SELECT count(*) AS total_programas FROM membresia_programa WHERE id_membresia = '$id_membresia'";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $total_programas = $row['total_programas'];
    
    mysqli_close($con);
    
    return $total_programas;
}

/* Consultas de registros */
function ConsultarMembresia($id_membresia)
{
    require("conexion.php");

    $sql = "SELECT * FROM membresia WHERE id_membresia = '$id_membresia'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

/* Registrar nuevos datos */
function RegistrarMembresia($nom, $desc, $prec, $dscto, $foto, $act)
{
    require("conexion.php");

    $sql = "INSERT INTO membresia() VALUES(NULL, '$nom', '$desc', '$prec', '$dscto', '$foto', '$act')";
    mysqli_query($con, $sql);

    mysqli_close($con);

    return "SI";
}

function RegistrarMembresiaPrograma($id_membresia, $id_programa, $act_programa){
    require("conexion.php");

    $sql = "INSERT INTO membresia_programa() VALUES(NULL, '$id_membresia', '$id_programa', '$act_programa')";
    mysqli_query($con, $sql);

    mysqli_close($con);

    return "SI";
}

/* Actualización de registros */
function ActualizarMembresia($id_membresia, $nom, $desc, $prec, $dscto, $foto, $act)
{
    require("conexion.php");

    $sql = "UPDATE membresia SET 
    nom_membresia = '$nom',
    desc_membresia = '$desc',
    prec_membresia = '$prec',
    dscto_membresia = '$dscto',
    foto_membresia = '$foto',
    act_membresia = '$act'
    WHERE id_membresia = '$id_membresia'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);

    if ($res) return "SI";
    else return "NO";
}

function ActualizarMembresiaPrograma($id_membresia_programa, $id_programa, $act_programa){
    require("conexion.php");

    $sql = "UPDATE membresia_programa SET 
    id_programa = '$id_programa',
    act_membresia_programa = '$act_programa'
    WHERE id_membresia_programa = '$id_membresia_programa'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);

    if ($res) return "SI";
    else return "NO";
}

/* Eliminación de registros */
function EliminarMembresia($id_membresia){
    require("conexion.php");

    mysqli_autocommit($con, false);

    $sql = "DELETE membresia_programa 
    FROM membresia_programa 
    JOIN membresia ON membresia_programa.id_membresia = membresia.id_membresia 
    WHERE membresia.id_membresia = '$id_membresia'";
    $res1 = mysqli_query($con, $sql);

    $sql = "DELETE FROM membresia WHERE id_membresia = '$id_membresia';";
    $res2 = mysqli_query($con, $sql);
    
    if ($res1 && $res2) {
        mysqli_commit($con);
        mysqli_autocommit($con, true);
        return "SI";
    } else {
        mysqli_rollback($con);
        mysqli_autocommit($con, true);
        return "NO";
    }
    
    mysqli_close($con);
}

function EliminarMembresiaPrograma($id_membresia_programa){
    require("conexion.php");

    $sql = "DELETE FROM membresia_programa WHERE id_membresia_programa = '$id_membresia_programa'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);
    
    if ($res) return "SI";
    else return "NO";

}
?>