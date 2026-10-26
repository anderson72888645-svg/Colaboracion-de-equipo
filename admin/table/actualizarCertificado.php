<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_matricula = $_REQUEST['id_matricula'];
$id_alumno = $_REQUEST['id_alumno'];
$id_certificado = $_REQUEST['id_certificado'];
$alumno = ConsultarAlumno($id_alumno);
$horario = ConsultarHorario($id_matricula);
$cursos = ConsultarCurso($horario);

function ConsultarAlumno($id_alumno)
{
    require("../model/conexionAPI.php");

    $sql = "SELECT * FROM alumno WHERE id_alum = '$id_alumno'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

function ConsultarHorario($id_matricula)
{
    require("../model/conexionAPI.php");

    $sql = "SELECT id_hor FROM matricula WHERE id_mat = '$id_matricula'";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $horario = $row['id_hor'];

    mysqli_close($con);

    return $horario;
}

function ConsultarCurso($horario)
{
    require("../model/conexion.php");

    $sql = "SELECT nom_curso, dur_curso, curso.id_nivel, nom_tipo, nom_nivel 
    FROM curso 
    JOIN tipo ON curso.id_tipo = tipo.id_tipo 
    LEFT JOIN nivel ON curso.id_nivel = nivel.id_nivel 
    INNER JOIN horarios ON curso.id_curso = horarios.id_curso 
    WHERE id_horario = '$horario'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
}

$top_fecha = 1250;
$top_qr = 1300;

foreach ($alumno as $key => $value) {
    $nom_alum = $value['nom_alum'];
    $ape1_alum = $value['ape1_alum'];
    $ape2_alum = $value['ape2_alum'];
}

if (empty($cursos)) {
    $nom_curso = "No registrado";
    $dur_curso = "No registrado";
    $id_nivel = "No registrado";
    $nom_tipo = "No registrado";
    $nom_nivel = "No registrado";
} else {
    foreach ($cursos as $key => $value2) {
        $nom_curso = $value2['nom_curso'];
        $dur_curso = $value2['dur_curso'];
        $dur_curso = round($dur_curso, 2);
        $id_nivel = $value2['id_nivel'];
        $nom_tipo = $value2['nom_tipo'];

        if ($id_nivel != '' && $id_nivel != NULL && $id_nivel != 0) {
            $nom_nivel = $value2['nom_nivel'];
            $top_fecha = 1150;
            $top_qr = 1200;
        }
    }
}


function ucwords_tilde($str)
{
    $words = explode(" ", mb_strtolower($str, 'UTF-8'));
    $result = [];
    foreach ($words as $word) {
        $result[] = mb_convert_case($word, MB_CASE_TITLE, 'UTF-8');
    }
    return implode(" ", $result);
}

$nombreAlumno = ucwords_tilde($nom_alum . ' ' . $ape1_alum . ' ' . $ape2_alum);


$longitudTexto = strlen($nombreAlumno);

$tamanioFuente = 225;

if ($longitudTexto > 25) {
    $tamanioFuente = 150;
}

$meses_espanol = [
    'January' => 'enero',
    'February' => 'febrero',
    'March' => 'marzo',
    'April' => 'abril',
    'May' => 'mayo',
    'June' => 'junio',
    'July' => 'julio',
    'August' => 'agosto',
    'September' => 'septiembre',
    'October' => 'octubre',
    'November' => 'noviembre',
    'December' => 'diciembre'
];

date_default_timezone_set('America/Lima');

$fecha = new DateTime();
$meses_espanol = [
    'January' => 'enero',
    'February' => 'febrero',
    'March' => 'marzo',
    'April' => 'abril',
    'May' => 'mayo',
    'June' => 'junio',
    'July' => 'julio',
    'August' => 'agosto',
    'September' => 'septiembre',
    'October' => 'octubre',
    'November' => 'noviembre',
    'December' => 'diciembre'
];

$mes_actual = $fecha->format('F');
$mes_en_espanol = $meses_espanol[$mes_actual];

$fecha_formateada = $fecha->format('j \d\e ') . $mes_en_espanol . $fecha->format(' \d\e\l Y');



$texto = 'https://cursos.gruporysoft.com/admin/img/certificados/certificado_' . $id_matricula . '_' . $id_alumno . '.jpg';
/* $texto = 'http://localhost/Rysoft/admin/img/certificados/certificado_' . $id_matricula . '_' . $id_alumno . '.jpg'; */
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado Digital</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Charm&display=swap');

        :root {
            --fontNombre: 'Charm', cursive;
            --fontTexto: Tahoma, Geneva, Verdana, sans-serif;
        }

        .certificado {
            width: 3333px;
            height: 2500px;
            margin: 0;
        }

        .certificado img {
            position: absolute;
            width: 3333px;
        }

        .certificado .nombre_estudiante {
            font-family: var(--fontNombre);
            width: 2733px;
            height: 348px;
            color: #a5150e;
            position: relative;
            top: 800px;
            left: 300px;
            font-size: <?php echo $tamanioFuente; ?>px;
            text-transform: capitalize;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .certificado .texto_tipo {
            font-family: var(--fontTexto);
            position: relative;
            text-align: center;
            font-size: 75px;
            top: 825px;
        }

        .certificado .texto_tipo span {
            font-weight: bold;
        }

        .certificado .nombre_curso {
            font-family: var(--fontTexto);
            position: relative;
            text-align: center;
            font-size: 100px;
            font-weight: bold;
            top: 900px;
        }

        .certificado .texto_duracion {
            font-family: var(--fontTexto);
            position: relative;
            text-align: center;
            font-size: 75px;
            top: 1000px;
        }

        .certificado .texto_nivel {
            font-family: var(--fontTexto);
            position: relative;
            text-align: center;
            font-size: 75px;
            top: 925px;
        }

        .certificado .fecha {
            width: 1000px;
            font-family: var(--fontTexto);
            position: relative;
            font-size: 65px;
            top: <?php echo $top_fecha; ?>px;
            left: 2125px;
        }

        .certificado .qr {
            position: relative;
            width: 365px;
            height: 365px;
            top: <?php echo $top_qr; ?>px;
            left: 2875px;
        }

        .certificado .qr img {
            width: 100%;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script defer src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script defer src="actualizarCertificado.js"></script>
</head>

<body>
    <div class="certificado" id="capture">
        <img src="../img/base_certificados/plantilla_certificado.jpg" alt="">
        <div class="nombre_estudiante">
            <?php echo $nombreAlumno; ?>
        </div>
        <div class="texto_tipo">
            En mérito a su destacada participación en el <span><?php echo $nom_tipo; ?></span> de:
        </div>
        <div class="nombre_curso">
            <?php echo $nom_curso; ?>
        </div>
        <?php
        if ($id_nivel != '' && $id_nivel != NULL && $id_nivel != 0) {
        ?>
            <div class="texto_nivel">
                <?php echo $nom_nivel; ?>
            </div>
        <?php
        }
        ?>
        <div class="texto_duracion">
            con una duración de <?php echo $dur_curso; ?> horas cronológicas
        </div>
        <div class="fecha">
            Lima, <?php echo $fecha_formateada; ?>
        </div>
        <form action="" id="formulario" class="formulario">
            <input type="hidden" id="link" value="<?php echo $texto; ?>" />
            <input type="hidden" id="matricula" value="<?php echo $id_matricula; ?>" />
            <input type="hidden" id="idalumno" value="<?php echo $id_alumno; ?>" />
            <input type="hidden" id="idcertificado" value="<?php echo $id_certificado; ?>" />
        </form>

        <div id="contenedorQR" class="qr"></div>
    </div>
</body>

</html>