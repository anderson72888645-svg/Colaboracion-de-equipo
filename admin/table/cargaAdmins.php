<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");

$columnas = ['id_admin', 'nom_admin', 'ape_admin', 'dni_admin', 'email_admin', 'foto_admin', 'est_admin'];
$columnasWhere = ['nom_admin', 'ape_admin', 'dni_admin', 'email_admin'];
$tabla = "administrador ";

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
        $sOrder = "ORDER BY " . $columnas[4] . ' ' . $orderType;
    } else if ($orderCol == 6) {
        $sOrder = "ORDER BY " . $columnas[6] . ' ' . $orderType;
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
        $id_admin = $row['id_admin'];
        $nom_admin = $row['nom_admin'];
        $ape_admin = $row['ape_admin'];
        $dni_admin = $row['dni_admin'];
        $email_admin = $row['email_admin'];
        $foto_admin = $row['foto_admin'];
        $est_admin = $row['est_admin'];

        if ($est_admin == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        if (!file_exists('../'.$foto_admin)) {
            $foto_admin = "img/bx_user.svg";
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>';
        $html .=  '<div class="img-listas"><img src="' . $foto_admin . '" alt="Imagen de docente' . $nom_admin . '"></div>';
        $html .=  '</td>';
        $html .=  '<td>' . $nom_admin . '</td>';
        $html .=  '<td>' . $ape_admin . '</td>';
        $html .=  '<td>' . $dni_admin . '</td>';
        $html .=  '<td>' . $email_admin . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button type="button" onclick="actualizarAdmin(' . $id_admin . ')" class="btn btn-edit">Editar</button></td>';
        $html .=  '<td><button type="button" onclick="return EliminarAdmin(' . $id_admin . ', `' . $foto_admin . '`);" class="btn btn-delete">Eliminar</button></td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="9">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>