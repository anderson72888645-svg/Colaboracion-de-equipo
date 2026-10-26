<?php
/*ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/debug.log'); // Ruta del archivo de log en el mismo directorio
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

error_log("Iniciando script api_inscripcion.php.");

error_log("Valores recibidos: ");
error_log("free: " . (isset($_POST['free']) ? $_POST['free'] : 'No definido'));
error_log("nom: " . (isset($_POST['nom']) ? $_POST['nom'] : 'No definido'));
error_log("dni: " . (isset($_POST['dni']) ? $_POST['dni'] : 'No definido'));
error_log("cel: " . (isset($_POST['cel']) ? $_POST['cel'] : 'No definido'));
error_log("correo: " . (isset($_POST['correo']) ? $_POST['correo'] : 'No definido'));
error_log("id_horario: " . (isset($_POST['id_horario']) ? $_POST['id_horario'] : 'No definido'));
error_log("med_pago: " . (isset($_POST['med_pago']) ? $_POST['med_pago'] : 'No definido'));*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

$free = $_POST['free'];
$nom = $_POST['nom'];
$dni = $_POST['dni'];
$cel = $_POST['cel'];
$correo = $_POST['correo'];
$id_horario = $_POST['id_horario'];
$med_pago = $_POST['med_pago'];


function RegistrarUsuario($free, $nom, $dni, $cel, $correo, $id_horario, $med_pago)
{
	require("admin/model/conexionAPI.php");
	//error_log("funcion registrar conexion exitosa");
	date_default_timezone_set('America/Lima');

	$sql = "SELECT *
	FROM alumno a
	WHERE a.dni_alum = '$dni'";

	$res = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($res);
	$id_alum = $row['id_alum'];

	if ($id_alum == null) //si el alumno no existe, se le registra
	{
		$sqlr = "INSERT INTO alumno() VALUES(NULL,'$nom','','','$dni','$cel','$correo',0,'','$dni','sinfoto.png',1,1,1,DATE(NOW()),DATE(NOW()),TIME(NOW()),TIME(NOW()))";
		mysqli_query($con, $sqlr);
		$id_alum = mysqli_insert_id($con); //se obtiene su ID
	}
	if ($free == 0) //si el curso es gratuito se matricula al alumno en el curso
	{
		//comprobar si ya se matriculo
		$sqlc = "SELECT * FROM matricula 
		WHERE id_alum = '$id_alum' 
		AND id_hor = '$id_horario' 
		AND act_mat = 1";
		$resc = mysqli_query($con, $sqlc);
		$rowc = mysqli_fetch_array($resc);
		$id_mat = $rowc['id_mat'];
		echo $id_mat;

		if ($id_mat == null) //si no tiene matricula en ese horario
		{
			//error_log("insertando datos a matricula...");
			$sqlm = "INSERT INTO matricula() VALUES(NULL,'$id_alum','$id_horario',0,0,0,DATE(NOW()),TIME(NOW()),1,1,1,DATE(NOW()),DATE(NOW()),TIME(NOW()),TIME(NOW()))";
			mysqli_query($con, $sqlm);
			$id_mat = mysqli_insert_id($con); //se obtiene su ID

			/* Registrar medio de pago */

			/* $curso = consultarCurso($id_horario);

			foreach ($curso as $key => $value) {
				$id_cur = $value['id_curso'];
				$nom_curso = strtoupper($value['nom_curso']);
				$prec_curso = $value['prec_curso'];
				$dscto_curso = $value['dscto_curso'];

				$precio =  $prec_curso - ($prec_curso * ($dscto_curso / 100));
				$precio = round($precio, 2);
			}

			$sin_espacio = str_replace(' ', '', $nom_curso);
			$primeras = substr($sin_espacio, 0, 3);
			$dia = date("d");
			$mes = date("m");
			$año = date("y");
			$fecha = date("Y-m-d");
			$hora = date("H:i:s");

			$num_pago = 'C' . $id_cur . '-' . $primeras . '-' . $dia . '' . $mes . '' . $año;

			$sql_pago = "INSERT INTO pago() VALUES(NULL, '$id_mat', '$id_alum', 1, '$num_pago', 'MENSUALIDAD', '$nom_curso', '$precio', '$fecha', '$hora', 1, '$med_pago')";
			mysqli_query($con, $sql_pago); */
		}
	}

	return $id_mat;

	// Cerrar la conexión
	mysqli_close($con);
}

