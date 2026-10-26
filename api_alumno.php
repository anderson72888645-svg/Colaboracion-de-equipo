<?php
require_once __DIR__ . '/config_local.php';
function ConsultarAlumno($dni)
{
	$con = cursos_db('proyecta_educatec_rysoft');
	//$con = cursos_db('proyecta_educatec_dr');

	$sql = "SELECT * 
	FROM alumno a
    WHERE a.dni_alum = '$dni'";

	$res = mysqli_query($con, $sql);
	$personal = array();
	while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$personal[] = $row;
	}
	// Cerrar la conexión
	mysqli_close($con);
	return $personal;
}

$dni = $_POST['dni'];
$datos = ConsultarAlumno($dni);
if ($datos != null) {
	foreach ($datos as $key => $value) {
		$ape1 = $value['ape1_alum'];
		$ape2 = $value['ape2_alum'];

		if ($ape1 == "" || $ape2 == "") {
			$nom = $value['nom_alum'];
		} else {
			$nom = $value['nom_alum'] . " " . $ape1 . " " . $ape2;
		}

		$cel = $value['tel_alum'];
		$email = $value['email_alum'];
	}
} else {
	$nom = "";
	$cel = "";
	$email = "";
}
echo json_encode(array("nom" => $nom, "cel" => $cel, "email" => $email));
