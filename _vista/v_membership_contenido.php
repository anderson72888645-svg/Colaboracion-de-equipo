<!-- End Course -->
<div class="card" style="margin-top: 30px;">
  <div class="center tabs__wrapper">
    <nav class="navbar-tabs" data-tabs="tabs">
      <a href="#contenido" class="nav-link active">Contenido</a>
      <a href="#docente" class="nav-link">Acerca del docente</a>
    </nav>
    <div class="tabs" id="tabs">
      <div class="tabs-content">
        <section id="contenido" class="tab-active">
          <div class="accordion">
            <?php
            $n = 0;
            foreach ($membresia_cursos as $key => $value) {
              $n++;
              $id_curso = $value['id_curso'];
              $id_horario = $value['id_horario'];
              $nom_curso = $value['nom_curso'];
              $desc_curso = $value['desc_curso'];
              $dur_curso = $value['dur_curso'];
              $vid_curso = $value['vid_curso'];
              $act_curso = $value['act_curso'];
            ?>
              <header>
                <h3>
                  <strong>Curso <?php echo $n; ?>:</strong> <?php echo $nom_curso; ?>
                </h3>
              </header>
              <div class="panel course-desc">
                <p><?php echo $desc_curso; ?></p>
                <h4>Temas</h4>
                <ul>
                  <?php
                  $temas = MembresiaCursosTemas($id_curso);
                  foreach ($temas as $key2 => $value2) {
                    $tema = $value2['tema'];
                  ?>
                      <li><?php echo $tema; ?></li>
                  <?php
                  }
                  ?>
                </ul>
                <div class="course-desc__foot">
                  <p><?php echo $dur_curso; ?> horas</p>
                  <p><?php echo $vid_curso; ?> videos</p>
                </div>
              </div>
            <?php } ?>
          </div>
        </section>
        <section id="docente">
          <?php
          foreach ($membresia_docentes as $key2 => $value2) {
            $nombre = $value2['nom_docente'];
            $apellido = $value2['ape_docente'];
            $descripcion = $value2['desc_docente'];
            $foto = "admin/" . $value2['foto_docente'];
            if (!file_exists($foto)) {
              $foto = "admin/img/bx_user.svg";
            }
          ?>
            <div class="docente">
              <div class="docente__header">
                <img src="<?php echo $foto; ?>" alt="Docente">
                <h2><?php echo $nombre . ' ' . $apellido; ?></h2>
              </div>
              <p><?php echo $descripcion; ?></p>
            </div>
          <?php } ?>
        </section>
      </div>
    </div>
  </div>
</div>