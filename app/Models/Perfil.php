<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfil';

    protected $fillable = [
        'descripcion'
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

    public function multimedia() {
        return $this->belongsTo(Multimedia::class);
    }
}
