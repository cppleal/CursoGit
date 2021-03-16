<?php

	echo "Entro en programa ";

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
					ORDER BY cb_direccion, cb_num_piso_puerta, cb_fecha_nacimiento desc
				";

//				WHERE	user_id < 10020
	
	$consulta = mysqli_query($link,$consulta); 
	
	while($row = mysqli_fetch_array($consulta))
		{
// -------------------- Inicializaciones de Campos ----------------------------

		$contador_socio = 0;

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
		
		echo '<br>'.'user id..'.$user_id.' Direccion Unidad Familiar...'.$cb_direccion.' '.$cb_num_piso_puerta;

// -------------------- Calculos para la Unidad Familiar ----------------------
//-----------------------------------------------------------------------------
//------- Relacion de IDs
//------- Importe de Pago 
//------- Nombre y Apellidos
		
		$consulta2="SELECT * FROM lyjrh_comprofiler 
							WHERE (cb_tipo_socio = 'SOC' 
							   OR cb_tipo_socio  = 'ASO')
							  AND user_id			   <> '$user_id'	
							  AND cb_fecha_nacimiento 	>  '0000-00-00'
							  AND cb_direccion 			= '$cb_direccion'
							  AND cb_num_piso_puerta 	= '$cb_num_piso_puerta'
							ORDER BY cb_direccion, cb_num_piso_puerta, cb_fecha_nacimiento desc
					";

//							WHERE	user_id < 10020
	
		$consulta2 = mysqli_query($link,$consulta2); 
	
		while($row2 = mysqli_fetch_array($consulta2))
		{
		
			$contador_socio = $contador_socio + 1;
			
			echo "Contador....".$contador_socio."<br>";
			
			$id_pago=$row2["user_id"];
						
			$nombre_apellidos=$row2["firstname"].' '.$row2["lastname"];
			
			echo "id pago....".$id_pago;			
			echo "  Nombre y Apellidos....".$nombre_apellidos;			

//-----------------------------------------------------------------------------

			if ($contador_socio == 1)			
				{
				$cb_id_pago_socio1a		= $id_pago;
				}
			if ($contador_socio == 2)			
				{
				$cb_id_pago_socio2a		= $id_pago;
				}
			if ($contador_socio == 3)			
				{
				$cb_id_pago_socio3a		= $id_pago;
				}
			if ($contador_socio == 4)			
				{
				$cb_id_pago_socio4a		= $id_pago;
				}
			if ($contador_socio == 5)			
				{
				$cb_id_pago_socio5a		= $id_pago;
				}
			if ($contador_socio == 6)			
				{
				$cb_id_pago_socio6a		= $id_pago;
				}
			if ($contador_socio == 7)			
				{
				$cb_id_pago_socio7a		= $id_pago;
				}
			if ($contador_socio == 8)			
				{
				$cb_id_pago_socio8a		= $id_pago;
				}
			if ($contador_socio == 9)			
				{
				$cb_id_pago_socio9a		= $id_pago;
				}
			if ($contador_socio == 10)			
				{
				$cb_id_pago_socio10a	= $id_pago;
				}
			
		}

		if ($cb_id_pago_socio1 == 0)
		{
			$cb_id_pago_socio1			= $cb_id_pago_socio1a;
			$cb_seleccion_pago_socio1	= 0;
		}
		
//		echo ' $cb_id_pago_socio1....'.$cb_id_pago_socio1; 
//		echo ' $cb_id_pago_socio1a....'.$cb_id_pago_socio1a; 
		
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
// Actualiza Base de Datos
//
//
		$actualiza="UPDATE lyjrh_comprofiler  
						SET
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
								cb_fecha_ult_modif			= current_timestamp
						WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$actualiza);
		
		echo $actualiza;
//
		}
		
	mysqli_close($link);  
?> 
