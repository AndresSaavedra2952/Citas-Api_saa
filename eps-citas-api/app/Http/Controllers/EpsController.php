<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eps;
use Illuminate\Http\JsonResponse;

class EpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $eps = Eps::where('activo', true)->get();
        return response()->json([
            'success' => true,
            'data' => $eps
        ]);
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
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'nit' => 'required|string|max:20|unique:eps,nit',
            'direccion' => 'required|string|max:200',
            'telefono' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'descripcion' => 'nullable|string'
        ]);

        $eps = Eps::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'EPS creada exitosamente',
            'data' => $eps
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $eps = Eps::find($id);
        
        if (!$eps) {
            return response()->json([
                'success' => false,
                'message' => 'EPS no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $eps
        ]);
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
    public function update(Request $request, string $id): JsonResponse
    {
        $eps = Eps::find($id);
        
        if (!$eps) {
            return response()->json([
                'success' => false,
                'message' => 'EPS no encontrada'
            ], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'nit' => 'sometimes|required|string|max:20|unique:eps,nit,' . $id,
            'direccion' => 'sometimes|required|string|max:200',
            'telefono' => 'sometimes|required|string|max:20',
            'email' => 'nullable|email|max:100',
            'descripcion' => 'nullable|string',
            'activo' => 'sometimes|boolean'
        ]);

        $eps->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'EPS actualizada exitosamente',
            'data' => $eps
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $eps = Eps::find($id);
        
        if (!$eps) {
            return response()->json([
                'success' => false,
                'message' => 'EPS no encontrada'
            ], 404);
        }

        // Soft delete - marcar como inactivo
        $eps->update(['activo' => false]);

        return response()->json([
            'success' => true,
            'message' => 'EPS eliminada exitosamente'
        ]);
    }
}
