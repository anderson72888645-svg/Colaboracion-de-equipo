<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2><?php echo $nom_programa; ?> - PROGRAMAS CURSOS</h2>
        </div>


        <div id="camposProgramasCursos" class="camposPreguntas">
            <?php foreach ($programa_cursos as $pre => $value) {
                $id_programa_curso  = $value['id_programa_curso'];
                $act_programa_curso  = $value['act_programa_curso'];
                $id_curso  = $value['id_curso'];

                if ($act_programa_curso == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }
                if ($act_programa_curso == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
            ?>
                <form action="programas_cursos.php" method="post" id="formActualizar<?php echo $id_programa_curso; ?>">
                    <input type="hidden" name="id_programa" value="<?php echo $id_programa; ?>">
                    <h2 class="tit-contenido sp6">Curso <?php echo $pre + 1; ?></h2>
                    <div class="form-group sp2 proCurso">
                        <label for="pro_cur<?php echo $id_programa_curso; ?>">Curso</label>
                        <select name="pro_cur<?php echo $id_programa_curso; ?>" id="pro_cur<?php echo $pre + 1; ?>" required>
                            <option value="" selected disabled>Seleccione un estado</option>
                            <?php
                            foreach ($cursos as $key => $value) {
                                $id_cur = $value['id_curso'];
                                $nom_cur = $value['nom_curso'];

                                $sel_cur = ($id_cur == $id_curso) ? 'selected' : '';

                                echo "<option value='$id_cur' $sel_cur>$nom_cur</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group sp2">
                        <label for="act-cur<?php echo $id_programa_curso; ?>">Estado</label>
                        <select name="act-cur<?php echo $id_programa_curso; ?>" id="act-cur<?php echo $pre + 1; ?>" required>
                            <option value="" selected disabled>Seleccione un estado</option>
                            <option value="0" <?php echo $e0; ?>>Inactivo</option>
                            <option value="1" <?php echo $e1; ?>>Activo</option>
                        </select>
                    </div>
                    <input type="hidden" name="actualizarProgramaCurso" value="<?php echo $id_programa_curso; ?>">
                    <div class="form-group sp2 botones">
                        <button name="eliminarProgramaCurso" type="button" class="btn btn-delete" onclick="return EliminarProgramaCurso(<?php echo $id_programa_curso; ?>, <?php echo $id_programa; ?>);">Eliminar</button>
                        <button type="button" class="btn btn-edit" onclick="return ActualizarProgramaCurso(<?php echo $id_programa_curso; ?>);">Actualizar</button>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div class="form-group btn-preguntas">
            <input type="button" onclick="agregarCampoProgramaCurso(<?php echo $id_programa; ?>)" value="AGREGAR CURSO" class="btn btn-new">
        </div>
    </div>
</div>