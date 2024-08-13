<?php

namespace App\Http\Controllers;

use App\Models\Detalles_pagos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DetallesPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalles_pagos = Detalles_pagos::all(); // Puedes ajustar la consulta según sea necesario

        return Inertia::render('Detalles_pagos/Index', [
            'detalles_pagos' => $detalles_pagos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Detalles_pagos/Create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        Detalles_pagos::create($validated);

        return redirect()->route('detalles_pagos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Detalles_pagos $detalles_pagos)
    {
        return Inertia::render('Detalles_pagos/Show', [
            'detalles_pago' => $detalles_pagos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detalles_pagos $detalles_pagos)
    {
        return Inertia::render('Detalles_pagos/Edit', [
            'detalles_pago' => $detalles_pagos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);
        $detpag = Detalles_pagos::findOrFail($id);
        $detpag->update($validated);

        return redirect()->route('detalles_pagos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {        $detpag = Detalles_pagos::findOrFail($id);

        $detpag->delete();

        return redirect()->route('detalles_pagos.index');
    }
}
