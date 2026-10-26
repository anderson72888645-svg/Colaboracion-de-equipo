<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Actualizar tipo</h2>
        </div>

        <form action="tipo_actualizar.php" method="post" id="formActualizar">
            <input type="hidden" name="actualizarTipo" value="<?php echo $id_tipo; ?>">
            <div class="form-group sp3">
                <label for="nom_tipo">Nombre</label>
                <input type="text" name="nom_tipo" required value="<?php echo $nom_tipo; ?>">
            </div>
            <div class="form-group sp3">
                <label for="act_tipo">Estado</label>
                <select name="act_tipo" id="act_tipo" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                    <option value="1" <?php echo $e1; ?>>Activo</option>
                </select>
            </div>
            <div class="form-group submit-btn">
                <button type="button" onclick="return ActualizarTipo();" class="btn btn-edit btn-100">Actualizar</button>
            </div>
        </form>
    </div>
</div>