<div class="cardBox">
    <div class="card">
        <div>
            <div class="numbers"><?php echo $total_cursos; ?></div>
            <div class="cardName">Cursos</div>
        </div>

        <div class="iconBx">
            <ion-icon name="library-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?php echo $total_docentes; ?></div>
            <div class="cardName">Docentes</div>
        </div>

        <div class="iconBx">
            <ion-icon name="people-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?php echo $total_alumnos; ?></div>
            <div class="cardName">Alumnos</div>
        </div>

        <div class="iconBx">
            <ion-icon name="school-outline"></ion-icon>
        </div>
    </div>
</div>

<!-- ================ Cursos ================= -->
<div class="tabla">
    <div class="lista">
        <div class="cardHeader">
            <h2>Cursos</h2>
            <a href="cursos.php" class="btn btn-main">Ver todos</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td></td>
                    <td>Nombre</td>
                    <td>Docente</td>
                    <td>Categoria</td>
                    <td>Estado</td>
                </tr>
            </thead>

            <tbody>
                <?php
                $n = 0;
                foreach ($cursos as $key => $value) {
                    $n++;
                    $curso = $value['nom_curso'];
                    $nom_docente = $value['nom_docente'];
                    $ape_docente = $value['ape_docente'];
                    $categoria = $value['nom_categoria'];
                    $estado = $value['act_curso'];

                    if ($estado == 0) {
                        $nom_estado = "Inactivo";
                    } else {
                        $nom_estado = "Activo";
                    }
                ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $curso; ?></td>
                        <td><?php echo $nom_docente . " " . $ape_docente; ?></td>
                        <td><?php echo $categoria; ?></td>
                        <td><?php echo $nom_estado; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- ================= Docentes ================ -->
    <div class="docentes_dashboard">
        <div class="cardHeader">
            <h2>Docentes</h2>
        </div>

        <table>
            <?php
            foreach ($docentes as $key => $value) {
                $nombre = $value['nom_docente'];
                $apellido = $value['ape_docente'];
                $pais = $value['nom_pais'];
                $activo = $value['act_docente'];
                $imagen_perfil = $value['foto_docente'];

                if ($activo == 0) {
                    $nom_activo = "Inactivo";
                } else {
                    $nom_activo = "Activo";
                }

                if (!file_exists($imagen_perfil)) {
                    $imagen_perfil = "img/bx_user.svg";
                }
            ?>
                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="<?php echo $imagen_perfil; ?>" alt=""></div>
                    </td>
                    <td>
                        <h4><?php echo $nombre . " " . $apellido; ?> <br> <span><?php echo $pais . " - " . $nom_activo; ?></span></h4>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>