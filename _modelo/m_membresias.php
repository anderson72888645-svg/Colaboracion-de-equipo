<?php
/* ------------------------- Programas ------------------------- */
function MostrarMembresias() {
    include("_conexion/conexion.php");
    
    $sql="SELECT * FROM membresia WHERE act_membresia = 1 ORDER BY id_membresia ASC";
	
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

function ConsultarMembresia($id_membresia) {
    include("_conexion/conexion.php");
    
    $sql="SELECT * FROM membresia WHERE act_membresia = 1 AND id_membresia = '$id_membresia'";
	
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

function MembresiaCursos($id_membresia) {
    include("_conexion/conexion.php");

    $sql = "SELECT DISTINCT * 
    FROM curso cur 
    JOIN horarios hor ON cur.id_curso = hor.id_curso 
    JOIN programa_curso pro_cur ON pro_cur.id_curso = cur.id_curso 
    JOIN programa pro ON pro.id_programa = pro_cur.id_programa 
    JOIN membresia_programa mem_pro ON mem_pro.id_programa = pro.id_programa 
    WHERE mem_pro.act_membresia_programa = 1 
    AND pro.act_programa = 1 
    AND pro_cur.act_programa_curso = 1 
    AND mem_pro.id_membresia = '$id_membresia' 
    AND hor.hor_principal = 1";
	
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

function MembresiaCursosTemas($id_curso) {
    include("_conexion/conexion.php");
    
    $sql="SELECT (nom_curso_contenido_tema) AS tema 
    FROM curso_contenido_tema tem 
    JOIN curso_contenido con ON tem.id_curso_contenido = con.id_curso_contenido 
    JOIN curso cur ON con.id_curso = cur.id_curso 
    WHERE cur.id_curso = '$id_curso' 
    AND tem.act_curso_contenido_tema = 1 
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

function MembresiaDocentes($id_membresia) {
    include("_conexion/conexion.php");
    
    $sql="SELECT DISTINCT nom_docente, ape_docente, desc_docente, foto_docente 
    FROM docente doc 
    JOIN curso cur ON doc.id_docente = cur.id_docente 
    JOIN programa_curso pro_cur ON cur.id_curso = pro_cur.id_curso 
    JOIN programa pro ON pro.id_programa = pro_cur.id_programa 
    JOIN membresia_programa mem_pro ON mem_pro.id_programa = pro.id_programa 
    WHERE mem_pro.act_membresia_programa = 1 
    AND pro.act_programa = 1 
    AND pro_cur.act_programa_curso = 1 
    AND mem_pro.id_membresia = '$id_membresia'";
	
	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
        $datos[] = $row;		
	}
	mysqli_close($con);
	return $datos;
}
