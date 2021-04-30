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


    $traerDatos = "SELECT   ventas.id_registro,
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
                            u.username AS user_crea
                            FROM ((registrar_venta ventas
                            INNER JOIN usuarios u
                                ON ventas.id_userCrea = u.id_usuario)
                            INNER JOIN tipificaciones t
                            ON ventas.id_Tipificacionciudad_contrato = t.id_tipificacion)
                            WHERE ventas.id_registro = '$registro'";
                            

    $ver = $con ->query($traerDatos) or die ('Ocurrio un problema al traer los registros');    

    
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
    <title>Analizar Ventas</title>

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
            <h1>Analizar <b>Ventas AMD</b> </h1>
            <hr>
                <form>
                    <div class="form-group" id="cont-registro" style="text-align: center;">
                    <label for="registro" style="font-weight: 700;">Registro N°</label>
                    <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $registro ?>"> <!-- Muestra el numero del registro a crear -->
                    </div>
                    <br>
  
                <?php foreach ($ver as $dato) { ?>
                    <div class="row" style="justify-content: center;">
                        <div id="cont-fecha" class="form-group row col-5">
                            <label for="fecha" class="col-sm-3   col-form-label">Fecha de registro</label>
                            <div class="col-sm-9">
                                <input type="text" name="fecha" id="fecha" value="Dia: <?php echo $dato['fecha_registro']; ?>  Hora: <?php echo $dato['horaRegistro']; ?>" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-asesor">
                            <label for="asesor" class="col-sm-3 col-form-label">Asesor</label>
                            <div class="col-sm-9">
                                <input type="text" name="asesor" id="asesor" class="form-control" value="<?php echo $dato['user_crea']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                            <div class="form-group row col-5" id="cont-contrato">
                                <label for="contrato" class="col-sm-3 col-form-label">N° contrato</label>
                                <div class="col-sm-9">
                                    <input type="text" name="contrato" id="contrato" class="form-control" value="<?php echo $dato['contrato']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row col-5" id="cont-documento_contratante">
                                <label for="documento_contratante" class="col-sm-3 col-form-label">N° Doc Contratante</label>
                                <div class="col-sm-9">
                                    <input type="text" name="documento_contratante" id="documento_contratante" class="form-control" value="<?php echo $dato['documento_contratante']; ?>" readonly>
                                </div>
                            </div>

                        
                    </div>
                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-nombre_contratante">
                            <label for="nombre_contratante" class="col-sm-3 col-form-label">Nombres Contratante</label>
                            <div class="col-sm-9">
                                <input type="text" name="nombre_contratante" id="nombre_contratante" class="form-control" value="<?php echo $dato['nombre_contratante']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-tipoIdentificacion_benefeciario">
                            <label for="tipoIdentificacion_benefeciario" class="col-sm-3 col-form-label">T° de Doc Beneficiario</label>
                            <div class="col-sm-9">
                                <input type="text" name="tipoIdentificacion_benefeciario" id="tipoIdentificacion_benefeciario" class="form-control" value="<?php echo $dato['tipoIdentificacion_beneficiario']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-documento_beneficiario">
                            <label for="documento_beneficiario" class="col-sm-3 col-form-label">N° Doc Beneficiario</label>
                            <div class="col-sm-9">
                                <input type="text" name="documento_beneficiario" id="documento_beneficiario" class="form-control" value="<?php echo $dato['documento_beneficiario']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-nombre_beneficiario">
                            <label for="nombre_beneficiario" class="col-sm-3 col-form-label">Nombre Beneficiario</label>
                            <div class="col-sm-9">
                                <input type="text" name="nombre_beneficiario" id="nombre_beneficiario" class="form-control" value="<?php echo $dato['nombre_beneficiario']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-celular_beneficiario">
                            <label for="celular_beneficiario" class="col-sm-3 col-form-label">Celular Beneficiario</label>
                            <div class="col-sm-9">
                                <input type="text" name="celular_beneficiario" id="celular_beneficiario" class="form-control" value="<?php echo $dato['celular_beneficiario']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row col-5" id="cont-ciudadContrato">
                            <label for="ciudadContrato" class="col-sm-3 col-form-label">Ciudad del Contrato</label>
                            <div class="col-sm-9">
                                <input type="text" name="ciudadContrato" id="ciudadContrato" class="form-control" value="<?php echo $dato['ciudadContrato']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-10" id="cont-fecha_activacionModulo">
                            <label for="fecha_activacionModulo" class="col-sm-3 col-form-label">Fecha Activación Módulo</label>
                            <div class="col-sm-9">
                                <input type="text" name="fecha_activacionModulo" id="fecha_activacionModulo" class="form-control" value="<?php echo $dato['activacion_modulo']; ?>" readonly>
                            </div>
                        </div>
                        
                    </div>
               
                    <br>
                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-10" style="justify-content: center;" id="cont-detalle">
                            <label for="detalle" class="col-sm-3 col-form-label">Observaciones</label>
                            <div class="col-sm-9">
                                <textarea name="detalle" id="detalle" class="form-control" cols="30" rows="5" style="resize: none;" readonly><?php echo $dato['observaciones']; ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </form>
                <hr>

                <!-- formlario a llenar por el gestor-->

                <?php if($permiso == 1){ ?>
                <form method="post" name="form_ventas_gestor" id="form_ventas_gestor">
                    <h1 style="text-align: center;">Datos<b> BACK OFFICE </b></h1>
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
                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-consecutivoVentas">
                            <label for="consecutivoVentas" class="col-sm-3 col-form-label">Consecutivo de Ventas</label>
                            <div class="col-sm-9">
                            <input type="text" name="consecutivoVentas" class="form-control" autocomplete="off" placeholder="Consecutivo Venta" id="consecutivoVentas">
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-idLlamada">
                            <label for="idLlamada" class="col-sm-3 col-form-label">ID Llamada</label>
                            <div class="col-sm-9">
                            <input type="text" name="idLlamada" class="form-control" autocomplete="off" placeholder="ID de la Llamada" id="idLlamada">
                            </div>
                        </div>
                    </div>
                
                    
                        <div class="form-group row  col-8" id="cont-observacionBack" style="margin-left:auto; margin-right:auto;">
                                <label for="observacionBack" class="col-sm-3 col-form-label">Observaciones Gestión</label>
                                <div class="col-sm-8">
                                    <textarea name="observacionBack" id="observacionBack" class="form-control" rows="4" style="resize:none;" placeholder="Observaciones"></textarea>
                                </div>
                        </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-8" id="cont-tipoVenta">
                            <label for="tipoVenta" class="col-sm-4 col-form-label">Tipo de Venta</label>
                            <div class="col-sm-6">
                            <select name="tipoVenta" id="tipoVenta" class="form-control" autofocus>
                                <option value="" hidden>Selecciona una opcion</option>
                                <!-- consulta traer datos de la base -->
                        
                                <?php $estadoSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Gestionar Ventas' AND grupo_tipificacion2 = 'ventas' ORDER BY nombre_tipificacion ASC";
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
                    
                    <center><input type="submit" class="btn btn-primary" id="btnEnviar_ventas_gestor" name="btnEnviar_ventas_gestor" value="Guardar"></center>
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
    <script src="sistema/js/ajax_formularios/form_venta_gestor.js"></script>
    <script src="sistema/js/libs/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>                