<?php
include('../../config/session.php');
header("Content-Type: text/html;charset=utf-8"); /* Cotejamiento de PHP */
mb_internal_encoding("UTF-8"); /*Cotejamiento interno para consultas SQL */

$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];

if(isset($_POST['generar_reportes_ventas']))
{
    // NOMBRE DEL ARCHIVO Y CHARSET
    
	header('Content-Type:text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename="Reporte_Consolidado_Ventas.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'b');
	// ENCABEZADOS
	fputcsv($salida, array('ID Registro','Fecha Registro', 'Hora Creacion Registro', ' Contrato',  'Nombre Contratante', 'Documento Contratante',
						   'Tipo de Identificacion','Documento Beneficiario', 'Nombre Beneficiario', 'Celular Beneficiario', 'Activacion Modulo',
                           'Observaciones','Ciudad del Contrato','Consecutivo Ventas','ID Llamada', 'Tipo Venta', 'Asesor de Ventas','Supervisor',  
                           'Fecha Cierre', 'Hora Cierre'));
	// QUERY PARA CREAR EL REPORTE VENTAS
	$traerDatos=$con->query("SELECT     ventas.id_registro,
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
                                        u1.username AS user_cierre,
                                        ventas.fechaCierre,
                                        ventas.horaCierre
                                        FROM ((((registrar_venta ventas
                                        INNER JOIN usuarios u
                                            ON ventas.id_userCrea = u.id_usuario)
                                        LEFT JOIN usuarios u1
                                            ON ventas.id_userCierre = u1.id_usuario)
                                        LEFT JOIN tipificaciones t
                                            ON ventas.id_Tipificacionciudad_contrato = t.id_tipificacion)
                                        LEFT JOIN tipificaciones t1
                                            ON ventas.id_TipificaciontipoVentas = t1.id_tipificacion)
                                        where fechaRegistro BETWEEN '$fecha1' AND '$fecha2' ORDER BY id_registro");

	foreach ($traerDatos as $filaR) {
				
		$cadena = $filaR['observaciones'];

		$filaR['observaciones'] = preg_replace("[\n|\r|\n\r]", "", $cadena);
	
		
		fputcsv($salida, array($filaR['id_registro'], 
								$filaR['fecha_registro'],
								$filaR['horaRegistro'],
                                $filaR['contrato'],
								$filaR['nombre_contratante'],
								$filaR['documento_contratante'],
								$filaR['tipoIdentificacion_beneficiario'],
								$filaR['documento_beneficiario'],
								$filaR['nombre_beneficiario'],
                                $filaR['celular_beneficiario'],
                                $filaR['activacion_modulo'],
                                $filaR['observaciones'],
                                $filaR['ciudadContrato'],
                                $filaR['consecutivoVentas'],
                                $filaR['id_llamada'],
                                $filaR['tipoVenta'],
                                $filaR['user_crea'],
                                $filaR['user_cierre'],
                                $filaR['fechaCierre'],
								$filaR['horaCierre']));
    }
}

if(isset($_POST['generar_reportes_correos']))
{
    // NOMBRE DEL ARCHIVO Y CHARSET
    
	header('Content-Type:text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename="Reporte_Consolidado_Correos.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'b');
	// ENCABEZADOS
	fputcsv($salida, array('ID Registro','Fecha Registro', 'Hora Creacion Registro', ' Contrato',  'Nombres', 'Tipo de Correo',
						   'Correo','Estado', 'Observaciones','Asesor','Supervisor',  
                           'Fecha Cierre', 'Hora Cierre'));
	// QUERY PARA CREAR EL REPORTE CORREOS
	$traerDatos=$con->query("SELECT     correo.id_registro,
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
                                        where fechaRegistro BETWEEN '$fecha1' AND '$fecha2' ORDER BY id_registro");

	foreach ($traerDatos as $filaR) {
				
		$cadena = $filaR['observaciones'];

		$filaR['observaciones'] = preg_replace("[\n|\r|\n\r]", "", $cadena);
	
		
		fputcsv($salida, array($filaR['id_registro'], 
								$filaR['fecha_registro'],
								$filaR['horaRegistro'],
                                $filaR['contrato'],
								$filaR['nombres'],
                                $filaR['tipo_correo'],
                                $filaR['correo'],
                                $filaR['estado'],
                                $filaR['observaciones'],
                                $filaR['user_crea'],
                                $filaR['user_cierre'],
                                $filaR['fechaCierre'],
								$filaR['horaCierre']));
    }
}


?>