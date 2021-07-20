<?php

namespace Database\Seeders;

use App\Models\Lecciones;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'name' => 'HTML',
            'tipo' => 1
        ]);
        DB::table('tipos')->insert([
            'name' => 'Video',
            'tipo' => 2
        ]);
        DB::table('tipos')->insert([
            'name' => 'Image',
            'tipo' => 3
        ]);

        for ($i=1; $i <= 10; $i++) { 
            DB::table('lecciones')->insert([
                'title' => "Leccion $i"
            ]);
        }
        $posiciones = ['left', 'center', 'right'];
        for ($i=1; $i < 10; $i++) {
            DB::table('detalles_lecciones')
            ->insert([
                'titulo' => "leccion $i",
                'descripcion' => "leccion numero $i",
                'leccion_id' => random_int(1, 10),
                'posicion' => $posiciones[random_int(0,2)],
                'pk_tipo' => random_int(1,3)
            ]);
        }

        // factory(Lecciones::class, 4)->create();
    }
}
