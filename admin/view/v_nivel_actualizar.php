<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Actualizar nivel</h2>
        </div>

        <form action="nivel_actualizar.php" method="post" id="formActualizar">
            <input type="hidden" name="actualizarNivel" value="<?php echo $id_nivel; ?>">
            <div class="form-group sp3">
                <label for="nom_nivel">Nombre</label>
                <input type="text" name="nom_nivel" required value="<?php echo $nom_nivel; ?>">
            </div>
            <div class="form-group sp3">
                <label for="act_nivel">Estado</label>
                <select name="act_nivel" id="act_nivel" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                    <option value="1" <?php echo $e1; ?>>Activo</option>
                </select>
            </div>
            <div class="form-group submit-btn">
                <button type="button" onclick="return ActualizarNivel();" class="btn btn-edit btn-100">Actualizar</button>
            </div>
        </form>
    </div>
</div>