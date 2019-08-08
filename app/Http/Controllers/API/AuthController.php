<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Passport\Client;
use Auth;
use App\User;
class AuthController extends Controller
{
     public function __construct()
    {
        $this->client=Client::find(1);
    }

    public function login(Request $request){
    	 $email=request('email');
         if(Auth::attempt(['email' => $email, 'password' => request('password')])){
                $user = Auth::user();
                $success['access_token'] =  $user->createToken('MyApp')->accessToken;
                $success['role']=Auth::user()->roles;
                return response()->json(['success' => $success],200);
         }
         else{
                return response()->json(['error'=>'Incorrect password'], 401);
         }
    }
}
