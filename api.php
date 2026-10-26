<?php
require_once __DIR__ . '/config_local.php';
function Horarios()
{
	$con = cursos_db('proyecta_educatec_rysoft');

	$sql = "SELECT h.id_hor as id, 
	c.nom_cur as nombre
	FROM horario h
    INNER JOIN curso c ON h.id_cur = c.id_cur";

	$res = mysqli_query($con, $sql);
	$personal = array();
	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$personal[] = $row;
	}
	// Cerrar la conexión
	mysqli_close($con);
	return $personal;
}
$datos = Horarios();
json_encode($datos);

function Alumnos()
{
	//$con = cursos_db('proyecta_educatec_dr');
	$con = cursos_db('proyecta_educatec_rysoft');

	$sql = "SELECT * FROM alumno";

	$res = mysqli_query($con, $sql);
	$alumnos = array();
	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$alumnos[] = $row;
	}
	// Cerrar la conexión
	mysqli_close($con);
	return $alumnos;
}

function ConsultarAlumnos($id_alum)
{
	//$con = cursos_db('proyecta_educatec_dr');
	$con = cursos_db('proyecta_educatec_rysoft');

	$sql = "SELECT * FROM alumno WHERE id_alum = '$id_alum'";

	$res = mysqli_query($con, $sql);
	$datos = array();
	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$datos[] = $row;
	}
	// Cerrar la conexión
	mysqli_close($con);
	return $datos;
}

function TotalAlumnos()
{
	//$con = cursos_db('proyecta_educatec_dr');
	$con = cursos_db('proyecta_educatec_rysoft');

	$sql = "SELECT count(*) AS total_alumnos FROM alumno";
	$res = mysqli_query($con, $sql);

	$row = mysqli_fetch_assoc($res);
	$total_alumnos = $row['total_alumnos'];
	// Cerrar la conexión
	mysqli_close($con);
	return $total_alumnos;
}

/* Certificados */
function Certificados($id_alumno)
{
	//$con = cursos_db('proyecta_educatec_dr');
	$con = cursos_db('proyecta_educatec_rysoft');

	$sql = "SELECT * FROM certificado cer INNER JOIN matricula mat ON (cer.id_mat = mat.id_mat) INNER JOIN alumno alu ON (alu.id_alum = mat.id_alum) INNER JOIN horario hor ON (mat.id_hor = hor.id_hor) INNER JOIN curso cur ON (cur.id_cur = hor.id_cur) WHERE mat.id_alum = '$id_alumno'";

	$res = mysqli_query($con, $sql);
	$certificados = array();
	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$certificados[] = $row;
	}
	// Cerrar la conexión
	mysqli_close($con);
	return $certificados;
}
