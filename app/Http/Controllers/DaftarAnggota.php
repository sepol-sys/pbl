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

        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            //response()->json($validator->errors(), 400);
        }

        $user = User::find(Auth::user()->id);

        if ($user) {

            $anggota = Anggota::where('email', $user->email)->first();
            //dd($anggota);
            if (!$anggota) {
                $na =  generateUniqueAnggota();
                $anggota = Anggota::create([
                    'email' => $user->email,
                    'nomor_anggota' => $na,
                    'pekerjaan' => $req->pekerjaan,
                    'penghasilan' => $req->penghasilan,
                    'tanggungan' => $req->tanggungan,
                    'tempat_tinggal' => $req->tempat_tinggal,
                ]);

                $user->nomor_anggota = $na;
                $user->save();
                //$token = $anggota->createToken('Personal Access Token')->plainTextToken;
                return $response = ['value' => '1', 'anggota' => $anggota];
                //return response()->json($response, 200);
            }
            return response()->json(['value' => '2', 'message' => 'sudah didaftarkan']);
        }
        
    }

    // public function me(Request $req)
    // {
    //     $anggota = Anggota::anggota();
    //     $this->response['message'] = 'succes';
    //     $this->response['data'] = $anggota;

    //     return response()->json($this->response, 200);
    // }
}
