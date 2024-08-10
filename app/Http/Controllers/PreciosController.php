<?php

namespace App\Http\Controllers;

use App\Models\Lugares;
use App\Models\Precios;
use App\Models\Productos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PreciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $precios = Productos::with(['precios','lugares'])->get();

        $productos = Productos::with('lugares')->get(); // Asegúrate de cargar la relación 'lugares'
        $lugares = Lugares::all(); // Obtener todos los lugares

        return Inertia::render('Precios/Index', [
            'productos' => $productos,
            'lugares' => $lugares,
            'precios' => $precios,
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
    public function show(Precios $precios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Precios $precios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Precios $precios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Precios $precios)
    {
        //
    }
}
