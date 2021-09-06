<?php

use App\Http\Controllers\Controller;
use App\Models\UsersImport;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;

class ArchivosController extends Controller
{
    public function importar_archivo(Request $request){
        $import = Excel::import(new UsersImport, $request->file('archivo'));
        dd($import);
    }
}
