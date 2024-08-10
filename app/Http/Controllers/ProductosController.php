<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $data['img'] = "storage/".$imagePath;
        }

        Productos::create($data);

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
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'Unid' => 'required|string',
            'peso' => 'required|numeric',
            'cantidad' => 'required|integer',
          
        ]);
    
        // Buscar el producto por ID
        $producto = Productos::findOrFail($id);
    
        // Verificar si se ha proporcionado una nueva imagen
        if ($request->hasFile('img')) {
            // Eliminar la imagen antigua si existe
            if ($producto->img) {
                Storage::disk('public')->delete(str_replace('storage/', '', $producto->img));
            }
    
            // Almacenar la nueva imagen
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $validatedData['img'] = "storage/" . $imagePath;
        }
    
        // Actualizar el producto con los datos validados (sin cambiar la imagen si no se proporcionó)
        $producto->update($validatedData);
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('productos.index')->with('message', 'Producto actualizado con éxito');
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
