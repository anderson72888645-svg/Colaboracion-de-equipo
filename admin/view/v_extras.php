<div class="tabla tabla-sub">
    <div class="lista">
        <div class="cardHeader">
            <h2>Paises</h2>
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar país" name="campoPais" id="campoPais">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <a href="pais_registrar.php" class="btn btn-new">Nuevo país</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="sortPais asc">Nombre</td>
                    <td class="sortPais asc">Estado</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>

            <tbody id="contentPais">

            </tbody>
        </table>
    </div>

    <div class="lista">
        <div class="cardHeader">
            <h2>Categorias</h2>
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar categoría" name="campoCategoria" id="campoCategoria">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <a href="categoria_registrar.php" class="btn btn-new">Nueva categoría</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td></td>
                    <td class="sortCategoria asc">Nombre</td>
                    <td class="sortCategoria asc">Estado</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>

            <tbody id="contentCategoria">

            </tbody>
        </table>
    </div>

    <h2>Certificados</h2>

    <div class="lista">
        <div class="cardHeader">
            <h2>Tipo</h2>
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar tipo" name="campoTipo" id="campoTipo">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <a href="tipo_registrar.php" class="btn btn-new">Nuevo tipo</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td></td>
                    <td class="sortTipo asc">Nombre</td>
                    <td class="sortTipo asc">Estado</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>

            <tbody id="contentTipo">

            </tbody>
        </table>
    </div>

    <div class="lista">
        <div class="cardHeader">
            <h2>Nivel</h2>
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar nivel" name="campoNivel" id="campoNivel">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <a href="nivel_registrar.php" class="btn btn-new">Nuevo nivel</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td></td>
                    <td class="sortNivel asc">Nombre</td>
                    <td class="sortNivel asc">Estado</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>

            <tbody id="contentNivel">

            </tbody>
        </table>
    </div>
</div>

<input type="hidden" id="orderColPais" value="0">
<input type="hidden" id="orderTypePais" value="asc">

<input type="hidden" id="orderColCategoria" value="0">
<input type="hidden" id="orderTypeCategoria" value="asc">

<input type="hidden" id="orderColTipo" value="0">
<input type="hidden" id="orderTypeTipo" value="asc">

<input type="hidden" id="orderColNivel" value="0">
<input type="hidden" id="orderTypeNivel" value="asc">

