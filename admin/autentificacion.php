<?php
session_start();

$user = $_REQUEST['username'];
$pass = $_REQUEST['password'];

require("model/m_admins.php");

$admin = ValidarAdmin($user, $pass);

if ($admin != null) {
    foreach ($admin as $key => $value) {
        $id_admin = $value['id_admin'];
        $nom_admin = $value['nom_admin'];
        $ape_admin = $value['ape_admin'];
        $dni_admin = $value['dni_admin'];
        $email_admin = $value['email_admin'];
        $pass_admin = $value['pass_admin'];
        $fecha_registro = $value['fecha_registro'];
        $foto_admin = $value['foto_admin'];
        $est_admin = $value['est_admin'];
    }

    //crear variables de sesión
    $_SESSION['autentificado'] = TRUE;
    $_SESSION['id_session'] = $id_admin;
    $_SESSION['foto_session'] = $foto_admin;
    $_SESSION['admin_session'] = $nom_admin . " " . $ape_admin;

    header('location: principal.php');
} else {
    header('location: index.php');
}
