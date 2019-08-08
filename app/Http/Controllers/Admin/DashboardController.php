<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Role;
use App\Models\City;
use App\Models\NgoProfile;
class DashboardController extends Controller
{
    public function index(){
        //$ngos = Role::where('name','ngo')->first()->users()->get();
    	return view('admin.index',compact('ngos'));
    }

    public function get_city(Request $request){
       $cities = City::where('state_id','=',$request->get('state_id'))->get();
       return response()->json($cities);
    }
}
