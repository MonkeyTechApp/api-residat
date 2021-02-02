<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function index (Request $request){
        // dumping the elts
        $obj = json_decode($request->getContent());

        $user = User::where('email', $obj->email)->first();
        if(!$user || Hash::check($obj->password, $user->password)){
            return response([
                'message' => ['These credentials doesn\'t match any records']
            ],404);
        }
        $token = $user->createToken('my_app_token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

}
