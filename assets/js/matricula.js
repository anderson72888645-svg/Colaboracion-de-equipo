    function Inscribirse() //original
    {

      var nom = $("#nom_").val();
      var dni = $("#dni_").val();
      var cel = $("#cel_").val();
      var correo = $("#correo_").val();

      var course_ = $("#course").val();
      var nom_ = $("#nomt").val();
      var prec_ = $("#prect").val();
      var hor_ = $("#hort").val();


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
    /*
    function InscribirseModal() //original
    {
      
      var nom = $("#nom").val();
      var dni = $("#dni").val();
      var cel = $("#cel").val();
      var correo = $("#correo").val();
      var course = $("#course_modal").val();


      if(course==null)
      {
        //alert("Seleccion un curso");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Elegir curso",
          text: "Debe seleccionar un curso",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      }
      else if(nom=="" || dni=="" || cel=="" || correo=="")
      {
        //alert("Complete todos los campos");
        Swal.fire({
          //icon: "error",
          icon: "warning",
          title: "Campos vacíos",
          text: "Debe completar todos sus datos",
          confirmButtonColor: "#bf0e09",
          //footer: '<a href="#">Why do I have this issue?</a>'
        });
      }
      else
      {
        var ref_wsp = "https://cursos.gruporysoft.com/course.php?i="+course+"%0A%0ANombres: "+nom+"%0ADNI: "+dni+"%0ACelular: "+cel+"%0AEmail: "+correo+"%0A%0AHola acabo de comprar el curso, por favor enviarme mi usuario de acceso a la plataforma.";
        //location.href="#?text="+ref_wsp;
        window.open('#?text='+ref_wsp, '_blank');
      }
      
      
    }
    */
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

        var seccion2 = document.getElementById("free");
        seccion2.style.display = "block";
      } else {
        var seccion = document.getElementById("nofree");
        seccion.style.display = "block";

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

        //var response = 1;
        var response = grecaptcha.getResponse();

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
          $.get("_controller/c_verificacion.php", {
            checkEmail: correo
          }, function(data) {
            if (data.verificado) {
              console.log(data.verificado);
              continuarAPago();
            } else {
              // Enviar código de verificación
              $.post("_controller/c_verificacion.php", {
                email: correo
              }, function(response) {
                if (response.success) {
                  Swal.fire({
                    title: 'Verificación de correo',
                    html: `
                                    <p>Te hemos enviado un código de verificación a <strong>${correo}</strong></p>
                                    <p style="font-size: 0.7em;">Si no lo encuentras en tu bandeja principal, revisa la carpeta de <strong>spam</strong>.</p>
                                    <input type="text" id="codigo_verificacion" class="swal2-input" placeholder="Ingresa el código">
                                `,
                    showCancelButton: true,
                    confirmButtonText: 'Verificar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                      const codigo = document.getElementById('codigo_verificacion').value;
                      return fetch(`_controller/c_verificacion.php?codigo=${codigo}`)
                        .then(response => response.json())
                        .then(data => {
                          if (!data.valid) {
                            throw new Error(data.error || 'Código inválido')
                          }
                          return data;
                        })
                        .catch(error => {
                          Swal.showValidationMessage(error.message)
                        })
                    }
                  }).then((result) => {
                    if (result.isConfirmed) {
                      continuarAPago();
                    }
                  });
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo enviar el código de verificación'
                  });
                }
              });
            }
          });

          var form = new FormData();
          form.append('amount', prech);
          form.append('email', correo);

          /* Izipay ----------------------------------- */
          $.ajax({
            url: "izipay.php",
            type: "POST",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            success: function(data) {

              var formToken = data.formToken;

              var script = document.createElement('script');
              script.src = "https://api.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js";
              script.setAttribute("kr-public-key", window.CURSOS_PAYMENT_PUBLIC_KEY || "");
              

              document.body.appendChild(script);

              var htmlCode = '<div class="formulario">' +
                '<div class="kr-embedded" kr-form-token="' + formToken + '">' +
                '<!-- payment form fields -->' +
                '<div class="kr-pan"></div>' +
                '<div class="kr-expiry"></div>' +
                '<div class="kr-security-code"></div>' +
                '<!-- payment form submit button -->' +
                '<button class="kr-payment-button"></button>' +
                '<!-- error zone -->' +
                '<div class="kr-form-error"></div>' +
                '</div>' +
                '</div>';

              console.log("formToken recibido:", formToken);
              $('#nofree_tarjeta').html(htmlCode);

              script.onload = function() {
                $(document).ready(function() {
                  KR.onSubmit(function(event) {

                    $(".kr-payment-button > span:first").html(event.clientAnswer.orderStatus);
                    $(".kr-spinner").hide();
                    $(".kr-payment-button > span:first").show();


                    if (event.clientAnswer.orderStatus == 'PAID') {

                      //Registrar al usuario e inscribir al curso
                      //mandarlo como free para que matricule ya que se ha pagado con tarjeta
                      $.post("api_inscripcion.php", {
                          free: 0,
                          nom: nom,
                          dni: dni,
                          cel: cel,
                          correo: correo,
                          id_horario: id_horario,
                          med_pago: 'IZIPAY'
                        },
                        function(mensaje) {
                          console.log("Respuesta del servidor:", mensaje);
                        });

                      Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "¡Pago exitoso!",
                        showConfirmButton: false,
                        timer: 2000
                      }).then((result) => {
                        var miEnlace = document.getElementById('fin');
                        miEnlace.href = '#fin';
                        document.getElementById('fin').click();

                        //bloquear para ver pestaa de pago
                        var miEnlace2 = document.getElementById('pago');
                        miEnlace2.href = 'javascript:void(0)';
                      });

                    }


                    return false;
                  });
                });
              };
            }
          });
          /* Izipay ----------------------------------- */

          /* Paypal ------------------------------------ */
          paypal.Buttons({
            style: {
              color: 'blue',
              shape: 'pill',
              label: 'pay'
            },
            createOrder: function(data, actions) {
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: Math.round(prech / 3.5)
                  }
                }]
              });

            },
            onApprove: function(data, actions) {
              actions.order.capture().then(function(detalles) {
                //console.log(detalles);

                //Registrar al usuario e inscribir al curso
                //mandarlo como free para que matricule ya que se ha pagado con tarjeta
                $.post("api_inscripcion.php", {
                    free: 0,
                    nom: nom,
                    dni: dni,
                    cel: cel,
                    correo: correo,
                    id_horario: id_horario,
                    med_pago: 'PAYPAL'
                  },
                  function(mensaje) {

                  });

                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "¡Pago exitoso!",
                  showConfirmButton: false,
                  timer: 2000
                }).then((result) => {
                  var miEnlace = document.getElementById('fin');
                  miEnlace.href = '#fin';
                  document.getElementById('fin').click();

                  //bloquear para ver pestaa de pago
                  var miEnlace2 = document.getElementById('pago');
                  miEnlace2.href = 'javascript:void(0)';
                });

              });
            },
            onCancel: function(data) {
              //alert("Pago cancelado");
              //console.log(data);
            }
          }).render('#paypal-button-container');
          /* Paypal ------------------------------------ */


          //alert("Captcha verificado");

        }


      }


    }

    function continuarAPago() {
      var miEnlace = document.getElementById('pago');
      miEnlace.href = '#pago';
      document.getElementById('pago').click();
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
            id_horario: id_horario,
            med_pago: 'FREE'
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