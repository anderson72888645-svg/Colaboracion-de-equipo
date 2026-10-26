<?php
require_once __DIR__ . '/config_local.php';
$con = cursos_db('proyecta_educatec_dr');

/* $id_alumno = $_REQUEST['id']; */

$columnas = ['id_certificado', 'nom_cur', 'link_certificado'];
$columnasWhere = ['nom_cur'];
$tabla = "certificado cert JOIN matricula mat ON cert.id_mat = mat.id_mat JOIN alumno alum ON mat.id_alum = alum.id_alum JOIN horario hor ON mat.id_hor = hor.id_hor JOIN curso cur ON hor.id_cur = cur.id_cur ";

$campo = isset($_POST['campoDNI']) ? $con->real_escape_string($_POST['campoDNI']) : null;

/* if ($campo == '') {
    $campo = 0;
} */

$where = 'WHERE alum.dni_alum = ' . $campo . ' AND cert.act_certificado = 1 ';

$sOrder = "";
if (isset($_POST['orderCol'])) {
    $orderCol = $_POST['orderCol'];
    $orderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'ASC';

    $sOrder = "ORDER BY " . $columnas[intval($orderCol)] . ' ' . $orderType;
}

$sql = "SELECT " . implode(", ", $columnas) . " FROM $tabla $where $sOrder";
$resultado = $con->query($sql);
$num_rows = $resultado->num_rows;
/* echo $num_rows;
exit(); */

$html = '';

if ($campo != '') {
    if ($num_rows > 0) {
        $n = 0;
        $nombre = ConsultarNombre($campo);
        $html .= '<h4>' . $nombre . '</h4>';
        $html .= '<br>';
        $html .= '<table>';
        $html .= '<thead>';
        $html .= '<th></th>';
        $html .= '<th class="sort asc">Curso</th>';
        $html .= '<th></th>';
        $html .= '</thead>';
        $html .= '<tbody>';

        while ($row = $resultado->fetch_assoc()) {
            $n++;
            $id_certificado = $row['id_certificado'];
            $nom_curso = $row['nom_cur'];
            $link_certificado = 'admin/' . $row['link_certificado'];

            $html .=  '<tr>';
            $html .=  '<td>' . $n . '</td>';
            $html .=  '<td>' . $nom_curso . '</td>';
            $html .=  '<td><button type="button" onclick="modalCertificado(' . $id_certificado . ')" class="btn btn-view"><i class="fa-solid fa-magnifying-glass"></i></button></td>';
            $html .=  '</tr>';

            /* Modal certificado */
            $html .= '<div id="modalCertificado' . $id_certificado . '" class="modal_cer">';
            $html .= '<div class="modal_cer-content">';
            $html .= '<div class="cardHeader">';
            $html .= '<h2>CERTIFICADO DE ' . $nombre . ' - ' . $nom_curso . '</h2>';
            $html .= '<span class="close" onclick="closeModalCertificado(' . $id_certificado . ')">&times;</span>';
            $html .= '</div>';
            $html .= '<div class="modal_cer-informacion">';
            $html .= '<div class="modal_cer-group modal_cer-certificado">';
            $html .= '<div class="img-modal_cer-certificado">';
            $html .= '<img src="' . $link_certificado . '" alt="Imagen de certificado ' . $nom_curso . '">';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="modal_cer-group sp4 submit-btn">';
            $html .= '<a href="' . $link_certificado . '" download>';
            $html .= '<button type="button" class="btn btn-extras">';
            $html .= '<i class="fa-solid fa-download"></i> Descargar';
            $html .= '</button>';
            $html .= '</a>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
    } else {
        $html .= '<table>';
        $html .= '<thead>';
        $html .= '<th></th>';
        $html .= '<th class="sort asc">Curso</th>';
        $html .= '<th></th>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td colspan="3">Sin resultados</td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
    }
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

function ConsultarNombre($campo)
{
    $con = cursos_db('proyecta_educatec_dr');

    $sql = "SELECT CONCAT(nom_alum, ' ', ape1_alum, ' ', ape2_alum) AS nombre FROM alumno WHERE dni_alum = '$campo'";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $nombre = $row['nombre'];

    mysqli_close($con);

    return $nombre;
}
