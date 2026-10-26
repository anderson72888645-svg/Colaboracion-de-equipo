<div class="tabla tabla-sub">
    <div class="lista" style="overflow-x: auto;">
        <div class="cardHeader">
            <h2>Cursos</h2>
            <div class="search">
                <label>
                    <input type="text" placeholder="Buscar curso" name="campo" id="campo">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <a href="cursos_registrar.php" class="btn btn-new">Nuevo curso</a>
        </div>

        <table id="tablaCursos">
            <thead>
                <tr>
                    <td></td>
                    <td class="sort asc">Nombre</td>
                    <td class="sort asc">Docente</td>
                    <td class="sort asc">Categoria</td>
                    <td class="sort asc">Precio</td>
                    <td class="sort asc">Descuento</td>
                    <td>Final</td>
                    <td class="sort asc">Estado</td>
                    <td>Módulos</td>
                    <td>Preguntas</td>
                    <td>Alumnos</td>
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
    getDataCursos();

    /* Cargar datos y filtrar por busqueda */
    document.getElementById("campo").addEventListener("keyup", getDataCursos)

    function getDataCursos() {
        let input = document.getElementById("campo").value;
        let content = document.getElementById("content");
        let orderCol = document.getElementById("orderCol").value;
        let orderType = document.getElementById("orderType").value;
        let url = "table/cargaCursos.php";
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

    /* Ordenar por columna */

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

        getDataCursos()
    }

    /* Acciones de botones */
    function modulosCurso(id) {
        var id_curso = id;
        location.href = "modulos.php?curso=" + id_curso;
    }

    function preguntasCurso(id) {
        var id_curso = id;
        location.href = "preguntas.php?curso=" + id_curso;
    }

    function actualizarCurso(id) {
        var id_curso = id;
        location.href = "cursos_actualizar.php?curso=" + id_curso;
    }
    
    function alumnosCurso(id) {
        var id_curso = id;
        location.href = "cursos_alumnos.php?curso=" + id_curso;
    }
</script>