function consultarCurso($id_horario)
{
	//error_log("Iniciando funcion consultarcurso");
	require("admin/model/conexion.php");

	$sql = "SELECT nom_curso, prec_curso, dscto_curso, dur_curso, vid_curso, CONCAT(ape_docente, ' ', nom_docente) AS docente, curso.id_curso 
    FROM curso 
    JOIN tipo ON curso.id_tipo = tipo.id_tipo 
    LEFT JOIN nivel ON curso.id_nivel = nivel.id_nivel 
    INNER JOIN horarios ON curso.id_curso = horarios.id_curso 
	INNER JOIN docente ON curso.id_docente = docente.id_docente
    WHERE id_horario = '$id_horario'";

	$res = mysqli_query($con, $sql);

	$datos = array();

	while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$datos[] = $fila;
	}
	//error_log("datos de consulta" . json_encode($datos));
	return $datos;


	mysqli_close($con);
}

function Correo($free, $nom, $dni, $cel, $correo, $id_horario)
{
	//error_log("Iniciando funcion correo - " . $correo);
	$curso = consultarCurso($id_horario);
	//error_log("ya consulto el curso" . json_encode($curso));
	if ($curso != NULL) {
		foreach ($curso as $key => $value) {
			$nom_curso = $value['nom_curso'];
			$dur_curso = $value['dur_curso'];
			$dur_curso = round($dur_curso, 2);
			$vid_curso = $value['vid_curso'];
			$docente = $value['docente'];

			$prec_curso = $value['prec_curso'];
			$dscto_curso = $value['dscto_curso'];

			$precio =  $prec_curso - ($prec_curso * ($dscto_curso / 100));
			$precio = round($precio, 2);
		}


		$mail = new PHPMailer(true);

		try {
			//Configuración del servidor
			$mail->SMTPDebug = SMTP::DEBUG_OFF; //SMTP::DEBUG_OFF para servidor - SMTP::DEBUG_SERVER
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->Host       = 'mail.gruporysoft.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = getenv('CURSOS_SMTP_USER') ?: '';
			$mail->Password   = getenv('CURSOS_SMTP_PASSWORD') ?: '';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = 465; //use 587 -> `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Emisor, receptor y respuestas al correo
			$mail->setFrom('cursos@gruporysoft.com', 'RYSOFT');
			$mail->addAddress($correo, "Usuario");
			$mail->addReplyTo('cursos@gruporysoft.com', 'Information RYSOFT'); // Rysoft respuesta

			//Content
			$mail->isHTML(true);
			$mail->Subject = '¡COMPRA EXITOSA DE CURSO ' . $nom_curso . '!';

			$mensaje = '<div style="width: 100%; background-color: #E5E7E9; text-align: center; color: #000000;">';
			$mensaje .= '<div style="width: 100%;">';
			$mensaje .= '<div style="padding: 50px; background-color: #bf0e09; color: white; font-weight: 500; font-size: 25px;">';
			$mensaje .= '<img src="cursos.gruporysoft.com/assets/foto/logo_rysoft.png" alt="Logo RYSOFT" style="width: 25%; padding: 10px 25px; background-color: white; border-radius: 10px;">';
			$mensaje .= '<h3>CONFIRMACIÓN DE COMPRA</h3>';
			$mensaje .= '</div>';
			$mensaje .= '<div style="padding: 25px; background-color: white;">';
			$mensaje .= '<h4 style="font-weight: 400; font-size: 25px;">DETALLES DE LA MATRÍCULA</h4>';
			$mensaje .= '<h5 style="font-weight: 400; font-size: 20px; text-align: left;">Información del curso</h5>';
			$mensaje .= '<table style="width: 100%; padding: 10px;">';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Nombre</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $nom_curso . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Precio</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">S/. ' . $precio . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Docente</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $docente . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Duración en horas</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $dur_curso . ' horas</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Duración en videos</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $vid_curso . ' videos</td>';
			$mensaje .= '</tr>';
			$mensaje .= '</table>';
			$mensaje .= '<h5 style="font-weight: 400; font-size: 20px; text-align: left;">Información del estudiante</h5>';
			$mensaje .= '<table>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Nombres y Apellidos</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $nom . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">DNI</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $dni . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Celular</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $cel . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Correo</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $correo . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '</table>';
			$mensaje .= '<div style="margin: 5%; padding: 10px; background-color: #FFBFBF; border-radius: 10px;">';
			$mensaje .= '<h5 style="text-align: center; font-weight: 600; font-size: 20px; margin: 5%;">¿Ahora que sigue?</h5>';
			$mensaje .= '<ol style="font-size: 15px; font-weight: 400;">';
			$mensaje .= '<li>Ingresa a <a href="www.educatecvirtual.com" style="text-decoration: none; color: #bf0e09; font-weight: 600;">www.educatecvirtual.com</a></li>';
			$mensaje .= '<li>Ingresa tu DNI como usuario y contraseña.</li>';
			$mensaje .= '<li>Seleccionar la institución Rysoft.</li>';
			$mensaje .= '<li>Dale clic a Ingresar.</li>';
			$mensaje .= '<li>Ingresa a la sección Anuncios.</li>';
			$mensaje .= '</ol>';
			$mensaje .= '</div>';
			$mensaje .= '</div>';
			$mensaje .= '<div style="padding: 20px;">';
			$mensaje .= '<h3>RYSOFT</h3>';
			$mensaje .= '<a href="https://web.facebook.com/gruporysoft" target="_blank">';
			$mensaje .= '<img src="cursos.gruporysoft.com/assets/foto/facebook.png" alt="Logo facebook">';
			$mensaje .= '</a>';
			$mensaje .= '</div>';
			$mensaje .= '</div>';
			$mensaje .= '</div>';

			$mail->CharSet = 'UTF-8';
			$mail->Encoding = 'base64';
			$mail->Body = $mensaje;
			$mail->AltBody = 'Le enviamos los detalles de su registro.';

			$mail->setLanguage('es');

			echo "Correo enviado";
			$mail->send();
		} catch (Exception $e) {
			echo "Error al enviar el correo electrónico de la compra: {$mail->ErrorInfo}";
			exit();
		}
	}
}

