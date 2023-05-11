<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $fillable = [
        'titulo',
        'descripcion',
        'conteido',
        'imagenes'
    ];

    protected function usuario() {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    protected function multimedia() {
        return $this->belongsTo(Multimedia::class, 'id', 'imagenes');
    }
}
