<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>NUEVO PAÍS</h2>
        </div>

        <form action="pais_registrar.php" method="post" enctype="multipart/form-data">
            <div class="form-group sp6">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" required>
            </div>
            <div class="form-group sp3">
                <label for="foto_pais">Imagen</label>
                <input type="file" name="foto_pais" accept="image/*">
            </div>
            <div class="form-group sp3">
                <label for="act_pais">Estado</label>
                <select name="act_pais" id="act_pais" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                </select>
            </div>
            <div class="form-group submit-btn">
                <input type="submit" value="REGISTRAR" name="registrar" class="btn btn-new btn-100">
            </div>
        </form>
    </div>
</div>