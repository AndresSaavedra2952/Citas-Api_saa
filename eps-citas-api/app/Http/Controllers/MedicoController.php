<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $medicos = Medico::with('especialidad')->where('activo', true)->get();
        return response()->json([
            'success' => true,
            'data' => $medicos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:medicos',
            'telefono' => 'required|string|max:20',
            'numero_licencia' => 'required|string|unique:medicos',
            'especialidad_id' => 'required|exists:especialidades,id',
            'activo' => 'boolean'
        ]);

        $medico = Medico::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Médico creado exitosamente',
            'data' => $medico->load('especialidad')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Medico $medico): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $medico->load('especialidad')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medico $medico): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:medicos,email,' . $medico->id,
            'telefono' => 'required|string|max:20',
            'numero_licencia' => 'required|string|unique:medicos,numero_licencia,' . $medico->id,
            'especialidad_id' => 'required|exists:especialidades,id',
            'activo' => 'boolean'
        ]);

        $medico->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Médico actualizado exitosamente',
            'data' => $medico->load('especialidad')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $medico): JsonResponse
    {
        $medico->update(['activo' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Médico eliminado exitosamente'
        ]);
    }
}
