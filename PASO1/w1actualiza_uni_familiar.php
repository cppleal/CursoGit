<?php

	echo "Num Socio;Plan ID;Cuota Plan;UserID;Fecha Baja;Fecha Sistema;Ano Sistema;Anos sin Renovar;
		Importe por NO Renovacion;Importe Derramas;Importe Suscripcion;Fecha Nacimiento;
		Ano Nacimiento; Ano Sistema - 5;Importe Bonificacion;IMPORTE TOTAL CALCULADO";

	include("AbrirBD.php4"); 

	$consulta="SELECT *
				FROM	lyjrh_comprofiler
					WHERE		(cb_tipo_socio = 'SOC' 
								OR cb_tipo_socio = 'ASO')
					AND 	cb_fecha_nacimiento > '0000-00-00'
					AND 	cb_ind_unidad_familiar is null	
				";

//				WHERE	user_id < 10020
//					AND 	cb_ind_unidad_familiar is null	
	
	
	$consulta = mysqli_query($link,$consulta); 
	
	while($row = mysqli_fetch_array($consulta))
	{
// -------------------- Inicializaciones de Campos ----------------------------

		$contador_socio = 0;
		$cb_ind_unidad_familiar='SI';

		$cb_id_pago_socio1a		= 0;
		$cb_id_pago_socio2a		= 0;
		$cb_id_pago_socio3a		= 0;
		$cb_id_pago_socio4a		= 0;
		$cb_id_pago_socio5a		= 0;
		$cb_id_pago_socio6a		= 0;
		$cb_id_pago_socio7a		= 0;
		$cb_id_pago_socio8a		= 0;
		$cb_id_pago_socio9a		= 0;
		$cb_id_pago_socio10a	= 0;

// -------------------- Recuperación desde Base de Datos ----------------------
		$user_id=$row["user_id"];
		$cb_num_socio=$row["cb_num_socio"];
		$plan_id=$row["cb_plan_id"];
		
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
		
//----    Llamada al módulo de Cálculo General de Socios    -------------

		$unidad_familiar = $cb_direccion . ' ' . $cb_num_piso_puerta;
		
		echo "<br>"."User ID....".$user_id;
		echo " Socio...".$cb_num_socio;
		echo ' Direccion Unidad Familiar...'.$cb_direccion.' '.$cb_num_piso_puerta;
		
//----
//----  TRATAMIENTO DE SOCIOS RELACIONADOS CON EL PRINCIPAL
//----
		$consulta2="SELECT *
					FROM	lyjrh_comprofiler
						WHERE 	cb_direccion = '$cb_direccion' 
						AND 	cb_num_piso_puerta = '$cb_num_piso_puerta'
						AND 	cb_fecha_nacimiento > '0000-00-00'
						AND 	(cb_tipo_socio = 'SOC' 
							 OR  cb_tipo_socio = 'ASO')
						AND		user_id <> '$user_id'
						ORDER BY cb_fecha_nacimiento desc
					";

		$consulta2 = mysqli_query($link,$consulta2); 

		while($row2 = mysqli_fetch_array($consulta2))
		{
// -------------------- Recuperación desde Base de Datos ----------------------
			$user_id2=$row2["user_id"];
			$cb_num_socio2=$row2["cb_num_socio"];
			$plan_id2=$row2["cb_plan_id"];
		
			$cb_direccion2=$row2["cb_direccion"];
			$cb_num_piso_puerta2=$row2["cb_num_piso_puerta"];
			
			$cb_total_asociados2=$row2["cb_total_asociados"];
			$cb_num_orden2=$row2["cb_num_orden"];
			$cb_ind_unidad_familiar2=$row2["cb_ind_unidad_familiar"];
		
			echo "<br>"."----------> User ID....".$user_id2;
			echo " Socio...".$cb_num_socio2;
			echo ' Direccion Unidad Familiar...'.$cb_direccion2.' '.$cb_num_piso_puerta2;
			echo " total asociados...".$cb_total_asociados2;
			echo " num orden...".$cb_num_orden;
			echo " ind_unidad_familia...".$cb_ind_unidad_familiar2;
//----

			$contador_socio = $contador_socio + 1;

			echo " secuencia calc...".$contador_secuencia;
//----

			if ($contador_socio == 1)			
				{
				$cb_id_pago_socio1a		= $user_id2;
				}
			if ($contador_socio == 2)			
				{
				$cb_id_pago_socio2a		= $user_id2;
				}
			if ($contador_socio == 3)			
				{
				$cb_id_pago_socio3a		= $user_id2;
				}
			if ($contador_socio == 4)			
				{
				$cb_id_pago_socio4a		= $user_id2;
				}
			if ($contador_socio == 5)			
				{
				$cb_id_pago_socio5a		= $user_id2;
				}
			if ($contador_socio == 6)			
				{
				$cb_id_pago_socio6a		= $user_id2;
				}
			if ($contador_socio == 7)			
				{
				$cb_id_pago_socio7a		= $user_id2;
				}
			if ($contador_socio == 8)			
				{
				$cb_id_pago_socio8a		= $user_id2;
				}
			if ($contador_socio == 9)			
				{
				$cb_id_pago_socio9a		= $user_id2;
				}
			if ($contador_socio == 10)			
				{
				$cb_id_pago_socio10a	= $user_id2;
				}
			
//----
		}

		if ($cb_id_pago_socio1 == 0)
		{
			$cb_id_pago_socio1			= $cb_id_pago_socio1a;
			$cb_seleccion_pago_socio1	= 0;
		}
		
		echo ' $cb_id_pago_socio1....'.$cb_id_pago_socio1; 
		echo ' $cb_id_pago_socio1a....'.$cb_id_pago_socio1a; 
		
		if ($cb_id_pago_socio2 == 0)
		{
			$cb_id_pago_socio2			= $cb_id_pago_socio2a;
			$cb_seleccion_pago_socio2	= 0;
		}

		if ($cb_id_pago_socio3 == 0)
		{
			$cb_id_pago_socio3			= $cb_id_pago_socio3a;
			$cb_seleccion_pago_socio3	= 0;
		}

		if ($cb_id_pago_socio4 == 0)
		{
			$cb_id_pago_socio4			= $cb_id_pago_socio4a;
			$cb_seleccion_pago_socio4	= 0;
		}
		
		if ($cb_id_pago_socio5 == 0)
		{
			$cb_id_pago_socio5			= $cb_id_pago_socio5a;
			$cb_seleccion_pago_socio5	= 0;
		}
		
		if ($cb_id_pago_socio6 == 0)
		{
			$cb_id_pago_socio6			= $cb_id_pago_socio6a;
			$cb_seleccion_pago_socio6	= 0;
		}
		
		if ($cb_id_pago_socio7 == 0)
		{
			$cb_id_pago_socio7			= $cb_id_pago_socio7a;
			$cb_seleccion_pago_socio7	= 0;
		}
		
		if ($cb_id_pago_socio8 == 0)
		{
			$cb_id_pago_socio8			= $cb_id_pago_socio8a;
			$cb_seleccion_pago_socio8	= 0;
		}
		
		if ($cb_id_pago_socio9 == 0)
		{
			$cb_id_pago_socio9			= $cb_id_pago_socio9a;
			$cb_seleccion_pago_socio9	= 0;
		}
		
		if ($cb_id_pago_socio10 == 0)
		{
			$cb_id_pago_socio10			= $cb_id_pago_socio10a;
			$cb_seleccion_pago_socio10	= 0;
		}

//
//----    Actualiza Base de Datos    -------------
//

		$actualiza="UPDATE lyjrh_comprofiler  
						SET
								cb_total_asociados 			= (SELECT count(*) FROM 
																(SELECT * FROM lyjrh_comprofiler 
																		WHERE cb_direccion = '$cb_direccion' 
																		AND cb_num_piso_puerta = '$cb_num_piso_puerta'
																		AND cb_fecha_nacimiento > '0000-00-00'
																		AND (cb_tipo_socio = 'SOC' 
																		 OR  cb_tipo_socio = 'ASO')
																) as t),
								cb_seleccion_pago_socio1 	= '$cb_seleccion_pago_socio1',
								cb_seleccion_pago_socio2 	= '$cb_seleccion_pago_socio2',
								cb_seleccion_pago_socio3 	= '$cb_seleccion_pago_socio3',
								cb_seleccion_pago_socio4 	= '$cb_seleccion_pago_socio4',
								cb_seleccion_pago_socio5 	= '$cb_seleccion_pago_socio5',
								cb_seleccion_pago_socio6 	= '$cb_seleccion_pago_socio6',
								cb_seleccion_pago_socio7 	= '$cb_seleccion_pago_socio7',
								cb_seleccion_pago_socio8 	= '$cb_seleccion_pago_socio8',
								cb_seleccion_pago_socio9 	= '$cb_seleccion_pago_socio9',
								cb_seleccion_pago_socio10	= '$cb_seleccion_pago_socio10',
								cb_id_pago_socio1 			= '$cb_id_pago_socio1',
								cb_id_pago_socio2 			= '$cb_id_pago_socio2',
								cb_id_pago_socio3 			= '$cb_id_pago_socio3',
								cb_id_pago_socio4 			= '$cb_id_pago_socio4',
								cb_id_pago_socio5 			= '$cb_id_pago_socio5',
								cb_id_pago_socio6 			= '$cb_id_pago_socio6',
								cb_id_pago_socio7 			= '$cb_id_pago_socio7',
								cb_id_pago_socio8 			= '$cb_id_pago_socio8',
								cb_id_pago_socio9 			= '$cb_id_pago_socio9',
								cb_id_pago_socio10			= '$cb_id_pago_socio10',
								cb_ind_unidad_familiar		= '$cb_ind_unidad_familiar',
								cb_fecha_ult_modif          = current_timestamp
						WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$actualiza);

	}
		
	mysqli_close($link);  
?> 
