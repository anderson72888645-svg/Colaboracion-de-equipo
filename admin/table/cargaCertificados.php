<?php
require_once dirname(__DIR__, 2) . '/config_local.php';
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$conn=cursos_db('proyecta_educatec_rysoft');

$id_alumno = $_REQUEST['id_alumno'];

$columnas = ['id_certificado', 'link_certificado', 'mat.id_alum', 'mat.id_mat', 'act_certificado', 'nom_cur', 'hor.id_hor', 'mat.act_mat'];
$columnasWhere = ['nom_cur'];
$tabla = "matricula mat JOIN alumno alu ON alu.id_alum = mat.id_alum JOIN horario hor ON mat.id_hor = hor.id_hor JOIN curso cur ON cur.id_cur = hor.id_cur LEFT JOIN certificado cer ON cer.id_mat = mat.id_mat ";

$campo = isset($_POST['campoCertificados']) ? $conn->real_escape_string($_POST['campoCertificados']) : null;

$where = 'WHERE mat.id_alum = ' . $id_alumno . ' AND mat.act_mat = 1 ';

if ($campo != null) {
    $where .= "AND (";
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
    } else if ($orderCol == 1) {
        $sOrder = "ORDER BY " . $columnas[3] . ' ' . $orderType;
    } else if ($orderCol == 2) {
        $sOrder = "ORDER BY " . $columnas[5] . ' ' . $orderType;
    } else if ($orderCol == 5) {
        $sOrder = "ORDER BY " . $columnas[4] . ' ' . $orderType;
    }
}

$sql = "SELECT " . implode(", ", $columnas) . " FROM $tabla $where $sOrder";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    $n = 0;
    while ($row = $resultado->fetch_assoc()) {
        $n++;
        if ($row['act_certificado'] == NULL) {
            $nom_estado = "PENDIENTE";
        } else if ($row['act_certificado'] == 1) {
            $nom_estado = "Activo";
        } else {
            $nom_estado = 'Inactivo';
        }

        $id_hor = $row['id_hor'];
        $id_alum = $row['id_alum'];

        $sqlAnuncios = "SELECT count(*) AS total_anuncios FROM anuncio WHERE id_hor = '$id_hor'";
        $resAnuncios = mysqli_query($conn, $sqlAnuncios);

        $rowAnuncios = mysqli_fetch_assoc($resAnuncios);
        $total_anuncios = $rowAnuncios['total_anuncios'];

        $sqlAnuncioRespuesta = "SELECT COUNT(DISTINCT anuncio_respuesta.id_anuncio) AS total_anuncio_respuesta FROM anuncio_respuesta INNER JOIN anuncio ON (anuncio.id_anuncio=anuncio_respuesta.id_anuncio) WHERE id_alum = '$id_alum' AND id_hor = '$id_hor'";
        $resAnuncioRespuesta = mysqli_query($conn, $sqlAnuncioRespuesta);

        $rowAnuncioRespuesta = mysqli_fetch_assoc($resAnuncioRespuesta);
        $total_anuncios_respuesta = $rowAnuncioRespuesta['total_anuncio_respuesta'];

        if ($row['link_certificado'] == NULL) {
            $estado_certificado = 'PENDIENTE';
        } else {
            $estado_certificado = 'REALIZADO';
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>' . $row['id_mat'] . '</td>';
        $html .=  '<td>' . $row['nom_cur'] . '</td>';
        $html .=  '<td>' . $total_anuncios . '</td>';
        $html .=  '<td>' . $total_anuncios_respuesta . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td>' . $estado_certificado . '</td>';
        if ($estado_certificado == 'PENDIENTE') {
            $html .=  '<td></td>';
        } else {
            $html .=  '<td><button type="button" onclick="modalCertificado(' . $row['id_certificado'] . ')" class="btn btn-view"><ion-icon name="search-outline"></ion-icon></button></td>';
        }
        if ($estado_certificado == 'PENDIENTE') {
           /* $html .=  '<td><button name="modalRegistrarCertificado" type="button" class="btn btn-new" onclick="return modalRegistrarCertificado(' . $row['id_mat'] . ');"><ion-icon name="cloud-upload-outline"></ion-icon></button></td>';*/
             $html .=  '<td><button name="modalRegistrarCertificado" type="button" class="btn btn-new" onclick="return generarCertificado(' . $row['id_mat'] . ', ' . $id_alum . ');"><ion-icon name="cloud-upload-outline"></ion-icon></button></td>'; 
        } else {
            $html .=  '<td><button name="modalActualizarCertificado" type="button" class="btn btn-edit" onclick="return modalActualizarCertificado(' . $row['id_mat'] . ');"><ion-icon name="reload-outline"></ion-icon></button></td>';
        }
        if ($estado_certificado == 'PENDIENTE') {
            $html .=  '<td></td>';
        } else {
            $html .=  '<td><button name="eliminarCertificado" type="button" class="btn btn-delete" onclick="return EliminarCertificado(' . $row['id_certificado'] . ', `' . $row['link_certificado'] . '`, ' . $row['id_alum'] . ');"><ion-icon name="trash-outline"></ion-icon></button></td>';
        }
        $html .=  '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="10">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>