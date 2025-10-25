<?php

class ControladorUsuarios {
	
	/**
	 * Ingreso de usuario al sistema
	 */
	static public function ctrLoginUsuario() {

    // Permitir acceso directo sin credenciales (modo desarrollo)
    if (isset($_POST["acceso_directo"])) {
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
            CURLOPT_PORT => "8080",
            CURLOPT_URL => API_BASE_URL . 'auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'username' => $_POST["ingUsuario"],
                'password' => $_POST["ingPassword"]
            ]),
            CURLOPT_HTTPHEADER => [
                "content-type: application/json"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        // Mostrar la respuesta cruda en la consola del navegador
        echo '<script>console.log(' . json_encode($response) . ');</script>';

        if ($err) {
            echo '<br><div class="alert alert-danger">Error de conexión con el servidor</div>';
        } else {
            $responseArray = json_decode($response, true);

            // Verificar si la API indica éxito
            if (isset($responseArray["success"]) && $responseArray["success"] === true) {

                $usuarioData = $responseArray["data"]["usuario"];
                $token = $responseArray["data"]["token"];
                $nombreCompleto = $usuarioData["usuaNombrecompleto"];
                $username = $usuarioData["usuaUsername"];
                $userId = $usuarioData["usuaId"];
                $email = $usuarioData["usuaEmail"];
                $telefono = $usuarioData["usuaTelefono"];

                // Iniciar sesión
                $_SESSION["iniciarSesion"] = "ok";
                $_SESSION["id"] = $userId;
                $_SESSION["nombre"] = $nombreCompleto;
                $_SESSION["usuario"] = $username;
                $_SESSION["perfil"] = "1"; // No hay rol explícito, puedes cambiarlo
                $_SESSION["email"] = $email;
                $_SESSION["telefono"] = $telefono;
                $_SESSION["token"] = $token;

                // Registrar fecha y hora de login
                date_default_timezone_set('America/Lima');
                $fechaActual = date('Y-m-d H:i:s');
                $_SESSION["ultima_sesion"] = $fechaActual;

                echo '<script>window.location = "dashboard";</script>';

            } else {
                // Manejo de error de login
                $mensaje = isset($responseArray["message"]) ? $responseArray["message"] : "Error al ingresar, vuelve a intentarlo";
                echo '<br><div class="alert alert-danger">' . htmlspecialchars($mensaje) . '</div>';
            }
        }
    }
}


}
