<?php
function ConsultarAlumnos($id_alum) {
	require("conexionAPI.php");

	$sql="SELECT * FROM alumno WHERE id_alum = '$id_alum'";
	
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

/* Certificados */
function Certificados($id_alumno) {
	require("conexionAPI.php");

	$sql="SELECT * FROM certificado cer INNER JOIN matricula mat ON (cer.id_mat = mat.id_mat) INNER JOIN alumno alu ON (alu.id_alum = mat.id_alum) INNER JOIN horario hor ON (mat.id_hor = hor.id_hor) INNER JOIN curso cur ON (cur.id_cur = hor.id_cur) WHERE mat.id_alum = '$id_alumno'";
	
	$res=mysqli_query($con,$sql);
	$certificados = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$certificados[] = $row;		
	}
	// Cerrar la conexión
	mysqli_close($con);
	return $certificados;
}

function RegistrarCertificado($id_mat, $img_cert, $act)
{
    require("conexionAPI.php");

    $sql = "INSERT INTO certificado() VALUES(NULL, '$id_mat', '$img_cert', '$act')";
    mysqli_query($con, $sql);

    return "SI";

    mysqli_close($con);
}

function ActualizarCertificado($id_cert, $img_cert, $act)
{
    require("conexionAPI.php");

    $sql = "UPDATE certificado SET 
	link_certificado = '$img_cert',
	act_certificado = '$act'
	WHERE id_certificado = '$id_cert'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}

function EliminarCertificado($id_certificado)
{
    require("conexionAPI.php");

    $sql = "DELETE FROM certificado WHERE id_certificado = '$id_certificado'";
    $res = mysqli_query($con, $sql);

    if ($res) return "SI";
    else return "NO";

    mysqli_close($con);
}

function CursosRegistrados($id_alumno){
    require("conexionAPI.php");

    $sql="SELECT * FROM matricula mat INNER JOIN alumno alu ON (alu.id_alum = mat.id_alum) INNER JOIN horario hor ON (mat.id_hor = hor.id_hor) INNER JOIN curso cur ON (cur.id_cur = hor.id_cur) WHERE mat.id_alum = '$id_alumno'";
	
	$res=mysqli_query($con,$sql);
	$cursos_registrados = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$cursos_registrados[] = $row;		
	}
	// Cerrar la conexión
	mysqli_close($con);
	return $cursos_registrados;
}

function ConsultarMatriculas($id_alumno){
    require("conexionAPI.php");

    $sql="SELECT id_certificado, cer.link_certificado, mat.id_alum, mat.id_mat, act_certificado, nom_cur, hor.id_hor FROM matricula mat JOIN alumno alu ON alu.id_alum = mat.id_alum JOIN horario hor ON mat.id_hor = hor.id_hor JOIN curso cur ON cur.id_cur = hor.id_cur LEFT JOIN certificado cer ON cer.id_mat = mat.id_mat WHERE mat.id_alum = '$id_alumno'";
	
	$res=mysqli_query($con,$sql);
	$cursos_matriculados = array();
	while($row=mysqli_fetch_array($res, MYSQLI_ASSOC))
	{
		$cursos_matriculados[] = $row;		
	}
	// Cerrar la conexión
	mysqli_close($con);
	return $cursos_matriculados;
}

?>