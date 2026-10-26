<div class="tabla tabla-sub">
    <div class="lista" style="overflow-x: auto;">
        <div class="cardHeader">
            <h2>Programas</h2>
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar programa" name="campo" id="campo">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <a href="programas_registrar.php" class="btn btn-new">Nuevo programa</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="sort asc">Nombre</td>
                    <td class="sort asc">Precio</td>
                    <td>Cursos</td>
                    <td>Preguntas</td>
                    <td class="sort asc">Estado</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>

            <tbody id="content">

            </tbody>
        </table>
    </div>
</div>

<input type="hidden" id="orderCol" value="0">
<input type="hidden" id="orderType" value="asc">

<script type="text/javascript">
    getDataProgramas();

    document.getElementById("campo").addEventListener("keyup", getDataProgramas)

    function getDataProgramas() {
        let input = document.getElementById("campo").value;
        let content = document.getElementById("content");
        let orderCol = document.getElementById("orderCol").value;
        let orderType = document.getElementById("orderType").value;
        let url = "table/cargaProgramas.php";
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

    function cursosPrograma(id) {
        var id_curso = id;
        location.href = "programas_cursos.php?programa=" + id_curso;
    }

    function preguntasPrograma(id) {
        var id_curso = id;
        location.href = "programas_preguntas.php?programa=" + id_curso;
    }

    function actualizarPrograma(id) {
        var id_curso = id;
        location.href = "programas_actualizar.php?programa=" + id_curso;
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

        getDataProgramas()
    }
</script>