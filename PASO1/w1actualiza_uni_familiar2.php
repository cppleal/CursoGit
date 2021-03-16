<?php

	echo "Entro en programa ";

	include("AbrirBD.php4"); 

// -------------------- Inicializaciones de Campos ----------------------------
//
	$control_unidad_familiar = '';
	$contador_secuencia = 0;	


	$consulta="SELECT * FROM lyjrh_comprofiler 
						WHERE (cb_tipo_socio = 'SOC' 
						   OR cb_tipo_socio = 'ASO')
						  AND cb_fecha_nacimiento > '0000-00-00'
						ORDER BY cb_direccion, cb_num_piso_puerta, cb_fecha_nacimiento desc
				";

//				WHERE	user_id < 10020
	
	$consulta = mysqli_query($link,$consulta); 
	
	$user_id=0;
	
	while($row = mysqli_fetch_array($consulta))
		{
		echo "Entro en while ".$user_id;
// -------------------- Inicializaciones de Campos ----------------------------
		
		
// -------------------- Recuperación desde Base de Datos ----------------------
		$user_id=$row["user_id"];
		$fecha_baja=$row["cb_fecha_baja"];
		$fecha_nacimiento=$row["cb_fecha_nacimiento"];
		$ano_nacimiento=$row["cb_ano_nacimiento"];
		
		$cb_direccion=$row["cb_direccion"];
		$cb_num_piso_puerta=$row["cb_num_piso_puerta"];
		
//
//-----------------------------------------------------------------------------
//

		$unidad_familiar = $cb_direccion . ' ' . $cb_num_piso_puerta;
		
		if ($control_unidad_familiar == '')
			{
			$control_unidad_familiar = $unidad_familiar;
			}
		
		if ($unidad_familiar <> $control_unidad_familiar)
			{
			$contador_secuencia = 1;		
			$control_unidad_familiar = $unidad_familiar;
			}
		else
			{
			$contador_secuencia = $contador_secuencia + 1;		
			}
//
// Actualiza Base de Datos
//
//
		$actualiza="UPDATE lyjrh_comprofiler  
						SET
								cb_num_orden				= '$contador_secuencia',
								cb_total_asociados 			= (SELECT count(*) FROM 
																(SELECT * FROM lyjrh_comprofiler 
																		WHERE cb_direccion = '$cb_direccion' 
																		AND cb_num_piso_puerta = '$cb_num_piso_puerta'
																		AND cb_fecha_nacimiento > '0000-00-00'
																		AND (cb_tipo_socio = 'SOC' 
																		 OR  cb_tipo_socio = 'ASO')
																) as t),
								cb_fecha_ult_modif			= current_timestamp
						WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$actualiza);
//
		}
		
	mysqli_close($link);  
?> 
