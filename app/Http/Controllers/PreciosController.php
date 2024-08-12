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
        $precio = Precios::with('producto')->get();
             
        return Inertia::render('Precios/Index', [
            'precios' => $precio,
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
            'lugar_id' => 'required',
            'producto_id' => 'required',
            'precio' => 'required|numeric|min:0',
        ]);

        Precios::create($request->all());

        return redirect()->route('precios.show',$request->lugar_id)->with('message', 'Precios Guardado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Precios $precios,$id)
    {
        $precio = Precios::with('producto')-> where('lugar_id', $id)->get();
        $productos=Productos::all();
        return Inertia::render('Precios/Index', [
            'precios' => $precio,
            'productos' => $productos,
            'lugar_id' => $id
        ]);
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

    public function updateMassive(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'precios.*' => 'nullable|numeric|min:0', // Validar que cada precio sea un número positivo o nulo
        ]);

        // Iterar sobre los precios enviados y actualizar o crear registros
        foreach ($request->input('precios') as $key => $precio) {
            [$producto_id, $lugar_id] = explode('-', $key);

            // Buscar el registro existente o crear uno nuevo
            $existingPrecio = Precios::where('producto_id', $producto_id)
                                     ->where('lugar_id', $lugar_id)
                                     ->first();

            if ($existingPrecio) {
                $existingPrecio->update(['precio' => $precio]);
            } else {
                Precios::create([
                    'producto_id' => $producto_id,
                    'lugar_id' => $lugar_id,
                    'precio' => $precio,
                ]);
            }
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('precios.index')->with('message', 'Precios actualizados con éxito.');
    }
}
