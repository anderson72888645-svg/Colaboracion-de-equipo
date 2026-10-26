<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>ACTUALIZAR MEMBRESÍA - <?php echo $nom_membresia; ?></h2>
        </div>

        <form action="membresias_actualizar.php" method="post" enctype="multipart/form-data" id="formActualizar">
            <div class="form-group sp4">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" required value="<?php echo $nom_membresia; ?>">
            </div>
            <div class="form-group sp2">
                <label for="act">Estado</label>
                <select name="act" id="act" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                    <option value="1" <?php echo $e1; ?>>Activo</option>
                </select>
            </div>
            <div class="form-group sp2">
                <label for="prec">Precio</label>
                <input type="number" name="prec" min="0" required value="<?php echo $prec_membresia; ?>">
            </div>
            <div class="form-group sp2">
                <label for="dscto">Descuento</label>
                <input type="number" name="dscto" min="0" required value="<?php echo $dscto_membresia; ?>">
            </div>
            <div class="form-group sp1">
                <label for="foto">Imagen</label>
                <input type="file" name="foto" accept="image/*">
                <input type="hidden" name="foto_actual" value="<?php echo $foto_membresia; ?>">
            </div>
            <div class="form-group sp1">
                <div class="img-listas-membresias">
                    <img src="<?php echo $foto_membresia; ?>" alt="Imagen de membresia <?php echo $nom_membresia; ?>">
                </div>
            </div>
            <div class="form-group sp6">
                <label for="desc">Descripción</label>
                <input type="text" name="desc" required value="<?php echo $desc_membresia; ?>">
            </div>
            <input type="hidden" name="actualizarMembresia" value="<?php echo $id_membresia; ?>">
            <div class="form-group submit-btn">
                <button type="button" onclick="return ActualizarMembresia();" class="btn btn-edit btn-100">Actualizar</button>
            </div>
        </form>
    </div>
</div>