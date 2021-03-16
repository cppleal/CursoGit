<?php

	echo "Num Socio;Plan ID;Cuota Plan;UserID;Fecha Baja;Fecha Sistema;Ano Sistema;Anos sin Renovar;
		Importe por NO Renovacion;Importe Derramas;Importe Suscripcion;Fecha Nacimiento;
		Ano Nacimiento; Ano Sistema - 5;Importe Bonificacion;IMPORTE TOTAL CALCULADO";

	include("AbrirBD.php4"); 

	$consulta="SELECT *
				FROM	lyjrh_comprofiler
				";

//				WHERE	user_id < 10020
	
	$consulta = mysqli_query($link,$consulta); 
	
	while($row = mysqli_fetch_array($consulta))
	{
// -------------------- Inicializaciones de Campos ----------------------------
		$cb_anos_sin_renovar = 0;
		$cb_importe_no_renovacion = 0;
		$cb_importe_derramas = 0;
		$cb_importe_derramas2020 = 0;
		$cb_importe_suscripcion = 0;
		$cb_importe_bonificacion = 0;

// -------------------- Recuperación desde Base de Datos ----------------------
		$user_id=$row["user_id"];
		$fecha_baja=$row["cb_fecha_baja"];
		$fecha_nacimiento=$row["cb_fecha_nacimiento"];
		$importe_derramas2020=$row["importe_derramas2020"];
		$ind_pago_derramas2020=$row["ind_pago_derramas2020"];
		$cb_num_socio=$row["cb_num_socio"];
		$plan_id=$row["cb_plan_id"];
		
//----    Llamada al módulo de Cálculo General de Socios    -------------

		$activa_traza = 'SI';
		$tipo_acceso  = 'batch';
		
		include 'w1_modulo_calculo_general.php'; 


//
//----    Actualiza Base de Datos    -------------
//

		$actualiza="UPDATE lyjrh_comprofiler  
						SET
								cb_anos_sin_renovar 		= '$cb_anos_sin_renovar',
								cb_importe_no_renovacion 	= '$cb_importe_no_renovacion', 
								cb_importe_derramas			= '$cb_importe_derramas',
								cb_importe_suscripcion		= '$cb_importe_suscripcion',
								cb_importe_bonificacion		= '$cb_importe_bonificacion',
								cb_fecha_ult_modif          = current_timestamp
						WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$actualiza);

	}
		
	mysqli_close($link);  
?> 
