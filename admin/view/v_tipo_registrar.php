<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Nuevo tipo</h2>
        </div>

        <form action="tipo_registrar.php" method="post" enctype="multipart/form-data">
            <div class="form-group sp3">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" required>
            </div>
            <div class="form-group sp3">
                <label for="act_tipo">Estado</label>
                <select name="act_tipo" id="act_tipo" required>
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