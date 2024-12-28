<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Summary of __construct
     * @param mixed $middleware
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['roles'] = [
            '' => '[Seleccione Rol]',
            'admin' => 'admin',
            'user' => 'user'
        ];
        return view('admin.index', $data);
    }

    public function getAllUsers()
    {
        $users = User::oldest('id')->get();
        foreach ($users as $index => $user) {
            $user->row_number = $index + 1; // Iniciar el contador en 1
        }
        $count = $users->count();
        $estudiosPersona = $count > 0 ? $users : [];
        $response = [
            'draw' => 0,
            'recordsTotal' => $count,
            'recordsFiltered' => 0,
            'data' => $estudiosPersona
        ];

        return response()->json($response);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (empty($request['email'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Email'
                ];
                return response()->json($return);
            }

            if (empty($request['name'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Nombres'
                ];
                return response()->json($return);
            }
            if (empty($request['paternal_surname'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Apellido Paterno'
                ];
                return response()->json($return);
            }
            if (empty($request['maternal_surname'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Apellido Materno'
                ];
                return response()->json($return);
            }

            if (empty($request['role'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Rol'
                ];
                return response()->json($return);
            }


            $userExists = User::where('email', $request->email)->exists();

            if ($userExists) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Esta usuario ya existe!',
                    'message' => 'Esta usuario ya esta registrado, intente registrar con otro email'
                ];
                return response()->json($return);
            }

            if (empty($request['password'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Contraseña'
                ];
                return response()->json($return);
            }

            if ($request['password'] != $request['password_rep']) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'Las contraseñas no coinciden'
                ];
                return response()->json($return);
            }

            $data = $request->except('_token', 'password_rep');
            if (empty($request['status'])) {
                $data['status'] = FALSE;
            }
            $data['password'] = Hash::make($request['password']);
            User::create($data);

            $return = [
                'status' => 'ok',
                'titulo' => '¡Registro Exitoso!',
                'message' => 'Se registró correctamente el usuario!'
            ];
            return response()->json($return);
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => '¡Registro no completado!',
                'message' => $ex->getMessage()
            ];
            return response()->json($return);
        }
    }

    /**
     * Summary of show
     * @param \App\Models\User $user
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            if (empty($request['email'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Email'
                ];
                return response()->json($return);
            }

            if (empty($request['name'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Nombres'
                ];
                return response()->json($return);
            }
            if (empty($request['paternal_surname'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Apellido Paterno'
                ];
                return response()->json($return);
            }
            if (empty($request['maternal_surname'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Apellido Materno'
                ];
                return response()->json($return);
            }

            if (empty($request['role'])) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Rol'
                ];
                return response()->json($return);
            }


            $user = User::find($request->userEditId);
            $userExists = User::where('email', $request->email)
                ->where('id', '!=', $user->id) // Ignorar al usuario actual
                ->exists();

            if ($userExists) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Esta usuario ya existe!',
                    'message' => 'Esta usuario ya esta registrado, intente registrar con otro email'
                ];
                return response()->json($return);
            }
            $data = $request->except('_token', 'password_rep', 'userEditId');
            if (empty($request['status'])) {
                $data['status'] = FALSE;
            }
            if ($request->checkPass == true) {
                if (empty($request['password'])) {
                    $return = [
                        'status' => 'error',
                        'titulo' => '¡Registro no completado!',
                        'message' => 'No se están enviando campos obligatorios: Contraseña'
                    ];
                    return response()->json($return);
                }

                if ($request['password'] != $request['password_rep']) {
                    $return = [
                        'status' => 'error',
                        'titulo' => '¡Registro no completado!',
                        'message' => 'Las contraseñas no coinciden'
                    ];
                    return response()->json($return);
                }
                $data['password'] = Hash::make($request['password']);
            }

            $user->update($data);

            $return = [
                'status' => 'ok',
                'titulo' => '¡Registro Exitoso!',
                'message' => 'Se registró correctamente el usuario!'
            ];
            return response()->json($return);
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => '¡Registro no completado!',
                'message' => $ex->getMessage()
            ];
            return response()->json($return);
        }
    }

    /**
     * Summary of destroy
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        try {
            $user = User::find($request->userDeleteId);
            $user->delete();

            $return = [
                'status' => 'ok',
                'titulo' => '¡Eliminación Exitosa!',
                'message' => 'Se eliminó correctamente el usuario!'
            ];
            return response()->json($return);
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => '¡Registro no completado!',
                'message' => $ex->getMessage()
            ];
            return response()->json($return);
        }
    }
}
