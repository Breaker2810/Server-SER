<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    
    protected $table = 'usuario';

    protected $fillable = [
        'nombre',
        'apellido_pat',
        'apellido_mat',
        'puesto',
        'correo',
        'contraseña'
    ];

    public function perfil() {
        return $this->hasOne(Perfil::class);
    }

    public function blog() {
        return $this->hasMany(Blog::class);
    }
}

