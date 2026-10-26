<?php

/* Lista de programas */
function Programas() {
    require("conexion.php");

    $sql = "SELECT * FROM programa";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

$listaProgramas = Programas();
$json_programas = json_encode($listaProgramas);

function ProgramasCursos($id_programa){
    require("conexion.php");

    $sql = "SELECT * FROM programa_curso pro_cur INNER JOIN programa pro ON (pro_cur.id_programa = pro.id_programa) WHERE pro_cur.id_programa = '$id_programa' ORDER BY pro_cur.id_programa_curso ASC";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

function ProgramasPreguntas($id_programa){
    require("conexion.php");

    $sql = "SELECT * FROM programa_preguntas WHERE id_programa = '$id_programa' ORDER BY id_programa_preguntas ASC";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

/* Cantidad de programas y preguntas por programa */
function TotalProgramasCursos($id_programa) {
    require("conexion.php");

    $sql = "SELECT count(*) AS total_programas FROM programa_curso WHERE id_programa = '$id_programa'";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $total_programas = $row['total_programas'];
    
    mysqli_close($con);
    
    return $total_programas;
}

function TotalProgramasPreguntas($id_programa) {
    require("conexion.php");

    $sql = "SELECT count(*) AS total_preguntas FROM programa_preguntas WHERE id_programa = '$id_programa'";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $total_preguntas = $row['total_preguntas'];
    
    mysqli_close($con);
    
    return $total_preguntas;
}

/* Consultas de registros */
function ConsultarPrograma($id_programa)
{
    require("conexion.php");

    $sql = "SELECT * FROM programa WHERE id_programa = '$id_programa' ORDER BY id_programa ASC";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

/* Registrar nuevos datos */
function RegistrarPrograma($nom, $desc, $prec, $foto, $act)
{
    require("conexion.php");

    $sql = "INSERT INTO programa() VALUES(NULL, '$nom', '$prec', '$desc', '$foto', '$act')";
    mysqli_query($con, $sql);

    mysqli_close($con);

    return "SI";
}

function RegistrarProgramaCurso($id_programa, $id_curso, $act_curso){
    require("conexion.php");

    $sql = "INSERT INTO programa_curso() VALUES(NULL, '$id_programa', '$id_curso', '$act_curso')";
    mysqli_query($con, $sql);

    mysqli_close($con);

    return "SI";
}

function RegistrarProgramaPregunta($id_programa, $preg_pro_pre, $rpta_pro_pre, $act_pro_pre){
    require("conexion.php");

    $sql = "INSERT INTO programa_preguntas() VALUES(NULL, '$id_programa', '$preg_pro_pre', '$rpta_pro_pre', '$act_pro_pre')";
    mysqli_query($con, $sql);

    mysqli_close($con);

    return "SI";
}

/* Actualización de registros */
function ActualizarPrograma($id_programa, $nom, $desc, $prec, $foto, $act)
{
    require("conexion.php");

    $sql = "UPDATE programa SET 
    nom_programa = '$nom',
    prec_programa = '$prec',
    desc_programa = '$desc',
    foto_programa = '$foto',
    act_programa = '$act'
    WHERE id_programa = '$id_programa'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);

    if ($res) return "SI";
    else return "NO";
}

function ActualizarProgramaCurso($id_programa_curso, $id_curso, $act_curso){
    require("conexion.php");

    $sql = "UPDATE programa_curso SET 
    id_curso = '$id_curso',
    act_programa_curso = '$act_curso'
    WHERE id_programa_curso = '$id_programa_curso'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);

    if ($res) return "SI";
    else return "NO";
}

function ActualizarProgramaPregunta($id_programa_preguntas, $preg_pro_pre, $rpta_pro_pre, $act_pro_pre){
    require("conexion.php");

    $sql = "UPDATE programa_preguntas SET 
    preg_programa_preguntas = '$preg_pro_pre',
    rpta_programa_preguntas = '$rpta_pro_pre',
    act_programa_preguntas = '$act_pro_pre'
    WHERE id_programa_preguntas = '$id_programa_preguntas'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);

    if ($res) return "SI";
    else return "NO";
}

/* Eliminación de registrso */
function EliminarPrograma($id_programa)
{
    require("conexion.php");

    mysqli_autocommit($con, false);

    $sql = "DELETE FROM programa_preguntas WHERE id_programa = '$id_programa';";
    $res1 = mysqli_query($con, $sql);

    $sql = "DELETE FROM programa_curso WHERE id_programa = '$id_programa';";
    $res2 = mysqli_query($con, $sql);

    $sql = "DELETE FROM membresia_programa WHERE id_programa = '$id_programa';";
    $res3 = mysqli_query($con, $sql);

    $sql = "DELETE FROM programa WHERE id_programa = '$id_programa';";
    $res4 = mysqli_query($con, $sql);

    if ($res1 && $res2 && $res3 && $res4) {
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

function EliminarProgramaCurso($id_programa_curso){
    require("conexion.php");

    $sql = "DELETE FROM programa_curso WHERE id_programa_curso = '$id_programa_curso'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);
    
    if ($res) return "SI";
    else return "NO";

}

function EliminarProgramaPregunta($id_programa_preguntas){
    require("conexion.php");

    $sql = "DELETE FROM programa_preguntas WHERE id_programa_preguntas = '$id_programa_preguntas'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);
    
    if ($res) return "SI";
    else return "NO";

}
?>