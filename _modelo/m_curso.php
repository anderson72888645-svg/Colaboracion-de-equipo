<?php
//---------------------------------------------Curso----------------------------------------------------------
function MostrarCurso1()
{
	include("_conexion/conexion.php");

	$sql="SELECT * 
	FROM curso c
	INNER JOIN horarios h ON c.id_curso = h.id_curso 
	INNER JOIN docente d ON c.id_docente = d.id_docente 
	INNER JOIN pais p ON d.id_pais = p.id_pais 
	INNER JOIN categoria ca ON c.id_categoria = ca.id_categoria 
	WHERE c.act_curso = 1 
	AND h.hor_principal = 1 
	ORDER BY c.nom_curso ASC
	";
	
	$res=mysqli_query($con,$sql);
	$personal = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$personal[] = $row;		
	}
	// Cerrar la conexión
	mysqli_close($con);
	return $personal;
}
//-------------------------------------------------------------------------------------------------------
function ConsultarCurso($cod)
{
	include("_conexion/conexion.php");
	
	$sql="SELECT * 
	FROM curso c 
	INNER JOIN horarios h ON c.id_curso = h.id_curso 
	INNER JOIN docente d ON c.id_docente = d.id_docente 
	INNER JOIN pais p ON d.id_pais = p.id_pais 
	INNER JOIN categoria ca ON c.id_categoria = ca.id_categoria 
	WHERE c.id_curso='$cod' 
	AND c.act_curso=1 
	AND h.hor_principal = 1 ";

	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$datos[] = $row;		
	}

	// Cerrar la conexión
	mysqli_close($con);
	return $datos;
}
//-------------------------------------------------------------------------------------------------------
function ConsultarCursoCategoria($cod)
{
	include("_conexion/conexion.php");
	
	$sql="SELECT * 
	FROM curso c 
	INNER JOIN horarios h ON c.id_curso = h.id_curso 
	INNER JOIN docente d ON c.id_docente = d.id_docente 
	INNER JOIN pais p ON d.id_pais = p.id_pais 
	INNER JOIN categoria ca ON c.id_categoria = ca.id_categoria 
	WHERE c.id_categoria='$cod' 
	AND c.act_curso=1 
	AND h.hor_principal = 1 ";

	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$datos[] = $row;		
	}

	// Cerrar la conexión
	mysqli_close($con);
	return $datos;
}
//-------------------------------------------------------------------------------------------------------
function ConsultarCursoContenido($cod)
{
	include("_conexion/conexion.php");
	
	$sql="SELECT * 
	FROM curso_contenido cc 
	INNER JOIN curso c ON cc.id_curso = c.id_curso 
	INNER JOIN docente d ON c.id_docente = d.id_docente 
	INNER JOIN pais p ON d.id_pais = p.id_pais 
	INNER JOIN categoria ca ON c.id_categoria = ca.id_categoria 
	WHERE cc.id_curso='$cod' 
	AND cc.act_curso_contenido=1";

	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$datos[] = $row;		
	}

	// Cerrar la conexión
	mysqli_close($con);
	return $datos;
}
//-------------------------------------------------------------------------------------------------------
function ConsultarCursoContenidoTema($cod)
{
	include("_conexion/conexion.php");
	
	$sql="SELECT * 
	FROM curso_contenido_tema ct
	INNER JOIN curso_contenido cc ON ct.id_curso_contenido = cc.id_curso_contenido
		INNER JOIN curso c ON cc.id_curso = c.id_curso
			INNER JOIN docente d ON c.id_docente = d.id_docente
				INNER JOIN pais p ON d.id_pais = p.id_pais
			INNER JOIN categoria ca ON c.id_categoria = ca.id_categoria
	WHERE ct.id_curso_contenido='$cod'
	AND ct.act_curso_contenido_tema=1
	ORDER BY ct.id_curso_contenido_tema ASC";

	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$datos[] = $row;		
	}

	// Cerrar la conexión
	mysqli_close($con);
	return $datos;
}
//-------------------------------------------------------------------------------------------------------
function ConsultarCursoPregunta($cod)
{
	include("_conexion/conexion.php");
	
	$sql="SELECT * 
	FROM curso_pregunta cp
	INNER JOIN curso c ON cp.id_curso = c.id_curso
	WHERE cp.id_curso='$cod'
	AND cp.act_curso_pregunta = 1";

	$res=mysqli_query($con,$sql);
	$datos = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$datos[] = $row;		
	}

	// Cerrar la conexión
	mysqli_close($con);
	return $datos;
}
//-------------------------------------------------------------------------------------------------------
?>