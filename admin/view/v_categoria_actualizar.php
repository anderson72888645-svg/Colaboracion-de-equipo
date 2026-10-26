<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Actualizar categoría</h2>
        </div>

        <form action="categoria_actualizar.php" method="post" id="formActualizar">
            <input type="hidden" name="actualizarCategoria" value="<?php echo $id_categoria; ?>">
            <div class="form-group categoria_nom">
                <label for="nom_categoria">Nombre</label>
                <input type="text" name="nom_categoria" required value="<?php echo $nom_categoria; ?>">
            </div>
            <div class="form-group categoria_estado">
                <label for="act_categoria">Estado</label>
                <select name="act_categoria" id="act_categoria" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                    <option value="1" <?php echo $e1; ?>>Activo</option>
                </select>
            </div>
            <div class="form-group submit-btn">
                <button type="button" onclick="return ActualizarCategoria();" class="btn btn-edit btn-100">Actualizar</button>
            </div>
        </form>
    </div>
</div>