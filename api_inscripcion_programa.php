<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require __DIR__ . '/vendor/autoload.php';

$free = $_POST['free'];
$nom = $_POST['nom'];
$dni = $_POST['dni'];
$cel = $_POST['cel'];
$correo = $_POST['correo'];
$id_programa = $_POST['id_programa'];
$ids_matriculas = [];

function RegistrarUsuario($free, $nom, $dni, $cel, $correo, $id_programa)
{
	require("admin/model/conexionAPI.php");

	$sql = "SELECT * FROM alumno WHERE dni_alum = '$dni'";

	$res = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($res);
	$id_alum = $row['id_alum'];

	if ($id_alum == null) {
		$sqlr = "INSERT INTO alumno() VALUES(NULL,'$nom','','','$dni','$cel','$correo',0,'','$dni','sinfoto.png',1,1,1,DATE(NOW()),DATE(NOW()),TIME(NOW()),TIME(NOW()))";
		mysqli_query($con, $sqlr);
		$id_alum = mysqli_insert_id($con);
	}

	if ($free == 0) {
		$cursos = CursosPrograma($id_programa);

		foreach ($cursos as $key => $value) {
			$id_horario = $value['id_horario'];

			//comprobar si ya se matriculo
			$sqlc = "SELECT * FROM matricula WHERE id_alum='$id_alum' AND id_hor='$id_horario' AND act_mat = 1";
			$resc = mysqli_query($con, $sqlc);
			$rowc = mysqli_fetch_array($resc);
			$id_mat = $rowc['id_mat'];

			//si no tiene matricula en ese horario
			if ($id_mat == null) {
				$sqlm = "INSERT INTO matricula() VALUES(NULL,'$id_alum','$id_horario',0,0,0,DATE(NOW()),TIME(NOW()),1,1,1,DATE(NOW()),DATE(NOW()),TIME(NOW()),TIME(NOW()))";
				mysqli_query($con, $sqlm);
			}
		}
	}

	return "SI";

	// Cerrar la conexión
	mysqli_close($con);
}

function CursosPrograma($id_programa)
{
	require("admin/model/conexion.php");

	$sql = "SELECT id_horario 
	FROM horarios 
	JOIN curso ON curso.id_curso = horarios.id_curso 
	JOIN programa_curso ON curso.id_curso = programa_curso.id_curso 
	WHERE id_programa = '$id_programa' AND programa_curso.act_programa_curso = 1 AND horarios.hor_principal = 1 AND horarios.act_horario = 1";
	$res = mysqli_query($con, $sql);

	$datos = array();

	while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$datos[] = $fila;
	}

	mysqli_close($con);

	return $datos;
}

function ConsultarAlumno($dni)
{
	require("admin/model/conexionAPI.php");

	$sql = "SELECT id_alum FROM alumno WHERE dni_alum = '$dni'";
	$res = mysqli_query($con, $sql);

	$row = mysqli_fetch_assoc($res);
	$id_alum = $row['id_alum'];

	mysqli_close($con);

	return $id_alum;
}

function ConsultarMatricula($id_alumno, $id_horario)
{
	require("admin/model/conexionAPI.php");

	$sql = "SELECT id_mat FROM matricula WHERE id_alum = '$id_alumno' AND id_hor = '$id_horario'";
	$res = mysqli_query($con, $sql);

	$row = mysqli_fetch_assoc($res);
	$id_mat = $row['id_mat'];

	mysqli_close($con);

	return $id_mat;
}

function consultarCurso($id_horario)
{
	require("admin/model/conexion.php");

	$sql = "SELECT nom_curso, dur_curso, vid_curso, CONCAT(ape_docente, ' ', nom_docente) AS docente 
    FROM curso 
    JOIN tipo ON curso.id_tipo = tipo.id_tipo 
    LEFT JOIN nivel ON curso.id_nivel = nivel.id_nivel 
    INNER JOIN horarios ON curso.id_curso = horarios.id_curso 
	INNER JOIN docente ON curso.id_docente = docente.id_docente
    WHERE id_horario = '$id_horario'";
	/* echo $sql;
	exit(); */
	$res = mysqli_query($con, $sql);

	$datos = array();

	while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$datos[] = $fila;
	}

	return $datos;

	mysqli_close($con);
}

