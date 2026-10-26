<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");

$columnas = ['id_nivel', 'nom_nivel', 'act_nivel'];
$columnasWhere = ['nom_nivel'];
$tabla = "nivel ";

$campo = isset($_POST['campoNivel']) ? $con->real_escape_string($_POST['campoNivel']) : null;

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
if (isset($_POST['orderColNivel'])) {
    $orderColNivel = $_POST['orderColNivel'];
    $orderTypeNivel = isset($_POST['orderTypeNivel']) ? $_POST['orderTypeNivel'] : 'asc';

    $sOrder = "ORDER BY ". $columnas[intval($orderColNivel)] . ' ' . $orderTypeNivel;
}

$sql = "SELECT " . implode(", ", $columnas) . " FROM $tabla $where $sOrder";
$resultado = $con->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    $n = 0;
    while ($row = $resultado->fetch_assoc()) {
        $n++;
        $id_nivel = $row['id_nivel'];
        $nom_nivel = $row['nom_nivel'];
        $act_nivel = $row['act_nivel'];

        if ($act_nivel == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>' . $nom_nivel . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button type="button" onclick="actualizarNivel(' . $id_nivel . ')" class="btn btn-edit">Editar</button></td>';
        $html .=  '<td><button type="button" onclick="return EliminarNivel(' . $id_nivel . ');" class="btn btn-delete">Eliminar</button></td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="5">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>