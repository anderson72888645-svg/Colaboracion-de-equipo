<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Nuevo docente</h2>
        </div>

        <form action="docentes_registrar.php" method="post" enctype="multipart/form-data">
            <div class="form-group sp3">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" oninput="validarTexto(this)" required>
            </div>
            <div class="form-group sp3">
                <label for="ape">Apellido</label>
                <input type="text" name="ape" oninput="validarTexto(this)" required>
            </div>
            <div class="form-group sp3">
                <label for="pais">País</label>
                <select name="pais" id="pais" required>
                    <option value="" selected disabled>Seleccione una pais</option>
                    <?php
                    foreach ($paises as $key => $value) {
                        $id_pais = $value['id_pais'];
                        $no_pais = $value['nom_pais'];
                        $es_pais = $value['act_pais'];

                        if ($es_pais == 1) {
                    ?>
                            <option value="<?php echo $id_pais; ?>"><?php echo $no_pais; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group sp3">
                <label for="dni">DNI</label>
                <input type="number" name="dni" min="10000000" max="99999999" required>
            </div>
            <div class="form-group sp3">
                <label for="foto_docente">Imagen</label>
                <input type="file" name="foto_docente" accept="image/*">
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
                <input type="submit" value="Registrar" name="registrar">
            </div>
        </form>
    </div>
</div>