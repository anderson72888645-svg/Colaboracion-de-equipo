<div class="registro">
    <div class="formulario">
        <div class="cardHeader">
            <h2><?php echo $nom_curso; ?> - MÓDULOS</h2>
        </div>

        <div id="camposModulos" class="camposModulos">
            <?php foreach ($modulos as $key => $value) {
                $id_modulo  = $value['id_curso_contenido'];
                $act_modulo  = $value['act_curso_contenido'];

                if ($act_modulo == 1) {
                    $e1 = "selected";
                } else {
                    $e1 = "";
                }

                if ($act_modulo == 0) {
                    $e0 = "selected";
                } else {
                    $e0 = "";
                }

                $temas = ConsultarTemas($id_modulo);
            ?>
                <form action="modulos.php" method="post" id="formActualizar<?php echo $id_modulo; ?>">
                    <input type="hidden" name="id_curso" value="<?php echo $id_curso; ?>">
                    <h2 class="tit-contenido sp6">Módulo <?php echo $key + 1; ?></h2>
                    <div class="form-group sp2 cod-contenido">
                        <label for="cod-con<?php echo $id_modulo; ?>">Código de contenido</label>
                        <input type="text" name="cod-con<?php echo $id_modulo; ?>" value="<?php echo $value['cod_curso_contenido']; ?>" required>
                    </div>
                    <div class="form-group sp2">
                        <label for="nom-con<?php echo $id_modulo; ?>">Nombre de contenido</label>
                        <input type="text" name="nom-con<?php echo $id_modulo; ?>" required value="<?php echo $value['nom_curso_contenido']; ?>">
                    </div>
                    <div class="form-group sp2">
                        <label for="est-con<?php echo $id_modulo; ?>">Estado de contenido</label>
                        <select name="est-con<?php echo $id_modulo; ?>" id="est-con<?php echo $id_modulo; ?>" required>
                            <option value="" selected disabled>Seleccione un estado</option>
                            <option value="0" <?php echo $e0; ?>>Inactivo</option>
                            <option value="1" <?php echo $e1; ?>>Activo</option>
                        </select>
                    </div>
                    <div class="form-group sp4">
                        <label for="des-con<?php echo $id_modulo; ?>">Descripción de contenido</label>
                        <input type="text" name="des-con<?php echo $id_modulo; ?>" required value="<?php echo $value['desc_curso_contenido']; ?>">
                    </div>
                    <input type="hidden" name="actualizarModulo" value="<?php echo $id_modulo; ?>">
                    <div class="form-group sp2 botones">
                        <button name="eliminarCursoContenido" type="button" class="btn btn-delete" onclick="return EliminarCursoContenido(<?php echo $id_modulo; ?>, <?php echo $id_curso; ?>);">Eliminar</button>
                        <button type="button" class="btn btn-edit" onclick="return ActualizarCursoModulo(<?php echo $id_modulo; ?>);">Actualizar</button>
                    </div>
                </form>

                <!-- Temas -->
                <div id="camposTemas<?php echo $id_modulo; ?>" class="camTemas">
                    <?php foreach ($temas as $tem => $value) {
                        $id_tema  = $value['id_curso_contenido_tema'];
                        $act_tema  = $value['act_curso_contenido_tema'];

                        if ($act_tema == 1) {
                            $e3 = "selected";
                        } else {
                            $e3 = "";
                        }

                        if ($act_tema == 0) {
                            $e2 = "selected";
                        } else {
                            $e2 = "";
                        }
                    ?>
                        <form action="modulos.php" method="post" id="formActualizarTema<?php echo $id_tema; ?>" class="form-tema">
                            <input type="hidden" name="id_curso" value="<?php echo $id_curso; ?>">
                            <h2 class="tit-contenido sp6">Tema <?php echo $tem + 1; ?></h2>
                            <div class="form-group sp2 nom-tema">
                                <label for="nom-tema<?php echo $id_tema; ?>">Nombre de tema</label>
                                <input type="text" name="nom-tema<?php echo $id_tema; ?>" required value="<?php echo $value['nom_curso_contenido_tema']; ?>">
                            </div>
                            <div class="form-group sp2">
                                <label for="est-tema<?php echo $id_tema; ?>">Estado de tema</label>
                                <select name="est-tema<?php echo $id_tema; ?>" id="est-tema<?php echo $id_tema; ?>" required>
                                    <option value="" selected disabled>Seleccione un estado</option>
                                    <option value="0" <?php echo $e2; ?>>Inactivo</option>
                                    <option value="1" <?php echo $e3; ?>>Activo</option>
                                </select>
                            </div>
                            <input type="hidden" name="actualizarTema" value="<?php echo $id_tema; ?>">
                            <div class="form-group sp2 botones">
                                <button name="eliminarCursoContenidoTema" type="button" class="btn btn-delete" onclick="return EliminarCursoContenidoTema(<?php echo $id_tema; ?>, <?php echo $id_curso; ?>);">Eliminar</button>
                                <button type="button" class="btn btn-edit" onclick="return ActualizarCursoTema(<?php echo $id_tema; ?>);">Actualizar</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>

                <div class="form-group btn-temas">
                    <input type="button" onclick="agregarCampoTema(<?php echo $id_modulo; ?>, <?php echo $id_curso; ?>)" value="Agregar Tema" class="btn btn-extras btn-100">
                </div>
            <?php } ?>
        </div>

        <div class="form-group btn-modulos">
            <input type="button" onclick="agregarCampoModulo(<?php echo $id_curso; ?>)" value="Agregar Módulos" class="btn btn-new">
        </div>
    </div>
</div>