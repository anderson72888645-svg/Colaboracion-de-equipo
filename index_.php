<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <?php
  require("_vista/v_estilos.php");
  ?>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script type="text/javascript">
    function Inscribirse() //original
    {

      var nom = $("#nom_").val();
      var dni = $("#dni_").val();
      var cel = $("#cel_").val();
      var correo = $("#correo_").val();

      var course_ = $("#course").val();
      var opciones = course_.split("|");
      var course = opciones[0];
      var nom_ = opciones[1];
      var prec_ = opciones[2];
      var hor_ = opciones[3];


      if (course_ == "") {
        //alert("Seleccion un curso");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Elegir curso",
          text: "Debe seleccionar un curso",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      } else if (nom == "" || dni == "" || cel == "" || correo == "") {
        //alert("Complete todos los campos");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Campos vacíos",
          text: "Debe completar todos sus datos",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      } else {
        /*
        Swal.fire({
          title: "¡A solo un paso!",
          text: "Escanea el QR o yapea al CONTACTO_CONFIGURABLE y luego dale clic en Comprar.",
          imageUrl: "https://cursos.gruporysoft.com/admin/img/mediopago/yape.jpeg",
          imageWidth: 400,
          //imageHeight: 200,
          confirmButtonColor: "#bf0e09",
          confirmButtonText: "Comprar",
          imageAlt: "Yapear"
        }).then((result) => {
          if (result.isConfirmed) {
            //var ref_wsp = "https://cursos.gruporysoft.com/course.php?i="+course+"%0A%0ANombres: "+nom+"%0ADNI: "+dni+"%0ACelular: "+cel+"%0AEmail: "+correo+"%0A%0AQuiero comprar este curso y envio mi captura de pantalla del pago realizado. Por favor enviarme mi usuario de acceso a la plataforma.";
            var ref_wsp = "https://cursos.gruporysoft.com/course.php?i="+course+"%0A%0ANombres: "+nom+"%0ADNI: "+dni+"%0ACelular: "+cel+"%0AEmail: "+correo+"%0A%0AHola acabo de comprar el curso, por favor enviarme mi usuario de acceso a la plataforma.";
            //location.href="#?text="+ref_wsp;
           window.open('#?text='+ref_wsp, '_blank');
          }
        });
        */
        $("#nom").val(nom);
        $("#dni").val(dni);
        $("#cel").val(cel);
        $("#correo").val(correo);

        abrirModal(course, nom_, prec_, hor_);

      }


    }

    function InscribirseModal() //original
    {

      var nom = $("#nom").val();
      var dni = $("#dni").val();
      var cel = $("#cel").val();
      var correo = $("#correo").val();
      var course = $("#course_modal").val();


      if (course == null) {
        //alert("Seleccion un curso");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Elegir curso",
          text: "Debe seleccionar un curso",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      } else if (nom == "" || dni == "" || cel == "" || correo == "") {
        //alert("Complete todos los campos");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Campos vacíos",
          text: "Debe completar todos sus datos",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      } else {
        var ref_wsp = "https://cursos.gruporysoft.com/course.php?i=" + course + "%0A%0ANombres: " + nom + "%0ADNI: " + dni + "%0ACelular: " + cel + "%0AEmail: " + correo + "%0A%0AHola acabo de comprar el curso, por favor enviarme mi usuario de acceso a la plataforma.";
        //location.href="#?text="+ref_wsp;
        window.open('#?text=' + ref_wsp, '_blank');
      }


    }

    function abrirModal(id, nom, prec, hor) //original
    {

      document.getElementById('datos').click();

      var miEnlace = document.getElementById('pago');
      miEnlace.href = 'javascript:void(0)';

      var miEnlace2 = document.getElementById('fin');
      miEnlace2.href = 'javascript:void(0)';

      document.getElementById('course_modal').value = id;
      document.getElementById('id_horario').value = hor;
      document.getElementById('nom_curso').value = nom;
      document.getElementById('text_curso').innerHTML = nom + " (" + prec + ")";

      if (prec == "Free") {
        var seccion = document.getElementById("nofree");
        seccion.style.display = "none";

        var seccion3 = document.getElementById("nofreet");
        seccion3.style.display = "none";

        var seccion2 = document.getElementById("free");
        seccion2.style.display = "block";
      } else {
        var seccion = document.getElementById("nofree");
        seccion.style.display = "block";

        var seccion3 = document.getElementById("nofreet");
        seccion3.style.display = "block";

        var seccion2 = document.getElementById("free");
        seccion2.style.display = "none";
      }

      document.getElementById('comprar').click(); //para abrir modal


      //Para poer el precio en imput (Izipay)
      var prec = prec.replace("S/ ", "");
      document.getElementById('prech').value = prec;


    }

    function Continuar() //original
    {

      var nom = $("#nom").val();
      var dni = $("#dni").val();
      var cel = $("#cel").val();
      var course = $("#course_modal").val();

      //Para Izipay
      var correo = $("#correo").val();
      var prech = $("#prech").val();


      if (course == null) {
        //alert("Seleccion un curso");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Elegir curso",
          text: "Debe seleccionar un curso",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      } else if (nom == "" || dni == "" || cel == "" || correo == "") {
        //alert("Complete todos los campos");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Campos vacíos",
          text: "Debe completar todos sus datos",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      } else {

        var response = 1;
        //var response = grecaptcha.getResponse();

        if (response.length == 0) {
          //alert("Captcha no verificado")
          Swal.fire({
            //icon: "error",
            icon: "warning",
            title: "Captcha no verificado",
            text: "Verificar código Captcha",
            confirmButtonColor: "#bf0e09",
            //footer: '<a href="#">Why do I have this issue?</a>'
          });
        } else {

          var miEnlace = document.getElementById('datos');
          miEnlace.href = 'javascript:void(0)';

          var form = new FormData();
          form.append('amount', prech);
          form.append('email', correo);

          $.ajax({
            url: "_vista/izipay.php",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            success: function(mensaje) {

              $('#nofree_tarjeta').html(mensaje);

            }
          });



          //alert("Captcha verificado");

          var miEnlace = document.getElementById('pago');
          miEnlace.href = '#pago';

          document.getElementById('pago').click();
        }


      }


    }

    function Continuar2(free) //original
    {
      var nom = $("#nom").val();
      var dni = $("#dni").val();
      var cel = $("#cel").val();
      var correo = $("#correo").val();
      var course = $("#course_modal").val();

      var id_horario = $("#id_horario").val();

      if (course == null) {
        //alert("Seleccion un curso");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Elegir curso",
          text: "Debe seleccionar un curso",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      } else if (nom == "" || dni == "" || cel == "" || correo == "") {
        //alert("Complete todos los campos");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Campos vacíos",
          text: "Debe completar todos sus datos",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      } else {

        //Registrar al usuario e inscribir al curso
        $.post("api_inscripcion.php", {
            free: free,
            nom: nom,
            dni: dni,
            cel: cel,
            correo: correo,
            id_horario: id_horario
          },
          function(mensaje) {

          });


        var miEnlace = document.getElementById('fin');
        miEnlace.href = '#fin';
        document.getElementById('fin').click();


        if (free == "1") //cuando no es free
        {
          var ref_wsp = "https://cursos.gruporysoft.com/course.php?i=" + course + "%0A%0AHola, he comprado el curso y envío la captura del pago correspondiente." + "%0A%0ANombres: " + nom + "%0ADNI: " + dni + "%0ACelular: " + cel + "%0AEmail: " + correo + "";
          //location.href="#?text="+ref_wsp;
          window.open('#?text=' + ref_wsp, '_blank');
        }

        /*
        Swal.fire({
          title: "Pago",
          text: "Estaremos validando el pago realizado",
          icon: "info",
          iconColor: "#bf0e09",
          confirmButtonColor: "#bf0e09"
        }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById('fin').click();
          }
        });
        */

      }


    }
  </script>


</head>

<body>

  <?php
  //Modelo
  require("_modelo/m_categoria.php");
  require("_modelo/m_curso.php");
  $curso =  MostrarCurso1();
  $categoria =  MostrarCategoria1();


  //require("_vista/v_login_modal.php");
  require("_vista/v_acciones.php");
  //require("_vista/v_carrito_modal.php");
  require("_vista/v_pago_modal.php");
  //require("_vista/v_inscripcion_modal.php");
  //require("_vista/v_menu_oferta.php");
  require("_vista/v_menu2.php");
  ?>

  <main>
    <?php
    require("_vista/v_inscripcion.php");
    ?>
    <div class="main">
      <div class="container">
        <?php
        //Vistas
        require("_vista/v_curso_home.php");
        //require("_vista/v_programa_home.php");
        //require("_vista/v_membresia_home.php");
        //require("_vista/v_insignias_home.php");
        ?>
      </div>
    </div>
  </main>

  <?php
  require("_vista/v_footer.php");
  require("_vista/v_script.php");
  ?>

</body>

</html>