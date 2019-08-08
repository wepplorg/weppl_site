<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(Auth::user()->hasRole('admin')){
           // dd(Auth::user()->hasRole('admin'));
            return redirect('admin/dashboard');
         }elseif (Auth::user()->hasRole('ngo')) {
             return redirect('ngo/profile/general');
         }else{
            return redirect('beneficiary_lists');
         }
        
    }
}
