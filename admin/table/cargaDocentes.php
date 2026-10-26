<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");

$columnas = ['id_docente', 'nom_docente', 'ape_docente', 'dni_docente', 'foto_docente', 'act_docente', 'nom_pais'];
$columnasWhere = ['nom_docente', 'ape_docente', 'dni_docente', 'nom_pais'];
$tabla = "docente JOIN pais ON docente.id_pais = pais.id_pais ";

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
    } else if ($orderCol == 5) {
        $sOrder = "ORDER BY " . $columnas[6] . ' ' . $orderType;
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
        $id_docente = $row['id_docente'];
        $nom_docente = $row['nom_docente'];
        $ape_docente = $row['ape_docente'];
        $dni_docente = $row['dni_docente'];
        $foto_docente = $row['foto_docente'];
        $act_docente = $row['act_docente'];
        $nom_pais = $row['nom_pais'];

        if ($act_docente == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        if (!file_exists('../'.$foto_docente)) {
            $foto_docente = "img/bx_user.svg";
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>';
        $html .=  '<div class="img-listas"><img src="' . $foto_docente . '" alt="Imagen de docente' . $nom_docente . '"></div>';
        $html .=  '</td>';
        $html .=  '<td>' . $nom_docente . '</td>';
        $html .=  '<td>' . $ape_docente . '</td>';
        $html .=  '<td>' . $dni_docente . '</td>';
        $html .=  '<td>' . $nom_pais . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button type="button" onclick="actualizarDocente(' . $id_docente . ')" class="btn btn-edit">Editar</button></td>';
        $html .=  '<td><button type="button" onclick="return EliminarDocente(' . $id_docente . ', `' . $foto_docente . '`);" class="btn btn-delete">Eliminar</button></td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="9">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>