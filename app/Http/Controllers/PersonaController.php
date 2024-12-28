<?php

namespace App\Http\Controllers;

use App\Services\ApiServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function obtenerPersona(Request $request)
    {
        $servicio = new ApiServicio();
        $dni = $request->input('dni');
        //validar que ingrese el campo
        if (empty($dni)) {
            return response()->json([
                'data' => 'El DNI es requerido',
                'status' => 'error',
            ]);
        }

        //validar que sea numerico
        if (!is_numeric($dni)) {
            return response()->json([
                'data' => 'El DNI debe ser numerico',
                'status' => 'error',
            ]);
        }
        //Validar que tenga 8 digitos
        if (strlen($dni) != 8) {
            return response()->json([
                'data' => 'El DNI debe tener 8 digitos',
                'status' => 'error',
            ]);
        }

        //Quitar espacios al dni
        $dni = str_replace(' ', '', $dni);

        // Intenta consultar el DNI a través de la API
        $response = $servicio->consultarDni($dni);
        // Si la API falla o devuelve un error, consulta la base de datos
        if ($response->getData()->status === 'error') {
            // Consultar la base de datos para obtener la información de la tabla persona
            // $persona = Persona::where('dni', $id)->first();
            $persona = [
                'nombres' => '',
                'apellidoPaterno' => '',
                'apellidoMaterno' => '',
            ];

            // if ($persona) {
            //     $data = [
            //         // 'nombre' => $persona->nombre,
            //         // 'apellido' => $persona->apellido,
            //         'nombres' => $persona['nombres'],
            //         'apellidoPaterno' => $persona['apellidoPaterno'],
            //         'apellidoMaterno' => $persona['apellidoMaterno'],
            //         // Puedes incluir otros campos que necesites

            //     ];
            //     return response()->json([
            //         'data' => $data,
            //         'status' => 'success',
            //     ]);
            // } else {
            // Si no existe en la base de datos, devuelve un error
            return response()->json([
                'error' => 'No se encontró la persona en la base de datos',
                'data' => 'No se encontró la persona',
                'status' => 'error',
                'code' => 404
            ]);
            // }
        }

        // Si la API tuvo éxito, simplemente devuelve la respuesta de la API
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
