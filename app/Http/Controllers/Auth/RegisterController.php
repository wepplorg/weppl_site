<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use Auth;
use App\Models\Role;
use Mail;
use Exception;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'mobile_no'=>'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_no'=>$data['mobile_no'],
            'password' => bcrypt($data['password']),
        ]);
        $user->attachRole(3);
        $mail=  Mail::send('email.donor_register',['name' => $data['name']],function($message) use($user) {
                 $message->to($user->email,$user->name)
                ->subject('Registration | Welcome to weppl family');
        });
         return $user; 
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    //facebook login
     public function handleProviderCallback()
    {

      try{
        $socailuser = Socialite::driver('facebook')->user();
        //dd($socailuser);
      
      
         // dd($socailuser->token);
      $user = User::where('email','=',$socailuser->getEmail())->first();
       //return $user;
        if(!$user){
           $data =  User::create([
                  'facebook_id' =>$socailuser->getId(),
                  'image' =>$socailuser->avatar,
                  'name' =>$socailuser->getName(),
                  'email' =>$socailuser->getEmail(),
                 
                ]);
           //$role = Role::whereName('donor')->first();
           $data->attachRole(3);  
           Auth::login($data);
            if(!session()->has('url.intended'))
            {
                session(['url.intended' => url()->previous()]);
            }
             return view('auth.login');  
           return redirect()->to('/home');
        // $user->token;
        }
        else{
           // $data['facebook_token']=$socailuser->token;
           // User::where('facebook_id','=',$socailuser->getId())->update($data);
            Auth::login($user); 
            return redirect()->to('/home');
        }
     }
        catch (Exception $e) {
            return redirect('/');
        }
    }

    
}
