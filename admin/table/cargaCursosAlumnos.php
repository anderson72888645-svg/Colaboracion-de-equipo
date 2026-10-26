<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$id_curso = $_REQUEST['id_curso'];

require("../model/conexionAPI.php");

$columnas = ['alumno.id_alum', 'foto_alum', 'nom_alum', 'ape1_alum', 'ape2_alum', 'dni_alum', 'email_alum'];
$columnasWhere = ['nom_alum', 'ape1_alum', 'ape2_alum', 'dni_alum', 'email_alum'];
$tabla = "alumno INNER JOIN matricula ON alumno.id_alum = matricula.id_alum INNER JOIN horario ON matricula.id_hor = horario.id_hor ";

$campo = isset($_POST['campoAlumnos']) ? $con->real_escape_string($_POST['campoAlumnos']) : null;

$where = 'WHERE horario.id_cur = ' . $id_curso . ' AND alumno.act_alum = 1 ';

if ($campo != null) {
    $where = "AND (";
    $cont = count($columnasWhere);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columnasWhere[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$sOrder = "";
if (isset($_POST['orderCol'])) {
    $orderCol = $_POST['orderCol'];
    $orderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';

    $sOrder = "ORDER BY ". $columnas[intval($orderCol)] . ' ' . $orderType;
}

$sql = "SELECT DISTINCT " . implode(", ", $columnas) . " FROM $tabla $where $sOrder";
/* echo $sql;
exit(); */
$resultado = $con->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    $n = 0;
    while ($row = $resultado->fetch_assoc()) {
        $n++;
        $nombre = $row['nom_alum'];
        $ape_pat = $row['ape1_alum'];
        $ape_mat = $row['ape2_alum'];
        $dni = $row['dni_alum'];
        $email = $row['email_alum'];

        $foto_alumno = "https://educatecvirtual.com/intranet/foto/alumno/" . $row['foto_alum'];

        if ($foto_alumno == "https://educatecvirtual.com/intranet/foto/alumno/sinfoto.png") {
            $foto_alumno = "img/bx_user.svg";
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>';
        $html .=  '<div class="img-listas"><img src="' . $foto_alumno . '" alt="Imagen de alumno' . $nombre . '"></div>';
        $html .=  '</td>';
        $html .=  '<td>' . $nombre . '</td>';
        $html .=  '<td>' . $ape_pat . '</td>';
        $html .=  '<td>' . $ape_mat . '</td>';
        $html .=  '<td>' . $dni . '</td>';
        $html .=  '<td>' . $email . '</td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
