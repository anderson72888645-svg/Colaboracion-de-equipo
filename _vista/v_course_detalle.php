<!-- Course -->
 <article class="card card--course-desc">
            <div class="card__img">
              <!--
                <iframe src="https://player.vimeo.com/video/512082463?app_id=122963" width="640" height="350" frameborder="0" allow="autoplay; fullscreen" data-ready="true"></iframe>
              -->
              <img src="<?php echo $foto_curso; ?>" alt="Imágen">
                </div><!-- .card__img -->
            <div class="card__body">
              <h4 class="card__title"><?php echo $nom_curso; ?></h4>
              <p class="card__author">Por <strong><?php echo $nom_docente; ?></strong></p>

              <p class="card__text"><?php echo $desc_curso; ?></p>
              
              <div class="d-flex justify-content-between prices">
                <div>
                  <p class="discount">
                    <?php echo $dscto_curso; ?>% de dscto.
                  </p>
                </div>

                <p class="price">
                  <span>S/ <?php echo $prec_curso; ?></span>
                  <span><?php echo $prec; ?></span>
                </p>
              </div>

              <div class="d-flex justify-content-between prices align-items-center course-icons">
                <p>
                  <i class="far fa-clock"></i>
                  <?php echo $dur_curso; ?> horas
                </p>

                <p>
                  <i class="fa fa-video"></i>
                  <!-- <i class="fa fa-download"></i> -->
                  <?php echo $vid_curso; ?> videos
                </p>

                <p>
                   <!--
                  <i class="far fa-star"></i>
                  4.2 -->
                </p>
              </div>

              <div class="card__buttons">
                <!--
                  <a class="btn btn--outline btn--outline-primary btn--rounded" href="#">
                  <i class="fa fa-shopping-cart"></i>
                </a>
                -->


                 <!--
                  <a class="btn btn--outline btn--outline-primary btn--full" href="#?text=<?php echo $ref_wsp." %0AQuiero comprar este curso y envio mi captura de pantalla del pago realizado. Por favor enviarme mi usuario de acceso a la plataforma."; ?>" data-text="<?php $nom_curso; ?>" data-action="share/whatsapp/share" target="_blank">
                -->
                <a class="btn btn--outline btn--outline-primary btn--full" onclick="abrirModal('<?php echo $id_curso; ?>','<?php echo $nom_curso; ?>','<?php echo $prec; ?>','<?php echo $id_horario; ?>')" > 
                 Comprar ahora
                </a>
                <a href="#" id="comprar" data-modal="#modal" ></a>
              </div>
            </div><!-- .card__body -->
</article><!-- .card -->
<!-- End Course -->
