<?php
//---------------------------------------------Categoria----------------------------------------------------------
function MostrarCategoria1()
{
	include("_conexion/conexion.php");

	$sql="SELECT * 
	FROM categoria c
	WHERE c.act_categoria=1 
	ORDER BY c.nom_categoria ASC
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
function ConsultarCategoria($cod)
{
	include("_conexion/conexion.php");
	
	$sql="SELECT * 
	FROM categoria c
	WHERE c.id_categoria='$cod'";

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