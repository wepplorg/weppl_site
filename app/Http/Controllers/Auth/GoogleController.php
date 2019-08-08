<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use Auth;
use App\User;
use App\Models\Role;
class GoogleController extends Controller
{
    public function redirect(){
    	return Socialite::driver('google')->redirect();
    }

    public function callback(){
    	$googleUser = Socialite::driver('google')->user();
        $existUser = User::where('email',$googleUser->email)->first();
        if($existUser){
           Auth::login($existUser);
           return redirect()->to('/home');
        }else{
           
           $data =  User::create([
                  'google_id' =>$googleUser->id,
                  'image' =>$googleUser->avatar,
                  'name' =>$googleUser->name,
                  'email' =>$googleUser->email,
                   
                ]);
          //$role = Role::whereName('donor')->first();
          $data->attachRole(3);  
          Auth::login($data);
          return redirect()->to('/home');
        }
    }
}
