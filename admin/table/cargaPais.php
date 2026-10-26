<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");

$columnas = ['id_pais', 'nom_pais', 'foto_pais', 'act_pais'];
$columnasWhere = ['nom_pais'];
$tabla = "pais ";

$campo = isset($_POST['campoPais']) ? $con->real_escape_string($_POST['campoPais']) : null;

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
if (isset($_POST['orderColPais'])) {
    $orderColPais = $_POST['orderColPais'];
    $orderTypePais = isset($_POST['orderTypePais']) ? $_POST['orderTypePais'] : 'asc';

    if ($orderColPais == 0) {
        $sOrder = "ORDER BY " . $columnas[0] . ' ' . $orderTypePais;
    } else if ($orderColPais == 2) {
        $sOrder = "ORDER BY " . $columnas[1] . ' ' . $orderTypePais;
    } else if ($orderColPais == 3) {
        $sOrder = "ORDER BY " . $columnas[3] . ' ' . $orderTypePais;
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
        $id_pais = $row['id_pais'];
        $nom_pais = $row['nom_pais'];
        $foto_pais = $row['foto_pais'];
        $act_pais = $row['act_pais'];

        if ($act_pais == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        if (!file_exists('../'.$foto_pais)) {
            $foto_pais = "img/pais/globe-outline.svg";
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>';
        $html .=  '<div class="img-listas"><img src="' . $foto_pais . '" alt="Imagen de país' . $nom_pais . '"></div>';
        $html .=  '</td>';
        $html .=  '<td>' . $nom_pais . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button type="button" onclick="actualizarPais(' . $id_pais . ')" class="btn btn-edit">Editar</button></td>';
        $html .=  '<td><button type="button" onclick="return EliminarPais(' . $id_pais . ', `' . $foto_pais . '`);" class="btn btn-delete">Eliminar</button></td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="6">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>