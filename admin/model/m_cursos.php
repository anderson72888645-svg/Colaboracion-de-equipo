<?php

/************************** Cursos **************************/
function ListarCursos()
{
    require("conexion.php");

    $sql = "SELECT * FROM curso cur INNER JOIN docente doc ON (cur.id_docente = doc.id_docente) INNER JOIN categoria cat ON (cur.id_categoria = cat.id_categoria)";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

$listaCursos = ListarCursos();
$json_cursos = json_encode($listaCursos);

function ConsultarCurso($id_curso)
{
    require("conexion.php");

    $sql = "SELECT * FROM curso WHERE id_curso = '$id_curso' ORDER BY id_curso ASC";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

function RegistrarCursos($doc, $cat, $nom, $desc, $dur, $prec, $dscto, $vid, $foto, $act, $hor, $tip, $niv)
{
    require("conexion.php");

    $sql = "INSERT INTO curso() VALUES(NULL, '$doc', '$cat', '$tip', '$niv', '$nom', '$desc', '$dur', '$prec', '$dscto', '$vid', '$foto', '$act')";
    mysqli_query($con, $sql);

    $ultimo_id_curso = mysqli_insert_id($con);

    $sql_relacion = "INSERT INTO horarios() VALUES (NULL, '$ultimo_id_curso', '$hor', 1, 1)";
    mysqli_query($con, $sql_relacion);

    mysqli_close($con);

    return "SI";
}

function ActualizarCursos($id_curso, $doc, $cat, $nom, $desc, $dur, $prec, $dscto, $vid, $foto, $act, $tip, $niv)
{
    require("conexion.php");

    $sql = "UPDATE curso SET 
    id_docente = '$doc',
    id_categoria = '$cat',
    id_tipo = '$tip',
    id_nivel = '$niv',
    nom_curso = '$nom',
    desc_curso = '$desc',
    dur_curso = '$dur',
    prec_curso = '$prec',
    dscto_curso = '$dscto',
    vid_curso = '$vid',
    foto_curso = '$foto',
    act_curso = '$act'
    WHERE id_curso = '$id_curso'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);

    if ($res) return "SI";
    else return "NO";
}

function EliminarCurso($id_curso)
{
    require("conexion.php");

    mysqli_autocommit($con, false);

    $sql = "DELETE curso_contenido_tema FROM curso_contenido_tema 
        JOIN curso_contenido ON curso_contenido_tema.id_curso_contenido = curso_contenido.id_curso_contenido 
        JOIN curso ON curso_contenido.id_curso = curso.id_curso 
        JOIN horarios ON curso.id_curso = horarios.id_curso 
        WHERE curso.id_curso = '$id_curso';";

    $res1 = mysqli_query($con, $sql);

    $sql = "DELETE FROM curso_contenido WHERE id_curso = '$id_curso';";
    $res2 = mysqli_query($con, $sql);

    $sql = "DELETE FROM curso_pregunta WHERE id_curso = '$id_curso';";
    $res3 = mysqli_query($con, $sql);

    $sql = "DELETE FROM curso WHERE id_curso = '$id_curso';";
    $res4 = mysqli_query($con, $sql);
    
    $sql = "DELETE FROM horarios WHERE id_curso = '$id_curso';";
    $res5 = mysqli_query($con, $sql);

    if ($res1 && $res2 && $res3 && $res4 && $res5) {
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

function consultarHorarioCursoAntiguo($id_curso) {
    require("conexion.php");

    $sql = "SELECT id_horario FROM horarios WHERE id_curso = '$id_curso'";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $id_horario = $row['id_horario'];

    mysqli_close($con);

    return $id_horario;
}

function consultarCursoAntiguo($id_horario) {
    require("conexionAPI.php");

    $sql = "SELECT id_cur FROM horario WHERE id_hor = '$id_horario' LIMIT 1";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $id_cur = $row['id_cur'];

    mysqli_close($con);

    return $id_cur;
}

/************************** Módulos **************************/
function ConsultarModulos($id_curso)
{
    require("conexion.php");

    $sql = "SELECT * FROM curso_contenido WHERE id_curso = '$id_curso' ORDER BY id_curso_contenido ASC";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

function RegistrarModulo($id_curso, $cod_con, $nom_con, $desc_con, $act_con)
{
    require("conexion.php");

    $sql = "INSERT INTO curso_contenido() VALUES(NULL, '$id_curso', '$cod_con', '$nom_con', '$desc_con', '$act_con')";
    mysqli_query($con, $sql);

    mysqli_close($con);

    return "SI";
}

function ActualizarModulo($id_modulo, $cod, $nom, $desc, $act)
{
    require("conexion.php");

    $sql = "UPDATE curso_contenido SET 
    cod_curso_contenido = '$cod',
    nom_curso_contenido = '$nom',
    desc_curso_contenido = '$desc',
    act_curso_contenido = '$act'
    WHERE id_curso_contenido = '$id_modulo'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);

    if ($res) return "SI";
    else return "NO";
}

function EliminarModulo($id_modulo)
{
    require("conexion.php");

    mysqli_autocommit($con, false);

    $sql = "DELETE curso_contenido_tema FROM curso_contenido_tema
        JOIN curso_contenido ON curso_contenido_tema.id_curso_contenido = curso_contenido.id_curso_contenido
        WHERE curso_contenido.id_curso_contenido = '$id_modulo';";

    $res1 = mysqli_query($con, $sql);

    $sql = "DELETE FROM curso_contenido WHERE id_curso_contenido = '$id_modulo';";
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

/************************** Temas **************************/
function ConsultarTemas($id_modulo)
{
    require("conexion.php");

    $sql = "SELECT * FROM curso_contenido_tema WHERE id_curso_contenido = '$id_modulo' ORDER BY id_curso_contenido_tema ASC";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

function RegistrarTema($id_modulo, $nom_tem, $act_tem)
{
    require("conexion.php");

    $sql = "INSERT INTO curso_contenido_tema() VALUES(NULL, '$id_modulo', '$nom_tem', '$act_tem')";
    mysqli_query($con, $sql);

    mysqli_close($con);

    return "SI";
}

function ActualizarTema($id_tema, $nom_tem, $est_tem)
{
    require("conexion.php");

    $sql = "UPDATE curso_contenido_tema SET 
    nom_curso_contenido_tema = '$nom_tem',
    act_curso_contenido_tema = '$est_tem'
    WHERE id_curso_contenido_tema = '$id_tema'";
    $res = mysqli_query($con, $sql);

    mysqli_close($con);

    if ($res) return "SI";
    else return "NO";
}

function EliminarTema($id_tema)
{
    require("conexion.php");

    $sql = "DELETE FROM curso_contenido_tema WHERE id_curso_contenido_tema = '$id_tema';";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}

/************************** Preguntas **************************/
function ConsultarPreguntas($id_curso)
{
    require("conexion.php");

    $sql = "SELECT * FROM curso_pregunta WHERE id_curso = '$id_curso' ORDER BY id_curso_pregunta ASC";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

function RegistrarPregunta($id_curso, $pre_pre, $res_pre, $act_pre)
{
    require("conexion.php");

    $sql = "INSERT INTO curso_pregunta() VALUES(NULL, '$id_curso', '$pre_pre', '$res_pre', '$act_pre')";
    mysqli_query($con, $sql);

    mysqli_close($con);

    return "SI";
}

function ActualizarPreguntas($id_pregunta, $nom_pre, $desc_pre, $act_pre)
{
    require("conexion.php");

    try {
        $sql = "UPDATE curso_pregunta SET 
        nom_curso_pregunta = '$nom_pre',
        desc_curso_pregunta = '$desc_pre',
        act_curso_pregunta = '$act_pre'
        WHERE id_curso_pregunta = '$id_pregunta'";
        $res = mysqli_query($con, $sql);

        if ($res) return "SI";
        else return "NO";
    } catch (Exception $e) {
        echo "Error al actualizar las preguntas de los cursos: " . $e->getMessage();
        return "Error al actualizar las preguntas de los cursos: " . $e->getMessage();
    } finally {
        mysqli_close($con);
    }
}

function EliminarPregunta($id_pregunta)
{
    require("conexion.php");

    $sql = "DELETE FROM curso_pregunta WHERE id_curso_pregunta = '$id_pregunta';";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}

/************************** Horarios **************************/
function ConsultarHorarios($id_curso)
{
    require("conexion.php");

    $sql = "SELECT * FROM horarios WHERE id_curso = '$id_curso' ORDER BY id_relacion ASC";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

function RegistrarHorarios($id_curso, $id_horario, $hor_principal, $act_horario)
{
    require("conexion.php");

    $sql = "INSERT INTO horarios() VALUES(NULL, '$id_curso', '$id_horario', '$hor_principal', '$act_horario')";
    mysqli_query($con, $sql);

    mysqli_close($con);

    return "SI";
}

function ActualizarHorario($id_relacion, $id_horario, $hor_principal, $act_horario)
{
    require("conexion.php");

    try {
        $sql = "UPDATE horarios SET 
        id_horario = '$id_horario', 
        hor_principal = '$hor_principal', 
        act_horario = '$act_horario' 
        WHERE id_relacion = '$id_relacion'";
        $res = mysqli_query($con, $sql);

        if ($res) return "SI";
        else return "NO";
    } catch (Exception $e) {
        echo "Error al actualizar el horario del cursos: " . $e->getMessage();
        return "Error al actualizar el horario del cursos: " . $e->getMessage();
    } finally {
        mysqli_close($con);
    }
}

function EliminarHorario($id_relacion)
{
    require("conexion.php");

    $sql = "DELETE FROM horarios WHERE id_relacion = '$id_relacion';";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}

/************************** Cantidad **************************/
function ConsultarCantidadModulos($id_curso)
{
    require("conexion.php");

    $sql = "SELECT count(*) AS total_modulos FROM curso_contenido WHERE id_curso = '$id_curso'";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $total_modulos = $row['total_modulos'];

    mysqli_close($con);

    return $total_modulos;
}

function ConsultarCantidadTemas($id_modulo)
{
    require("conexion.php");

    try {
        $sql = "SELECT count(*) AS total_temas FROM curso_contenido_tema WHERE id_curso_contenido = '$id_modulo'";
        $res = mysqli_query($con, $sql);

        $row = mysqli_fetch_assoc($res);
        $total_temas = $row['total_temas'];

        return $total_temas;
    } catch (Exception $e) {
        echo "Error en la consulta de la cantidad de preguntas: " . $e->getMessage();
    } finally {
        mysqli_close($con);
    }
}

function ConsultarCantidadPreguntas($id_curso)
{
    require("conexion.php");

    try {
        $sql = "SELECT count(*) AS total_preguntas FROM curso_pregunta WHERE id_curso = '$id_curso'";
        $res = mysqli_query($con, $sql);

        $row = mysqli_fetch_assoc($res);
        $total_preguntas = $row['total_preguntas'];

        return $total_preguntas;
    } catch (Exception $e) {
        echo "Error en la consulta de la cantidad de preguntas: " . $e->getMessage();
    } finally {
        mysqli_close($con);
    }
}

