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

                // --- Extrae bloque data ---
                $data        = $responseArray["data"] ?? [];
                $token       = $data["token"] ?? null;
                $type        = $data["type"]  ?? 'Bearer'; // viene "Bearer"
                $usuario     = $data["usuario"] ?? [];

                // --- Usuario & Persona ---
                $userId      = $usuario["usuaId"]        ?? null;
                $username    = $usuario["usuaUsername"]  ?? '';
                $ultimaSesion= $usuario["usuaUltimaSesion"] ?? null;
                $usuaEstado  = $usuario["usuaEstado"]    ?? null;

                $persona                 = $usuario["persona"] ?? [];
                $persId                  = $persona["persId"] ?? null;
                $nombreCompleto          = $persona["persNombrecompleto"] ?? '';
                $tipoDoc                 = $persona["persTipoDoc"] ?? '';
                $nroDoc                  = $persona["persNroDoc"] ?? '';
                $email                   = $persona["persEmail"] ?? '';
                $telefono                = $persona["persTelefono"] ?? '';
                $direccion               = $persona["persDireccion"] ?? '';
                $fotoUrl                 = $persona["persFotoUrl"] ?? '';
                $persEsActivo            = $persona["persEsActivo"] ?? false;

				 // --- Roles ---
                $roles        = $responseArray["roles"] ?? [];            // p.ej. ["MEDICO"]
                $usuariosRoles= $responseArray["usuariosRoles"] ?? [];    // con roleId, roleName, etc.
                // Iniciar sesión
                if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION["iniciarSesion"] = "ok";
                $_SESSION["id"]            = $userId;
                $_SESSION["usuario"]       = $username;
                $_SESSION["nombre"]        = $nombreCompleto;

                // Guarda datos de contacto desde PERSONA
                //$_SESSION["email"]         = $email;
                //$_SESSION["telefono"]      = $telefono;
                //$_SESSION["direccion"]     = $direccion;
                $_SESSION["foto"]          = $fotoUrl;

                // Documento y persona
                //$_SESSION["persId"]        = $persId;
                //$_SESSION["tipoDoc"]       = $tipoDoc;
                //$_SESSION["nroDoc"]        = $nroDoc;

                // Estado/fechas
                //$_SESSION["usuaEstado"]    = $usuaEstado;
                //$_SESSION["persEsActivo"]  = $persEsActivo;
                //$_SESSION["usuaUltimaSesionApi"] = $ultimaSesion; // la que vino de la API

                // Token para Authorization
                $_SESSION["token"]         = $token;
                $_SESSION["tokenType"]     = $type; // "Bearer"
                $_SESSION["authHeader"]    = $token ? ($type . ' ' . $token) : null;

                // Roles
                $_SESSION["rolesArray"]    = $roles;         // ["MEDICO", ...]
                $_SESSION["usuariosRoles"] = $usuariosRoles; // objetos con roleId/name
                $_SESSION["perfil"]        = "1"; // primer rol como "perfil" visible

                // Registrar fecha/hora local de este login (cliente)
                date_default_timezone_set('America/Lima');
                $_SESSION["ultima_sesion"] = date('Y-m-d H:i:s');

                // Redirige
                echo '<script>window.location = "dashboard";</script>';
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
