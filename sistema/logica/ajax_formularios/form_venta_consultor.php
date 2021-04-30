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
    else if (empty($_POST['contrato']) || empty($_POST['documento_contratante']) || empty($_POST['nombre_contratante'])
                || empty($_POST['tipoIdentificacion_benefeciario']) || empty($_POST['documento_beneficiario']) || empty($_POST['nombre_beneficiario']) 
                || empty($_POST['celular_beneficiario']) || empty($_POST['fecha_activacionModulo']) || empty($_POST['ciudadContrato']) 
                || empty($_POST['observaciones'])) {                
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
        $documento_contratante = $_POST['documento_contratante'];
        $nombre_contratante = $_POST['nombre_contratante'];
        $tipoIdentificacion_benefeciario = $_POST['tipoIdentificacion_benefeciario'];
        $documento_beneficiario = $_POST['documento_beneficiario'];
        $nombre_beneficiario = $_POST['nombre_beneficiario'];
        $celular_beneficiario = $_POST['celular_beneficiario'];
        $fecha_activacionModulo = $_POST['fecha_activacionModulo'];
        $ciudadContrato= $_POST['ciudadContrato'];
        $observaciones = $_POST['observaciones'];

        $insertSsql = "INSERT INTO  registrar_venta (fechaRegistro,
                                    horaRegistro,
                                    contrato,
                                    documento_contratante,
                                    nombre_contratante,
                                    tipoIdentificacion_beneficiario,
                                    documento_beneficiario,
                                    nombre_beneficiario,
                                    celular_beneficiario,
                                    activacion_modulo,
                                    id_Tipificacionciudad_contrato,
                                    observaciones,
                                    id_userCrea)
                            VALUES (
                                    STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$contrato',
                                    '$documento_contratante',
                                    '$nombre_contratante',
                                    '$tipoIdentificacion_benefeciario',
                                    '$documento_beneficiario',
                                    '$nombre_beneficiario',
                                    '$celular_beneficiario',
                                    '$fecha_activacionModulo',
                                    '$ciudadContrato',
                                    '$observaciones',
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
                        text: 'Something went wrong!'

                    })
                    </script>";
        }
           
        mysqli_close($con);
    }

    echo $alert;

?>