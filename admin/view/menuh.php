<?php 
$nombre = $_SESSION['admin_session'];
$foto = $_SESSION['foto_session'];
?>
<div class="topbar">
    <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>

    <div class="nombre-usuario">
        <h2><?php echo $nombre; ?></h2>
    </div>

    <div class="user">
        <img src="<?php echo $foto; ?>" alt="">
    </div>
</div>