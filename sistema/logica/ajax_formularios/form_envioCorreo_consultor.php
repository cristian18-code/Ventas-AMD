<?php 

    if ( empty($_POST['user'])) {
        $alert="<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Error en la sesion!'
        })
        </script>";
    }
    else if (empty($_POST['dia']) || empty($_POST['hora']) || empty($_POST['registro'])) {
        $alert="<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Error en la sesion!'
        })
        </script>";
    }
    else if (empty($_POST['contrato']) || empty($_POST['nombres'])
                || empty($_POST['correo']) || empty($_POST['tipoCorreo'])) {                
                    $alert="<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Todos los campos son obligatorios!'
                    })
                    </script>";
    } else {
        
        require('../../../config/db.php');
        require('../../../config/conexion.php');

        $userRegistra = $_POST['user'];
        $fechaRegistro = $_POST['dia'];
        $horaRegistro = $_POST['hora'];
        $registro = $_POST['registro'];
        $contrato = $_POST['contrato'];
        $nombres = $_POST['nombres'];
        $correo = $_POST['correo'];
        $tipoCorreo = $_POST['tipoCorreo'];

        $insertSsql = "INSERT INTO  envioCorreo_registros (fechaRegistro,
                                    horaRegistro,
                                    contrato,
                                    nombres,
                                    correo,
                                    id_tipoCorreo,
                                    id_userCrea)
                            VALUES (
                                    STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$contrato',
                                    '$nombres',
                                    '$correo',
                                    '$tipoCorreo',
                                    '$userRegistra')";

        $insertQslq = $con -> query($insertSsql);
            
        if($insertQslq){
            $alert="<script>
                    var id = $registro;
                    Swal.fire(
                        'Registro Creado',
                        'Se ha a guardado el registro No: '+ id +'',
                        'success'
                    ) 
                    </script>";
        }else{
            $alert="<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ocurrio un error!'

                    })
                    </script>";
        }
           
        mysqli_close($con);
    }

    echo $alert;

?>