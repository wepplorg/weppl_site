<?php

namespace App\Http\Controllers\NGO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Http\Requests\NgoRegister;
use Auth;
use App\User;
use Mail;
class NgoRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::where('status','=',1)->get();
        return view('ngo.register',compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NgoRegister $request)
    {
         $user =User::create([
                   'name' => $request->get('name'),
                   'email' => $request->get('email'),
                   'password' => bcrypt($request->get('password')),
                   'mobile_no' =>$request->get('mobile_no'),
                ]);
         Auth::login($user);
         $user->attachRole(2);
        // $document = asset('guide/NGO_registration_guide_document.pdf');
        
         $mail=  Mail::send('email.ngo_register',[ 'name' => $request->get('name')],function($message) use($user) {
                 $message->to($user->email,$user->name);
                 $message->subject('Partner Registration | Welcome to weppl family');
                 $message->attach(public_path('guide/NGO_registration_guide_document.pdf'));
            });
         return redirect()->to('/home');            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
