<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Lugares;
use App\Models\Productos;
use App\Models\Proformas;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProformasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proformas = Proformas::all(); // Puedes ajustar la consulta según sea necesario
        $productos = Productos::with('precios')->get();
        $clientes = Clientes::all();
        $lugares = Lugares::all();
        return Inertia::render('Proformas/Index', [
            'proformas' => $proformas,
            'productos' => $productos,
            'clientes' => $clientes,
            'lugares' => $lugares
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Proformas $proformas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proformas $proformas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proformas $proformas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proformas $proformas)
    {
        //
    }
}
