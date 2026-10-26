<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Nuevo curso</h2>
        </div>

        <form action="cursos_registrar.php" method="post" enctype="multipart/form-data">
            <div class="form-group nombre">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" required>
            </div>
            <div class="form-group sp2">
                <label for="cat">Categoría</label>
                <select name="cat" id="cat" required>
                    <option value="" selected disabled>Seleccione una categoría</option>
                    <?php
                    foreach ($categorias as $key => $value) {
                        $id_cat = $value['id_categoria'];
                        $no_cat = $value['nom_categoria'];
                        $es_cat = $value['act_categoria'];

                        if ($es_cat == 1) {
                    ?>
                            <option value="<?php echo $id_cat; ?>"><?php echo $no_cat; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group sp2">
                <label for="doc">Docente</label>
                <select name="doc" id="doc" required>
                    <option value="" selected disabled>Seleccione un docente</option>
                    <?php
                    foreach ($docentes as $key => $value) {
                        $id_doc = $value['id_docente'];
                        $no_doc = $value['nom_docente'];
                        $ap_doc = $value['ape_docente'];
                        $es_doc = $value['act_docente'];

                        if ($es_doc == 1) {
                    ?>
                            <option value="<?php echo $id_doc; ?>"><?php echo $no_doc . " " . $ap_doc; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group sp2">
                <label for="hor">Horarios</label>
                <select name="hor" id="hor" required>
                    <option value="" selected disabled>Seleccione un horario</option>
                    <?php
                    foreach ($horarios as $key => $value) {
                        $id_hor = $value['id'];
                        $no_hor = $value['nombre'];
                    ?>
                        <option value="<?php echo $id_hor; ?>"><?php echo $id_hor . " -> " . $no_hor; ?></option>
                    <?php
                    } ?>
                </select>
            </div>
            <div class="form-group sp2">
                <label for="prec">Precio</label>
                <input type="number" name="prec" min="0" required>
            </div>
            <div class="form-group sp2">
                <label for="dscto">Descuento</label>
                <input type="number" name="dscto" min="0" required>
            </div>
            <div class="form-group sp2">
                <label for="dur">Duración en horas</label>
                <input type="number" name="dur" min="0" required>
            </div>
            <div class="form-group sp2">
                <label for="vid">Cantidad de videos</label>
                <input type="number" name="vid" min="0" required>
            </div>
            <div class="form-group sp2">
                <label for="tip">Tipo de certificación</label>
                <select name="tip" id="tip" required>
                    <option value="" selected disabled>Seleccione un tipo</option>
                    <?php
                    foreach ($tipos as $key => $value) {
                        $id_tipo = $value['id_tipo'];
                        $nom_tipo = $value['nom_tipo'];
                        $act_tipo = $value['act_tipo'];

                        if ($act_tipo == 1) {
                    ?>
                            <option value="<?php echo $id_tipo; ?>"><?php echo $nom_tipo; ?></option>
                    <?php
                        }
                    } ?>
                </select>
            </div>
            <div class="form-group sp2">
                <label for="niv">Nivel de certificación</label>
                <select name="niv" id="niv">
                    <option value="" selected>Seleccione un estado</option>
                    <?php
                    foreach ($niveles as $key => $value) {
                        $id_nivel = $value['id_nivel'];
                        $nom_nivel = $value['nom_nivel'];
                        $act_nivel = $value['act_nivel'];

                        if ($act_nivel == 1) {
                    ?>
                            <option value="<?php echo $id_nivel; ?>"><?php echo $nom_nivel; ?></option>
                    <?php
                        }
                    } ?>
                </select>
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
                <input type="submit" value="Registrar" name="registrar" class="btn btn-new btn-100">
            </div>
        </form>
    </div>
</div>