<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2><?php echo $nom_membresia; ?> - MEMBRESÍA PROGRAMAS</h2>
        </div>


        <div id="camposMembresiaPrograma" class="camposPreguntas">
            <?php foreach ($membresia_programa as $pre => $value) {
                $id_membresia_programa  = $value['id_membresia_programa'];
                $act_membresia_programa  = $value['act_membresia_programa'];
                $id_programa  = $value['id_programa'];

                if ($act_membresia_programa == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }
                if ($act_membresia_programa == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }
            ?>
                <form action="membresias_programas.php" method="post" id="formActualizar<?php echo $id_membresia_programa; ?>">
                    <input type="hidden" name="id_membresia" value="<?php echo $id_membresia; ?>">
                    <h2 class="tit-contenido sp6">Programa <?php echo $pre + 1; ?></h2>
                    <div class="form-group sp2 memPrograma">
                        <label for="mem-pro<?php echo $id_membresia_programa; ?>">Programa</label>
                        <select name="mem-pro<?php echo $id_membresia_programa; ?>" id="mem-pro<?php echo $pre + 1; ?>" required>
                            <option value="" selected disabled>Seleccione un estado</option>
                            <?php
                            foreach ($programas as $key => $value) {
                                $id_pro = $value['id_programa'];
                                $nom_pro = $value['nom_programa'];

                                $sel_pro = ($id_pro == $id_programa) ? 'selected' : '';

                                echo "<option value='$id_pro' $sel_pro>$nom_pro</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group sp2">
                        <label for="act-pro<?php echo $id_membresia_programa; ?>">Estado</label>
                        <select name="act-pro<?php echo $id_membresia_programa; ?>" id="act-pro<?php echo $pre + 1; ?>" required>
                            <option value="" selected disabled>Seleccione un estado</option>
                            <option value="0" <?php echo $e0; ?>>Inactivo</option>
                            <option value="1" <?php echo $e1; ?>>Activo</option>
                        </select>
                    </div>
                    <input type="hidden" name="actualizarMembresiaPrograma" value="<?php echo $id_membresia_programa; ?>">
                    <div class="form-group sp2 botones">
                        <button name="eliminarMembresiaPrograma" type="button" class="btn btn-delete" onclick="return EliminarMembresiaPrograma(<?php echo $id_membresia_programa; ?>, <?php echo $id_membresia; ?>);">Eliminar</button>
                        <button type="button" class="btn btn-edit" onclick="return ActualizarMembresiaPrograma(<?php echo $id_membresia_programa; ?>);">Actualizar</button>
                    </div>
                </form>
            <?php } ?>
        </div>

        <div class="form-group btn-preguntas">
            <input type="button" onclick="agregarCampoMembresiaPrograma(<?php echo $id_membresia; ?>)" value="AGREGAR PROGRAMA" class="btn btn-new">
        </div>
    </div>
</div>