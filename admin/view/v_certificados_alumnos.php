<div class="tabla tabla-sub">
    <div class="lista" style="overflow-x: auto;">
        <div class="cardHeader" style="margin-bottom: 10px;">
            <h2>Certificados alumno - <?php echo $nom_alum . ' ' . $ape1_alum . ' ' . $ape2_alum ?></h2>
        </div>
        <div class="cardHeader">
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar certificado" name="campoCertificados" id="campoCertificados">
                    <input type="hidden" id="id_alumno" value="<?php echo $id_alumno; ?>">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
        </div>

        <table>
            <thead>
                <th></th>
                <th class="sort asc">Matrícula</th>
                <th class="sort asc">Curso</th>
                <th>Anuncios</th>
                <th>Respuestas</th>
                <th class="sort asc">Estado</th>
                <th>Certificación</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>

            <tbody id="contentCertificados">

            </tbody>
        </table>

        <!-- Modales para cada alumno -->
        <?php
        foreach ($certificados as $key => $value) {
            $id_certificado = $value['id_certificado'];
            $link_certificado = $value['link_certificado'];
            $act_certificado = $value['act_certificado'];
            $nom_cur = $value['nom_cur'];

            if ($act_certificado == 0) {
                $nom_estado = "Inactivo";
            } else {
                $nom_estado = "Activo";
            }
        ?>
            <div id="modalCertificado<?php echo $id_certificado; ?>" class="modal">
                <div class="modal-content">
                    <div class="cardHeader">
                        <h2>CERTIFICADO DE <?php echo $nom_alum . ' ' . $ape1_alum . ' ' . $ape2_alum ?> - <?php echo $nom_cur; ?></h2>
                        <span class="close" onclick="closeModalCertificado('<?php echo $id_certificado; ?>')">&times;</span>
                    </div>
                    <div class="modal-informacion">
                        <div class="modal-group modal-certificado">
                            <div class="img-modal-certificado">
                                <img src="<?php echo $link_certificado; ?>" alt="Imagen de certificado <?php echo $nom_cur; ?>">
                            </div>
                        </div>
                        <div class="modal-group sp4 submit-btn">
                            <a href="<?php echo $link_certificado; ?>" download>
                                <button type="button" class="btn btn-extras btn-100">
                                    <ion-icon name="cloud-download-outline"></ion-icon> Descargar
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        foreach ($cursos_matriculados as $key => $value) {
            $id_mat = $value['id_mat'];
            $nom_cur = $value['nom_cur'];
            $link_certificado = $value['link_certificado'];
            $act_certificado = $value['act_certificado'];
            $id_certificado = $value['id_certificado'];

            if ($act_certificado == 1) {
                $e1 = "selected";
            } else {
                $e1 = "";
            }
            if ($act_certificado == 0) {
                $e0 = "selected";
            } else {
                $e0 = "";
            }

            if (!file_exists($link_certificado)) {
                $link_certificado = "img/certificados/rysoft.png";
            }

            ?>
                <div id="modalActualizarCertificado<?php echo $id_mat; ?>" class="modal">
                    <div class="modal-content">
                        <div class="cardHeader">
                            <h2>CERTIFICADO <?php echo $nom_cur; ?> - <?php echo $nom_alum . ' ' . $ape1_alum . ' ' . $ape2_alum ?></h2>
                            <span class="close" onclick="closeModalActualizarCertificado(<?php echo $id_mat; ?>)">&times;</span>
                        </div>
                        <form action="certificado_alumno.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_alu" value="<?php echo $id_alumno; ?>">
                            <input type="hidden" name="ape1" value="<?php echo $ape1_alum; ?>">
                            <input type="hidden" name="ape2" value="<?php echo $ape2_alum; ?>">
                            <input type="hidden" name="nom" value="<?php echo $nom_alum; ?>">
                            <input type="hidden" name="mat<?php echo $id_certificado; ?>" value="<?php echo $id_mat; ?>">
                            <input type="hidden" name="certificado_actual<?php echo $id_certificado; ?>" value="<?php echo $link_certificado; ?>">
                            <div class="form-group curso_foto_preview">
                                <div class="img-listas-cursos">
                                    <img src="<?php echo $link_certificado; ?>" alt="Imagen de certificado <?php echo $nom_cur; ?>">
                                </div>
                            </div>
                            <div class="form-group sp3">
                                <label for="cert<?php echo $id_certificado; ?>">Certificado</label>
                                <input type="file" name="cert<?php echo $id_certificado; ?>" accept="image/*">
                            </div>
                            <div class="form-group sp2">
                                <label for="act<?php echo $id_certificado; ?>">Estado</label>
                                <select name="act<?php echo $id_certificado; ?>" id="act" required>
                                    <option value="" selected disabled>Seleccione un estado</option>
                                    <option value="0" <?php echo $e0; ?>>Inactivo</option>
                                    <option value="1" <?php echo $e1; ?>>Activo</option>
                                </select>
                            </div>
                            <div class="form-group submit-btn sp3">
                                <button name="actualizar" type="submit" value="<?php echo $id_certificado; ?>" class="btn btn-edit btn-100">Actualizar manualmente</button>
                            </div>
                            <div class="form-group submit-btn sp3">
                                <button name="modalActualizarCertificado" type="button" class="btn btn-edit btn-100" onclick="return actualizarCertificado('<?php echo $id_mat; ?>', '<?php echo $id_alumno; ?>', '<?php echo $id_certificado; ?>');"><ion-icon name="cloud-upload-outline"></ion-icon> Actualizar automáticamente</button>
                            </div>
                        </form>
                    </div>
                </div>
        <?php } ?>
    </div>
</div>

<input type="hidden" id="orderCol" value="0">
<input type="hidden" id="orderType" value="asc">

<script>
    getDataCertificados();

    document.getElementById("campoCertificados").addEventListener("keyup", getDataCertificados)

    function getDataCertificados() {
        let input = document.getElementById("campoCertificados").value;
        let alumno = document.getElementById("id_alumno").value;
        let content = document.getElementById("contentCertificados");
        let orderCol = document.getElementById("orderCol").value;
        let orderType = document.getElementById("orderType").value;
        let url = "table/cargaCertificados.php?id_alumno=" + alumno;
        let formData = new FormData();
        formData.append('campoCertificados', input);
        formData.append('orderCol', orderCol);
        formData.append('orderType', orderType);

        fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data
            }).catch(err => console.log(err))
    }

    let columnas = document.getElementsByClassName("sort");
    let long = columnas.length;
    for (let i = 0; i < long; i++) {
        columnas[i].addEventListener("click", ordenar);
    }

    function ordenar(e) {
        let elemento = e.target

        document.getElementById('orderCol').value = elemento.cellIndex

        if (elemento.classList.contains("asc")) {
            document.getElementById("orderType").value = "asc"
            elemento.classList.remove("asc")
            elemento.classList.add("desc")
        } else {
            document.getElementById("orderType").value = "desc"
            elemento.classList.remove("desc")
            elemento.classList.add("asc")
        }

        getDataCertificados()
    }
</script>