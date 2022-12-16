<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\simpanan;


class registersimpanan extends Controller
{
    //
    public function register(Request $req)
    {

        //valdiate
        $rules = [
            'name' => 'required|string',
            'simpanan' => 'required|string',
            'rekening' => 'required|string',
            'keterangan' => 'required|string',

        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            // $response = ['message' => 'Incorrect email or password'];
            return $response = ['value' => '2'];
            //response()->json($validator->errors(), 400);
        }
        //create new user in users table
        $simpanan = simpanan::create([
            'name' => $req->name,
            'simpanan' => $req->simpanan,
            'rekening' => $req->rekening,
            'keterangan' => $req->keterangan,

        ]);
        return $response = ['value' => '1', 'user' => $simpanan];
        //return response()->json($response, 200);
    }
}
