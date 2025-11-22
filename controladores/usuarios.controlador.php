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
        
        // Token demo para desarrollo
        $tokenDemo = "eyJhbGciOiJIUzM4NCJ9.eyJzdWIiOiJhZG1pbiIsInVzdWFyaW9JZCI6MSwicm9sIjoiQURNSU4iLCJpYXQiOjE3NjE0NDg3ODcsImV4cCI6MTc5MzAwMDAwMH0.demo_token_admin";

        echo '<script>
            // Guardar token demo en sessionStorage
            sessionStorage.setItem("authToken", "' . $tokenDemo . '");
            sessionStorage.setItem("tokenType", "Bearer");
            sessionStorage.setItem("authHeader", "Bearer ' . $tokenDemo . '");
            sessionStorage.setItem("userId", "1");
            sessionStorage.setItem("username", "admin");
            sessionStorage.setItem("nombre", "Dr. Admin Demo");
            sessionStorage.setItem("roles", "ADMIN");
            
            console.log("✅ Acceso directo - Token demo guardado");
            
            window.location = "dashboard";
        </script>';
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

                // --- Extrae bloque data ---
                $data        = $responseArray["data"] ?? [];
                $token       = $data["token"] ?? null;
                $type        = $data["type"]  ?? 'Bearer'; // viene "Bearer"
                $usuario     = $data["usuario"] ?? [];

                // --- Usuario & Persona ---
                $userId      = $usuario["usuaId"]        ?? null;
                $username    = $usuario["usuaUsername"]  ?? '';

                $persona                 = $usuario["persona"] ?? [];
                $nombreCompleto          = $persona["persNombrecompleto"] ?? '';
                //$fotoUrl                 = $persona["persFotoUrl"] ?? '';

				 // --- Roles ---
                $roles        = $responseArray["roles"] ?? [];            // p.ej. ["MEDICO"]
                // Iniciar sesión
                if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION["iniciarSesion"] = "ok";
                $_SESSION["id"]            = $userId;
                $_SESSION["usuario"]       = $username;
                $_SESSION["nombre"]        = $nombreCompleto;


                // Token para Authorization
                $_SESSION["token"]         = $token;
                $_SESSION["tokenType"]     = $type; // "Bearer"
                $_SESSION["authHeader"]    = $token ? ($type . ' ' . $token) : null;

                // Roles
                $_SESSION["roles"] = $roles;

                $_SESSION["perfil"]        = "1"; // primer rol como "perfil" visible

                // Registrar fecha/hora local de este login (cliente)
                date_default_timezone_set('America/Lima');
                $_SESSION["ultima_sesion"] = date('Y-m-d H:i:s');

                // Guardar token en sessionStorage desde JavaScript
                echo '<script>
                    // Guardar datos de sesión en sessionStorage
                    sessionStorage.setItem("authToken", "' . $token . '");
                    sessionStorage.setItem("tokenType", "' . $type . '");
                    sessionStorage.setItem("authHeader", "' . ($type . ' ' . $token) . '");
                    sessionStorage.setItem("userId", "' . $userId . '");
                    sessionStorage.setItem("username", "' . $username . '");
                    sessionStorage.setItem("nombre", "' . addslashes($nombreCompleto) . '");
                    sessionStorage.setItem("roles", "' . implode(',', $roles) . '");
                    
                    console.log("✅ Token guardado en sessionStorage");
                    console.log("Token:", sessionStorage.getItem("authToken"));
                    console.log("Auth Header:", sessionStorage.getItem("authHeader"));
                    
                    // Redirigir al dashboard
                    window.location = "dashboard";
                </script>';
                exit;

            } else {
                // Manejo de error de login
                $mensaje = isset($responseArray["message"]) ? $responseArray["message"] : "Error al ingresar, vuelve a intentarlo";
                echo '<br><div class="alert alert-danger">' . htmlspecialchars($mensaje) . '</div>';
            }
        }
    }
    }


}
