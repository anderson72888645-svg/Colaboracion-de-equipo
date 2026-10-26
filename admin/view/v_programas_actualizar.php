<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>ACTUALIZAR PROGRAMA - <?php echo $nom_programa; ?></h2>
        </div>

        <form action="programas_actualizar.php" method="post" enctype="multipart/form-data" id="formActualizar">
            <div class="form-group sp4">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" required value="<?php echo $nom_programa; ?>">
            </div>
            <div class="form-group sp2">
                <label for="prec">Precio</label>
                <input type="number" name="prec" min="0" required value="<?php echo $prec_programa; ?>">
            </div>
            <div class="form-group sp3">
                <label for="foto">Imagen</label>
                <input type="file" name="foto" accept="image/*">
                <input type="hidden" name="foto_actual" value="<?php echo $foto_programa; ?>">
            </div>
            <div class="form-group sp1">
                <div class="img-listas-programas">
                    <img src="<?php echo $foto_programa; ?>" alt="Imagen de programa <?php echo $nom_programa; ?>">
                </div>
            </div>
            <div class="form-group sp2">
                <label for="act">Estado</label>
                <select name="act" id="act" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                    <option value="1" <?php echo $e1; ?>>Activo</option>
                </select>
            </div>
            <div class="form-group sp6">
                <label for="desc">Descripción</label>
                <input type="text" name="desc" required value="<?php echo $desc_programa; ?>">
            </div>
            <input type="hidden" name="actualizarPrograma" value="<?php echo $id_programa; ?>">
            <div class="form-group submit-btn">
                <button type="button" onclick="return ActualizarPrograma();" class="btn btn-edit btn-100">Actualizar</button>
            </div>
        </form>
    </div>
</div>