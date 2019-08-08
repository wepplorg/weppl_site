<?php

namespace App\Http\Controllers\Sites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Auth;
use User;
class BeneficiaryController extends Controller
{
    public function beneficiary_detail($id){
    	$beneficiary= Beneficiary::where('slug','=',$id)->first();
    	return view('beneficiarydetails',compact('beneficiary'));
    }
}
