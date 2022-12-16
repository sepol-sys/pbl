<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\biaya;

class BiayaAdmin extends Controller
{
    //
    public function register(Request $req)
    {

        //valdiate
        $rules = [
            'rekening' => 'required|string',
            'simpanan' => 'required|string',
            'tanggal' => 'required|string',
            'nominal' => 'required|string',
            'keterangan' => 'required|string',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            // $response = ['message' => 'Incorrect email or password'];
            return $response = ['value' => '2'];
            //response()->json($validator->errors(), 400);
        }
        //create new user in users table
        $biaya = biaya::create([
            'rekening' => $req->rekening,
            'simpanan' => $req->simpanan,
            'tanggal' => $req->tanggal,
            'nominal' => $req->nominal,
            'keterangan' => $req->keterangan,

        ]);
        return $response = ['value' => '1', $biaya];
        //return response()->json($response, 200);
    }
}
