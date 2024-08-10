<?php

namespace App\Http\Controllers;

use App\Models\Lugares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class LugaresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lugares = Lugares::all();
        return Inertia::render('Lugares/Index', [
            'lugares' => $lugares,
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
            'descripcion' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $data['img'] = "storage/" . $imagePath;
        }

        Lugares::create($data);

        return redirect()->route('lugares.index')->with('message', 'Lugar guardado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lugares $lugares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lugares $lugares)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $lugar = Lugares::findOrFail($id);

        // Inicializa $data con todos los campos excepto la imagen
        $data = $request->only(['descripcion', 'direccion']);

        if ($request->hasFile('img')) {
            // Eliminar la imagen antigua si existe
            if ($lugar->img) {
                Storage::disk('public')->delete($lugar->img);
            }

            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $data['img'] = "storage/" . $imagePath;
        }

        // Actualiza el registro con los datos
        $lugar->update($data);

        return redirect()->route('lugares.index')->with('message', 'Lugar actualizado con éxito');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lugar = Lugares::findOrFail($id);

        if ($lugar->img) {
            Storage::disk('public')->delete($lugar->img);
        }

        $lugar->delete();

        return redirect()->route('lugares.index')->with('message', 'Lugar eliminado con éxito');
    }
}
