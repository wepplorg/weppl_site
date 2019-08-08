<?php

namespace App\Http\Controllers\NGO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Payment;
use App\Models\BeneficiaryMedia;
use App\Models\NgoUser;
use App\Models\Category;
use App\Models\Feature;
use Auth;
use Carbon\Carbon;
class FundTrackController extends Controller
{
    public function index(){
    	$beneficiaries = Beneficiary::where('ngo_id','=',Auth::user()->id)->where('status','!=',1)->get();
    	$ids = Beneficiary::where('ngo_id','=',Auth::user()->id)->pluck('id');
    	$total_amount= Payment::whereIN('beneficiary_id',$ids)->where('payment_status','=','Success')->sum('amount');
    	return view('ngo.track_fund.index',compact('beneficiaries','total_amount'));
    }

    public function track_details($id){
    	$categories = Category::where('status', '=', 1)->get();
        $features = Feature::where('status', '=', 1)->get();
        $beneficiary = Beneficiary::find($id);
        $ngo_user = NgoUser::where('id', '=', $beneficiary->ngo_user_id)->first();
        $ngo_user['age'] = Carbon::parse($ngo_user->date_of_birth)->age;
        $date1_ts = strtotime($beneficiary->start_date);
        $date2_ts = strtotime($beneficiary->end_date);
        $diff = $date2_ts - $date1_ts;
        $no_of_days = round($diff / 86400);
        return view('ngo.track_fund.track_details', compact('beneficiary', 'categories', 'features','ngo_user','no_of_days'));
    }
}
