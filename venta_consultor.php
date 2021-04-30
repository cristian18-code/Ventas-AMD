<?php 
    include('config/session.php');
    include('config/conexion.php');

    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT Agente
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsersVentas']."'");

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $permiso = $filaP[0];
    } else {
        header("location: alerta.php");
    }

    if($permiso != 1){ 
        header("location: alerta.php");
    }

    /* Trae el ultimo registro creado */
    $traerDatos = "SELECT max(id_registro) FROM registrar_venta";
    $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

    if ($row = mysqli_fetch_row($ver)) {
        $id = $row[0];
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
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/img/ventas.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
    <script src="sistema/js/getTime.js"></script>
<!-- Scripts -->    
    <title>Registrar nueva venta</title>
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
        <h1>Registrar Venta <b> AMD </b> </h1>
        <hr>
            <form method="post" name="form_registrarVenta" id="form_registrarVenta">
                <div class="form-group" id="cont-registro" style="text-align: center;">
                <label for="registro" style="font-weight: 700;">Registro N°</label>
                <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $id + 1; ?>"> <!-- Muestra el numero del registro a crear -->
                </div>
                <br>
                <div id="encabezado" class="form-group">
                    <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                    <img src="media/img/crear.png" class="mover" alt="anadir" width="80px">
                    <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                    <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsersVentas']; ?>">
                </div>

                <div class="form-group row" id="cont-contrato">
                    <label for="contrato" class="col-sm-4 col-form-label">Contrato</label>
                    <div class="col-sm-8">
                        <input type="text" name="contrato" class="form-control" autocomplete="off" placeholder="Numero de contrato" id="contrato" autofocus>
                    </div>
                </div>

                <div class="form-group row" id="cont-documento_contratante">
                    <label for="documento_contratante" class="col-sm-4 col-form-label">Documento del contratante</label>
                    <div class="col-sm-8">
                        <input type="text" name="documento_contratante" class="form-control" autocomplete="off" placeholder="documento del contratante" id="documento_contratante">
                    </div>
                </div>

                <div class="form-group row" id="cont-nombre_contratante">
                    <label for="nombre_contratante" class="col-sm-4 col-form-label">Nombre del contratante</label>
                    <div class="col-sm-8">
                        <input type="text" name="nombre_contratante" class="form-control" autocomplete="off" placeholder="Nombre del contratante" id="nombre_contratante">
                    </div>
                </div>

                <div class="form-group row" id="cont-tipoIdentificacion_benefeciario">
                    <label for="tipoIdentificacion_benefeciario" class="col-sm-4 col-form-label">Tipo de identificacion del beneficiario</label>
                    <div class="col-sm-8">
                        <input type="text" name="tipoIdentificacion_benefeciario" class="form-control" autocomplete="off" placeholder="tipo de identificacion del beneficiario" id="tipoIdentificacion_benefeciario">
                    </div>
                </div>

                <div class="form-group row" id="cont-documento_beneficiario">
                    <label for="documento_beneficiario" class="col-sm-4 col-form-label">Documento del beneficiario</label>
                    <div class="col-sm-8">
                        <input type="text" name="documento_beneficiario" class="form-control" autocomplete="off" placeholder="documento del beneficiario" id="documento_beneficiario">
                    </div>
                </div>

                <div class="form-group row" id="cont-nombre_beneficiario">
                    <label for="nombre_beneficiario" class="col-sm-4 col-form-label">Nombre del beneficiario</label>
                    <div class="col-sm-8">
                        <input type="text" name="nombre_beneficiario" class="form-control" autocomplete="off" placeholder="Nombre del beneficiario" id="nombre_beneficiario">
                    </div>
                </div>

                <div class="form-group row" id="cont-celular_beneficiario">
                    <label for="celular_beneficiario" class="col-sm-4 col-form-label">Celular del beneficiario</label>
                    <div class="col-sm-8">
                        <input type="text" name="celular_beneficiario" class="form-control" autocomplete="off" placeholder="celular del beneficiario" id="celular_beneficiario">
                    </div>
                </div>

                <div class="form-group row" id="cont-fecha_activacionModulo">
                    <label for="fecha_activacionModulo" class="col-sm-4 col-form-label">Fecha de activacón del modulo</label>
                    <div class="col-sm-8">
                        <input type="date" name="fecha_activacionModulo" class="form-control" autocomplete="off" id="fecha_activacionModulo">
                    </div>
                </div>
                <div class="form-group row" id="cont-ciudadContrato">
                    <label for="ciudadContrato" class="col-sm-4 col-form-label">Ciudad del Contrato</label>
                    <div class="col-sm-8">
                        <select name="ciudadContrato" id="ciudadContrato" class="form-control">
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php $cmdSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Registrar Venta' AND grupo_tipificacion2 = 'ventas' ORDER BY nombre_tipificacion ASC";
                                $cmdQsql = $con -> query($cmdSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($cmdQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-observaciones">
                    <label for="observaciones" class="col-sm-4 col-form-label">observaciones</label>
                    <div class="col-sm-8">
                        <textarea name="observaciones" id="observaciones" class="form-control" style="resize:none; text-align: center;" placeholder="Servicio solicitado"></textarea>
                    </div>
                </div>

               
                <center><input type="submit" class="btn btn-info" id="btnEnviar_registrarVenta" name="btnEnviar_registrarVenta" value="Guardar"></center>
            </form>
        </div>    

    </section>
</body>
    <script src="sistema/js/ajax_formularios/form_venta_consultor.js"></script>
    <script src="sistema/js/libs/pushbar.js"></script>
<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
</html>