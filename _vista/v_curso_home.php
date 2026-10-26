<section class="page-section">
          <div class="page-section__header">
            <h2 class="page-section__title">Cursos</h2>
            <p class="page-section__description">Cursos 100% virtuales con certificación gratuita diseñados por verdaderos especialistas en su rubro. ¡Cómpralos HOY!</p>
          </div>

          <?php
          foreach ($categoria as $key1) 
          {
            $id_categoria = $key1['id_categoria'];
            $nom_categoria = $key1['nom_categoria'];

           
            ?>
            <section class="subsection">
              <header class="subsection-header">
                <h3><?php echo $nom_categoria; ?></h3>
                <!-- <a href="cursos.php">Ver Todos</a> -->
              </header>

              <div class="slider-courses">
                <div class="l-grid-courses">

                  <?php 
                  $curso = ConsultarCursoCategoria($id_categoria);
                  foreach ($curso as $key) 
                  {
                    $id_curso = $key['id_curso'];
                    $nom_curso = $key['nom_curso'];
                    $desc_curso = $key['desc_curso'];
                    $dur_curso = $key['dur_curso'];
                    $prec_curso = $key['prec_curso'];
                    $dscto_curso = $key['dscto_curso'];
                    $prec = $prec_curso - ($prec_curso*$dscto_curso/100);
                    if($prec==0){$prec="Free";}else{$prec = "S/ ".$prec;}
                    $foto_curso = "admin/".$key['foto_curso'];
                    $vid_curso = $key['vid_curso'];
                    $act_curso = $key['act_curso'];

                    $nom_categoria = $key['nom_categoria'];
                    $nom_docente = $key['nom_docente']." ".$key['ape_docente'];
                    $ruta_foto = "admin/";
                    $foto_docente = $ruta_foto.$key['foto_docente'];
                    $desc_docente = $key['desc_docente'];
                    $nom_pais = $key['nom_pais'];

                    $id_horario = $key['id_horario'];

                    $ref_wsp = "https://cursos.gruporysoft.com/course.php?i=".$id_curso;

                    ?>
                    <article class="card">
                      <a class="card__img" href="course.php?i=<?php echo $id_curso; ?>">
                      <div class="img-container"><img src="<?php echo $foto_curso; ?>" alt="Imágen"></div>
                      </a><!-- .card__img -->
                      <div class="card__body">
                        <a href="course.php?i=<?php echo $id_curso; ?>" style="text-decoration: none;">
                          <h4 class="card__title"><?php echo $nom_curso; ?></h4>
                        </a>
                        <p>Por <strong><?php echo $nom_docente; ?></strong></p>
                        
                        <div class="d-flex justify-content-between prices">
                          <p>
                            <i class="far fa-clock"></i>
                            <?php echo $dur_curso; ?> horas
                          </p>
      
                          <p class="price">
                            <span>S/ <?php echo $prec_curso; ?></span>
                            <span><?php echo $prec; ?></span>
                          </p>
                        </div>
      
                        <div class="card__buttons">
                          <!--
                          <a class="btn btn--outline btn--outline-primary btn--rounded" href="#" data-modal="#modal-cart">
                            <i class="fa fa-shopping-cart"></i>
                          </a>
                          -->

                          <a class="btn btn--outline btn--outline-primary btn--full" onclick="abrirModal('<?php echo $id_curso; ?>','<?php echo $nom_curso; ?>','<?php echo $prec; ?>','<?php echo $id_horario; ?>')" >
                         
                          <!--
                             <a href="#" id="comprar" class="btn btn--outline btn--outline-primary btn--full" data-modal="#modal" data-variable="<?php echo $id_curso; ?>">
                            <a class="btn btn--outline btn--outline-primary btn--full" href="#?text=<?php echo $ref_wsp." %0AQuiero comprar este curso y envio mi captura de pantalla del pago realizado. Por favor enviarme mi usuario de acceso a la plataforma."; ?>" data-text="<?php $nom_curso; ?>" data-action="share/whatsapp/share" target="_blank">
                          -->
                            Comprar ahora
                         </a>
                         <a href="#" id="comprar" data-modal="#modal" ></a>
                        </div>
                      </div><!-- .card__body -->
                    </article>
                    <?php 
                  }
                  ?>

                </div><!-- .l-grid-courses -->
              </div>
            </section>
            <?php
          }
          ?>

         
        </section><!-- .page-section -->