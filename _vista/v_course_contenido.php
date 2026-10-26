 <div class="card" style="margin-top: 30px;">
            <div class="center tabs__wrapper">
              <nav class="navbar-tabs" data-tabs="tabs">
                <a href="#contenido" class="nav-link active">Contenido</a>
                <a href="#docente" class="nav-link">Acerca del docente</a>
                <a href="#faq" class="nav-link">Preguntas frecuentes</a>
              </nav>
              <div class="tabs" id="tabs">
                <div class="tabs-content">
                  
                  <section id="contenido" class="tab-active">
                    <div class="accordion">

                      <?php 
                      foreach ($curso_contenido as $key) 
                      {
                        $id_curso_contenido = $key['id_curso_contenido'];
                        $cod_curso_contenido = $key['cod_curso_contenido'];
                        $nom_curso_contenido = $key['nom_curso_contenido'];
                        $desc_curso_contenido = $key['desc_curso_contenido'];
                        ?>
                        <header>
                          <h3>
                            <strong><?php echo $cod_curso_contenido.":"; ?></strong> <?php echo $nom_curso_contenido; ?>
                          </h3>
                        </header>
                        <div class="panel course-desc">
                          <p><?php echo $desc_curso_contenido; ?></p>
                          <h4>Temas:</h4>
                          <ul>
                            <?php
                            $curso_contenido_tema = ConsultarCursoContenidoTema($id_curso_contenido);
                            foreach ($curso_contenido_tema as $key1) 
                            {
                              $nom_curso_contenido_tema = $key1['nom_curso_contenido_tema'];
                              ?>
                              <li><?php echo $nom_curso_contenido_tema; ?></li>
                              <?php
                            }
                            ?>

                          </ul>
                          
                          <div class="course-desc__foot">
                            <!--
                            <p><?php //echo $dur_curso." horas"; ?></p>
                            <p><?php //echo $vid_curso." videos"; ?></p>
                            <p>6 evaluaciones</p>
                            <p> 75 materiales</p>
                            -->
                          </div>
                          
                        </div>
                        <?php 
                      }
                      ?>

                    </div>
                  </section>

                  <section id="docente">
                    <div class="docente">
                      <div class="docente__header">
                        <img src="<?php echo $foto_docente ?>" alt="Docente">
                        <h2><?php echo $nom_docente; ?></h2>
                      </div>
                      <p><?php echo $desc_docente; ?></p>
                    </div>
                  </section>

                  <section id="faq">
                  <?php
                  foreach ($curso_pregunta as $key1) 
                  {
                      $nom_curso_pregunta = $key1['nom_curso_pregunta'];
                      $desc_curso_pregunta = $key1['desc_curso_pregunta'];
                      ?>
                      <article class="course-faq">
                        <h4><?php echo $nom_curso_pregunta; ?></h4>
                        <p><?php echo $desc_curso_pregunta; ?></p>
                      </article>
                      <?php 
                  }
                   ?> 
                  </section>

                </div>
              </div>
            </div>
          </div>