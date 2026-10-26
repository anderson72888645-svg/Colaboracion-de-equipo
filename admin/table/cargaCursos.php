<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");

$columnas = ['id_curso', 'nom_curso', 'nom_docente', 'nom_categoria', 'prec_curso', 'dscto_curso', 'foto_curso', 'act_curso'];
$columnasWhere = ['nom_curso', 'nom_docente', 'nom_categoria', 'prec_curso', 'dscto_curso'];
$tabla = "curso cur INNER JOIN docente doc ON (cur.id_docente = doc.id_docente) INNER JOIN categoria cat ON (cur.id_categoria = cat.id_categoria) ";

$campo = isset($_POST['campo']) ? $con->real_escape_string($_POST['campo']) : null;

$where = '';

if ($campo != null) {
    $where = "WHERE (";
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

$sql = "SELECT " . implode(", ", $columnas) . " FROM $tabla $where $sOrder";
$resultado = $con->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    $n = 0;
    while ($row = $resultado->fetch_assoc()) {
        $n++;
        $id_curso = $row['id_curso'];
        $nom_curso = $row['nom_curso'];
        $nom_docente = $row['nom_docente'];
        $nom_categoria = $row['nom_categoria'];
        $prec_curso = $row['prec_curso'];
        $dscto_curso = $row['dscto_curso'];
        $foto_curso = $row['foto_curso'];
        $act_curso = $row['act_curso'];
        $final = $prec_curso - ($prec_curso * $dscto_curso / 100);

        if ($act_curso == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>' . $nom_curso . '</td>';
        $html .=  '<td>' . $nom_docente . '</td>';
        $html .=  '<td>' . $nom_categoria . '</td>';
        $html .=  '<td>' . $prec_curso . '</td>';
        $html .=  '<td>' . $dscto_curso . ' % </td>';
        $html .=  '<td>' . $final . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button type="button" onclick="modulosCurso(' . $id_curso . ')" class="btn btn-extras">Módulos</button></td>';
        $html .=  '<td><button type="button" onclick="preguntasCurso(' . $id_curso . ')" class="btn btn-extras">Preguntas</button></td>';
        $html .=  '<td><button type="button" onclick="alumnosCurso(' . $id_curso . ')" class="btn btn-extras">Alumnos</button></td>';
        $html .=  '<td><button type="button" onclick="actualizarCurso(' . $id_curso . ')" class="btn btn-edit">Editar</button></td>';
        $html .=  '<td><button type="button" onclick="return EliminarCurso(' . $id_curso . ', `' . $foto_curso . '`);" class="btn btn-delete">Eliminar</button></td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="9">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>