let list = document.querySelectorAll(".menu li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

let toggle = document.querySelector(".toggle");
let menu = document.querySelector(".menu");
let main = document.querySelector(".main");

toggle.onclick = function () {
  menu.classList.toggle("active");
  main.classList.toggle("active");
};

function agregarCampoModulo(id) {
  var id_curso = id;
  let camposModulos = document.getElementById("camposModulos");
  let cantidadModulos = camposModulos.querySelectorAll(".cod-contenido").length + 1;

  let nuevoModulo = document.createElement("div");
  nuevoModulo.classList.add("nuevo");
  nuevoModulo.innerHTML = `
  <form action="modulos.php" method="post">
    <h2 class="tit-contenido sp6">Módulo ${cantidadModulos}</h2>
    <div class="form-group sp2 cod-contenido">
        <label for="cod-nom">Código de contenido</label>
        <input type="text" name="cod-con" value="Módulo ${cantidadModulos}" required>
    </div>
    <div class="form-group sp2">
        <label for="nom-con">Nombre de contenido</label>
        <input type="text" name="nom-con" required>
    </div>
    <div class="form-group sp2">
        <label for="est-con">Estado de contenido</label>
        <select name="est-con" id="est-con" required>
            <option value="" selected disabled>Seleccione un estado</option>
            <option value="0">Inactivo</option>
            <option value="1">Activo</option>
        </select>
    </div>
    <div class="form-group sp4">
        <label for="des-con">Descripción de contenido</label>
        <input type="text" name="des-con" required>
    </div>

    <div class="form-group sp2 botones">
      <button type="submit" name="registrarModulo" value="${id_curso}" class="btn btn-new">Registrar</button>
      <button type="button" onclick="recargarPagina()" class="btn btn-delete">Cancelar</button>
    </div>
    </form>
  `;

  camposModulos.appendChild(nuevoModulo);
}

function agregarCampoTema(numeroModulo, curso) {
  var id_curso = curso;
  let camposTemas = document.getElementById(`camposTemas${numeroModulo}`);
  let cantidadTemas = camposTemas.querySelectorAll(".nom-tema").length + 1;

  let nuevoTema = document.createElement("div");
  nuevoTema.classList.add("nuevo");
  nuevoTema.classList.add("sp6");
  nuevoTema.innerHTML = `
        <form action="modulos.php" method="post" class="form-tema">
          <input type="hidden" name="id_curso" value="${id_curso}">
          <h2 class="tit-contenido sp6">Tema ${cantidadTemas}</h2>
          <div class="form-group sp2 nom-tema">
              <label for="nom-tema">Nombre de tema</label>
              <input type="text" name="nom-tema" required>
          </div>
          <div class="form-group sp2">
              <label for="est-tema">Estado de tema</label>
              <select name="est-tema" id="est-tema" required>
                  <option value="" selected disabled>Seleccione un estado</option>
                  <option value="0">Inactivo</option>
                  <option value="1">Activo</option>
              </select>
          </div>

          <div class="form-group sp2 botones">
            <button type="submit" name="registrarTema" class="btn btn-new" value="${numeroModulo}">Registrar</button>
            <button type="button" onclick="recargarPagina()" class="btn btn-delete">Cancelar</button>
          </div>
        </form>
        `;
  camposTemas.appendChild(nuevoTema);

}

function agregarCampoPregunta(id) {
  var id_curso = id;
  let camposPreguntas = document.getElementById("camposPreguntas");

  let cantidadPreguntas = camposPreguntas.querySelectorAll(".pregunta").length + 1;

  let nuevaPregunta = document.createElement("div");
  nuevaPregunta.classList.add("nuevo");
  nuevaPregunta.innerHTML = `
  <form action="preguntas.php" method="post">
    <h2 class="tit-contenido sp6">Pregunta ${cantidadPreguntas}</h2>
    <div class="form-group sp4 pregunta">
        <label for="pre">Pregunta</label>
        <input type="text" name="pre" required>
    </div>
    <div class="form-group sp2">
        <label for="act-pre">Estado</label>
        <select name="act-pre" id="act-pre" required>
            <option value="" selected disabled>Seleccione un estado</option>
            <option value="0">Inactivo</option>
            <option value="1">Activo</option>
        </select>
    </div>
    <div class="form-group sp4">
        <label for="desc-pre">Respuesta</label>
        <input type="text" name="desc-pre" required>
    </div>
    <div class="form-group botones sp2">
      <button type="submit" name="registrarPregunta" value="${id_curso}" class="btn btn-new">Registrar</button>
      <button type="button" onclick="recargarPagina()" class="btn btn-delete">Cancelar</button>
    </div>
  </form>
  `;

  camposPreguntas.appendChild(nuevaPregunta);
}

function agregarCampoMembresiaPrograma(id) {
  var id_membresia = id;
  let camposMembresiaPrograma = document.getElementById("camposMembresiaPrograma");

  let cantidadMembresiaPrograma = camposMembresiaPrograma.querySelectorAll(".memPrograma").length + 1;

  let nuevaMembresiaPrograma = document.createElement("div");
  nuevaMembresiaPrograma.classList.add("nuevo");
  nuevaMembresiaPrograma.innerHTML = `
  <form action="membresias_programas.php" method="post">
    <h2 class="tit-contenido sp6">Programa ${cantidadMembresiaPrograma}</h2>
    <div class="form-group sp2 memPrograma">
      <label for="mem-pro">Programa</label>
      <select name="mem-pro" data-id="${cantidadMembresiaPrograma}" id="mem-pro" required>
        <option value="" selected disabled>Seleccione un estado</option>
      </select>
    </div>
    <div class="form-group sp2">
      <label for="act-pro">Estado</label>
      <select name="act-pro" id="act-pro" required>
        <option value="" selected disabled>Seleccione un estado</option>
        <option value="0">Inactivo</option>
        <option value="1">Activo</option>
      </select>
    </div>
    <div class="form-group sp2 botones">
      <button type="submit" name="registrarMembresiaPrograma" value="${id_membresia}" class="btn btn-new">Registrar</button>
      <button type="button" onclick="recargarPagina()" class="btn btn-delete">Cancelar</button>
    </div>
  </form>
  `;

  camposMembresiaPrograma.appendChild(nuevaMembresiaPrograma);

  cargarProgramas(cantidadMembresiaPrograma);
}

function agregarCampoProgramaCurso(id) {
  var id_programa = id;
  let camposProgramaCurso = document.getElementById("camposProgramasCursos");

  let cantidadProgramaCurso = camposProgramaCurso.querySelectorAll(".proCurso").length + 1;

  let nuevaProgramaCurso = document.createElement("div");
  nuevaProgramaCurso.classList.add("nuevo");
  nuevaProgramaCurso.innerHTML = `
  <form action="programas_cursos.php" method="post">
    <h2 class="tit-contenido sp6">Programa ${cantidadProgramaCurso}</h2>
    <div class="form-group sp2 proCurso">
      <label for="pro_cur">Programa</label>
      <select name="pro_cur" data-id="${cantidadProgramaCurso}" id="mem-pro" required>
        <option value="" selected disabled>Seleccione un estado</option>
      </select>
    </div>
    <div class="form-group sp2">
      <label for="act-cur">Estado</label>
      <select name="act-cur" id="act-cur" required>
        <option value="" selected disabled>Seleccione un estado</option>
        <option value="0">Inactivo</option>
        <option value="1">Activo</option>
      </select>
    </div>
    <div class="form-group sp2 botones">
      <button type="submit" name="registrarProgramaCurso" value="${id_programa}" class="btn btn-new">Registrar</button>
      <button type="button" onclick="recargarPagina()" class="btn btn-delete">Cancelar</button>
    </div>
  </form>
  `;

  camposProgramaCurso.appendChild(nuevaProgramaCurso);

  cargarCursos(cantidadProgramaCurso);
}

function agregarCampoProgramaPregunta(id) {
  var id_programa = id;
  let camposProgramasPreguntas = document.getElementById("camposProgramasPreguntas");

  let cantidadProgramasPreguntas = camposProgramasPreguntas.querySelectorAll(".proPregunta").length + 1;

  let nuevaProgramaPregunta = document.createElement("div");
  nuevaProgramaPregunta.classList.add("nuevo");
  nuevaProgramaPregunta.innerHTML = `
  <form action="programas_preguntas.php" method="post">
    <h2 class="tit-contenido sp6">Pregunta ${cantidadProgramasPreguntas}</h2>
    <div class="form-group sp4 proPregunta">
      <label for="preg_pro_pre">Pregunta</label>
      <input type="text" name="preg_pro_pre" required>
    </div>
    <div class="form-group sp2">
      <label for="act_pro_pre">Estado</label>
      <select name="act_pro_pre" id="act_pro_pre" required>
        <option value="" selected disabled>Seleccione un estado</option>
        <option value="0">Inactivo</option>
        <option value="1">Activo</option>
      </select>
    </div>
      <div class="form-group sp4">
        <label for="rpta_pro_pre">Respuesta</label>
        <input type="text" name="rpta_pro_pre" required>
    </div>
    <div class="form-group sp2 botones">
      <button type="submit" name="registrarProgramaPregunta" value="${id_programa}" class="btn btn-new">Registrar</button>
      <button type="button" onclick="recargarPagina()" class="btn btn-delete">Cancelar</button>
    </div>
  </form>
  `;

  camposProgramasPreguntas.appendChild(nuevaProgramaPregunta);
}

function cargarProgramas(id) {
  let selectProgramas = document.querySelector(`select[data-id="${id}"]`);

  if (typeof programas !== 'undefined') {
    programas.forEach(programa => {
      let option = document.createElement('option');
      option.value = programa.id_programa;
      option.textContent = programa.nom_programa;
      selectProgramas.appendChild(option);
    });
  } else {
    console.error('Los datos de programas no están disponibles');
  }
}

function cargarCursos(id) {
  let selectCursos = document.querySelector(`select[data-id="${id}"]`);

  if (typeof cursos !== 'undefined') {
    cursos.forEach(cursos => {
      let option = document.createElement('option');
      option.value = cursos.id_curso;
      option.textContent = cursos.nom_curso;
      selectCursos.appendChild(option);
    });
  } else {
    console.error('Los datos de cursos no están disponibles');
  }
}

function recargarPagina() {
  location.reload();
}

/* VALIDAR DATOS INTRODUCIDOS */
function validarTexto(input) {
  const regex = /^[a-zA-ZÀ-ÿ\s]*$/;

  if (!regex.test(input.value)) {
    input.value = input.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
  }
}

/************************** MODAL **************************/
/* Alumno */
function modalAlumno(id) {
  var modal = document.getElementById('modal' + id);
  modal.style.display = "block";
}

function closeModal(id) {
  var modal = document.getElementById('modal' + id);
  modal.style.display = "none";
}

/* Certificados */
function modalCertificado(id) {
  var modal = document.getElementById('modalCertificado' + id);
  modal.style.display = "block";
}

function closeModalCertificado(id) {
  var modal = document.getElementById('modalCertificado' + id);
  modal.style.display = "none";
}

function modalRegistrarCertificado(id) {
  var modal = document.getElementById('modalRegistrarCertificado' + id);
  modal.style.display = "block";
}

function closeModalRegistrarCertificado(id) {
  var modal = document.getElementById('modalRegistrarCertificado' + id);
  modal.style.display = "none";
}

function modalActualizarCertificado(id) {
  var modal = document.getElementById('modalActualizarCertificado' + id);
  modal.style.display = "block";
}

function closeModalActualizarCertificado(id) {
  var modal = document.getElementById('modalActualizarCertificado' + id);
  modal.style.display = "none";
}

/* Horarios Cursos */
function modalRegistrarHorario(id) {
  var modal = document.getElementById('modalRegistrarHorario' + id);
  modal.style.display = "block";
}

function closeModalRegistrarHorario(id) {
  var modal = document.getElementById('modalRegistrarHorario' + id);
  modal.style.display = "none";
}

function modalActualizarHorario(id) {
  var modal = document.getElementById('modalActualizarHorario' + id);
  modal.style.display = "block";
}

function closeModalActualizarHorario(id) {
  var modal = document.getElementById('modalActualizarHorario' + id);
  modal.style.display = "none";
}

/* Certificados alumnos */
function certificadoAlumno(id) {
  var id_alumno = id;
  location.href = "certificado_alumno.php?alumno=" + id_alumno;
}

function generarCertificado(idmat, idalum) {
  var id_matricula = idmat;
  var id_alumno = idalum;
  location.href = "table/generarCertificado.php?id_matricula=" + id_matricula + "&id_alumno=" + id_alumno;
}

function actualizarCertificado(idmat, idalum, idcert) {
  var id_matricula = idmat;
  var id_alumno = idalum;
  var id_certificado = idcert;
  location.href = "table/actualizarCertificado.php?id_matricula=" + id_matricula + "&id_alumno=" + id_alumno + "&id_certificado=" + id_certificado;
}