<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>ACTUALIZAR PAÍS</h2>
        </div>

        <form action="pais_actualizar.php" method="post" enctype="multipart/form-data" id="formActualizar">
            <input type="hidden" name="actualizarPais" value="<?php echo $id_pais; ?>">
            <div class="form-group sp6">
                <label for="nom">Nombre</label>
                <input type="text" name="nom_pais" required value="<?php echo $nom_pais; ?>">
            </div>
            <div class="form-group sp2">
                <label for="imagen_pais">Imagen</label>
                <input type="file" name="imagen_pais" accept="image/*">
                <input type="hidden" name="foto_actual" value="<?php echo $foto_pais; ?>">
            </div>
            <div class="form-group sp1">
                <div class="img-listas" style="left: 25px; top: 25px;">
                    <img src="<?php echo $foto_pais; ?>" alt="Imagen de Admin <?php echo $nom_admin; ?>">
                </div>
            </div>
            <div class="form-group sp3">
                <label for="act_pais">Estado</label>
                <select name="act_pais" id="act_pais" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                    <option value="1" <?php echo $e1; ?>>Activo</option>
                </select>
            </div>
            <div class="form-group submit-btn">
                <button type="button" onclick="return ActualizarPais();" class="btn btn-edit btn-100">Actualizar</button>
            </div>
        </form>
    </div>
</div>