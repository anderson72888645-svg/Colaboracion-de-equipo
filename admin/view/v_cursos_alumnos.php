<div class="tabla tabla-sub">
    <div class="lista" style="overflow-x: auto;">
        <div class="cardHeader" style="margin-bottom: 10px;">
            <h2>ALUMNOS - <?php echo $nom_curso; ?></h2>
            <div class="cardHeader">
                <div class="search">
                    <label>
                        <input type="text" placeholder="Buscar alumno" name="campoAlumnos" id="campoAlumnos">
                        <input type="hidden" id="id_curso" value="<?php echo $id_curso_antiguo; ?>">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <th></th>
                <th></th>
                <th class="sort asc">Nombres</th>
                <th class="sort asc">Apellido Paterno</th>
                <th class="sort asc">Apellido Materno</th>
                <th class="sort asc">DNI</th>
                <th class="sort asc">Correo</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>

            <tbody id="contentAlumnos">

            </tbody>
        </table>
    </div>
</div>

<input type="hidden" id="orderCol" value="0">
<input type="hidden" id="orderType" value="asc">

<script>
    getDataAlumnos();

    document.getElementById("campoAlumnos").addEventListener("keyup", getDataAlumnos)

    function getDataAlumnos() {
        let input = document.getElementById("campoAlumnos").value;
        let alumno = document.getElementById("id_curso").value;
        let content = document.getElementById("contentAlumnos");
        let orderCol = document.getElementById("orderCol").value;
        let orderType = document.getElementById("orderType").value;
        let url = "table/cargaCursosAlumnos.php?id_curso=" + alumno;
        let formData = new FormData();
        formData.append('campoAlumnos', input);
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

        getDataAlumnos()
    }
</script>