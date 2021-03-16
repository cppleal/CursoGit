<?php

	echo "Entro en programa ";

	include("AbrirBD.php4"); 
	
//
// Actualización de CBSUBS_SUBSCRIPTIONS para permitir revision de Socios 
//	 para ello hay que ampliar la Fecha de Expiración a 30-09-XXXX (año de la Temporada)
// Además de los Socios que renuevan por primera vez, aquellos que no han renovado el año
//   pasado, tienen la Fecha de Expiración anterior y no permite su renovación, o sea, todos
//   aquellos que tengan Fecha de Baja anterior a la Temporada en curso, deberán de actualizar
//   en el mismo sentido su Fecha de Expiración.
//
// -------------------- Inicializaciones de Campos ----------------------------
	$contador2 = 0;


	$consulta="SELECT *
					FROM	lyjrh_cbsubs_subscriptions t1, lyjrh_comprofiler t2
					WHERE	t1.user_id = t2.user_id 
				";

//				WHERE	user_id < 10100
	
	$consulta = mysqli_query($link,$consulta); 
	
	while($row = mysqli_fetch_array($consulta))
		{
// -------------------- Inicializaciones de Campos ----------------------------


// -------------------- Recuperación desde Base de Datos ----------------------
		$user_id=$row["user_id"];
		$plan_id=$row["plan_id"];
		$fecha_expiracion=$row["expiry_date"];
		$status=$row["status"];
		$cb_fecha_baja=$row["cb_fecha_baja"];

//
// Calculos con Fechas. Fecha de Expiración y Fecha Temporada
//
		$ano_sistema = date("Y");		
		$resto_expiracion = "-09-30 23:59:59";
		$fecha_expiracion_calc = $ano_sistema.$resto_expiracion;

		$fecha_temporada = $ano_sistema."-01-01";

//-------------------------------------------------------------------------------

		echo "<br>"."User ID....".$user_id;
		echo " Plan ID...".$plan_id;
		echo " status...".$status;
		echo " fecha expiración...".$fecha_expiracion;
		echo " fecha expiración calc...".$fecha_expiracion_calc;
		echo " fecha baja...".$cb_fecha_baja;
		echo " fecha temporada...".$fecha_temporada;

		if ($plan_id == 4)
		{	
			$status = "A";
			$fecha_expiracion = $fecha_expiracion_calc;
			echo " Plan 4.cambia Fecha Expiración";
		}


// Llegado este punto, todos los registros tienen fecha de baja, hay que distinguir los menores de la 
// temporada actual

		if ($plan_id == 1)
		{	
			if($cb_fecha_baja < $fecha_temporada)
			{
				$fecha_expiracion = $fecha_expiracion_calc;
				echo " Plan 1.cambia Fecha Expiración";
			}
		}
		

//
// Actualiza Base de Datos
//
		$actualiza="UPDATE lyjrh_cbsubs_subscriptions  
						SET
							status				= '$status',
							expiry_date			= '$fecha_expiracion'
						WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$actualiza);

//

		}
		
	mysqli_close($link);  
?> 
