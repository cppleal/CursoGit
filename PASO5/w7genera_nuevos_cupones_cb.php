<?php

//	echo "Entro en programa ";
// -------------------- Inicializaciones de Campos ----------------------------
	$contador = 0;
	
	include("AbrirBD.php4"); 

//
// -------------------- Obtener último Registro de la Tabla comprofiler_cupones ----------------------------
//
	$consulta="SELECT max(user_id) as ultimo_id
				FROM	lyjrh_comprofiler_cupones
				";

	$consulta = mysqli_query($link,$consulta); 
	
	$row = mysqli_fetch_array($consulta);

	$ultimo_id_com_cupones=$row["ultimo_id"];
	
	$cont_user_id	= $ultimo_id_com_cupones;		

	echo "<br>";
	echo " Ultimo Id de Conmprofiler Cupones....".$ultimo_id_com_cupones;		

//-------------------------------------------------------------------------------

	while($contador < 100)
		{
//
// Generación de Códigos de Cupón
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
		echo " Id de Conmprofiler Cupones....".$cont_user_id;	
		echo " Codigo Cupon....".$codigo_cupon;		
		echo " contador....".$contador;		

//
// Inserta registros en la tabla de comprofiler_cupones
//

		$actualiza="INSERT INTO lyjrh_comprofiler_cupones	(
							user_id,
							codigo_cupon,
							usuario_audit, 
							fecha_audit) 
						VALUES (
							'$cont_user_id',
							'$codigo_cupon',
							'$usuario_audit',
							current_timestamp
							)
			";
		mysqli_query($link,$actualiza);


		}
		
	mysqli_close($link);  
?> 
