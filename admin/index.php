<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body class="container-login">
    <form action="autentificacion.php" method="post" class="form-login">
        <img src="img/logo_rysoft.png" alt="">
        <h1>Iniciar Sesión</h1>
        <label>
            <i class="fa-solid fa-user"></i>
            <input placeholder="Email" type="text" name="username">
        </label>
        <label>
            <i class="fa-solid fa-lock"></i>
            <input placeholder="Contraseña" type="password" name="password">
        </label>
        <button id="button" class="btn btn-main">Iniciar sesión</button>
    </form>

    <?php require("view/scripts.php"); ?>
</body>
</div>

</html>