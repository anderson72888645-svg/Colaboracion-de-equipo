<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Actualizar docente</h2>
        </div>

        <form action="docentes_actualizar.php" method="post" enctype="multipart/form-data" id="formActualizar">
            <div class="form-group docente_nom">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" oninput="validarTexto(this)" required value="<?php echo $nom_docente; ?>">
            </div>
            <div class="form-group docente_nom">
                <label for="ape">Apellido</label>
                <input type="text" name="ape" oninput="validarTexto(this)" required value="<?php echo $ape_docente; ?>">
            </div>
            <div class="form-group docente_pais">
                <label for="pais">País</label>
                <select name="pais" id="pais" required>
                    <option value="" selected disabled>Seleccione una pais</option>
                    <?php
                    foreach ($paises as $key => $value) {
                        $id_pais = $value['id_pais'];
                        $no_pais = $value['nom_pais'];
                        $es_pais = $value['act_pais'];

                        $sel_pais = ($id_pais == $pais) ? 'selected' : '';

                        echo "<option value='$id_pais' $sel_pais>$no_pais</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group docente_dni">
                <label for="dni">DNI</label>
                <input type="number" name="dni" min="10000000" max="99999999" required value="<?php echo $dni_docente; ?>">
            </div>
            <div class="form-group docente_foto_edit">
                <label for="foto_docente">Imagen</label>
                <input type="file" name="foto_docente" accept="image/*">
                <input type="hidden" name="foto_actual" value="<?php echo $foto; ?>">
            </div>
            <div class="form-group docente_foto_preview">
                <div class="img-listas" style="left: 25px; top: 25px;">
                    <img src="<?php echo $foto; ?>" alt="Imagen de Admin <?php echo $nom_admin; ?>">
                </div>
            </div>
            <div class="form-group estado">
                <label for="act">Estado</label>
                <select name="act" id="act" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                    <option value="1" <?php echo $e1; ?>>Activo</option>
                </select>
            </div>
            <div class="form-group descripcion">
                <label for="desc">Descripción</label>
                <input type="text" name="desc" required value="<?php echo $desc_docente; ?>">
            </div>
            <input type="hidden" name="actualizarDocente" value="<?php echo $id_docente; ?>">
            <div class="form-group submit-btn">
                <button type="button" onclick="return ActualizarDocente();" class="btn-edit btn-100">Actualizar</button>
            </div>
        </form>
    </div>
</div>