$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_registrarVenta").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_registrarVenta")[0]);
        var btnEnviar = $("#btnEnviar_registrarVenta");
      
         // valida que el campo contrato no este vacio ni contenga letras
         var contrato = $("#contrato").val();
         if (isNaN(contrato) || /^\s+$/.test(contrato) || contrato == null || contrato == 0) {
             Swal.fire({
                 icon: 'warning',
                 title: 'Oops...',
                 text: 'El campo CONTRATO no puede estar vacio ni contener letras'
               });
               $("#contrato").css("border-color", "red");
             return
         } else {
            $("#contrato").css("border-color", "#ced4da");
         }
           
        // valida que el campo documento no este vacio ni contenga letras
        var documento_contratante = $("#documento_contratante").val();
        if (isNaN(documento_contratante) || /^\s+$/.test(documento_contratante) || documento_contratante == null || documento_contratante == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo DOCUMENTO CONTRATANTE no puede estar vacio ni contener letras'
              });
              $("#documento_contratante").css("border-color", "red");
            return
        } else {
            $("#documento_contratante").css("border-color", "#ced4da");
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var nombre_contratante = $("#nombre_contratante").val();
        if (nombre_contratante.length == 0 || nombre_contratante == null || /^\s+$/.test(nombre_contratante)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo NOMBRE CONTRATANTE no puede estar vacio'
                });
                $("#nombre_contratante").css("border-color", "red");
            return
        } else {
            $("#nombre_contratante").css("border-color", "#ced4da");
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var tipoIdentificacion_benefeciario = $("#tipoIdentificacion_benefeciario").val();
        if (tipoIdentificacion_benefeciario.length == 0 || tipoIdentificacion_benefeciario == null || /^\s+$/.test(tipoIdentificacion_benefeciario)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo Tipo de identificacion del beneficiario no puede estar vacio'
            });
            $("#tipoIdentificacion_benefeciario").css("border-color", "red");
        return
        } else {
            $("#tipoIdentificacion_benefeciario").css("border-color", "#ced4da");
        }

              
        // valida que el campo documento no este vacio ni contenga letras
        var documento_beneficiario = $("#documento_beneficiario").val();
        if (isNaN(documento_beneficiario) || /^\s+$/.test(documento_beneficiario) || documento_beneficiario == null || documento_beneficiario == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo DOCUMENTO BENEFICIARIO no puede estar vacio ni contener letras'
              });
              $("#documento_beneficiario").css("border-color", "red");
            return
        } else {
            $("#documento_beneficiario").css("border-color", "#ced4da");
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var nombre_beneficiario = $("#nombre_beneficiario").val();
        if (nombre_beneficiario.length == 0 || nombre_beneficiario == null || /^\s+$/.test(nombre_beneficiario)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo NOMBRE BENEFICIARIO no puede estar vacio'
                });
                $("#nombre_beneficiario").css("border-color", "red");
            return
        } else {
            $("#nombre_beneficiario").css("border-color", "#ced4da");
        }

            // valida que el campo documento no este vacio ni contenga letras
            var celular_beneficiario = $("#celular_beneficiario").val();
            if (isNaN(celular_beneficiario) || /^\s+$/.test(celular_beneficiario) || celular_beneficiario == null || celular_beneficiario == 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'El campo CELULAR BENEFICIARIO no puede estar vacio ni contener letras'
                  });
                  $("#celular_beneficiario").css("border-color", "red");
                return
            } else {
                $("#celular_beneficiario").css("border-color", "#ced4da");
            }
            // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
            var fecha_activacionModulo = $("#fecha_activacionModulo").val();
            if (fecha_activacionModulo == null || fecha_activacionModulo == 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Debe seleccionar alguna opcion en FECHA DE ACTIVACIÓN DE MÓDULO, no puede estar vacio'
                    });
                    $("#fecha_activacionModulo").css("border-color", "red");
                return
            } else {
                $("#fecha_activacionModulo").css("border-color", "#ced4da");
            }
            // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
            var ciudadContrato = $("#ciudadContrato").val();
            if (ciudadContrato == null || ciudadContrato == 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Debe seleccionar alguna opcion en CIUDAD DE CONTRATO, no puede estar vacio'
                    });
                    $("#ciudadContrato").css("border-color", "red");
                return
            } else {
                $("#ciudadContrato").css("border-color", "#ced4da");
            }


        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var observaciones = $("#observaciones").val();
        if (observaciones.length == 0 || observaciones == null || /^\s+$/.test(observaciones)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo Observaciones no puede estar vacio'
                });
                $("#observaciones").css("border-color", "red");
            return
        } else {
            $("#observaciones").css("border-color", "#ced4da");
        }

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
          })
          
          swalWithBootstrapButtons.fire({
            title: '¿Estas seguro?',
            text: "Despues de guardar no se podra reversar",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Guardar',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

            $.ajax({
                data:parametros,
                url:"././sistema/logica/ajax_formularios/form_venta_consultor.php",
                type:"POST",
                contentType:false,
                processData:false,
                success: function(data){
                    btnEnviar.val("Guardando.."); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $("body").append(data);
                    setTimeout(function () {
                      location.reload("./././venta_consultor.php");
                    }, 5000); //hace redireccion despues de 3 segundos
                },
                error: function( jqXHR, textStatus, errorThrown) { // Si el servidor no envia una respuesta se 
                  // ejecutara alguna de las siguientes alertas de acuerdo error
                if (jqXHR.status === 0) {

                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Not connect: Verify Network.'
                })

                } else if (jqXHR.status == 404) {

                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Requested page not found [404]'
                })

                } else if (jqXHR.status == 500) {

                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Internal Server Error [500].'
                })

                } else if (textStatus === 'parsererror') {

                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Error de análisis JSON solicitado.'
                })

                } else if (textStatus === 'timeout') {

                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Time out error.'
                })

                } else if (textStatus === 'abort') {

                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ajax request aborted.'
                })

                } else {

                alert('Uncaught Error: ' + jqXHR.responseText);
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Uncaught Error: ' + jqXHR.responseText
                })

                }
                }
            });
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Registro Cancelado',
              'Has Cancelado el envio',
              'error'
            )
          }
        });
    });
});