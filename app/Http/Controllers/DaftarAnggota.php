<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DaftarAnggota extends Controller
{
    //
    public function register(Request $req)
    {

        function generateUniqueAnggota()
        {
            do {
                $anggota = random_int(10000, 99999);
            } while (Anggota::where("nomor_anggota", "=", $anggota)->first());

            return $anggota;
        }

        //valdiate
        $rules = [
            'pekerjaan' => 'required|string',
            'penghasilan' => 'required|string',
            'tanggungan' => 'required|string',
            'tempat_tinggal' => 'required|string',
        ];

        $anggota = Anggota::create([
            'nomor_anggota' => generateUniqueAnggota(),
            'pekerjaan' => $req->pekerjaan,
            'penghasilan' => $req->penghasilan,
            'tanggungan' => $req->tanggungan,
            'tempat_tinggal' => $req->tempat_tinggal,
        ]);
        return $response = ['value' => '1', 'anggota' => $anggota,];
        //return response()->json($response, 200);
    }
}
