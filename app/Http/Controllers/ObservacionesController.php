<?php

namespace App\Http\Controllers;

use App\Models\Observaciones;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ObservacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $observaciones = Observaciones::all();

        return Inertia::render('Observaciones/Index', [
            'observaciones' => $observaciones
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
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        $observaciones = Observaciones::create($request->all());
        $observaciones = Observaciones::all();
        return Inertia::render('Observaciones/Index', [
            'observaciones' => $observaciones
        ])->with('message', 'Precios Guardado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Observaciones $observaciones)
    {
        return Inertia::render('Observaciones/Index', [
            'observaciones' => $observaciones
        ])->with('message', 'Precios Actualizado con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Observaciones $observaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de la solicitud
        $request->validate([
            'codigo' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        // Buscar el registro a actualizar
        $observaciones = Observaciones::findOrFail($id);

        // Actualizar el registro con los datos de la solicitud
        $observaciones->update($request->all());

        // Redirigir a la lista de observaciones con un mensaje de éxito
        return redirect()->route('observaciones.index')->with('message', 'Precios Actualizado con éxito');
    }


    /**
     * Remove the specified resource from storage.
     */
  
    public function destroy($id)
    {
        // Buscar el recurso a eliminar
        $observaciones = Observaciones::findOrFail($id);
    
        // Eliminar el recurso
        $observaciones->delete();
    
        // Redirigir a la lista de observaciones con un mensaje de éxito
        return redirect()->route('observaciones.index')->with('message', 'Observación eliminada con éxito');
    }
}
