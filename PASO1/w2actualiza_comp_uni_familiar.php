<?php

	echo "Entro en programa ";

// -------------------- Inicializaciones de Campos ----------------------------
	$contador = 0;
	$control_unidad_familiar = '';
	$contador_secuencia = 0;	
	$cb_ind_unidad_familiar = 'NO';

// ------------------------------------------------
	
	include("AbrirBD.php4"); 

//
// -------------------- Obtener último Registro de la Tabla comprofiler_cupones ----------------------------
//
	$consulta="SELECT * 
					FROM `lyjrh_comprofiler`
						WHERE (cb_tipo_socio = 'SOC' 
						   OR cb_tipo_socio = 'ASO')
						  AND cb_fecha_nacimiento > '0000-00-00'
						ORDER BY cb_direccion, cb_num_piso_puerta, cb_fecha_nacimiento DESC
				";

	$consulta = mysqli_query($link,$consulta); 

//		echo " Despues de SELECT";

	while($row = mysqli_fetch_array($consulta))
	{
// -------------------- Inicializaciones de Campos ----------------------------
//
		$situacion_pago 		= "";
		$user_id_pago			= 0;

// -------------------- 	
		$user_id=$row["user_id"];

		$num_socio=$row["cb_num_socio"];
		$total_asociados=$row["cb_total_asociados"];
		$num_orden=$row["cb_num_orden"];
		$cb_direccion=$row["cb_direccion"];
		$cb_num_piso_puerta=$row["cb_num_piso_puerta"];

		$cb_importe_suscripcion=$row["cb_importe_suscripcion"];
		$cb_importe_no_renovacion=$row["cb_importe_no_renovacion"];
		$cb_importe_derramas=$row["cb_importe_derramas"];
		$cb_importe_derramas2020=$row["cb_importe_derramas2020"];
		$cb_importe_bonificacion=$row["cb_importe_bonificacion"];
		
		$cb_ind_pago_derramas2020=$row["cb_ind_pago_derramas2020"];

//------			
//------ CALCULO DE PAGOS PENDIENTES PARA LA TEMPORADA Y POR SOCIO -----------------
//------

		if ($cb_ind_pago_derramas2020 == 'SI')
		{	
			$cb_importe_derramas2020 = 0;
		}
		else
		{
			$cb_importe_derramas2020=$row["cb_importe_derramas2020"];
		}

			
		$importe_pago = $cb_importe_suscripcion + $cb_importe_no_renovacion + $cb_importe_derramas +
						$cb_importe_derramas2020 + $cb_importe_bonificacion;

//------------------------------------------------------

		$consulta2="SELECT *
						FROM	lyjrh_comp_uni_familiar 
						WHERE 	user_id		= '$user_id'	
					";

		$consulta2 = mysqli_query($link,$consulta2); 
	
		echo "<br>"."User ID....".$user_id;
		echo " Socio...".$num_socio;
		echo " Direccion Unidad Familiar...".$cb_direccion." ".$cb_num_piso_puerta;
		echo " Importe Pago Temporada...".$importe_pago;		

		while($registro = mysqli_fetch_array($consulta2))
		{ 
			$situacion_pago	= $registro["situacion_pago"];
		}
	
//------------------------------------------------------

		echo " Situacion de Pago..".$situacion_pago;

		if ($situacion_pago == "")
		{
			echo " -NO- EXISTE REGISTRO";
			$situacion_pago		= "PENDIENTE";		
			$user_id_pago		= 0;

			$actualiza="INSERT INTO lyjrh_comp_uni_familiar	(
								`user_id`, 
								`num_socio`, 
								`total_asociados`, 
								`num_orden`, 
								`importe_pago`, 
								`seleccion_pago`, 
								`user_id_pago`, 
								`situacion_pago`,
								`fecha_modificacion`								
							) 
							VALUES
								('$user_id', 
								'$num_socio', 
								'$total_asociados', 
								'$num_orden', 
								'$importe_pago', 
								NULL, 
								'$user_id_pago', 
								'$situacion_pago',
								current_timestamp)
					";
		}
		else
		{
			echo " -SI- EXISTE REGISTRO";
			$situacion_pago	= "PENDIENTE";		
			$user_id_pago		= 0;
			
			$actualiza="UPDATE lyjrh_comp_uni_familiar  
						SET
							total_asociados			= '$total_asociados', 
							num_orden				= '$num_orden', 
							importe_pago			= '$importe_pago', 
							user_id_pago			= '$user_id_pago', 
							situacion_pago			= '$situacion_pago',
							fecha_modificacion		= current_timestamp
						WHERE 	user_id = '$user_id'
				";
		}
					
		mysqli_query($link,$actualiza);

	}
		
	mysqli_close($link);  
?> 