function Programa($id_programa)
{
	require("admin/model/conexion.php");

	$sql = "SELECT nom_programa, desc_programa, prec_programa  
    FROM programa 
    WHERE id_programa = '$id_programa'";
	$res = mysqli_query($con, $sql);

	$datos = array();

	while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		$datos[] = $fila;
	}

	return $datos;

	mysqli_close($con);
}

function Correo($free, $nom, $dni, $cel, $correo, $id_programa)
{
	$n = 0;
	$programa = CursosPrograma($id_programa);
	$infoPrograma = Programa($id_programa);
	$id_alumno = ConsultarAlumno($dni);

	foreach ($infoPrograma as $key => $value) {
		$nom_programa = $value['nom_programa'];
		$desc_programa = $value['desc_programa'];
		$precio = $value['prec_programa'];
	}


	$mail = new PHPMailer(true);

	try {
		//Configuración del servidor
		$mail->SMTPDebug = SMTP::DEBUG_OFF; //SMTP::DEBUG_OFF para servidor - SMTP::DEBUG_SERVER
		$mail->isSMTP();
		$mail->Host       = 'mail.gruporysoft.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = getenv('CURSOS_SMTP_USER') ?: '';
		$mail->Password   = getenv('CURSOS_SMTP_PASSWORD') ?: '';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = 465; //use 587 -> `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Emisor, receptor y respuestas al correo
		$mail->setFrom('cursos@gruporysoft.com', 'RYSOFT');
		$mail->addAddress("gruporysoft@gmail.com", "Administrador");
		$mail->addReplyTo('cursos@gruporysoft.com', 'Information RYSOFT'); // Rysoft respuesta

		//Agregar archivos
		/* $mail->addAttachment('/var/tmp/file.tar.gz');
		$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */

		//Content
		$mail->isHTML(true);
		$mail->Subject = '¡COMPRA EXITOSA DEL PROGRAMA ' . $nom_programa . '!';

		$mensaje = '<div style="width: 100%; background-color: #E5E7E9; text-align: center; color: #000000;">';
		$mensaje .= '<div style="width: 100%;">';
		$mensaje .= '<div style="padding: 50px; background-color: #bf0e09; color: white; font-weight: 500; font-size: 25px;">';
		$mensaje .= '<img src="cursos.gruporysoft.com/assets/foto/logo_rysoft.png" alt="Logo RYSOFT" style="width: 25%; padding: 10px 25px; background-color: white; border-radius: 10px;">';
		$mensaje .= '<h3>CONFIRMACIÓN DE COMPRA</h3>';
		$mensaje .= '</div>';
		$mensaje .= '<div style="padding: 25px; background-color: white;">';
		$mensaje .= '<h4 style="font-weight: 400; font-size: 25px;">DETALLES DEL PROGRAMA</h4>';
		$mensaje .= '<h5 style="font-weight: 400; font-size: 20px; text-align: left;">Información del programa</h5>';
		$mensaje .= '<table style="width: 100%; padding: 10px;">';
		$mensaje .= '<tr>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">ID Programa</td>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $id_programa . '</td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Nombre</td>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $nom_programa . '</td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Descripción</td>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $desc_programa . '</td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Precio</td>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">S/. ' . $precio . '</td>';
		$mensaje .= '</tr>';
		$mensaje .= '</table>';
		foreach ($programa as $key => $value) {
			$id_horario = $value['id_horario'];

			$curso = consultarCurso($id_horario);

			foreach ($curso as $key2 => $value2) {
				$n++;
				$nom_curso = $value2['nom_curso'];
				$dur_curso = $value2['dur_curso'];
				$dur_curso = round($dur_curso, 2);
				$vid_curso = $value2['vid_curso'];
				$docente = $value2['docente'];

				$mensaje .= '<h5 style="font-weight: 400; font-size: 20px; text-align: left;">Información del curso ' . $n . '</h5>';
				$mensaje .= '<table style="width: 100%; padding: 10px;">';
				$mensaje .= '<tr>';
				$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Nombre</td>';
				$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $nom_curso . '</td>';
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
			}
		}
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

function CorreoAdministrador($free, $nom, $dni, $cel, $correo, $id_programa)
{
	$n = 0;
	$programa = CursosPrograma($id_programa);
	$infoPrograma = Programa($id_programa);
	$id_alumno = ConsultarAlumno($dni);

	foreach ($infoPrograma as $key => $value) {
		$nom_programa = $value['nom_programa'];
		$desc_programa = $value['desc_programa'];
		$precio = $value['prec_programa'];
	}


	$mail = new PHPMailer(true);

	try {
		//Configuración del servidor
		$mail->SMTPDebug = SMTP::DEBUG_OFF; //SMTP::DEBUG_OFF para servidor - SMTP::DEBUG_SERVER
		$mail->isSMTP();
		$mail->Host       = 'mail.gruporysoft.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = getenv('CURSOS_SMTP_USER') ?: '';
		$mail->Password   = getenv('CURSOS_SMTP_PASSWORD') ?: '';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = 465; //use 587 -> `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Emisor, receptor y respuestas al correo
		$mail->setFrom('cursos@gruporysoft.com', 'RYSOFT');
		$mail->addAddress("gruporysoft@gmail.com", "Administrador");
		/* $mail->addReplyTo('cursos@gruporysoft.com', 'Information RYSOFT'); // Rysoft respuesta */

		//Agregar archivos
		/* $mail->addAttachment('/var/tmp/file.tar.gz');
		$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */

		//Content
		$mail->isHTML(true);
		$mail->Subject = '¡COMPRA EXITOSA DEL PROGRAMA ' . $nom_programa . '!';

		$mensaje = '<div style="width: 100%; background-color: #E5E7E9; text-align: center; color: #000000;">';
		$mensaje .= '<div style="width: 100%;">';
		$mensaje .= '<div style="padding: 50px; background-color: #bf0e09; color: white; font-weight: 500; font-size: 25px;">';
		$mensaje .= '<img src="cursos.gruporysoft.com/assets/foto/logo_rysoft.png" alt="Logo RYSOFT" style="width: 25%; padding: 10px 25px; background-color: white; border-radius: 10px;">';
		$mensaje .= '<h3>CONFIRMACIÓN DE COMPRA</h3>';
		$mensaje .= '</div>';
		$mensaje .= '<div style="padding: 25px; background-color: white;">';
		$mensaje .= '<h4 style="font-weight: 400; font-size: 25px;">DETALLES DEL PROGRAMA</h4>';
		$mensaje .= '<h5 style="font-weight: 400; font-size: 20px; text-align: left;">Información del programa</h5>';
		$mensaje .= '<table style="width: 100%; padding: 10px;">';
		$mensaje .= '<tr>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">ID Programa</td>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $id_programa . '</td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Nombre</td>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $nom_programa . '</td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Descripción</td>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">' . $desc_programa . '</td>';
		$mensaje .= '</tr>';
		$mensaje .= '<tr>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">Precio</td>';
		$mensaje .= '<td style="text-align: left; padding-top: 5px; font-weight: 300; font-size: 15px;">S/. ' . $precio . '</td>';
		$mensaje .= '</tr>';
		$mensaje .= '</table>';
		foreach ($programa as $key => $value) {
			$id_horario = $value['id_horario'];

			$curso = consultarCurso($id_horario);

			foreach ($curso as $key2 => $value2) {
				$n++;
				$nom_curso = $value2['nom_curso'];
				$dur_curso = $value2['dur_curso'];
				$dur_curso = round($dur_curso, 2);
				$vid_curso = $value2['vid_curso'];
				$docente = $value2['docente'];
				$id_matricula = ConsultarMatricula($id_alumno, $id_horario);

				$mensaje .= '<h5 style="font-weight: 400; font-size: 20px; text-align: left;">Información del curso ' . $n . '</h5>';
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
			}
		}
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

$rpta = RegistrarUsuario($free, $nom, $dni, $cel, $correo, $id_programa);
Correo($free, $nom, $dni, $cel, $correo, $id_programa);
CorreoAdministrador($free, $nom, $dni, $cel, $correo, $id_programa);
echo $rpta;
