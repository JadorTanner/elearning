<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesLecciones extends Model
{
    use HasFactory;
    public function tipos(){
        return $this->belongsTo('tipos', 'pk_tipo', 'id');
    }
}
