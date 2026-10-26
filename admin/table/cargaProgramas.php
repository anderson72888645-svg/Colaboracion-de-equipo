<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");
require("../model/m_programas.php");

$columnas = ['id_programa', 'nom_programa', 'prec_programa', 'desc_programa', 'foto_programa', 'act_programa'];
$columnasWhere = ['nom_programa', 'prec_programa', 'desc_programa'];
$tabla = "programa";

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

    if ($orderCol == 0) {
        $sOrder = "ORDER BY " . $columnas[0] . ' ' . $orderType;
    } else if ($orderCol == 2) {
        $sOrder = "ORDER BY " . $columnas[1] . ' ' . $orderType;
    } else if ($orderCol == 3) {
        $sOrder = "ORDER BY " . $columnas[2] . ' ' . $orderType;
    } else if ($orderCol == 6) {
        $sOrder = "ORDER BY " . $columnas[5] . ' ' . $orderType;
    }
}

$sql = "SELECT " . implode(", ", $columnas) . " FROM $tabla $where $sOrder";
$resultado = $con->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    $n = 0;
    while ($row = $resultado->fetch_assoc()) {
        $n++;
        $id_programa = $row['id_programa'];
        $nom_programa = $row['nom_programa'];
        $prec_programa = $row['prec_programa'];
        $desc_programa = $row['desc_programa'];
        $foto_programa = $row['foto_programa'];
        $act_programa = $row['act_programa'];

        if ($act_programa == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        if (!file_exists('../' . $foto_programa)) {
            $foto_programa = "img/programas/programas.svg";
        }

        $total_cursos = TotalProgramasCursos($id_programa);
        $total_preguntas = TotalProgramasPreguntas($id_programa);

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>';
        $html .=  '<div class="img-listas"><img src="' . $foto_programa . '" alt="Imagen de programa' . $nom_programa . '"></div>';
        $html .=  '</td>';
        $html .=  '<td>' . $nom_programa . '</td>';
        $html .=  '<td>' . $prec_programa . '</td>';
        $html .=  '<td>' . $total_cursos . '</td>';
        $html .=  '<td>' . $total_preguntas . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button type="button" onclick="cursosPrograma(' . $id_programa . ')" class="btn btn-extras">Cursos</button></td>';
        $html .=  '<td><button type="button" onclick="preguntasPrograma(' . $id_programa . ')" class="btn btn-extras">Preguntas</button></td>';
        $html .=  '<td><button type="button" onclick="actualizarPrograma(' . $id_programa . ')" class="btn btn-edit">Editar</button></td>';
        $html .=  '<td><button type="button" onclick="return EliminarPrograma(' . $id_programa . ', `' . $foto_programa . '`);" class="btn btn-delete">Eliminar</button></td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="11">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
