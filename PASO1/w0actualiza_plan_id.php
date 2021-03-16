<?php

	echo "user_id;cb_num_socio;cb_fecha_baja;cb_plan_id;cb_plan_id_new";

	include("AbrirBD.php4"); 

//
// 1.- Actualización de COMPROFILER para pasar planes de Altas (planes 3 y 6) a Renovaciones (plan 1)
//     y arreglo temporada 2020 con las Derramas (plan 12)
//
// -------------------- Inicializaciones de Campos ----------------------------

	$consulta="SELECT *
				FROM	lyjrh_comprofiler
				";

	$consulta = mysqli_query($link,$consulta); 
	
	$control_socio = "";
	
	while($row = mysqli_fetch_array($consulta))
	{
// -------------------- Inicializaciones --------------------------------------

		$cb_plan_id_new =0;

// -------------------- Recuperación desde Base de Datos ----------------------
		$user_id=$row["user_id"];
		$cb_num_socio=$row["cb_num_socio"];
		$cb_plan_id=$row["cb_plan_id"];
		$cb_fecha_baja=$row["cb_fecha_baja"];


//		echo "<br> user_id....".$user_id."....num_socio...".$cb_num_socio."....Fecha de Baja....".$t1_cb_fecha_baja."....Plan ID....".$cb_plan_id;

		if ($cb_plan_id == 3 or $cb_plan_id == 6 or $cb_plan_id == 12)
		{
			$cb_plan_id_new = 1;
				
			echo 	"<br>".$user_id.";".$cb_num_socio.";".$t1_cb_fecha_baja.";".$cb_plan_id.";".$cb_plan_id_new;
//
//----    Actualiza Base de Datos    -------------
//
					$actualiza="UPDATE lyjrh_comprofiler  
						SET
								cb_plan_id 			= '$cb_plan_id_new',
								cb_fecha_ult_modif  = current_timestamp
						WHERE 	user_id = '$user_id'
						";
					mysqli_query($link,$actualiza);
		}
		
	}

//
// 2.- Actualización de CBSUBS_SUBSCRIPTIONS para pasar planes de Altas a Renovaciones
//		(el Plan 12 tiene su propio registro en esta tabla)
//

	$consulta="SELECT *
				FROM	lyjrh_cbsubs_subscriptions
				WHERE	plan_id = 3
				   OR	plan_id = 6
				";

	$consulta = mysqli_query($link,$consulta); 
	
	while($row = mysqli_fetch_array($consulta))
	{
// -------------------- Inicializaciones de Campos ----------------------------

		$cb_plan_id_new =0;

// -------------------- Recuperación desde Base de Datos ----------------------
		$user_id=$row["user_id"];
		$plan_id=$row["plan_id"];
		$regular_recurrings_total=$row["regular_recurrings_total"];
		
//
// Cambio de Plan 3 o 6 a Plan 1 (el Plan 12 tiene su propio registro en esta tabla)
//
		$cb_plan_id_new = 1;
		$regular_recurrings_total = 0;
		
//-------------------------------------------------------------------------------

		echo 	"<br>".$user_id.";".";".";".$cb_plan_id.";".$cb_plan_id_new;
	
//
// Actualiza Base de Datos
//
		$actualiza="UPDATE lyjrh_cbsubs_subscriptions  
						SET
							plan_id						= '$cb_plan_id_new',
							regular_recurrings_total	= '$regular_recurrings_total'
						WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$actualiza);

	}
	
	mysqli_close($link);  
?> 
