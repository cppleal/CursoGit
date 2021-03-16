<?php

//	echo "Entro en programa ";
// -------------------- Inicializaciones de Campos ----------------------------
	$contador = 0;
	
	include("AbrirBD.php4"); 


	while($contador < 100)
		{
//
// Generación de Token de Seguridad
//
		include("genera_claves.php"); 
		$token_seguridad = $clave;

//
// Resto de Campos
//
		$estado_uso = "PENDIENTE";
		$usuario_audit = "carga";
//
//-------------------------------------------------------------------------------
		$contador = $contador + 1;

		echo "<br>";
		echo " Token Seguridad....".$token_seguridad;		
		echo " contador....".$contador;		

//
// Inserta registros en la tabla de Claves de Autorización para Altas
//

		$actualiza="INSERT INTO lyjrh_comprofiler_clave	(
							token_seguridad, 
							email_solicitud, 
							fecha_solicitud, 
							user_id_uso, 
							fecha_uso, 
							estado_uso, 
							tipo_socio, 
							usuario_audit, 
							fecha_audit) 
						VALUES (
							'$token_seguridad',
							null,
							null,
							null,
							null,
							'$estado_uso',
							null,
							'$usuario_audit',
							current_timestamp
							)
			";
		mysqli_query($link,$actualiza);

		}
		
	mysqli_close($link);  
?> 