function CorreoAdministrador($free, $nom, $dni, $cel, $correo, $id_horario, $id_matricula)
{
	//error_log("Iniciando funcion correo administration");
	$curso = consultarCurso($id_horario);

	if ($curso != NULL) {
		foreach ($curso as $key => $value) {
			$nom_curso = $value['nom_curso'];
			$dur_curso = $value['dur_curso'];
			$dur_curso = round($dur_curso, 2);
			$vid_curso = $value['vid_curso'];
			$docente = $value['docente'];
			$prec_curso = $value['prec_curso'];
			$dscto_curso = $value['dscto_curso'];

			$precio =  $prec_curso - ($prec_curso * ($dscto_curso / 100));
			$precio = round($precio, 2);
		}


		$mail = new PHPMailer(true);

		try {
			//Configuración del servidor
			$mail->SMTPDebug = SMTP::DEBUG_OFF; //SMTP::DEBUG_OFF para servidor - SMTP::DEBUG_SERVER
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->Host       = 'mail.gruporysoft.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = getenv('CURSOS_SMTP_USER') ?: '';
			$mail->Password   = getenv('CURSOS_SMTP_PASSWORD') ?: '';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = 465; //use 587 -> `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Emisor, receptor y respuestas al correo
			$mail->setFrom('cursos@gruporysoft.com', 'RYSOFT');
			$mail->addAddress("gruporysoft@gmail.com", "Administrador");

			//Content
			$mail->isHTML(true);
			$mail->Subject = '¡COMPRA EXITOSA DE CURSO ' . $nom_curso . '!';

			$mensaje = '<div style="width: 100%; background-color: #E5E7E9; text-align: center; color: #000000;">';
			$mensaje .= '<div style="width: 100%;">';
			$mensaje .= '<div style="padding: 50px; background-color: #bf0e09; color: white; font-weight: 500; font-size: 25px;">';
			$mensaje .= '<img src="cursos.gruporysoft.com/assets/foto/logo_rysoft.png" alt="Logo RYSOFT" style="width: 25%; padding: 10px 25px; background-color: white; border-radius: 10px;">';
			$mensaje .= '<h3>CONFIRMACIÓN DE COMPRA</h3>';
			$mensaje .= '</div>';
			$mensaje .= '<div style="padding: 25px; background-color: white;">';
			$mensaje .= '<h4 style="font-weight: 400; font-size: 25px;">DETALLES DE LA MATRÍCULA</h4>';
			$mensaje .= '<h5 style="font-weight: 400; font-size: 20px; text-align: left;">Información del curso</h5>';
			$mensaje .= '<table style="width: 100%; padding: 10px;">';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">ID Matrícula</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $id_matricula . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Nombre</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $nom_curso . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Precio</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">S/. ' . $precio . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Docente</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $docente . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Duración en horas</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $dur_curso . ' horas</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Duración en videos</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $vid_curso . ' videos</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">ID Horario</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $id_horario . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '</table>';
			$mensaje .= '<h5 style="font-weight: 400; font-size: 20px; text-align: left;">Información del estudiante</h5>';
			$mensaje .= '<table>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Nombres y Apellidos</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $nom . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">DNI</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $dni . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Celular</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $cel . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '<tr>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Correo</td>';
			$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $correo . '</td>';
			$mensaje .= '</tr>';
			$mensaje .= '</table>';
			$mensaje .= '<div style="margin: 5%; padding: 10px; background-color: #FFBFBF; border-radius: 10px;">';
			$mensaje .= '<h5 style="text-align: center; font-weight: 600; font-size: 20px; margin: 5%;">¿Ahora que sigue?</h5>';
			$mensaje .= '<ol style="font-size: 15px; font-weight: 400;">';
			$mensaje .= '<li>Ingresa a <a href="www.educatecvirtual.com" style="text-decoration: none; color: #bf0e09; font-weight: 600;">www.educatecvirtual.com</a></li>';
			$mensaje .= '<li>Ingresa tu DNI como usuario y contraseña.</li>';
			$mensaje .= '<li>Seleccionar la institución Rysoft.</li>';
			$mensaje .= '<li>Dale clic a Ingresar.</li>';
			$mensaje .= '<li>Ingresa a la sección Anuncios.</li>';
			$mensaje .= '</ol>';
			$mensaje .= '</div>';
			$mensaje .= '</div>';
			$mensaje .= '<div style="padding: 20px;">';
			$mensaje .= '<h3>RYSOFT</h3>';
			$mensaje .= '<a href="https://web.facebook.com/gruporysoft" target="_blank">';
			$mensaje .= '<img src="cursos.gruporysoft.com/assets/foto/facebook.png" alt="Logo facebook">';
			$mensaje .= '</a>';
			$mensaje .= '</div>';
			$mensaje .= '</div>';
			$mensaje .= '</div>';

			$mail->CharSet = 'UTF-8';
			$mail->Encoding = 'base64';
			$mail->Body = $mensaje;
			$mail->AltBody = 'Le enviamos los detalles de su registro.';

			$mail->setLanguage('es');

			echo "Correo enviado";
			$mail->send();
		} catch (Exception $e) {
			echo "Error al enviar el correo electrónico de la compra al administrador: {$mail->ErrorInfo}";
			exit();
		}
	}
}

$rpta = RegistrarUsuario($free, $nom, $dni, $cel, $correo, $id_horario, $med_pago);
Correo($free, $nom, $dni, $cel, $correo, $id_horario);
CorreoAdministrador($free, $nom, $dni, $cel, $correo, $id_horario, $rpta);
echo $rpta;
