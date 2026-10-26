<?php
session_start();
if (!$_SESSION['autentificado']) {
    header('location: index.php');
    exit();
}
?>