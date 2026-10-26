<?php
require_once dirname(__DIR__, 2) . '/config_local.php';
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

$conn=cursos_db('proyecta_educatec_rysoft');

$columnas = ['id_alum', 'nom_alum', 'ape1_alum', 'ape2_alum', 'dni_alum', 'email_alum', 'foto_alum', 'act_alum'];
$columnasWhere = ['nom_alum', 'ape1_alum', 'ape2_alum', 'dni_alum', 'email_alum'];
$tabla = "alumno";

$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

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
        $sOrder = "ORDER BY " . $columnas[4] . ' ' . $orderType;
    } else if ($orderCol == 5) {
        $sOrder = "ORDER BY " . $columnas[5] . ' ' . $orderType;
    } else if ($orderCol == 6) {
        $sOrder = "ORDER BY " . $columnas[7] . ' ' . $orderType;
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
        $id_alum = $row['id_alum'];
        if ($row['act_alum'] == 0) {
            $nom_estado = 'Inactivo';
        } else {
            $nom_estado = "Activo";
        }

        $foto_alumno = "https://educatecvirtual.com/intranet/foto/alumno/" . $row['foto_alum'];

        if ($foto_alumno == "https://educatecvirtual.com/intranet/foto/alumno/sinfoto.png") {
            $foto_alumno = "img/bx_user.svg";
        }

        $sqlCertificadosListos = "SELECT count(id_certificado) AS total_certificados FROM certificado cert JOIN matricula mat ON cert.id_mat = mat.id_mat WHERE id_alum = '$id_alum' AND mat.act_mat = 1";
        $resCertificadosListos = mysqli_query($conn, $sqlCertificadosListos);
        $rowCertificadosListos = mysqli_fetch_assoc($resCertificadosListos);
        $total_certificados_listos = $rowCertificadosListos['total_certificados'];

        $sqlCursosMatriculados = "SELECT count(id_mat) AS total_matriculados FROM matricula mat JOIN horario hor WHERE id_alum = '$id_alum' AND act_mat = 1 AND mat.id_hor = hor.id_hor";
        $resCursosMatriculados = mysqli_query($conn, $sqlCursosMatriculados);
        $rowCursosMatriculados = mysqli_fetch_assoc($resCursosMatriculados);
        $total_cursos_matriculados = $rowCursosMatriculados['total_matriculados'];

        if ($nom_estado == 'Inactivo') {
            $estado_certificado = 'Inactivo';
        } else {
            if ($total_cursos_matriculados == 0) {
                $estado_certificado = $total_cursos_matriculados;
            } else if ($total_certificados_listos == $total_cursos_matriculados) {
                $estado_certificado = 'LISTO';
            } else if ($total_certificados_listos < $total_cursos_matriculados) {
                $matriculas = ListarMatriculas($id_alum);
                $estado_certificado = 0;
                foreach ($matriculas as $key => $value) {
                    $id_hor = $value['id_hor'];

                    $sqlAnuncios = "SELECT count(*) AS total_anuncios FROM anuncio WHERE id_hor = '$id_hor'";
                    $resAnuncios = mysqli_query($conn, $sqlAnuncios);
                    $rowAnuncios = mysqli_fetch_assoc($resAnuncios);
                    $total_anuncios = $rowAnuncios['total_anuncios'];

                    $sqlAnuncioRespuesta = "SELECT COUNT(DISTINCT anuncio_respuesta.id_anuncio) AS total_anuncio_respuesta FROM anuncio_respuesta INNER JOIN anuncio ON (anuncio.id_anuncio=anuncio_respuesta.id_anuncio) WHERE id_alum = '$id_alum' AND id_hor = '$id_hor'";
                    $resAnuncioRespuesta = mysqli_query($conn, $sqlAnuncioRespuesta);
                    $rowAnuncioRespuesta = mysqli_fetch_assoc($resAnuncioRespuesta);
                    $total_anuncios_respuesta = $rowAnuncioRespuesta['total_anuncio_respuesta'];

                    if ($total_anuncios_respuesta == $total_anuncios) {
                        $estado_certificado++;
                    }
                }
            } else {
                $estado_certificado = 0;
            }
        }

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>';
        $html .=  '<div class="img-listas"><img src="' . $foto_alumno . '" alt="Imagen de alumno' . $row['nom_alum'] . '"></div>';
        $html .=  '</td>';
        $html .=  '<td>' . $row['nom_alum'] . '</td>';
        $html .=  '<td>' . $row['ape1_alum'] . ' ' . $row['ape2_alum'] . '</td>';
        $html .=  '<td>' . $row['dni_alum'] . '</td>';
        $html .=  '<td>' . $row['email_alum'] . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td>' . $estado_certificado . '</td>';
        $html .=  '<td><button type="button" onclick="modalAlumno(' . $row['id_alum'] . ')" class="btn btn-view"><ion-icon name="search-outline"></ion-icon></button></td>';
        $html .=  '<td><button type="button" onclick="certificadoAlumno(' . $row['id_alum'] . ')" class="btn btn-view"><ion-icon name="document-text-outline"></ion-icon></button></td>';
        $html .=  '</td>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="10">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

function ListarMatriculas($id_alumno)
{
    $conn=cursos_db('proyecta_educatec_rysoft');

    $sql = "SELECT id_hor FROM matricula WHERE id_alum = $id_alumno AND act_mat = 1 AND NOT EXISTS (SELECT 1 FROM certificado WHERE matricula.id_mat = certificado.id_mat)";
    $res = mysqli_query($conn, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($conn);

    return $datos;
}
