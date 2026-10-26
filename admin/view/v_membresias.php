<div class="tabla tabla-sub">
    <div class="lista" style="overflow-x: auto;">
        <div class="cardHeader">
            <h2>Membresías</h2>
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar membresía" name="campo" id="campo">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <a href="membresias_registrar.php" class="btn btn-new">Nueva membresía</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="sort asc">Nombre</td>
                    <td class="sort asc">Precio</td>
                    <td class="sort asc">Descuento</td>
                    <td>Final</td>
                    <td>Programas</td>
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

<script>
    getDataMembresias();

    document.getElementById("campo").addEventListener("keyup", getDataMembresias)

    function getDataMembresias() {
        let input = document.getElementById("campo").value;
        let content = document.getElementById("content");
        let orderCol = document.getElementById("orderCol").value;
        let orderType = document.getElementById("orderType").value;
        let url = "table/cargaMembresias.php";
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

    function actualizarMembresia(id) {
        var id_membresia = id;
        location.href = "membresias_actualizar.php?membresia=" + id_membresia;
    }

    function programasMembresia(id) {
        var id_membresia = id;
        location.href = "membresias_programas.php?membresia=" + id_membresia;
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

        getDataMembresias()
    }
</script>