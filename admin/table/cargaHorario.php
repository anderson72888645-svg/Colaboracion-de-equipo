<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: ../index.php');
    exit();
}

require("../model/conexion.php");

$id_curso = $_REQUEST['id_curso'];

$columnas = ['id_relacion', 'id_curso', 'id_horario', 'hor_principal', 'act_horario'];
$tabla = "horarios";

$where = 'WHERE id_curso = ' . $id_curso;


$sql = "SELECT " . implode(", ", $columnas) . " FROM $tabla $where";
$resultado = $con->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    $n = 0;
    while ($row = $resultado->fetch_assoc()) {
        $n++;
        if ($row['act_horario'] == 1) {
            $nom_estado = "Activo";
        } else {
            $nom_estado = 'Inactivo';
        }

        if ($row['hor_principal'] == 1) {
            $principal = "SI";
        } else {
            $principal = 'NO';
        }

        $hora = ConsultarHorario($row['id_horario']);

        $html .=  '<tr>';
        $html .=  '<td>' . $n . '</td>';
        $html .=  '<td>' . $hora . '</td>';
        $html .=  '<td>' . $principal . '</td>';
        $html .=  '<td>' . $nom_estado . '</td>';
        $html .=  '<td><button name="modalActualizarHorario" type="button" class="btn btn-edit" onclick="return modalActualizarHorario(' . $row['id_relacion'] . ');"><ion-icon name="reload-outline"></ion-icon></button></td>';
        $html .=  '<td><button name="eliminarHorario" type="button" class="btn btn-delete" onclick="return EliminarHorario(' . $row['id_relacion'] . ');"><ion-icon name="trash-outline"></ion-icon></button></td>';
        $html .=  '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="6">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

function ConsultarHorario($id_horario) {
    require("../model/conexionAPI.php");

    /* $sql = "SELECT CONCAT('(', id_hor, ') ', nom_frec, ' ', tur_hor, ' ', hini_hor, ' - ', hfin_hor) AS hora  */
    $sql = "SELECT CONCAT('(', id_hor, ') ', nom_cur) AS hora 
    FROM horario 
    JOIN frecuencia ON horario.id_frec = frecuencia.id_frec 
    JOIN curso ON horario.id_cur = curso.id_cur 
    WHERE id_hor = '$id_horario'";
    $res = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($res);
    $hora = $row['hora'];

    mysqli_close($con);

    return $hora;
}