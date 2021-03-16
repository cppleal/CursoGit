<?php

//	echo "Entro en programa ";
// -------------------- Inicializaciones de Campos ----------------------------
	
	
	include("AbrirBD.php4"); 


	$consulta="SELECT *
				FROM	lyjrh_comprofiler
				";

//				WHERE	user_id < 10100
	
	$consulta = mysqli_query($link,$consulta); 
	
	while($row = mysqli_fetch_array($consulta))
		{
// -------------------- Inicializaciones de Campos ----------------------------

// -------------------- Recuperación desde Base de Datos ----------------------
		$user_id=$row["user_id"];
		$fecha_baja=$row["cb_fecha_baja"];


//
// Inicialización de la Fecha de Baja a los Socios en vigor del año pasado
// Se deben de mantener los registros que ya tienen Fecha de Baja sin tocar
//
		if ($fecha_baja == null OR $fecha_baja == "0000-00-00")
		{
			$ano_sistema = date("Y");		
			$resto_baja = "-03-31";
			$fecha_baja = $ano_sistema.$resto_baja;
			echo "<br>"."**** Se Actualiza la Fecha de Baja****";
		}
		else
		{
			echo "<br>";
		}
//
// Generación de Token de Seguridad
//
		include("genera_claves.php"); 
		$token = $clave;

//
// Limpieza del campo de Código de Cupón. Se asignará en el momento de la renovación
//
		$cb_codigo_cupon = "";

//
// Actualiza campos para la generación de Carnets de Socio
//
		$cb_marca_envio_carnet = "";
		$cb_fecha_envio_carnet = "0000-00-00 00:00:00";

//-------------------------------------------------------------------------------

		echo "User ID....".$user_id." Fecha Baja...".$fecha_baja;
		echo " Token Seguridad....".$token;		

//-------------------------------------------------------------------------------
//
// Actualiza Base de Datos
//

		$actualiza="UPDATE lyjrh_comprofiler  
						SET
								cb_fecha_baja		= '$fecha_baja', 	
								cb_genera_token 	= '$token',
								cb_codigo_cupon		= '$cb_codigo_cupon',
								cb_marca_envio_carnet = null,
								cb_fecha_envio_carnet = '$cb_fecha_envio_carnet'
						WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$actualiza);


		}
		
	mysqli_close($link);  
?> 
