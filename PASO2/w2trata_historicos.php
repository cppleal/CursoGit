<?php

	echo "Num Socio;Plan ID;Cuota Plan;UserID;Fecha Baja;Fecha Sistema;Ano Sistema;Anos sin Renovar;
		Importe por NO Renovacion;Importe Derramas;Importe Suscripcion;Fecha Nacimiento;
		Ano Nacimiento; Ano Sistema - 5;Importe Bonificacion;IMPORTE TOTAL CALCULADO;Historico";

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
		$paso_historico="NO";

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
		

//--- cambiamos el planid = 4 por 1 para simular renovación y ver 
//--- de aquellos registros que todavía no se han registrado, si 
//--- por importe hay que llevarlos al histórico.

		if ($plan_id == 4)
		{
			$plan_id_guarda = $plan_id;
			$plan_id = 1;
		}
		
		include 'w1_modulo_calculo_general.php'; 


//----    Si el importe excede los 165 € del Alta, se elimina el registro y se lleva al Histórico  -------------
//
		
		if ($importe_pago_calc < -165)
		{
			$paso_historico = 'SI';
			$plan_id = $plan_id_guarda;
		}

//----    Si existen Socios de Temporada del año anterior o Trabajadores, se llevan también al Histórico   -------------
//
		
		if ($plan_id == 8 or $plan_id == 10)
		{
			$paso_historico = 'SI';
		}
				
//
		if ($paso_historico == 'SI')
		{
			include 'w2genera_historicos.php'; 
		}

		echo ";".$paso_historico;

	}
		
	mysqli_close($link);  
?> 
