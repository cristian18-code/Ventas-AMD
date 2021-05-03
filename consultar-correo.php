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
    <link rel="stylesheet" href="media/css/libs/dataTables.bootstrap5.min.css"> <!-- estilo de la tabla -->
<!-- Estilos css -->
<link rel="shortcut icon" href="media/img/ventas.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Consulta - Correo</title>
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
    <form action="consultar-correo.php"  method="post">

            <h1>Consulta de Correo</h1>
            
            <input type="number" name="id" placeholder="Ingresa El Número de Contrato" class="form-control" required>
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
                    <th style='color:#fff;'> Nombres </th>
                    <th style='color:#fff;'> Tipo de Correo</th>
                    <th style='color:#fff;'> Correo</th>
                    <th style='color:#fff;'> Estado</th>
                    <th style='color:#fff;'> Asesor</th>
                    <th style='color:#fff;'> Supervisor</th>
                    <th style='color:#fff;'> Observaciones</th>
                </tr>
         </thead>
        ";
       
        
$consulta = mysqli_query($con, "SELECT correo.id_registro,
                                        DATE_FORMAT(correo.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                                        correo.horaRegistro,
                                        correo.contrato,
                                        correo.nombres,
                                        correo.correo,
                                        correo.observaciones,
                                        t.nombre_tipificacion AS tipo_correo,
                                        t1.nombre_tipificacion AS estado,
                                        u.username AS user_crea,
                                        u1.username AS user_cierre,
                                        correo.fechaCierre,
                                        correo.horaCierre
                                        FROM ((((envioCorreo_registros correo
                                        LEFT JOIN tipificaciones t
                                            ON correo.id_tipoCorreo = t.id_tipificacion)
                                        LEFT JOIN tipificaciones t1
                                            ON correo.id_estado = t1.id_tipificacion)
                                        LEFT JOIN usuarios u
                                            ON correo.id_UserCrea = u.id_usuario)
                                        LEFT JOIN usuarios u1
                                            ON correo.id_userCierra = u1.id_usuario)
                                        WHERE correo.contrato = '$id'");

while($registro = mysqli_fetch_array($consulta)){

      echo "

      <tr>
            <td>".$registro['fecha_registro']."</td>
            <td>".$registro['horaRegistro']."</td>
            <td>".$registro['contrato']."</td>
            <td>".$registro['nombres']."</td>
            <td>".$registro['tipo_correo']."</td>
            <td>".$registro['correo']."</td>
            <td>".$registro['estado']."</td>
            <td>".$registro['user_crea']."</td>
            <td>".$registro['user_cierre']."</td>
            <td> <button class='btn btn-success'data-pushbar-target='pushbar-menu-venta".$registro['id_registro']."'> <span class='icon-eye'></span> Ver</button></td>

      </tr>
      <div data-pushbar-id='pushbar-menu-venta".$registro['id_registro']."' data-pushbar-direction='bottom' class='pusbar-fono-consultar1'>

      <h1> Observaciones </h1>

      <div class='respuestas'>
      <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['observaciones']."</textarea>
      <div>

      <button data-pushbar-close><span class='icon-cancel-circle' id='close'></span></button>
      
      </div>
         
            ";
      };
      echo "
      <tfoot style='background-image: linear-gradient(180deg,rgb(63, 4, 102), rgb(84, 1, 151));'>
            <tr>
                <th> Fecha Registro</th>
                <th> Hora Registro</th>
                <th> Contrato </th>
                <th> Nombres </th>
                <th> Tipo de Correo</th>
                <th> Correo</th>
                <th> Estado</th>
                <th> Asesor</th>
                <th> Supervisor</th>
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