<div class="tabla tabla-sub">
    <div class="lista">
        <div class="cardHeader">
            <h2>Docentes</h2>
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar docente" name="campo" id="campo">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <a href="docentes_registrar.php" class="btn btn-new">Nuevo docente</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="sort asc">Nombre</td>
                    <td class="sort asc">Apellido</td>
                    <td class="sort asc">DNI</td>
                    <td class="sort asc">País</td>
                    <td class="sort asc">Estado</td>
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

<script>
    getDataDocentes();

    document.getElementById("campo").addEventListener("keyup", getDataDocentes)

    function getDataDocentes() {
        let input = document.getElementById("campo").value;
        let content = document.getElementById("content");
        let orderCol = document.getElementById("orderCol").value;
        let orderType = document.getElementById("orderType").value;
        let url = "table/cargaDocentes.php";
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

    function actualizarDocente(id) {
        var id_docente = id;
        location.href = "docentes_actualizar.php?docente=" + id_docente;
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

        getDataDocentes()
    }
</script>