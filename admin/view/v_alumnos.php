<div class="tabla tabla-sub">
    <div class="lista" style="overflow-x: auto;">
        <div class="cardHeader">
            <h2>Alumnos</h2>
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar alumno" name="campo" id="campo">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
        </div>

        <table>
            <thead>
                <th></th>
                <th></th>
                <th class="sort asc">Nombres</th>
                <th class="sort asc">Apellidos</th>
                <th class="sort asc">DNI</th>
                <th class="sort asc">Email</th>
                <th class="sort asc">Estado</th>
                <th>Certificados Pendientes</th>
                <th></th>
                <th></th>
            </thead>

            <tbody id="content">

            </tbody>
        </table>

        <!-- Modales para cada alumno -->
        <?php
        foreach ($alumnos as $key => $value) {
            $id_alum = $value['id_alum'];
            $nom_alum = $value['nom_alum'];
            $ape1_alum = $value['ape1_alum'];
            $ape2_alum = $value['ape2_alum'];
            $dni_alum = $value['dni_alum'];
            $tel_alum = $value['tel_alum'];
            $email = $value['email_alum'];
            $fec_nac_alum = $value['fec_nac_alum'];
            $dir_alum = $value['dir_alum'];
            $pass_alum = $value['pass_alum'];
            $foto_alum = "https://educatecvirtual.com/intranet/foto/alumno/" . $value['foto_alum'];
            $act_alum = $value['act_alum'];
            $ucrea_alum = $value['ucrea_alum'];
            $uedit_alum = $value['uedit_alum'];
            $fcrea_alum = $value['fcrea_alum'];
            $fedit_alum = $value['fedit_alum'];
            $hcrea_alum = $value['hcrea_alum'];
            $hedit_alum = $value['hedit_alum'];

            if ($act_alum == 0) {
                $nom_estado = "Inactivo";
            } else {
                $nom_estado = "Activo";
            }

            if ($foto_alum == "https://educatecvirtual.com/intranet/foto/alumno/sinfoto.png") {
                $foto_alum = "img/bx_user.svg";
            }
        ?>
            <div id="modal<?php echo $id_alum; ?>" class="modal">
                <div class="modal-content">
                    <div class="cardHeader">
                        <h2>DETALLE DE ALUMNO</h2>
                        <span class="close" onclick="closeModal('<?php echo $id_alum; ?>')">&times;</span>
                    </div>
                    <div class="modal-informacion">
                        <div class="modal-group modal-foto">
                            <div class="img-modal">
                                <img src="<?php echo $foto_alum; ?>" alt="Imagen de alumno <?php echo $nom_alum; ?>">
                            </div>
                        </div>
                        <div class="modal-group sp2">
                            <label for="nom">Nombres</label>
                            <input type="text" name="nom" value="<?php echo $nom_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="dni">DNI</label>
                            <input type="number" name="dni" value="<?php echo $dni_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="ape1">Apellido Paterno</label>
                            <input type="text" name="ape1" value="<?php echo $ape1_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="ape2">Apellido Materno</label>
                            <input type="text" name="ape2" value="<?php echo $ape2_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="nac">Fecha de nacimient</label>
                            <input type="date" name="nac" value="<?php echo $fec_nac_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="tel">Teléfono</label>
                            <input type="tel" name="tel" value="<?php echo $tel_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="dir">Dirección</label>
                            <input type="text" name="dir" value="<?php echo $dir_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="est">Estado</label>
                            <input type="text" name="est" value="<?php echo $nom_estado; ?>" readonly>
                        </div>
                        <div class="modal-group sp3">
                            <label for="ema">Email</label>
                            <input type="email" name="ema" value="<?php echo $email; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="pas">Password</label>
                            <input type="password" name="pas" value="<?php echo $pass_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="fec_cre">Fecha de creación</label>
                            <input type="date" name="fec_cre" value="<?php echo $fcrea_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="hor_cre">Hora de creación</label>
                            <input type="time" name="hor_cre" value="<?php echo $hcrea_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="fec_act">Fecha de actualización</label>
                            <input type="date" name="fec_act" value="<?php echo $fedit_alum; ?>" readonly>
                        </div>
                        <div class="modal-group sp1">
                            <label for="hor_act">Hora de actualización</label>
                            <input type="time" name="hor_act" value="<?php echo $hedit_alum; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<input type="hidden" id="orderCol" value="0">
<input type="hidden" id="orderType" value="asc">

<script>
    getDataAlumnos();

    document.getElementById("campo").addEventListener("keyup", getDataAlumnos)

    function getDataAlumnos() {
        let input = document.getElementById("campo").value;
        let content = document.getElementById("content");
        let orderCol = document.getElementById("orderCol").value;
        let orderType = document.getElementById("orderType").value;
        let url = "table/cargaAlumnos.php";
        let formData = new FormData();
        formData.append('campo', input);
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

    function certificadoAlumno(data) {
        var id_alumno = data.value;
        $.post("certificado_alumnno.php", {
            id_alumno: id_alumno
        });
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

        getDataAlumnos()
    }
</script>