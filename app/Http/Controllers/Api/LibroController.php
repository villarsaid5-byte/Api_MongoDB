<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    // Ver todos los libros
    public function index()
    {
        $libros = Libro::all();

        return response()->json($libros, 200);
    }

    // Crear un libro
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'genero' => 'nullable|string|max:255',
            'anio_publicacion' => 'nullable|integer',
        ]);

        $libro = Libro::create($validated);

        return response()->json($libro, 201);
    }

    // Ver un libro específico
    public function show($id)
    {
        $libro = Libro::findOrFail($id);

        return response()->json($libro, 200);
    }

    // Actualizar un libro
    public function update(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'autor' => 'sometimes|string|max:255',
            'genero' => 'nullable|string|max:255',
            'anio_publicacion' => 'nullable|integer',
        ]);

        $libro->update($validated);

        return response()->json($libro, 200);
    }

    // Eliminar un libro
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);

        $libro->delete();

        return response()->json(null, 204);
    }
}