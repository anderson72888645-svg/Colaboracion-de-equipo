<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");

$columnas = ['id_tipo', 'nom_tipo', 'act_tipo'];
$columnasWhere = ['nom_tipo'];
$tabla = "tipo ";

$campo = isset($_POST['campoTipo']) ? $con->real_escape_string($_POST['campoTipo']) : null;

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
if (isset($_POST['orderColTipo'])) {
    $orderColTipo = $_POST['orderColTipo'];
    $orderTypeTipo = isset($_POST['orderTypeTipo']) ? $_POST['orderTypeTipo'] : 'asc';

    $sOrder = "ORDER BY ". $columnas[intval($orderColTipo)] . ' ' . $orderTypeTipo;
}

$sql = "SELECT " . implode(", ", $columnas) . " FROM $tabla $where $sOrder";
$resultado = $con->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    $n = 0;
    while ($row = $resultado->fetch_assoc()) {
        $n++;
        $id_tipo = $row['id_tipo'];
        $nom_tipo = $row['nom_tipo'];
        $act_tipo = $row['act_tipo'];

        if ($act_tipo == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>' . $nom_tipo . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button type="button" onclick="actualizarTipo(' . $id_tipo . ')" class="btn btn-edit">Editar</button></td>';
        $html .=  '<td><button type="button" onclick="return EliminarTipo(' . $id_tipo . ');" class="btn btn-delete">Eliminar</button></td>';
        $html .=  '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="5">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>