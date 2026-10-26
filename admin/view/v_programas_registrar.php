<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>NUEVO PROGRAMA</h2>
        </div>

        <form action="programas_registrar.php" method="post" enctype="multipart/form-data">
            <div class="form-group sp4">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" required>
            </div>
            <div class="form-group sp2">
                <label for="prec">Precio</label>
                <input type="number" name="prec" min="0" required>
            </div>
            <div class="form-group sp3">
                <label for="foto">Imagen</label>
                <input type="file" name="foto" accept="image/*">
            </div>
            <div class="form-group sp3">
                <label for="act">Estado</label>
                <select name="act" id="act" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                </select>
            </div>
            <div class="form-group sp6">
                <label for="desc">Descripción</label>
                <input type="text" name="desc" required>
            </div>
            <div class="form-group submit-btn">
                <button type="submit" name="registrar" class="btn btn-new btn-100">Registrar</button>
            </div>
        </form>
    </div>
</div>