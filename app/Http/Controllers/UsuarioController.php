<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Multimedia;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        $usr = $usuarios->toArray();
        return response()->json($usr);
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
        // valida antes de realizar cualquier accion
        $validarUsuarios = $request->validate([
            'nombre' => 'required',
            'apellido_mat' => 'required',
            'apellido_pat' => 'required',
            'puesto' => 'required',
            'correo' => 'required|email|unique:usuarios|max:255',
            'contraseña' => 'required|min:8'
        ]);

        // creo objeto con los datos del formulario
        $usuario = new Usuario();
        $usuario->nombre = $request->input('nombre');
        $usuario->apellido_pat = $request->input('apellido_pat');
        $usuario->apellido_mat = $request->input('apellido_mat');
        $usuario->puesto = $request->input('puesto');
        $usuario->correo = $request->input('correo');
        $usuario->contraseña = Hash::make($request->input('contraseña')); // metodo de encriptado hash
        $usuario->save();


        //imagen 
        $img = new Multimedia();
        $img->nombre = "Avatar de".$usuario->nombre;
        $img->descripcion = "Foto de perfil de ".$usuario->nombre;
        $img->tipo = 1;
        $img->url = $request->input("url");
        $img->formato = $request->input('formato');
        $img->perfil = true;
        $img->save();


        $perfil = new Perfil();
        $perfil->usr_id = $usuario->id;
        $perfil->img_id = $img->id;
        $perfil->desc_perfil = $request->input('desc_perfil');

        return response()->json($usuario, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = Usuario::find($id);
        $img = Multimedia::find($usuario->id);
        $perfil = Perfil::find($usuario->id);

        if (!$usuario && !$img && $perfil) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario, 200);
        return response()->json($img, 200);
        return response()->json($perfil, 200);
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
        $usuario = Usuario::findOrFail($id);
        $validarUsuarios = $request->validate([
            'nombre' => 'required',
            'apellido_mat' => 'required',
            'apellido_pat' => 'required',
            'puesto' => 'required',
            'correo' => 'required|email|unique:usuarios, correo,'.$id.',id|max:255',
            'contraseña' => 'required|min:8'
        ]);

        $usuario = new Usuario();
        $usuario->nombre = $request->input('nombre');
        $usuario->apellido_pat = $request->input('apellido_pat');
        $usuario->apellido_mat = $request->input('apellido_mat');
        $usuario->puesto = $request->input('puesto');
        $usuario->correo = $request->input('correo');
        if (request()->input('contraseña')){
            $usuario->contraseña = Hash::make($request->input('contraseña'));
        }
        $usuario->save();

        //imagen 
        $img = new Multimedia();
        $img->url = $request->input("url");
        $img->formato = $request->input('formato');
        $img->save();

        $perfil = new Perfil();
        $perfil->desc_perfil = $request->input('desc_perfil');
        $perfil->save();

        return response()->json($usuario,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::find($id);
        $img = Multimedia::find($usuario->id);
        $perfil = Perfil::find($usuario->id);

        if (!$usuario && !$img && $perfil) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete(); 
        $img->delete();
        $perfil->delete();

        return response()->json(['message' => 'Usuario eliminado con exito'], 200);
    }
}
