<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Productos::all(); // Puedes ajustar la consulta según sea necesario

        return Inertia::render('Productos/Index', [
            'productos' => $productos,
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
            'descripcion' => 'required|string',
            'Unid' => 'required|string',
            'peso' => 'required|numeric',
            'cantidad' => 'required|integer',
            'img' => 'nullable|string',
        ]);

        Productos::create($request->all());

        return redirect()->route('productos.index')->with('message', 'Producto Guardado con éxito');

    }

    /**
     * Display the specified resource.
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'codigo' => 'required|string',
            'descripcion' => 'required|string',
            'Unid' => 'required|string',
            'peso' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'img' => 'nullable|string',
        ]);

        // Encontrar y actualizar el producto
        $productos = Productos::findOrFail($id);
        $productos->update($data);

        // Opcional: Obtener la lista actualizada de productos
        $productos = Productos::all(); // Ajusta según sea necesario

        // Retorna la respuesta con el mensaje de éxito
        return redirect()->route('productos.index')->with('message', 'Producto Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $productos = Productos::findOrFail($id);
        $productos->delete();

        return redirect()->route('productos.index')->with('message', 'Producto eliminado con éxito');
    }
}
