<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $table = 'multimedia';

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'url',
        'formato',
        'isPerfil'
    ];

    public function perfil() {
        return $this->hasOne(Perfil::class);
    }

    public function blog() {
        return $this->hasMany(Blog::class);
    }
}
