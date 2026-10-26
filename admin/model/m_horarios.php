<?php
require_once dirname(__DIR__, 2) . '/config_local.php';
function Horarios()
{
	$con = cursos_db('proyecta_educatec_rysoft');

    $sql="SELECT h.id_hor as id, 
	c.nom_cur as nombre
	FROM horario h
    INNER JOIN curso c ON h.id_cur = c.id_cur";
	
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
$datos = Horarios();
echo json_encode($datos);
?>