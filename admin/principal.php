<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php 
            require("view/menuh.php");
            
            require("model/m_principal.php");
            require("../api.php");
            $total_cursos = CursosRegistrados();
            $total_docentes = DocentesRegistrados();
            $total_alumnos = TotalAlumnos();

            $cursos = Cursos();
            $docentes = Docentes();
            ?>
            <?php require("view/v_principal.php"); ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>