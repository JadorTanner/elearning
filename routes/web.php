<?php

use App\Models\Lecciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $lecciones = Lecciones::with('detalles_lecciones')->get();
    // $lecciones = DB::table('lecciones')->join('detalles_lecicones', 'detalles_lecicones.leccion_id', 'lecciones.id')->get();
    return view('home', compact('lecciones'));
});

Route::get('/get-sliders', function (Request $request) {
    return view('sliders', ['cantidad' => $request->cantidad]);
});

Route::post('/add-leccion', function (Request $request) {
    DB::table('lecciones')->insert([
        'title' => $request->title
    ]);
    return response()->json(DB::table('lecciones')->latest('id')->first(), 200);
});

Route::post('/add-leccion-detalles', function (Request $request) {
    
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