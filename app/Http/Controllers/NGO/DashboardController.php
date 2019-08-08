<?php

namespace App\Http\Controllers\NGO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Beneficiary;
use App\Models\Category;
use App\Models\Feature;
class DashboardController extends Controller
{
    public function index(){
    	
            $beneficiaries = Beneficiary::all();
    		return view('ngo.index',compact('beneficiaries'));
    	
    }
}
