<?php 
    include('config/session.php');
    include('config/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/css/libs/bootstrap5.min.css">
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/libs/pushbar.css">	
    <link rel="stylesheet" href="media/css/libs/reset.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/css/header.css">
    <link rel="stylesheet" href="media/css/contenedores_hover.css">

<!-- Estilos css -->
    <link rel="shortcut icon" href="media/img/ventas.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title> Ventas AMD</title>
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
<div class="circle"></div>
<section>


<!-- Opcion de Citas-->
<div class="container-all" id="menu">

    <div class="container-box">

        <a href="venta_consultor.php">

            <div class="box box1">

                <img src="media/img/crear.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Registrar Venta</h4>

                <p><strong>¡Modulo <?php echo strtoupper($_SESSION["rolVentas"])?>!</strong></p>

            <div class="background-hover"></div>

        </a>
        
    </div>  

 <!-- Opcion de Fonoplus-->        
    <a href="correo_consultor.php">

        <div class="box box2">

            <img src="media/img/documentos.png" alt="documentos" class="icon">

            <h4 class="title">Envio de correo</h4>

            <p><strong>¡Modulo <?php echo strtoupper($_SESSION["rolVentas"])?>!</strong></p>

        <div class="background-hover"></div>

    </a> 

    </div> 
        
    <a href="#"  data-pushbar-target="pushbar-menu-consulta">

        <div class="box box2">

            <img src="media/img/consultar.png" alt="consultar" class="icon">

            <h4 class="title">Consultar</h4>

            <p><strong>¡Modulo <?php echo strtoupper($_SESSION["rolVentas"])?>!</strong></p>

        <div class="background-hover"></div>

    </a> 

    </div> 

<!-- Opcion de Descargar Reportes en General-->
    <?php if ($_SESSION['rolVentas'] == 'Administrador' || $_SESSION['rolVentas'] == 'Supersivor')  { ?>
    <a href="#" data-pushbar-target="pushbar-menu-supervisor">

        <div class="box box3">

        <img src="media/img/analizarVentas.png" alt="analizarVentas" class="icon">

        <h4 class="title">Supervisor</h4>

        <p><strong>Gestionar</strong></p>

        <div class="background-hover"></div>

    </a> 
    <?php } ?>

    </div> 
<!-- Opcion de Crear Usuarios-->
    <?php if ($_SESSION['rolVentas'] == 'Administrador') { ?>
    <a href="crear_usuario.php">

        <div class="box box4">

            <img src="media/img/crear_usuario.png" class="icon">

            <h4 class="title">Crear usuario</h4>

            <p><strong>Añadir un nuevo usuario</strong></p>

        <div class="background-hover"></div>

    </a> 
    <?php } ?>

    </div> 
<!-- Opcion de Listado de Usuarios-->
    <?php if ($_SESSION['rolVentas'] == 'Administrador') { ?>
    <a href="listado-usuarios.php">

        <div class="box box5">

            <img src="media/img/listado.png" class="icon">

            <h4 class="title">Lista de usuarios</h4>

            <p><strong>Usuarios registrados</strong></p>


        <div class="background-hover"></div>

    </a> 
    <?php } ?>

    </div> 

</div>
</section>
<!-- Opciones desplegables de Supervisor - Gestion-->
<div data-pushbar-id="pushbar-menu-supervisor" data-pushbar-direction="top" class="pusbar-fono-bitacora">
    <h1> Gestión Supersivor</h1>
    <div class="container-boxes">

            <a href="tabla_ventas.php" target="_top">

                <div class="boxes boxes1">

                    <img src="media/img/ventas.png" alt="usuario-reportar" class="icon" >

                    <h4 class="title">Ventas</h4>

                    <p><strong><?php echo strtoupper($_SESSION["rolVentas"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

            <div class="boxes boxes1">

                <img src="media/img/consultar.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Documentos</h4>

                <p><strong><?php echo strtoupper($_SESSION["rolVentas"])?></strong></p>

                <div class="background-hover"></div>

            </div>  

            </a>

</div>
<button data-pushbar-close><span class="icon-cancel-circle" id="close"></span></button>
<span class="icon-circle-down"  data-pushbar-target="pushbar-menu-fonoplus"></span>
</div>

<!-- Opciones desplegables de Consulta -->
<div data-pushbar-id="pushbar-menu-consulta" data-pushbar-direction="top" class="pusbar-fono-bitacora">
    <h1> Modulo Consultar </h1>
    <div class="container-boxes">

            <a href="consultar-ventas.php" target="_top">

                <div class="boxes boxes1">

                    <img src="media/img/ventas.png" alt="usuario-reportar" class="icon" >

                    <h4 class="title"> Ventas</h4>

                    <p><strong>Consultar Ventas</strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

            <div class="boxes boxes1">

                <img src="media/img/consultar.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Documentos</h4>

                <p><strong>Consultar Documentos</strong></p>

                <div class="background-hover"></div>

            </div>  

            </a>

</div>
<button data-pushbar-close><span class="icon-cancel-circle" id="close"></span></button>
<span class="icon-circle-down"  data-pushbar-target="pushbar-menu-fonoplus"></span>
</div>

<script src="sistema/js/libs/pushbar.js"></script>


<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
<script src="sistema/js/libs/sweetalert2.js"></script>

	<script>
        Swal.fire({
        title: "Bienvenido/a!",
        html:'<h2 class="user"><?php echo $_SESSION["rolVentas"]?><?php echo ':'?> <?php echo $_SESSION["usernames"]?></h2>',
        timer:3000,
        timerProgressBar:true,
        confirmButtonText: 'Aceptar'
        });
    </script>

    <script>
     
        Swal.bindClickHandler()

        Swal.mixin({
        toast: true,
        }).bindClickHandler('data-swal-toast-template')
        
       
    </script>
</body>
</html>