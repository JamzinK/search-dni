<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class ApiServicio
{
    /**
     * Summary of consultarDni
     * @param mixed $dni
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function consultarDni($dni)
    {
        try {
            $token1 = env('API_TOKEN_1', 'apis-token-1');
            $token2 = env('API_TOKEN_2', 'apis-token-2');
            $token3 = env('API_TOKEN_3', 'apis-token-3');
            $tokens = [$token1, $token2, $token3];
            foreach ($tokens as $token) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 2,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Referer: https://apis.net.pe/consulta-dni-api',
                        'Authorization: Bearer ' . $token
                    ),
                ));

                // Intenta realizar la solicitud con el token actual
                $response = curl_exec($curl);
                Log::info($response);
                $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE); // Obtiene el código de estado HTTP

                if ($http_status == 200) {
                    // La solicitud fue exitosa, procesa la respuesta como se muestra anteriormente
                    break; // Sale del bucle si la solicitud fue exitosa
                } elseif ($http_status == 429) {
                    // Has alcanzado el límite de solicitudes con este token, intenta con el siguiente token
                    Log::info('El token ' . $token . ' ha alcanzado el límite de solicitudes.');
                } else {
                    // Otro tipo de error, maneja según sea necesario
                    Log::error('Error al hacer la solicitud a la API. Código de estado HTTP: ' . $http_status);
                    break; // Sale del bucle en caso de otro tipo de error
                }
            }
            curl_close($curl);
            $persona = json_decode($response);
            if (!$persona || isset($persona->message)) {
                // Si la respuesta es inválida o tiene un mensaje de error, devuelve un error
                return response()->json([
                    'error' => 'Revise el Dni ingresado y vuelva a intentarlo',
                    'titulo' => 'Dni inválido',
                    'status' => 'error',
                    'code' => 500
                ]);
            }

            // Respuesta exitosa con los datos de la persona
            return response()->json([
                'data' => $persona,
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            // Entra aquí si hay un error
            return response()->json([
                'error' => 'Error',
                'titulo' => 'Error de consulta',
                'status' => 'error',
                'code' => 500
            ]);
        }
    }
}
