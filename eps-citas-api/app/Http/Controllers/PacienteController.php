<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $pacientes = Paciente::where('activo', true)->get();
        return response()->json([
            'success' => true,
            'data' => $pacientes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:pacientes',
            'telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'tipo_documento' => 'required|string|max:50',
            'numero_documento' => 'required|string|unique:pacientes',
            'direccion' => 'required|string',
            'activo' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $paciente = Paciente::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Paciente creado exitosamente',
            'data' => $paciente
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $paciente
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:pacientes,email,' . $paciente->id,
            'telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'tipo_documento' => 'required|string|max:50',
            'numero_documento' => 'required|string|unique:pacientes,numero_documento,' . $paciente->id,
            'direccion' => 'required|string',
            'activo' => 'boolean'
        ]);

        $paciente->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Paciente actualizado exitosamente',
            'data' => $paciente
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente): JsonResponse
    {
        $paciente->update(['activo' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Paciente eliminado exitosamente'
        ]);
    }
}
