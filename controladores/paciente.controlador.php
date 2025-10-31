<?php

class ControladorPaciente {
	
	/**
	 * Ingreso de usuario al sistema
	 */
	static public function ctrBuscarPacientePorDni() {

        if (isset($_POST["dniConsulta"])) {

            $dni = $_POST["dniConsulta"];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => API_BASE_URL . 'dni/' . $dni,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    // Si necesitas token:
                    // 'Authorization: Bearer ' . $_SESSION["token"]
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            // Muestra en consola del navegador
            echo '<script>console.log(' . json_encode($response) . ');</script>';

            if ($err) {
                echo '<div class="alert alert-danger">Error al conectar con el servidor</div>';
            } else {
                $responseArray = json_decode($response, true);

                if ($responseArray) {
                    // ✅ Si devuelve datos correctamente
                    if (isset($responseArray["paciNombre"])) {
                        echo '<div class="alert alert-success">Paciente encontrado: <b>' . 
                            htmlspecialchars($responseArray["paciNombre"]) . ' ' . 
                            htmlspecialchars($responseArray["paciApellido"]) . '</b></div>';
                    } else {
                        echo '<div class="alert alert-warning">No se encontró información del paciente.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Respuesta inválida del servidor.</div>';
                }
            }
        }
    }

}
