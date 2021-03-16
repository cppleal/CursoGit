<?php

	echo "Num Socio;Plan ID;UserID;Fecha Baja;Fecha Nacimiento;
			direccion;num_piso_puerta;total asociados;num orden;
			seleccion_pago_socio1;id_pago_socio1;
			seleccion_pago_socio2;id_pago_socio2;
			seleccion_pago_socio3;id_pago_socio3;
			seleccion_pago_socio4;id_pago_socio4;
			seleccion_pago_socio5;id_pago_socio5;
			seleccion_pago_socio6;id_pago_socio6;
			seleccion_pago_socio7;id_pago_socio7;
			seleccion_pago_socio8;id_pago_socio8;
			seleccion_pago_socio9;id_pago_socio9;
			seleccion_pago_socio10;id_pago_socio10;";

	include("AbrirBD.php4"); 

// -------------------- Inicializaciones de Campos ----------------------------
//
	$control_unidad_familiar = '';
	$contador_secuencia = 0;	

// -------------------- 	

	$consulta="SELECT * FROM lyjrh_comprofiler 
						WHERE (cb_tipo_socio = 'SOC' 
						   OR cb_tipo_socio = 'ASO')
						  AND cb_fecha_nacimiento > '0000-00-00'
					ORDER BY cb_direccion, cb_num_piso_puerta, cb_num_orden
				";

//				WHERE	user_id < 10020
	
	$consulta = mysqli_query($link,$consulta); 
	
	while($row = mysqli_fetch_array($consulta))
	{
// -------------------- Inicializaciones de Campos ----------------------------


// -------------------- Recuperación desde Base de Datos ----------------------
		
		$user_id=$row["user_id"];
		$fecha_baja=$row["cb_fecha_baja"];
		$fecha_nacimiento=$row["cb_fecha_nacimiento"];
		$cb_num_socio=$row["cb_num_socio"];
		$plan_id=$row["cb_plan_id"];
		$cb_total_asociados=$row["cb_total_asociados"];
		$cb_num_orden=$row["cb_num_orden"];

		$cb_direccion=$row["cb_direccion"];
		$cb_num_piso_puerta=$row["cb_num_piso_puerta"];

		
		$cb_id_pago_socio1	= $row["cb_id_pago_socio1"];
		$cb_id_pago_socio2	= $row["cb_id_pago_socio2"];
		$cb_id_pago_socio3	= $row["cb_id_pago_socio3"];
		$cb_id_pago_socio4	= $row["cb_id_pago_socio4"];
		$cb_id_pago_socio5	= $row["cb_id_pago_socio5"];
		$cb_id_pago_socio6	= $row["cb_id_pago_socio6"];
		$cb_id_pago_socio7	= $row["cb_id_pago_socio7"];
		$cb_id_pago_socio8	= $row["cb_id_pago_socio8"];
		$cb_id_pago_socio9	= $row["cb_id_pago_socio9"];
		$cb_id_pago_socio10	= $row["cb_id_pago_socio10"];			

		$cb_seleccion_pago_socio1	= $row["cb_seleccion_pago_socio1"];
		$cb_seleccion_pago_socio2	= $row["cb_seleccion_pago_socio2"];
		$cb_seleccion_pago_socio3	= $row["cb_seleccion_pago_socio3"];
		$cb_seleccion_pago_socio4	= $row["cb_seleccion_pago_socio4"];
		$cb_seleccion_pago_socio5	= $row["cb_seleccion_pago_socio5"];
		$cb_seleccion_pago_socio6	= $row["cb_seleccion_pago_socio6"];
		$cb_seleccion_pago_socio7	= $row["cb_seleccion_pago_socio7"];
		$cb_seleccion_pago_socio8	= $row["cb_seleccion_pago_socio8"];
		$cb_seleccion_pago_socio9	= $row["cb_seleccion_pago_socio9"];
		$cb_seleccion_pago_socio10	= $row["cb_seleccion_pago_socio10"];		
		
//		echo '<br>'.'Direccion Unidad Familiar...'.$cb_direccion.' '.$cb_num_piso_puerta;
		
		echo 	"<br>".$cb_num_socio.';'.$plan_id.';'.$user_id.';'.$fecha_baja.';'.$fecha_nacimiento.';'.
				$cb_direccion.';'.$cb_num_piso_puerta.';'.$cb_total_asociados.';'.$cb_num_orden.';'.
				$cb_seleccion_pago_socio1.';'.$cb_id_pago_socio1.';'.
				$cb_seleccion_pago_socio2.';'.$cb_id_pago_socio2.';'.
				$cb_seleccion_pago_socio3.';'.$cb_id_pago_socio3.';'.
				$cb_seleccion_pago_socio4.';'.$cb_id_pago_socio4.';'.
				$cb_seleccion_pago_socio5.';'.$cb_id_pago_socio5.';'.
				$cb_seleccion_pago_socio6.';'.$cb_id_pago_socio6.';'.
				$cb_seleccion_pago_socio7.';'.$cb_id_pago_socio7.';'.
				$cb_seleccion_pago_socio8.';'.$cb_id_pago_socio8.';'.
				$cb_seleccion_pago_socio9.';'.$cb_id_pago_socio9.';'.
				$cb_seleccion_pago_socio10.';'.$cb_id_pago_socio10;

	}
		
	mysqli_close($link);  
?> 
