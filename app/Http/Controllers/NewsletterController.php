<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $correos = Newsletter::all();
        $email = $correos->toArray();
        return response()->json($email);
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
        $validarCorreo = request()->validate([
            'correo' => 'required|email|unique:usuarios|max:255'
        ]
        );
        
        $correo = new Newsletter();
        $correo->correo = request()->input("email");
        $correo->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // NO USAR*
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
        // NO USAR*
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // NO USAR*
    }
}
