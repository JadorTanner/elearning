<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    use HasFactory;
    public function collection(Collection $rows)
    {
        // dd($rows);
        $tipos = DB::table('ttipo_user')->get();
        foreach ($rows as $row) {

            // return new User([
            //     'name' => $row[0],
            //     'email' => $row[1],
            //     'password' => $row[2]
            // ]);
        }
    }
}
