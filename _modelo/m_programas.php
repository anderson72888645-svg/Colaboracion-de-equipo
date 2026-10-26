<?php
/* ------------------------- Programas ------------------------- */
function MostrarProgramas() {
    include("_conexion/conexion.php");
    
    $sql="SELECT * FROM programa WHERE act_programa = 1 ORDER BY id_programa ASC";
	
	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
        $datos[] = $row;		
	}
	mysqli_close($con);
	return $datos;
}

/* ------------------------------------------------------------- */

function HorasVideo($id_programa) {
    include("_conexion/conexion.php");
    
    $sql = "SELECT SUM(curso.vid_curso) AS horasVideo 
    FROM curso JOIN programa_curso ON curso.id_curso = programa_curso.id_curso 
    WHERE programa_curso.id_programa = '$id_programa' AND act_programa_curso = 1";
	$res = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_assoc($res);
    $horasVideo = $row['horasVideo'];
    
    mysqli_close($con);
    
    return $horasVideo;
}

/* ------------------------------------------------------------- */

function CantidadCursos($id_programa) {
    include("_conexion/conexion.php");
    
    $sql = "SELECT count(*) AS cantidad_cursos FROM programa_curso WHERE id_programa = '$id_programa' AND act_programa_curso = 1";
	$res = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_assoc($res);
    $cantidad_cursos = $row['cantidad_cursos'];
    
    mysqli_close($con);
    
    return $cantidad_cursos;
}

/* ------------------------------------------------------------- */

function CostoTotal($id_programa) {
    include("_conexion/conexion.php");
    
    $sql = "SELECT ROUND(SUM(c.prec_curso - (c.prec_curso * c.dscto_curso / 100)), 2) AS costoTotal 
    FROM curso AS c 
    JOIN programa_curso AS pc ON pc.id_curso = c.id_curso 
    WHERE pc.id_programa = '$id_programa' 
    AND pc.act_programa_curso = 1;";
	$res = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_assoc($res);
    $costoTotal = $row['costoTotal'];
    
    mysqli_close($con);
    
    return $costoTotal;
}

/* ------------------------------------------------------------- */

function ConsultarPrograma($id_programa) {
    include("_conexion/conexion.php");
    
    $sql="SELECT * FROM programa WHERE act_programa = 1 AND id_programa = '$id_programa'";
	
	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
        $datos[] = $row;		
	}
	mysqli_close($con);
	return $datos;
}

/* ------------------------------------------------------------- */

function ProgramaCursos($id_programa) {
    include("_conexion/conexion.php");
    
    $sql="SELECT * 
    FROM curso cur 
    JOIN horarios hor ON cur.id_curso = hor.id_curso 
    JOIN programa_curso pro_cur ON cur.id_curso = pro_cur.id_curso 
    JOIN programa pro ON pro.id_programa = pro_cur.id_programa 
    WHERE pro.act_programa = 1 
    AND pro_cur.act_programa_curso = 1 
    AND hor.hor_principal = 1 
    AND pro.id_programa = '$id_programa'";
	
	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
        $datos[] = $row;		
	}
	mysqli_close($con);
	return $datos;
}

/* ------------------------------------------------------------- */

function ProgramaCursosTemas($id_curso) {
    include("_conexion/conexion.php");
    
    $sql="SELECT (nom_curso_contenido_tema) AS tema, (act_curso_contenido_tema) AS estado 
    FROM curso_contenido_tema tem 
    JOIN curso_contenido con ON tem.id_curso_contenido = con.id_curso_contenido 
    JOIN curso cur ON con.id_curso = cur.id_curso 
    WHERE cur.id_curso = '$id_curso' 
    ORDER BY tem.id_curso_contenido_tema ASC";
	
	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
        $datos[] = $row;		
	}
	mysqli_close($con);
	return $datos;
}

/* ------------------------------------------------------------- */

function ProgramaDocentes($id_programa) {
    include("_conexion/conexion.php");
    
    $sql="SELECT DISTINCT nom_docente, ape_docente, desc_docente, foto_docente 
    FROM docente doc 
    JOIN curso cur ON doc.id_docente = cur.id_docente 
    JOIN programa_curso pro_cur ON cur.id_curso = pro_cur.id_curso 
    JOIN programa pro ON pro.id_programa = pro_cur.id_programa 
    WHERE pro.act_programa = 1 
    AND pro_cur.act_programa_curso = 1 
    AND pro.id_programa = '$id_programa'";
	
	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
        $datos[] = $row;		
	}
	mysqli_close($con);
	return $datos;
}

/* ------------------------------------------------------------- */

function ProgramaPregunta($id_programa) {
    include("_conexion/conexion.php");
    
    $sql="SELECT * FROM programa_preguntas pro_pre JOIN programa pro ON pro_pre.id_programa = pro.id_programa WHERE pro.act_programa = 1 AND pro.id_programa = '$id_programa' AND pro_pre.act_programa_preguntas = 1";
	
	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
        $datos[] = $row;		
	}
	mysqli_close($con);
	return $datos;
}