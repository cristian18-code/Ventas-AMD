<?php 
    include('config/session.php');
    include('config/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="media/css/libs/pushbar.css">	
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/css/libs/pushbar.css">
    <link rel="stylesheet" href="media/css/tabla_usuarios.css"> 
	<link rel="stylesheet" href="media/css/libs/animate.css">    

<!-- Estilos css -->
<link rel="shortcut icon" href="media/img/ventas.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Consulta - Ventas</title>
</head>
<body>
<header>
    <?php 
        include 'sistema/includes/header.php';
    ?>
        <nav>
        <?php
            include 'sistema/includes/nav.php';
        ?>
        </nav>
</header>
<div class="adicional"></div>
<section id="container">
    <form action="consultar-ventas.php"  method="post">

            <h1>Consulta de Ventas</h1>
            
            <input type="number" name="id" placeholder="Ingresa el Número de Documento o El Número de Contrato" class="form-control" required>
            <br>
            <br>
            <input type="submit" name="consultar" value="Consulta" class="btn btn-primary">

    </form>   

         <?php

if(isset($_POST['consultar'])){



         	$id = $_POST['id'];
         echo "

         <table id='registros' class='table table-striped table-bordered animate__animated animate__fadeIn' style='width:100%' >
         <thead style='background-image: linear-gradient(180deg,rgb(63, 4, 102), rgb(84, 1, 151));'>
                <tr>
                    <th style='color:#fff;'> Fecha Registro</th>
                    <th style='color:#fff;'> Hora Registro</th>
                    <th style='color:#fff;'> Contrato</th>
                    <th style='color:#fff;'> Doc Contratante </th>
                    <th style='color:#fff;'> Nombre Contratante</th>
                    <th style='color:#fff;'> Tipo Venta</th>
                    <th style='color:#fff;'> Ciudad</th>
                    <th style='color:#fff;'> Agente</th>
                    <th style='color:#fff;'> Backoffice</th>
                    <th style='color:#fff;'> Observaciones</th>
                </tr>
         </thead>
        ";
       
        
$consulta = mysqli_query($con, "SELECT  ventas.id_registro,
                                        t.nombre_tipificacion AS ciudadContrato,
                                        DATE_FORMAT(ventas.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                                        ventas.horaRegistro,
                                        ventas.contrato,
                                        ventas.nombre_contratante,
                                        ventas.documento_contratante,
                                        ventas.nombre_contratante,
                                        ventas.tipoIdentificacion_beneficiario,
                                        ventas.documento_beneficiario,
                                        ventas.nombre_beneficiario,
                                        ventas.celular_beneficiario,
                                        ventas.activacion_modulo,
                                        ventas.observaciones,
                                        ventas.consecutivoVentas,
                                        ventas.id_llamada,
                                        ventas.observacionesSuper,
                                        t1.nombre_tipificacion AS tipoVenta,
                                        u.username AS user_crea,
                                        u1.username AS user_cierre
                                        FROM ((((registrar_venta ventas
                                        INNER JOIN usuarios u
                                            ON ventas.id_userCrea = u.id_usuario)
                                        LEFT JOIN usuarios u1
                                            ON ventas.id_userCierre = u1.id_usuario)
                                        LEFT JOIN tipificaciones t
                                            ON ventas.id_Tipificacionciudad_contrato = t.id_tipificacion)
                                        LEFT JOIN tipificaciones t1
                                            ON ventas.id_TipificaciontipoVentas = t1.id_tipificacion)
                                        WHERE ventas.documento_contratante = '$id' OR ventas.contrato = '$id'");

while($registro = mysqli_fetch_array($consulta)){

      echo "

      <tr>
            <td>".$registro['fecha_registro']."</td>
            <td>".$registro['horaRegistro']."</td>
            <td>".$registro['contrato']."</td>
            <td>".$registro['documento_contratante']."</td>
            <td>".$registro['nombre_contratante']."</td>
            <td>".$registro['tipoVenta']."</td>
            <td>".$registro['ciudadContrato']."</td>
            <td>".$registro['user_crea']."</td>
            <td>".$registro['user_cierre']."</td>
            <td> <button class='btn btn-success'data-pushbar-target='pushbar-menu-venta".$registro['id_registro']."'> <span class='icon-eye'></span> Ver</button></td>
          
      </tr>
      <div data-pushbar-id='pushbar-menu-venta".$registro['id_registro']."' data-pushbar-direction='bottom' class='pusbar-fono-consultar1'>
            <div class='adicional'></div>
            <div class='adicional'></div>
            <div class='adicional'></div>
            <section style='width:70%;'>
            
            <div id='formulario' style='margin-top:5vh;'>    
                <h1>Datos Beneficiario y Observaciones <b> - Ventas AMD </b> </h1>
                <hr>
                    <form method='post' name='form_envioCorreo_consultor' id='form_envioCorreo_consultor'>
                        <div class='row' style='justify-content: center;'>
                                <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                                    <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>T° Doc Beneficiario</label>
                                    <div class='col-sm-6'>
                                        <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['tipoIdentificacion_beneficiario']." readonly>
                                    </div>
                                </div>
                                <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                                    <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>N° Doc Beneficiario</label>
                                    <div class='col-sm-6'>
                                        <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['documento_beneficiario']." readonly>
                                    </div>
                                </div>
                                
                        </div>
                        <div class='row' style='justify-content: center;'>
                            <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                                <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>Nombre Beneficiario</label>
                                <div class='col-sm-6'>
                                    <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['nombre_beneficiario']." readonly>
                                </div>
                            </div>
                            <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                                <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>Celular Beneficiario</label>
                                <div class='col-sm-6'>
                                    <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['celular_beneficiario']." readonly>
                                </div>
                            </div>
                        
                        </div>
                        <div class='row' style='justify-content: center;'>
                            <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                                <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>Ciudad Contrato</label>
                                <div class='col-sm-6'>
                                    <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['ciudadContrato']." readonly>
                                </div>
                            </div>
                            <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                                <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>Fecha Activación M</label>
                                <div class='col-sm-6'>
                                    <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['documento_beneficiario']." readonly>
                                </div>
                            </div>
                        
                        </div>
                        <div class='row' style='justify-content: center;'>
                            <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                                <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>Consecutivo Ventas</label>
                                <div class='col-sm-6'>
                                    <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['consecutivoVentas']." readonly disabled>
                                </div>
                            </div>
                            <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                                <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>ID llamada</label>
                                <div class='col-sm-6'>
                                    <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['id_llamada']." readonly disabled>
                                </div>
                            </div>
                    
                        </div>
                        <div class='row' style='justify-content: center;'>
                            <label for='detalle' class='col-sm-3 col-form-label'>Observaciones Asesor</label>
                            <div class='col-sm-8'>
                                <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['observaciones']."</textarea>
                            </div>
                        </div>
                        <br>
                        <div class='row' style='justify-content: center;'>
                            <label for='detalle' class='col-sm-3 col-form-label'>Observaciones Supervisor</label>
                                <div class='col-sm-8'>
                                    <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['observacionesSuper']."</textarea>
                                </div>
                        </div>

                        
                </div>    

            </section>
            
            

      <button data-pushbar-close><span style='background:none;' class='icon-cancel-circle' id='close'></span></button>
      
      </div>

         
            ";
      };
      echo "
      <tfoot style='background-image: linear-gradient(180deg,rgb(63, 4, 102), rgb(84, 1, 151));'>
            <tr>
                <th> Fecha Registro</th>
                <th> Hora Registro</th>
                <th> Contrato </th>
                <th> Doc Contratante </th>
                <th> Nombre Contratante</th>
                <th> Tipo Venta</th>
                <th> Ciudad</th>
                <th> Agente</th>
                <th> Backoffice</th>
                <th> Observaciones</th>
            </tr>
       </tfoot>
            </table>
            </section>
        ";

 }
?>

</body>
<script src="sistema/js/libs/pushbar.js"></script>


<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
<script>
    $(document).ready(function() {
        $('#registros').DataTable(); /* Script para la tabla */
    } );
</script>
    <script src="sistema/js/libs/jquery.dataTables.min.js"></script> <!-- Script de Datatable -->
    <script src="sistema/js/libs/bootstrap5.min.js"></script> <!-- Script de Datatable -->
	<script src="sistema/js/libs/sweetalert2.js"></script>
</html>