<script>
    getDataPais();
    getDataCategoria();
    getDataTipo();
    getDataNivel();

    document.getElementById("campoPais").addEventListener("keyup", getDataPais)
    document.getElementById("campoCategoria").addEventListener("keyup", getDataCategoria)
    document.getElementById("campoTipo").addEventListener("keyup", getDataTipo)
    document.getElementById("campoNivel").addEventListener("keyup", getDataNivel)

    /********************* País *********************/
    function actualizarPais(id) {
        var id_pais = id;
        location.href = "pais_actualizar.php?pais=" + id_pais;
    }

    function getDataPais() {
        let input = document.getElementById("campoPais").value;
        let content = document.getElementById("contentPais");
        let orderColPais = document.getElementById("orderColPais").value;
        let orderTypePais = document.getElementById("orderTypePais").value;
        let url = "table/cargaPais.php";
        let formData = new FormData();
        formData.append('campoPais', input);
        formData.append('orderColPais', orderColPais);
        formData.append('orderTypePais', orderTypePais);

        fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data
            }).catch(err => console.log(err))
    }

    let columnasPais = document.getElementsByClassName("sortPais");
    let longPais = columnasPais.length;
    for (let i = 0; i < longPais; i++) {
        columnasPais[i].addEventListener("click", ordenarPais);
    }

    function ordenarPais(e) {
        let elemento = e.target

        document.getElementById('orderColPais').value = elemento.cellIndex

        if (elemento.classList.contains("asc")) {
            document.getElementById("orderTypePais").value = "asc"
            elemento.classList.remove("asc")
            elemento.classList.add("desc")
        } else {
            document.getElementById("orderTypePais").value = "desc"
            elemento.classList.remove("desc")
            elemento.classList.add("asc")
        }

        getDataPais()
    }

    /********************* Categoría *********************/
    function actualizarCategoria(id) {
        var id_categoria = id;
        location.href = "categoria_actualizar.php?categoria=" + id_categoria;
    }

    function getDataCategoria() {
        let input = document.getElementById("campoCategoria").value;
        let content = document.getElementById("contentCategoria");
        let orderColCategoria = document.getElementById("orderColCategoria").value;
        let orderTypeCategoria = document.getElementById("orderTypeCategoria").value;
        let url = "table/cargaCategoria.php";
        let formData = new FormData();
        formData.append('campoCategoria', input);
        formData.append('orderColCategoria', orderColCategoria);
        formData.append('orderTypeCategoria', orderTypeCategoria);

        fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data
            }).catch(err => console.log(err))
    }

    let columnasCategoria = document.getElementsByClassName("sortCategoria");
    let longCategoria = columnasCategoria.length;
    for (let i = 0; i < longCategoria; i++) {
        columnasCategoria[i].addEventListener("click", ordenarCategoria);
    }

    function ordenarCategoria(e) {
        let elemento = e.target

        document.getElementById('orderColCategoria').value = elemento.cellIndex

        if (elemento.classList.contains("asc")) {
            document.getElementById("orderTypeCategoria").value = "asc"
            elemento.classList.remove("asc")
            elemento.classList.add("desc")
        } else {
            document.getElementById("orderTypeCategoria").value = "desc"
            elemento.classList.remove("desc")
            elemento.classList.add("asc")
        }

        getDataCategoria()
    }

    /********************* Tipo *********************/
    function actualizarTipo(id) {
        var id_tipo = id;
        location.href = "tipo_actualizar.php?tipo=" + id_tipo;
    }

    function getDataTipo() {
        let input = document.getElementById("campoTipo").value;
        let content = document.getElementById("contentTipo");
        let orderColTipo = document.getElementById("orderColTipo").value;
        let orderTypeTipo = document.getElementById("orderTypeTipo").value;
        let url = "table/cargaTipo.php";
        let formData = new FormData();
        formData.append('campoTipo', input);
        formData.append('orderColTipo', orderColTipo);
        formData.append('orderTypeTipo', orderTypeTipo);

        fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data
            }).catch(err => console.log(err))
    }

    let columnasTipo = document.getElementsByClassName("sortTipo");
    let longTipo = columnasTipo.length;
    for (let i = 0; i < longTipo; i++) {
        columnasTipo[i].addEventListener("click", ordenarTipo);
    }

    function ordenarTipo(e) {
        let elemento = e.target

        document.getElementById('orderColTipo').value = elemento.cellIndex

        if (elemento.classList.contains("asc")) {
            document.getElementById("orderTypeTipo").value = "asc"
            elemento.classList.remove("asc")
            elemento.classList.add("desc")
        } else {
            document.getElementById("orderTypeTipo").value = "desc"
            elemento.classList.remove("desc")
            elemento.classList.add("asc")
        }

        getDataTipo()
    }

    /********************* Nivel *********************/
    function actualizarNivel(id) {
        var id_nivel = id;
        location.href = "nivel_actualizar.php?nivel=" + id_nivel;
    }

    function getDataNivel() {
        let input = document.getElementById("campoNivel").value;
        let content = document.getElementById("contentNivel");
        let orderColNivel = document.getElementById("orderColNivel").value;
        let orderTypeNivel = document.getElementById("orderTypeNivel").value;
        let url = "table/cargaNivel.php";
        let formData = new FormData();
        formData.append('campoNivel', input);
        formData.append('orderColNivel', orderColNivel);
        formData.append('orderTypeNivel', orderTypeNivel);

        fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data
            }).catch(err => console.log(err))
    }

    let columnasNivel = document.getElementsByClassName("sortNivel");
    let longNivel = columnasNivel.length;
    for (let i = 0; i < longNivel; i++) {
        columnasNivel[i].addEventListener("click", ordenarNivel);
    }

    function ordenarNivel(e) {
        let elemento = e.target

        document.getElementById('orderColNivel').value = elemento.cellIndex

        if (elemento.classList.contains("asc")) {
            document.getElementById("orderTypeNivel").value = "asc"
            elemento.classList.remove("asc")
            elemento.classList.add("desc")
        } else {
            document.getElementById("orderTypeNivel").value = "desc"
            elemento.classList.remove("desc")
            elemento.classList.add("asc")
        }

        getDataNivel()
    }
</script>