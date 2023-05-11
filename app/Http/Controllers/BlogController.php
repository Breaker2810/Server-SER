<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Multimedia;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::all();
        $blogs = $blog->toArray();
        return response()->json($blogs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // NO USAR
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validarBlog = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'contenido' => 'required',
            'imagenes' => 'array'
        ]);

        $blog = new Blog();
        $blog->titulo = $request->input('titulo');
        $blog->descripcion = $request->input('descripcion');
        $blog->contenido = $request->input('contenido');
        $blog->save();

        // Guarda las imágenes relacionadas con el blog
        if ($request->has('imagenes')) {
            $imagenes = $request->input('imagenes');

            foreach ($imagenes as $imagen) {
                // Crea una nueva instancia de Multimedia
                $multimedia = new Multimedia();
                $multimedia->nombre = $imagen['nombre'];
                $multimedia->descripcion = $imagen['descripcion'];                $multimedia->tipo = $imagen['tipo'];
                $multimedia->url = $imagen['url'];
                $multimedia->formato = $imagen['formato'];
                $multimedia->perfil = false;
                // Guarda la relación con el blog
                $blog->multimedia()->save($multimedia);
            }
        }

        return response()->json($blog, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::with('multimedia')->find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog no encontrado'], 404);
        }

        return response()->json([
            'data' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // NO USAR
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $validarBlog = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'contenido' => 'required',
            'imagenes' => 'array'
        ]);

        $blog = new Blog();
        $blog->titulo = $request->input('titulo');
        $blog->descripcion = $request->input('descripcion');
        $blog->contenido = $request->input('contenido');
        $blog->save();

        // Guarda las imágenes relacionadas con el blog
        if ($request->has('imagenes')) {
            $imagenes = $request->input('imagenes');

            $blog->multimedia()->delete();

            foreach ($imagenes as $imagen) {
                // Crea una nueva instancia de Multimedia
                $multimedia = new Multimedia();
                $multimedia->nombre = $imagen['nombre'];
                $multimedia->descripcion = $imagen['descripcion'];                $multimedia->tipo = $imagen['tipo'];
                $multimedia->url = $imagen['url'];
                $multimedia->formato = $imagen['formato'];
                $multimedia->perfil = false;
                // Guarda la relación con el blog
                $blog->multimedia()->save($multimedia);
            }
        }

        return response()->json($blog, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        
        if (!$blog) {
            return response()->json(['message' => 'Blog no encontrado'], 404);
        }

        $blog->multimedia()->delete();

        return response()->json(['message' => 'Blog eliminado exitosamente'], 200);
    }
}
