<?php

//	echo "Entro en programa ";
// -------------------- Inicializaciones de Campos ----------------------------
	$contador = 0;
	
	include("AbrirBD.php4"); 

	$consulta="SELECT *
				FROM	lyjrh_comprofiler_cupones
				";

//				WHERE	user_id < 10100
	
	$consulta = mysqli_query($link,$consulta); 
	
	while($row = mysqli_fetch_array($consulta))
		{
// -------------------- Recuperación desde Base de Datos ----------------------
		$user_id=$row["user_id"];
//
// Generación de Códigos de Cupón para Invitaciones
//
		include("genera_claves.php"); 
		$codigo_cupon = $clave;
		
		$usuario_audit = "carga";

//-------------------------------------------------------------------------------
		$contador = $contador + 1;

		echo "<br>"."User ID....".$user_id;
		echo " Codigo Cupon....".$codigo_cupon;		
		echo " contador....".$contador;		

//
// Actualiza Base de Datos
//

		$actualiza="UPDATE lyjrh_comprofiler_cupones  
						SET
								codigo_cupon		= '$codigo_cupon', 	
								usuario_audit 		= '$usuario_audit',
								fecha_audit			= current_timestamp
						WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$actualiza);



		$actualiza="UPDATE lyjrh_vikevents_coupons  
						SET
								code				= '$codigo_cupon', 	
								type		 		= 1,
								percentot			= 2,
								value				= 6.00,
								allitems			= 0,
								iditems				= ';1;',
								mintotord			= 0.00,
								minpeople			= 1,
								maxuse				= 1,
								numuse				= 0
						WHERE 	id = '$user_id'
			";
		mysqli_query($link,$actualiza);


		}
		
	mysqli_close($link);  
?> 
