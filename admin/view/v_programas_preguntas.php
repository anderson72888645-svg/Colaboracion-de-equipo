<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2><?php echo $nom_programa; ?> - PROGRAMAS PREGUNTAS</h2>
        </div>


        <div id="camposProgramasPreguntas" class="camposPreguntas">
            <?php foreach ($programa_preguntas as $pre => $value) {
                $id_programa_preguntas  = $value['id_programa_preguntas'];
                $act_programa_preguntas  = $value['act_programa_preguntas'];
                $id_programa  = $value['id_programa'];

                if ($act_programa_preguntas == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }
                if ($act_programa_preguntas == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
            ?>
                <form action="programas_preguntas.php" method="post" id="formActualizar<?php echo $id_programa_preguntas; ?>">
                    <input type="hidden" name="id_programa" value="<?php echo $id_programa; ?>">
                    <h2 class="tit-contenido sp6">Pregunta <?php echo $pre + 1; ?></h2>
                    <div class="form-group sp4 proPregunta">
                        <label for="preg_pro_pre<?php echo $id_programa_preguntas; ?>">Pregunta</label>
                        <input type="text" name="preg_pro_pre<?php echo $id_programa_preguntas; ?>" required value="<?php echo $value['preg_programa_preguntas']; ?>">
                    </div>
                    <div class="form-group sp2">
                        <label for="act_pro_pre<?php echo $id_programa_preguntas; ?>">Estado</label>
                        <select name="act_pro_pre<?php echo $id_programa_preguntas; ?>" id="act_pro_pre<?php echo $pre + 1; ?>" required>
                            <option value="" selected disabled>Seleccione un estado</option>
                            <option value="0" <?php echo $e0; ?>>Inactivo</option>
                            <option value="1" <?php echo $e1; ?>>Activo</option>
                        </select>
                    </div>
                    <div class="form-group sp4">
                        <label for="rpta_pro_pre<?php echo $id_programa_preguntas; ?>">Respuesta</label>
                        <input type="text" name="rpta_pro_pre<?php echo $id_programa_preguntas; ?>" required value="<?php echo $value['rpta_programa_preguntas']; ?>">
                    </div>
                    <input type="hidden" name="actualizarProgramaPregunta" value="<?php echo $id_programa_preguntas; ?>">
                    <div class="form-group sp2 botones">
                        <button name="eliminarProgramaPregunta" type="button" class="btn btn-delete" onclick="return EliminarProgramaPregunta(<?php echo $id_programa_preguntas; ?>, <?php echo $id_programa; ?>);">Eliminar</button>
                        <button type="button" class="btn btn-edit" onclick="return ActualizarProgramaPregunta(<?php echo $id_programa_preguntas; ?>);">Actualizar</button>
                    </div>
                </form>
            <?php } ?>
        </div>

        <div class="form-group btn-preguntas">
            <input type="button" onclick="agregarCampoProgramaPregunta(<?php echo $id_programa; ?>)" value="AGREGAR PREGUNTA" class="btn btn-new">
        </div>
    </div>
</div>