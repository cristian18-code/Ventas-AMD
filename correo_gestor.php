<?php 
    include('config/session.php');
    include('config/conexion.php');
    include('sistema/logica/envio_correo.php');

    // valida que se envie un registro
    if (empty($_POST['registro'])) {
        header("location: principal.php");
    }
    
    $registro = $_POST['registro'];

    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT Supervisor
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsersVentas']."'") or die (header("location: principal.php"));

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $permiso = $filaP[0];
    } else {
        header("location: alerta.php");
    }


    $traerDatos = "     SELECT correo.id_registro,
                        DATE_FORMAT(correo.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                        correo.horaRegistro,
                        correo.contrato,
                        correo.nombres,
                        correo.correo,
                        t.nombre_tipificacion AS tipo_correo,
                        u.username AS user_crea
                        FROM ((envioCorreo_registros correo
                        INNER JOIN tipificaciones t
                            ON correo.id_tipoCorreo = t.id_tipificacion)
                        INNER JOIN usuarios u
                            ON correo.id_userCrea = u.id_usuario)
                        WHERE correo.id_registro = '$registro'";
                            

    $ver = $con ->query($traerDatos) or die ('Ocurrio un problema al traer los registros');    

    if ($filaR = mysqli_fetch_row($ver)) {
        $correos = EnvioCorreos($filaR[4]);
    }
        
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/css/libs/pushbar.css">	
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/libs/reset.css">
    <link rel="stylesheet" href="media/css/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/css/ventas.css">
    <link rel="stylesheet" href="media/css/informacion_investigar.css">
<!-- Estilos css -->
<link rel="shortcut icon" href="media/img/ventas.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
    <script src="sistema/js/getTime.js"></script>
<!-- Scripts -->    
    <title>Envio de correos - supervisor</title>

    <style>
        section {max-width: 1400px;} section form {max-width: 1200px;} section form input{font-size: 16px;} 
    </style>
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

    <section>

        <div id="formulario">    
            <h1>Datos <b>ASESOR</b> </h1>
            <hr>
                <form>
                    <div class="form-group" id="cont-registro" style="text-align: center;">
                    <label for="registro" style="font-weight: 700;">Registro N°</label>
                    <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $registro ?>"> <!-- Muestra el numero del registro a crear -->
                    </div>
                    <br>
  
                <?php foreach ($ver as $dato) { ?>
                    <div id="cont-fecha" class="form-group row" style="text-align: center;">
                        <label for="fecha" class="col-sm-4 col-form-label">Fecha y hora de registro</label>
                        <div class="col-sm-6">
                            <input type="text" name="fecha" id="fecha" value="Dia: <?php echo $dato['fecha_registro']; ?>  Hora: <?php echo $dato['horaRegistro']; ?>" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row" id="cont-contrato" style="text-align: center;">
                        <label for="contrato" class="col-sm-4 col-form-label">Numero de contrato</label>
                        <div class="col-sm-6">
                            <input type="text" name="contrato" id="contrato" class="form-control" value="<?php echo $dato['contrato']; ?>" readonly>
                        </div>
                    </div>

                    <div id="cont-nombres" class="form-group row" style="text-align: center;">
                        <label for="nombres" class="col-sm-4 col-form-label">Nombres del usuario</label>
                        <div class="col-sm-6">
                            <input type="text" name="nombres" id="nombres" class="form-control" value="<?php echo $dato['nombres']; ?>" readonly>
                        </div>
                    </div>

                    <div id="cont-correo" class="form-group row" style="text-align: center;">
                        <label for="correo" class="col-sm-4 col-form-label">Correo de usuario</label>
                        <div class="col-sm-6">
                            <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $dato['correo']; ?>" readonly>
                        </div>
                    </div>

                    <div id="cont-tipoCorreo" class="form-group row" style="text-align: center;">
                        <label for="tipoCorreo" class="col-sm-4 col-form-label">Tipo de correo</label>
                        <div class="col-sm-6">
                            <input type="text" name="tipoCorreo" id="tipoCorreo" class="form-control" value="<?php echo $dato['tipo_correo']; ?>" readonly>
                        </div>
                    </div>
               
                <?php } ?>
                </form>
                <hr>

                <!-- formlario a llenar por el gestor-->

                <?php if($permiso == 1){ ?>
                <form method="post" name="form_envioCorreo_gestor" id="form_envioCorreo_gestor">
                    <h1 style="text-align: center;">Gestion <b>SUPERVISOR - BACK OFFICE </b></h1>
                    <hr>
                    <div id="encabezado" class="form-group">
                        <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                        <img src="media/img/gestion.png" class="mover" alt="anadir" width="80px">
                        <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                        <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsersVentas']; ?>">
                        <input type="hidden" name="registro" id="registro" value="<?php echo $registro ?>"> <!-- Muestra el numero del registro a crear -->
                    </div>        
            
                    
                    <div class="form-group row col-8" style="justify-content: center;" id="cont-gestionBack">
                   
                                
                    </div>
                    <div id="cont-enviarCorreo">
                        <center><a href="<?php echo $correos; ?>"><img src="media/img/correo-electronico.png" title="enviar correo" alt="enviar correo" width="80px"></a></center>
                    </div>
                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-observaciones">
                            <label for="observaciones" class="col-sm-3 col-form-label">Observaciones</label>
                            <div class="col-sm-9">
                            <textarea name="observaciones" id="observaciones" class="form-control" rows="4" style="resize:none;"></textarea>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-estado">
                            <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                            <div class="col-sm-9">
                                <select name="estado" id="estado" class="form-control" autofocus>
                                    <option value="" hidden>Selecciona una opcion</option>
                                    <!-- consulta traer datos de la base -->
                            
                                    <?php $estadoSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'estado' AND grupo_tipificacion2 = 'gestionarCorreo' ORDER BY nombre_tipificacion ASC";
                                        $estadoQsql = $con->query($estadoSsql);
                                    ?>
                                    <!-- ciclo para mostrar las areas -->
                                    <?php foreach ($estadoQsql as $row) { ?>
                                    
                                        <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                                    
                                    <?php } ?>                        
                                </select>
                            </div>
                        </div>
                    </div>
                
                    

                    <div class="row" style="justify-content: center;">
                        

                    </div>
                    
                    <center><input type="submit" class="btn btn-primary" id="btnEnviar_envioCorreo_gestor" name="btnEnviar_envioCorreo_gestor" value="Guardar"></center>
                </form>
                <?php } ?>
        </div>
    </section>
</body>
<script src="sistema/js/libs/pushbar.js"></script>


<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
    <script src="sistema/js/libs/sweetalert2.js"></script>
    <script src="sistema/js/ajax_formularios/form_envioCorreo_gestor.js"></script>
    <script src="sistema/js/libs/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>                