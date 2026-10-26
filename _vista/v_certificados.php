<section class="page-section">
  <div class="page-section__header">
    <h2 class="page-section__title">Certificados</h2>
    <p class="page-section__description">Consulta las certificaciones obtenidas.</p>
  </div>

  <section class="subsection">
    <div class="busqueda">
      <h3>Ingrese DNI: </h3>
      <input placeholder="" class="campo_texto" type="number" name="id" id="dni" min="10000000" max="99999999" required>
      <input placeholder="" class="btn btn--primary" type="submit" id="buscar" value="Buscar">
    </div>
  </section>

  <section class="subsection">
    <div id="content">

    </div>
  </section>
</section><!-- .page-section -->

<input type="hidden" id="orderCol" value="0">
<input type="hidden" id="orderType" value="asc">

<script>
  getDataCertificados();

  document.getElementById("buscar").addEventListener("click", getDataCertificados)

  function getDataCertificados() {
    let input = document.getElementById("dni").value;
    let content = document.getElementById("content");
    let orderCol = document.getElementById("orderCol").value;
    let orderType = document.getElementById("orderType").value;
    let url = "cargaCertificado.php";
    let formData = new FormData();
    formData.append('campoDNI', input);
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

  const campo = document.querySelector('.campo_texto');

  campo.addEventListener('input', function() {
    const valor = this.value.replace(/\D/g, '');
    this.value = valor.slice(0, 8);
  });
</script>