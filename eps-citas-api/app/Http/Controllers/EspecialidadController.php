<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $especialidades = Especialidad::where('activo', true)->get();
        return response()->json([
            'success' => true,
            'data' => $especialidades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'activo' => 'boolean'
        ]);

        $especialidad = Especialidad::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Especialidad creada exitosamente',
            'data' => $especialidad
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Especialidad $especialidad): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $especialidad
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialidad $especialidad): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'activo' => 'boolean'
        ]);

        $especialidad->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Especialidad actualizada exitosamente',
            'data' => $especialidad
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialidad $especialidad): JsonResponse
    {
        $especialidad->update(['activo' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Especialidad eliminada exitosamente'
        ]);
    }
}
