<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecciones extends Model
{
    use HasFactory;
    public function detalles_lecciones()
    {
        return $this->hasMany(DetallesLecciones::class, 'leccion_id', 'id');
    }
}
