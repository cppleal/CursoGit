<?php
//
// Inserta registros en Histórico, actualiza su Fecha de Eliminación, 
// borra el registro original y el registro de la tabla de Usuarios y de Subscripciones
//
		$inserta="INSERT INTO lyjrh_comprofiler_history (
							`id`, 
							`user_id`, 
							`alias`, 
							`firstname`, 
							`middlename`, 
							`lastname`, 
							`hits`, 
							`message_last_sent`, 
							`message_number_sent`, 
							`avatar`, 
							`avatarapproved`, 
							`canvas`, 
							`canvasapproved`, 
							`canvasposition`, 
							`approved`, 
							`confirmed`, 
							`lastupdatedate`, 
							`registeripaddr`, 
							`cbactivation`, 
							`banned`, 
							`banneddate`, 
							`unbanneddate`, 
							`bannedby`, 
							`unbannedby`, 
							`bannedreason`, 
							`acceptedterms`, 
							`acceptedtermsconsent`, 
							`cb_subs_inv_first_name`, 
							`cb_subs_inv_last_name`, 
							`cb_subs_inv_payer_business_name`, 
							`cb_subs_inv_address_street`, 
							`cb_subs_inv_address_city`, 
							`cb_subs_inv_address_state`, 
							`cb_subs_inv_address_zip`, 
							`cb_subs_inv_address_country`, 
							`cb_subs_inv_contact_phone`, 
							`cb_subs_inv_vat_number`, 
							`cb_folderaccess`, 
							`cb_contra_inicial`, 
							`cb_codigo_autorizacion`, 
							`cb_num_socio`, 
							`cb_ind_email_alternativo`, 
							`cb_email_alternativo`, 
							`cb_ano_nacimiento`, 
							`cb_fecha_nacimiento`, 
							`cb_direccion`, 
							`cb_num_piso_puerta`, 
							`cb_direccion_asoc`, 
							`cb_telefono`, 
							`cb_tipo_socio`, 
							`cb_dni_socio`, 
							`cb_imagen_dni`, 
							`cb_imagen_dniapproved`, 
							`cb_imagen_dni2`, 
							`cb_imagen_dni2approved`, 
							`cb_imagen_carnet`, 
							`cb_imagen_carnetapproved`, 
							`cb_imagen_escrituras`, 
							`cb_imagen_escriturasapproved`, 
							`cb_fecha_baja`, 
							`cb_fecha_eliminacion`, 
							`cb_fecha_alta`, 
							`cb_fecha_ult_modif`, 
							`cb_ind_revision`, 
							`cb_observaciones`, 
							`cb_plan_id`, 
							`cb_marca_envio_carnet`, 
							`cb_fecha_envio_carnet`, 
							`cb_anos_sin_renovar`, 
							`cb_total_asociados`, 
							`cb_importe_no_renovacion`, 
							`cb_importe_derramas`, 
							`cb_importe_suscripcion`, 
							`cb_importe_bonificacion`, 
							`cb_num_orden`, 
							`cb_clausula_veracidad`, 
							`cb_ligado_a_socio`, 
							`cb_codigo_cupon`, 
							`cb_imagen_otrosdoc`, 
							`cb_imagen_otrosdocapproved`, 
							`cb_condiciones_uso_privacidad`, 
							`cb_propietario_inquilino`, 
							`cb_genera_token`, 
							`cb_clausula_veracidadconsent`, 
							`cb_condiciones_uso_privacidadconsent`, 
							`cb_ind_unidad_familiar`, 
							`cb_seleccion_pago_socio1`, 
							`cb_seleccion_pago_socio2`, 
							`cb_seleccion_pago_socio3`, 
							`cb_seleccion_pago_socio4`, 
							`cb_seleccion_pago_socio5`, 
							`cb_seleccion_pago_socio6`, 
							`cb_seleccion_pago_socio7`, 
							`cb_seleccion_pago_socio8`, 
							`cb_seleccion_pago_socio9`, 
							`cb_seleccion_pago_socio10`, 
							`cb_id_pago_socio1`, 
							`cb_id_pago_socio2`, 
							`cb_id_pago_socio3`, 
							`cb_id_pago_socio4`, 
							`cb_id_pago_socio5`, 
							`cb_id_pago_socio6`, 
							`cb_id_pago_socio7`, 
							`cb_id_pago_socio8`, 
							`cb_id_pago_socio9`, 
							`cb_id_pago_socio10`, 
							`cb_importe_derramas2020`,
							`cb_ind_pago_derramas2020`) 
					SELECT *
					FROM lyjrh_comprofiler
						WHERE user_id =  '$user_id'
			";
		mysqli_query($link,$inserta);

		$actualiza="UPDATE lyjrh_comprofiler_history  
						SET
								cb_fecha_eliminacion 		= current_timestamp
						WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$actualiza);

		$borra="DELETE FROM lyjrh_comprofiler  
					WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$borra);
		
		$borra="DELETE FROM lyjrh_users  
					WHERE 	id = '$user_id'
			";
		mysqli_query($link,$borra);
		
		$borra="DELETE FROM lyjrh_cbsubs_subscriptions  
					WHERE 	user_id = '$user_id'
			";
		mysqli_query($link,$borra);
//
