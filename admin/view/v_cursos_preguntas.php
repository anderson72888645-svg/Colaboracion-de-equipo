<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2><?php echo $nom_curso; ?> - PREGUNTAS</h2>
        </div>

        <div id="camposPreguntas" class="camposPreguntas">
            <?php foreach ($preguntas as $pre => $value) {
                $id_pregunta  = $value['id_curso_pregunta'];
                $act_pregunta  = $value['act_curso_pregunta'];

                if ($act_pregunta == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }

                if ($act_pregunta == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }
            ?>
                <form action="preguntas.php" method="post" id="formActualizar<?php echo $id_pregunta; ?>">
                    <input type="hidden" name="id_curso" value="<?php echo $id_curso; ?>">
                    <h2 class="tit-contenido sp6">Pregunta <?php echo $pre + 1; ?></h2>
                    <div class="form-group sp4 pregunta">
                        <label for="pre<?php echo $id_pregunta; ?>">Pregunta</label>
                        <input type="text" name="pre<?php echo $id_pregunta; ?>" required value="<?php echo $value['nom_curso_pregunta']; ?>">
                    </div>
                    <div class="form-group sp2">
                        <label for="act-pre<?php echo $id_pregunta; ?>">Estado</label>
                        <select name="act-pre<?php echo $id_pregunta; ?>" id="act-pre<?php echo $pre + 1; ?>" required>
                            <option value="" selected disabled>Seleccione un estado</option>
                            <option value="0" <?php echo $e0; ?>>Inactivo</option>
                            <option value="1" <?php echo $e1; ?>>Activo</option>
                        </select>
                    </div>
                    <div class="form-group sp4">
                        <label for="desc-pre<?php echo $id_pregunta; ?>">Respuesta</label>
                        <input type="text" name="desc-pre<?php echo $id_pregunta; ?>" required value="<?php echo $value['desc_curso_pregunta']; ?>">
                    </div>
                    <input type="hidden" name="actualizarPregunta" value="<?php echo $id_pregunta; ?>">
                    <div class="form-group botones sp2">
                        <button name="eliminarCursoPregunta" type="button" class="btn btn-delete" onclick="return EliminarCursoPregunta(<?php echo $id_pregunta; ?>);">Eliminar</button>
                        <button type="button" class="btn btn-edit" onclick="return ActualizarCursoPregunta(<?php echo $id_pregunta; ?>);">Actualizar</button>
                    </div>
                </form>
            <?php } ?>
        </div>

        <div class="form-group btn-preguntas">
            <input type="button" onclick="agregarCampoPregunta(<?php echo $id_curso; ?>)" value="Agregar Preguntas" class="btn btn-new">
        </div>

    </div>
</div>