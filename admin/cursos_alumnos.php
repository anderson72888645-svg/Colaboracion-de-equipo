<?php require("seguridad.php");  ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">

    <title>Alumnos inscritos | Rysoft</title>

    <?php require("view/style.php"); ?>
</head>

<body>
    <div class="container">
        <?php require("view/menuv.php"); ?>

        <div class="main">
            <?php 
            require("view/menuh.php");

            require("model/m_cursos.php");

            $id_curso = $_REQUEST['curso'];

            $curso = ConsultarCurso($id_curso);

            foreach ($curso as $key => $value) {
                $nom_curso = $value['nom_curso'];
            }

            $id_horario_curso_antiguo = consultarHorarioCursoAntiguo($id_curso);
            $id_curso_antiguo = consultarCursoAntiguo($id_horario_curso_antiguo);

            require("view/v_cursos_alumnos.php");
            ?>
        </div>
    </div>

    <?php require("view/scripts.php"); ?>
</body>

</html>