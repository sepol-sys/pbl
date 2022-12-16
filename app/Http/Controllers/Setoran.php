<?php

namespace App\Http\Controllers;

use App\Models\setoran as ModelsSetoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Setoran extends Controller
{
    public function register(Request $req)
    {

        //valdiate
        $rules = [
            'nominal' => 'required|string',
            'simpanan' => 'required|string',
            'rekening' => 'required|string',
            'keterangan' => 'required|string',
            'tanggal' => 'required|string',

        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            // $response = ['message' => 'Incorrect email or password'];
            return $response = ['value' => '2'];
            //response()->json($validator->errors(), 400);
        }
        //create new user in users table
        $setoran = ModelsSetoran::create([
            'nominal' => $req->nominal,
            'simpanan' => $req->simpanan,
            'rekening' => $req->rekening,
            'keterangan' => $req->keterangan,
            'tanggal' => $req->tanggal,

        ]);
        return $response = ['value' => '1', 'user' => $setoran];
        //return response()->json($response, 200);
    }
}
