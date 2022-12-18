<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function index()
    {
        $data = User::all();
        return response()->json(['data' => $data]);
    }

    public function register(Request $req)
    {
        //valdiate
        $rules = [
            'name' => 'required|string',
            'address' => 'required|string',
            "handphone" => 'required|string',
            "gender" => 'required|string',
            'username' => 'required|string',
            'birth' => 'required|string',
            'password' => 'required|string|min:6'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            // $response = ['message' => 'Incorrect email or password'];
            return $response = ['value' => '4'];
            //response()->json($validator->errors(), 400);
        }

        $rules = [
            'email' => 'required|string|email',
        ];

        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            // $response = ['message' => 'Incorrect email or password'];
            return $response = ['value' => '3'];
            //response()->json($validator->errors(), 400);
        }

        $rules = [
            'email' => 'required|string|unique:users',
        ];

        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            // $response = ['message' => 'Incorrect email or password'];
            return $response = ['value' => '2'];
            //response()->json($validator->errors(), 400);
        }



        //create new user in users table
        $user = User::create([
            'name' => $req->name,
            'username' => $req->username,
            'birth' => $req->birth,
            'email' => $req->email,
            'roles' => $req->roles,
            //'level' => 0,
            'address' => $req->address,
            'gender' => $req->gender,
            'handphone' => $req->handphone,
            'password' => Hash::make($req->password)
        ]);
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        return $response = ['value' => '1', 'user' => $user, 'token' => $token];
        //return response()->json($response, 200);
    }

    public function login(Request $req)
    {
        // validate inputs
        $rules = [
            'username' => 'required',
            'password' => 'required|string'
        ];
        $req->validate($rules);
        // find user email in users table
        $user = User::where('username', $req->username)->first();
        // if user email found and password is correct
        if ($user && Hash::check($req->password, $user->password)) {
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            return $response = ['value' => '1', 'user' => $user, 'token' => $token];
            //$response = ['user' => $user, 'token' => $token];
            //return response()->json($response, 200);
        }
        // $response = ['message' => 'Incorrect email or password'];
        // return response()->json($response, 400);
        return $response = ['message' => 'Incorrect email or password', 'value' => '2'];
    }

    public function me(Request $req)
    {
        $user = Auth::user();
        $this->response['message'] = 'succes';
        $this->response['data'] = $user;

        return response()->json($this->response, 200);
    }

    public function logout(Request $req)
    {
        $req->user()->currentAccessToken('Logout acces token')->delete();

        $this->response['message'] = 'succes';

        return response()->json($this->response, 200);
    }
}
