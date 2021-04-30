$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_ventas_gestor").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_ventas_gestor")[0]);
        var btnEnviar = $("#btnEnviar_ventas_gestor");
      
  
   

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var consecutivoVentas = $("#consecutivoVentas").val();
        if (consecutivoVentas.length == 0 || consecutivoVentas == null || /^\s+$/.test(consecutivoVentas)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo CONSECUTIVO VENTAS no puede estar vacio'
                });
            return
        }


        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var idLlamada = $("#idLlamada").val();
        if (idLlamada.length == 0 ||idLlamada == null || /^\s+$/.test(idLlamada)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo id Llamada no puede estar vacio'
                });
            return
        }
             // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
             var observaciones = $("#observacionBack").val();
             if (observaciones.length == 0 || observaciones == null || /^\s+$/.test(observaciones)) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Oops...',
                     text: 'El campo Observaciones no puede estar vacio'
                     });
                 return
             }
     
            // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
            var tipoVenta = $("#tipoVenta").val();
            if (tipoVenta == null || tipoVenta== 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Debe seleccionar alguna opcion en Tipo Venta, no puede estar vacio'
                    });
                return
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
                url:"././sistema/logica/ajax_formularios/form_venta_gestor.php",
                type:"POST",
                contentType:false,
                processData:false,
                success: function(data){
                    btnEnviar.val("Guardando.."); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $("body").append(data);
                    setTimeout(function () {
                      window.location.href = "./././tabla_ventas.php";
                    }, 4000); //hace redireccion despues de 3 segundos
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