<?php

namespace Database\Factories;

use App\Models\DetallesLecciones;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class DetallesLeccionesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetallesLecciones::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $posiciones = ['left', 'center', 'right'];
        $lecciones_db = DB::table('lecciones')->get();
        $lecciones = (array) $lecciones_db;
        dd($lecciones);
        return [
            'posicion' => $posiciones[random_int(0,2)],
            // 'leccion_id' => 
        ];
    }
}
