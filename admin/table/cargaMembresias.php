<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");
require("../model/m_membresias.php");

$columnas = ['id_membresia', 'nom_membresia', 'prec_membresia', 'dscto_membresia', 'foto_membresia', 'act_membresia'];
$columnasWhere = ['nom_membresia', 'prec_membresia', 'dscto_membresia'];
$tabla = "membresia ";

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
    } else if ($orderCol == 4) {
        $sOrder = "ORDER BY " . $columnas[3] . ' ' . $orderType;
    } else if ($orderCol == 7) {
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
        $id_membresia = $row['id_membresia'];
        $nom_membresia = $row['nom_membresia'];
        $prec_membresia = $row['prec_membresia'];
        $dscto_membresia = $row['dscto_membresia'];
        $foto_membresia = $row['foto_membresia'];
        $act_membresia = $row['act_membresia'];
        $final = $prec_membresia - ($prec_membresia * $dscto_membresia / 100);

        if ($act_membresia == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        if (!file_exists('../'.$foto_membresia)) {
            $foto_membresia = "img/membresias/membresias.svg";
        }

        $total_membresia_programas = TotalMembresiaPrograma($id_membresia);

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>';
        $html .=  '<div class="img-listas"><img src="' . $foto_membresia . '" alt="Imagen de membresia' . $nom_membresia . '"></div>';
        $html .=  '</td>';
        $html .=  '<td>' . $nom_membresia . '</td>';
        $html .=  '<td>' . $prec_membresia . '</td>';
        $html .=  '<td>' . $dscto_membresia . '</td>';
        $html .=  '<td>' . $final . '</td>';
        $html .=  '<td>' . $total_membresia_programas . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button type="button" onclick="programasMembresia(' . $id_membresia . ')" class="btn btn-extras">Programas</button></td>';
        $html .=  '<td><button type="button" onclick="actualizarMembresia(' . $id_membresia . ')" class="btn btn-edit">Editar</button></td>';
        $html .=  '<td><button type="button" onclick="return EliminarMembresia(' . $id_membresia . ', `' . $foto_membresia . '`);" class="btn btn-delete">Eliminar</button></td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="11">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>