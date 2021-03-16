<?php

	echo "t1.id;t1.cb_num_socio;t1.cb_plan_id;t1.cb_fecha_baja;
		t3.for_user_id;t3.by_user_id;t3.time_paid_date;t3.payer_name;t3.item_name;t3.mc_gross;t3.payment_gross;fecha_baja calculada";

	include("AbrirBD.php4"); 

	$consulta="SELECT 	t1.id, t1.cb_num_socio, t1.cb_plan_id, t1.cb_fecha_baja, 
						t3.for_user_id, t3.by_user_id, t3.time_paid_date, t3.payer_name, t3.item_name, t3.mc_gross, t3.payment_gross
					FROM	lyjrh_comprofiler t1, 
							lyjrh_cbsubs_payments t3
					WHERE 	t1.user_id			= t3.for_user_id
						AND t1.user_id			> 42
					ORDER BY  t1.id, t3.time_paid_date desc
				";

//

	$consulta = mysqli_query($link,$consulta); 
	
	$control_socio = "";
	
	while($row = mysqli_fetch_array($consulta))
	{
// -------------------- Recuperación desde Base de Datos ----------------------
		$t1_id=$row["id"];
		$t1_cb_num_socio=$row["cb_num_socio"];
		$t1_cb_plan_id=$row["cb_plan_id"];
		$t1_cb_fecha_baja=$row["cb_fecha_baja"];
		$t3_for_user_id=$row["for_user_id"];
		$t3_by_user_id=$row["by_user_id"];
		$t3_time_paid_date=$row["time_paid_date"];
		$t3_payer_name=$row["payer_name"];
		$t3_item_name=$row["item_name"];		
		$t3_mc_gross=$row["mc_gross"];
		$t3_payment_gross=$row["payment_gross"];

//		echo "<br> id....".$t1_id."....item_name...".$t3_item_name."....Fecha de Baja....".$t1_cb_fecha_baja."....Fecha Recibo....".$t3_time_paid_date;

		$eval_item = substr($t3_item_name, 0, 8);
		
		if ($eval_item == "Renovaci" or $eval_item == "Pago Sus" )
		{
			if ($control_socio <> $t1_id)
			{
				$control_socio = $t1_id;
			
				if(is_null($t1_cb_fecha_baja) or $t1_cb_fecha_baja == '0000-00-00')
				{
					$ano_baja = date("Y");
				}
				else
				{
					$ano_baja = date("Y", strtotime($t1_cb_fecha_baja));
				}

				$ano_recibo = date("Y", strtotime($t3_time_paid_date));			
				$ano_baja_1 = $ano_baja - 1;
			
				if ($ano_baja_1 <> $ano_recibo)
				{
					$ano_resultante = $ano_recibo + 1;
					$fecha_baja_resultante = $ano_resultante."-03-31";
					
					echo 	"<br>".$t1_id.";".$t1_cb_num_socio.";".$t1_cb_plan_id.";".$t1_cb_fecha_baja.";".
							$t3_for_user_id.";".$t3_by_user_id.";".$t3_time_paid_date.";".$t3_payer_name.";".
							$t3_item_name.";".$t3_mc_gross.";".$t3_payment_gross.";".$fecha_baja_resultante;
//
//----    Actualiza Base de Datos    -------------
//
					$actualiza="UPDATE lyjrh_comprofiler  
						SET
								cb_fecha_baja 			= '$fecha_baja_resultante',
								cb_fecha_ult_modif  	= current_timestamp
						WHERE 	id = '$t1_id'
						";
					mysqli_query($link,$actualiza);

				}
			}
		}
		
	}
		
	mysqli_close($link);  
?> 
