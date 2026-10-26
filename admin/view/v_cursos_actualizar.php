<?php
function HorariosExistentes($id_curso)
{
    require("model/conexion.php");

    $sql = "SELECT * FROM horarios WHERE id_curso = '$id_curso'";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}

function Horarios()
{
    require("model/conexionAPI.php");

    $sql = "SELECT id_hor, CONCAT(nom_cur, ' - ', nom_frec, ' ', tur_hor, ' ', hini_hor, ' - ', hfin_hor) AS hora 
    FROM horario JOIN frecuencia ON horario.id_frec = frecuencia.id_frec JOIN curso ON horario.id_cur = curso.id_cur";
    $res = mysqli_query($con, $sql);

    $datos = array();

    while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $datos[] = $fila;
    }

    mysqli_close($con);

    return $datos;
}
?>
<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2>Actualizar curso</h2>
        </div>

        <form action="cursos_actualizar.php" method="post" enctype="multipart/form-data" id="formActualizar">
            <input type="hidden" id="id_curso" value="<?php echo $id_curso; ?>">
            <div class="form-group sp6">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" required value="<?php echo $nom_curso; ?>">
            </div>
            <div class="form-group sp3">
                <label for="cat">Categoría</label>
                <select name="cat" id="cat" required>
                    <option value="" selected disabled>Seleccione una categoría</option>
                    <?php
                    foreach ($categorias as $key => $value) {
                        $id_cat = $value['id_categoria'];
                        $no_cat = $value['nom_categoria'];

                        $sel_cat = ($id_cat == $id_categoria) ? 'selected' : '';

                        echo "<option value='$id_cat' $sel_cat>$no_cat</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group sp3">
                <label for="doc">Docente</label>
                <select name="doc" id="doc" required>
                    <option value="" selected disabled>Seleccione un docente</option>
                    <?php
                    foreach ($docentes as $key => $value) {
                        $id_doc = $value['id_docente'];
                        $no_doc = $value['nom_docente'];
                        $ap_doc = $value['ape_docente'];

                        $sel_doc = ($id_doc == $id_docente) ? 'selected' : '';

                        echo "<option value='$id_doc' $sel_doc>$no_doc $ap_doc</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group sp2">
                <label for="prec">Precio</label>
                <input type="number" name="prec" min="0" required value="<?php echo $prec_curso; ?>">
            </div>
            <div class="form-group sp2">
                <label for="dscto">Descuento</label>
                <input type="number" name="dscto" min="0" required value="<?php echo $dscto_curso; ?>">
            </div>
            <div class="form-group sp2">
                <label for="dur">Duración en horas</label>
                <input type="number" name="dur" min="0" required value="<?php echo $dur_curso; ?>">
            </div>
            <div class="form-group sp2">
                <label for="vid">Cantidad de videos</label>
                <input type="number" name="vid" min="0" required value="<?php echo $vid_curso; ?>">
            </div>
            <div class="form-group sp2">
                <label for="tip">Tipo de certificación</label>
                <select name="tip" id="tip" required>
                    <option value="" selected disabled>Seleccione un tipo</option>
                    <?php
                    foreach ($tipos as $key => $value) {
                        $id_tipo = $value['id_tipo'];
                        $nom_tipo = $value['nom_tipo'];

                        $sel_tip = ($id_tipo == $tipo) ? 'selected' : '';

                        echo "<option value='$id_tipo'  $sel_tip>$nom_tipo</option>";
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

                        $sel_niv = ($id_nivel == $nivel) ? 'selected' : '';

                        echo "<option value='$id_nivel'  $sel_niv>$nom_nivel</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group sp2">
                <label for="foto">Imagen</label>
                <input type="file" name="foto" accept="image/*">
                <input type="hidden" name="foto_actual" value="<?php echo $foto_curso; ?>">
            </div>
            <div class="form-group sp1">
                <div class="img-listas-cursos">
                    <img src="<?php echo $foto_curso; ?>" alt="Imagen de curso <?php echo $nom_curso; ?>">
                </div>
            </div>
            <div class="form-group sp3">
                <label for="act">Estado</label>
                <select name="act" id="act" required>
                    <option value="" selected disabled>Seleccione un estado</option>
                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                    <option value="1" <?php echo $e1; ?>>Activo</option>
                </select>
            </div>
            <div class="form-group sp6">
                <label for="desc">Descripción</label>
                <input type="text" name="desc" required value="<?php echo $desc_curso; ?>">
            </div>
            <input type="hidden" name="actualizarCurso" value="<?php echo $id_curso; ?>">
            <div class="form-group submit-btn">
                <button type="button" onclick="return ActualizarCurso();" class="btn btn-edit btn-100">Actualizar</button>
            </div>
        </form>

        <!-- Horario -->
        <div class="cardHeader">
            <h2>Horarios</h2>
            <button name="modalRegistrarHorario" type="button" class="btn btn-new" onclick="return modalRegistrarHorario(<?php echo $id_curso; ?>);">Nuevo Horario</button>
        </div>

        <table style="width: 100%; text-align: center; padding-left: 50px; padding-right: 50px;">
            <thead>
                <th></th>
                <th>Horario</th>
                <th>Principal</th>
                <th>Activo</th>
                <th></th>
                <th></th>
            </thead>

            <tbody id="contentHorarios">

            </tbody>
        </table>

        <!-- Modal -->
        <!-- Nuevo -->
        <div id="modalRegistrarHorario<?php echo $id_curso; ?>" class="modal">
            <div class="modal-content">
                <div class="cardHeader">
                    <h2>Horario</h2>
                    <span class="close" onclick="closeModalRegistrarHorario(<?php echo $id_curso; ?>)">&times;</span>
                </div>
                <form action="cursos_actualizar.php" method="post">
                    <div class="form-group sp2">
                        <label for="hor">Horario</label>
                        <select name="hor" id="hor" required>
                            <option value="" selected disabled>Seleccione un horario</option>
                            <?php
                            $horarios = Horarios();

                            foreach ($horarios as $key => $value) {
                                $id_hor = $value['id_hor'];
                                $hora = $value['hora'];
                            ?>
                                <option value='<?php echo $id_hor; ?>'><?php echo $hora; ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                    <div class="form-group sp2">
                        <label for="pri">Principal</label>
                        <select name="pri" id="pri" required>
                            <option value="" selected disabled>Seleccione una opción</option>
                            <option value="0">No principal</option>
                            <option value="1">Principal</option>
                        </select>
                    </div>
                    <div class="form-group sp2">
                        <label for="act">Estado</label>
                        <select name="act" id="act" required>
                            <option value="" selected disabled>Seleccione un estado</option>
                            <option value="0">Inactivo</option>
                            <option value="1">Activo</option>
                        </select>
                    </div>
                    <div class="form-group submit-btn sp3">
                        <button name="registrarHorario" type="submit" value="<?php echo $id_curso; ?>" class="btn btn-new btn-100">Registrar</button>
                    </div>
                </form>
            </div>
        </div> <!-- Nuevo -->

        <!-- Actualizar -->
        <?php
        $horariosExistentes = HorariosExistentes($id_curso);
        $horarios = Horarios();


        foreach ($horariosExistentes as $key => $value) {
            $id_relacion = $value['id_relacion'];
            $id_horario = $value['id_horario'];
            $hor_principal = $value['hor_principal'];
            $act_horario = $value['act_horario'];

            if ($act_horario == 1) {
                $e1 = "selected";
            } else {
                $e1 = "";
            }
            if ($act_horario == 0) {
                $e0 = "selected";
            } else {
                $e0 = "";
            }

            if ($hor_principal == 1) {
                $p1 = "selected";
            } else {
                $p1 = "";
            }
            if ($hor_principal == 0) {
                $p0 = "selected";
            } else {
                $p0 = "";
            }

        ?>
            <div id="modalActualizarHorario<?php echo $id_relacion; ?>" class="modal">
                <div class="modal-content">
                    <div class="cardHeader">
                        <h2>Horario</h2>
                        <span class="close" onclick="closeModalActualizarHorario(<?php echo $id_relacion; ?>)">&times;</span>
                    </div>
                    <form action="cursos_actualizar.php" method="post" id="formActualizarHorario<?php echo $id_relacion; ?>">
                        <input type="hidden" name="id_curso" value="<?php echo $id_curso; ?>">
                        <div class="form-group sp2">
                            <label for="hor<?php echo $id_relacion; ?>">Horario</label>
                            <select name="hor<?php echo $id_relacion; ?>" id="hor" required>
                                <option value="" selected disabled>Seleccione un horario</option>
                                <?php
                                foreach ($horarios as $key => $value) {
                                    $id_hor = $value['id_hor'];
                                    $hora = $value['hora'];

                                    $sel_hor = ($id_hor == $id_horario) ? 'selected' : '';

                                    echo "<option value='$id_hor' $sel_hor>$hora</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group sp2">
                            <label for="pri<?php echo $id_relacion; ?>">Principal</label>
                            <select name="pri<?php echo $id_relacion; ?>" id="pri" required>
                                <option value="" selected disabled>Seleccione una opción</option>
                                <option value="0" <?php echo $p0; ?>>No principal</option>
                                <option value="1" <?php echo $p1; ?>>Principal</option>
                            </select>
                        </div>
                        <div class="form-group sp2">
                            <label for="act<?php echo $id_relacion; ?>">Estado</label>
                            <select name="act<?php echo $id_relacion; ?>" id="act" required>
                                <option value="" selected disabled>Seleccione un estado</option>
                                <option value="0" <?php echo $e0; ?>>Inactivo</option>
                                <option value="1" <?php echo $e1; ?>>Activo</option>
                            </select>
                        </div>
                        <div class="form-group submit-btn sp3">
                            <input type="hidden" name="actualizarHorario" value="<?php echo $id_relacion; ?>">
                            <button type="button" onclick="return ActualizarHorario(<?php echo $id_relacion; ?>);" class="btn btn-edit btn-100">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?> <!-- Actualizar -->
        <!-- Modal -->
    </div>
</div>

<script type="text/javascript">
    getDataHorario();

    function getDataHorario() {
        let content = document.getElementById("contentHorarios");
        let curso = document.getElementById("id_curso").value;
        let url = "table/cargaHorario.php?id_curso=" + curso;
        let formData = new FormData();

        fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data
            }).catch(err => console.log(err))
    }
</script>