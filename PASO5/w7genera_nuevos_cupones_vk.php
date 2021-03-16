<?php

//	
// -------------------- Inicializaciones de Campos ----------------------------
	$contador = 0;
	
	include("AbrirBD.php4"); 

//
// -------------------- Obtener último Registro de la Tabla vikevents coupons ----------------------------
//
	$consulta="SELECT max(id) as ultimo_id
				FROM	lyjrh_vikevents_coupons
				";

	$consulta = mysqli_query($link,$consulta); 
	
	$row = mysqli_fetch_array($consulta);

	$ultimo_id_com_cupones=$row["ultimo_id"];
	
	$cont_user_id	= $ultimo_id_com_cupones;		

	echo "<br>";
	echo " Ultimo Id de Vikevents Cupones....".$ultimo_id_com_cupones;		

//-------------------------------------------------------------------------------

	while($contador < 100)
		{
//
// Generación de Token de Seguridad
//
		include("genera_claves.php"); 
		$codigo_cupon = $clave;

//
// Resto de Campos
//
		$cont_user_id	= $cont_user_id + 1;

		$usuario_audit 	= "carga";
//
//-------------------------------------------------------------------------------
		$contador = $contador + 1;

		echo "<br>";
		echo " Id de Vikevents Cupones....".$cont_user_id;	
		echo " Codigo Cupon....".$codigo_cupon;		
		echo " contador....".$contador;		

//
// Inserta registros en la tabla de comprofiler_cupones
//

		$actualiza="INSERT INTO lyjrh_vikevents_coupons	(
							id,
							code,
							type,
							percentot,
							value,
							allitems,
							iditems,
							mintotord,
							minpeople,
							maxuse,
							numuse) 
						VALUES (
							'$cont_user_id',
							'$codigo_cupon',
							1,
							2,
							6.00,
							0,
							';1;',
							0.00,
							1,
							1,
							0
							)
			";
		mysqli_query($link,$actualiza);


		}
		
	mysqli_close($link);  
?> 
