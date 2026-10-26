<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");

$columnas = ['id_categoria', 'nom_categoria', 'act_categoria'];
$columnasWhere = ['nom_categoria'];
$tabla = "categoria ";

$campo = isset($_POST['campoCategoria']) ? $con->real_escape_string($_POST['campoCategoria']) : null;

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
if (isset($_POST['orderColCategoria'])) {
    $orderColCategoria = $_POST['orderColCategoria'];
    $orderTypeCategoria = isset($_POST['orderTypeCategoria']) ? $_POST['orderTypeCategoria'] : 'asc';

    $sOrder = "ORDER BY ". $columnas[intval($orderColCategoria)] . ' ' . $orderTypeCategoria;
}

$sql = "SELECT " . implode(", ", $columnas) . " FROM $tabla $where $sOrder";
$resultado = $con->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    $n = 0;
    while ($row = $resultado->fetch_assoc()) {
        $n++;
        $id_categoria = $row['id_categoria'];
        $nom_categoria = $row['nom_categoria'];
        $act_categoria = $row['act_categoria'];

        if ($act_categoria == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>' . $nom_categoria . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button type="button" onclick="actualizarCategoria(' . $id_categoria . ')" class="btn btn-edit">Editar</button></td>';
        $html .=  '<td><button type="button" onclick="return EliminarCategoria(' . $id_categoria . ');" class="btn btn-delete">Eliminar</button></td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="5">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>