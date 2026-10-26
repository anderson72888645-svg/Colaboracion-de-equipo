<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Nuevo administrador</h2>
        </div>

        <form action="admin_registrar.php" method="post" enctype="multipart/form-data">
            <div class="form-group admin_nom">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" oninput="validarTexto(this)" required>
            </div>
            <div class="form-group admin_nom">
                <label for="ape">Apellido</label>
                <input type="text" name="ape" oninput="validarTexto(this)" required>
            </div>
            <div class="form-group admin_dni">
                <label for="dni">DNI</label>
                <input type="number" name="dni" min="10000000" max="99999999" required>
            </div>
            <div class="form-group admin_correo">
                <label for="ema">Correo</label>
                <input type="email" name="ema" required>
            </div>
            <div class="form-group admin_pass">
                <label for="pas">Contraseña</label>
                <input type="password" name="pas" required>
            </div>
            <div class="form-group admin_foto">
                <label for="foto_admin">Imagen</label>
                <input type="file" name="foto_admin" accept="image/*">
            </div>
            <div class="form-group admin_estado">
                <label for="act">Estado</label>
                <select name="act" id="act" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                </select>
            </div>

            <div class="form-group submit-btn">
                <input type="submit" value="Registrar" name="registrar" class="btn btn-new btn-100">
            </div>
        </form>
    </div>
</div>