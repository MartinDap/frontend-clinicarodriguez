<?php

class ControladorUsuarios {
	
	/**
	 * Ingreso de usuario al sistema
	 */
	static public function ctrLoginUsuario() {
		
		// Permitir acceso directo sin credenciales (modo desarrollo)
		if (isset($_POST["acceso_directo"])) {
			// Crear sesión con datos por defecto
			$_SESSION["iniciarSesion"] = "ok";
			$_SESSION["id"] = 1;
			$_SESSION["nombre"] = "Dr. Admin Demo";
			$_SESSION["usuario"] = "admin";
			$_SESSION["perfil"] = "1"; // Perfil administrador
			$_SESSION["especialidad"] = "Administración";
			
			echo '<script>window.location = "dashboard";</script>';
			return;
		}
		
		// Login tradicional con API
		if (isset($_POST["ingUsuario"]) && isset($_POST["ingPassword"])) {
			
			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => API_BASE_URL . 'login',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_HTTPHEADER => array(
				"Usuario: {$_POST["ingUsuario"]}",
                "Contra: {$_POST["ingPassword"]}"
			),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			
			// Manejo de errores de la solicitud
			if ($err) {
				echo '<br><div class="alert alert-danger">Error de conexión con el servidor</div>';
			} else {
				$responseArray = json_decode($response, true);
				
				if (isset($responseArray["Detalles"]) && $responseArray["Detalles"] === "Logeado correctamente") {
					// Usuario autenticado correctamente
					$usua_id = $responseArray["Datos"]["usua_id"];
					$usua_nombrecompleto = $responseArray["Datos"]["usua_nombrecompleto"];
					$usua_username = $responseArray["Datos"]["usua_username"];
					$usua_role_id = $responseArray["Datos"]["usua_role_id"];
					$especialidad = $responseArray["Datos"]["especialidad"] ?? "General";

					$_SESSION["iniciarSesion"] = "ok";
					$_SESSION["id"] = $usua_id;
					$_SESSION["nombre"] =  $usua_nombrecompleto;
					$_SESSION["usuario"] = $usua_username;
					$_SESSION["perfil"] = $usua_role_id;
					$_SESSION["especialidad"] = $especialidad;

					// Registrar fecha y hora del último login
					date_default_timezone_set('America/Lima');
					$fechaActual = date('Y-m-d H:i:s');

					echo '<script>window.location = "dashboard";</script>';
				} else {
					// Manejo de errores según el detalle proporcionado por la API
					if (isset($responseArray["Detalles"])) {
						// Detalles específicos proporcionados por la API
						switch ($responseArray["Detalles"]) {
							case "Contraseña incorrecta":
							case "Usuario incorrecto":
							case "No ingresó datos":
								echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
								break;
							default:
								echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
								break;
						}
					} else {
						// No se proporcionaron detalles, error genérico
						echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
					}
				}
			}
		}
	}

}
