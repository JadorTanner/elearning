<?php

use App\Models\DetallesLecciones;
use App\Models\Lecciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $lecciones = Lecciones::with('detalles_lecciones')->get();
    // $lecciones = DB::table('lecciones')->join('detalles_lecicones', 'detalles_lecicones.leccion_id', 'lecciones.id')->get();
    return view('home', compact('lecciones'));
});

Route::get('/lecciones', function () {
    $tipos = [1, 2, 3];
    $lecciones = Lecciones::with('detalles_lecciones')->get();
    return view('lecciones', compact('lecciones', 'tipos'));
});



Route::get('/sliders-v2', function () {
    return view('sliders_v2',['items'=>[
        1, 2,3,4,5,6,7,8,9
    ]]);
});



Route::get('/get-sliders', function (Request $request) {
    return view('sliders', ['cantidad' => $request->cantidad]);
});
function transparent_background($filename, $color)
{
    $img = imagecreatefromjpeg($filename); //or whatever loading function you need
    $colors = explode(',', $color);
    $remove = imagecolorallocate($img, $colors[0], $colors[1], $colors[2]);
    imagecolortransparent($img, $remove);
    imagepng($img, public_path('img/') . replace_extension($filename->getClientOriginalName(), 'png'));
}
function replace_extension($filename, $new_extension) {
    $info = pathinfo($filename);
    return $info['filename'] . '.' . $new_extension;
}
Route::post('/add-leccion', function (Request $request) {
    $response = [];

    //foreach de las imagenes
    foreach ($request->file('imgs') as $index => $file) {
        $name = "";
        //si tiene extension, es un archivo valido y no vacio
        if ($file->extension()) {
            //guarda en carpeta y cambia la variable nombre
            $name = $file->getClientOriginalName();
            $name = date('Y-m-d_h_i_s') . '-' . $name;
            $file->move(public_path('img/'), $name);
        }

        //parsea los datos
        $sliderData = json_decode($request->sliders_data[$index]);

        //guarda los datos en la tabla
        DB::table('detalles_lecciones')->insert([
            'titulo' => $sliderData->title,
            'descripcion' => $sliderData->desc,
            'leccion_id' => $sliderData->leccion_id,
            'img' => $name,
            'posicion' => $sliderData->posicion
        ]);

        //agrega a un array el slider agregado
        $response[] = DB::table('detalles_lecciones')
            ->latest('id')
            ->first();
    }

    DB::table('lecciones')->insert([
        'title' => $request->title
    ]);

    return response()->json($response, 200);
});
Route::post('/add-lecciones', function (Request $request) {
    DB::table('lecciones')->insert([
        'title' => $request->title
    ]);
    return response()->json(DB::table('lecciones')->latest('id')->first(), 200);
});

Route::post('/add-leccion-detalles', function (Request $request) {
    return response()->json($request->all(), 200);
    $datos = json_decode($request->slider_data);
    $image = $request->file('img');
    $name = $image->getClientOriginalName();
    $name = date('Y-m-d_h_i_s') . '-' . $name;
    $image->move(public_path('img/'), $name);
    DB::table('detalles_lecciones')->insert([
        'titulo' => $datos->title,
        'descripcion' => $datos->desc,
        'leccion_id' => $request->leccion_id,
        'img' => $name,
        'posicion' => $datos->posicion
    ]);

    $detalle = DB::table('detalles_lecciones')
        ->latest('id')
        ->first();

    return response()->json($detalle, 200);
});
