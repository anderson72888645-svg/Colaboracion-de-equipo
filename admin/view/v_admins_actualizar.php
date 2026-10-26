<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Actualizar administrador</h2>
        </div>

        <form action="admin_actualizar.php" method="post" enctype="multipart/form-data" id="formActualizar">
            <div class="form-group admin_nom">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" oninput="validarTexto(this)" required value="<?php echo $nom_admin; ?>">
            </div>
            <div class="form-group admin_nom">
                <label for="ape">Apellido</label>
                <input type="text" name="ape" oninput="validarTexto(this)" required value="<?php echo $ape_admin; ?>">
            </div>
            <div class="form-group admin_dni">
                <label for="dni">DNI</label>
                <input type="number" name="dni" min="10000000" max="99999999" required value="<?php echo $dni_admin; ?>">
            </div>
            <div class="form-group admin_correo">
                <label for="ema">Correo</label>
                <input type="email" name="ema" required value="<?php echo $email_admin; ?>">
            </div>
            <div class="form-group admin_pass">
                <label for="pas">Contraseña</label>
                <input type="password" name="pas" required value="<?php echo $pass_admin; ?>">
            </div>
            <div class="form-group admin_foto_edit">
                <label for="foto_admin">Imagen</label>
                <input type="file" name="foto_admin" accept="image/*">
                <input type="hidden" name="foto_actual" value="<?php echo $foto_administrador; ?>">
            </div>
            <div class="form-group admin_foto_preview">
                <div class="img-listas" style="left: 25px; top: 25px;">
                    <img src="<?php echo $foto_administrador; ?>" alt="Imagen de Admin <?php echo $nom_admin; ?>">
                </div>
            </div>
            <div class="form-group admin_estado">
                <label for="act">Estado</label>
                <select name="act" id="act" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                    <option value="1" <?php echo $e1; ?>>Activo</option>
                </select>
            </div>
            <input type="hidden" name="actualizarAdmin" value="<?php echo $id_admin; ?>">
            <div class="form-group submit-btn">
                <button type="button" onclick="return ActualizarAdmin();" class="btn btn-edit btn-100">Actualizar</button>
            </div>
        </form>
    </div>
</div>