<?php
function CursosRegistrados() {
    require("conexion.php");

    $sql = "SELECT count(*) AS total_cursos FROM curso";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $total_cursos = $row['total_cursos'];
    
    mysqli_close($con);
    
    return $total_cursos;
}

function DocentesRegistrados() {
    require("conexion.php");

    $sql = "SELECT count(*) AS total_docentes FROM docente";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $total_docentes = $row['total_docentes'];
    
    mysqli_close($con);
    
    return $total_docentes;
}



function Cursos() {
    require("conexion.php");

    $sql = "SELECT cur.nom_curso, doc.nom_docente, doc.ape_docente, cat.nom_categoria, cur.act_curso FROM curso cur INNER JOIN docente doc ON (cur.id_docente = doc.id_docente) INNER JOIN categoria cat ON (cur.id_categoria = cat.id_categoria) LIMIT 10;";
    $res = mysqli_query($con, $sql);

    $cursos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $cursos[] = $fila;
    }
    
    mysqli_close($con);
    
    return $cursos;
}

function Docentes() {
    require("conexion.php");

    $sql = "SELECT doc.nom_docente, doc.ape_docente, pai.nom_pais, doc.foto_docente, doc.act_docente FROM docente doc INNER JOIN pais pai ON (doc.id_pais = pai.id_pais) ORDER BY id_docente DESC LIMIT 7;";
    $res = mysqli_query($con, $sql);

    $docentes = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $docentes[] = $fila;
    }
    
    mysqli_close($con);
    
    return $docentes;
}