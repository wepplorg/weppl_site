<?php

namespace App\Http\Controllers\Admin;

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
use App\User;
use App\Models\Role;
use Response;
class TrackController extends Controller
{
    public function track_fund(){
    	$ngos = Role::where('name','ngo')->first()->users()->get();
    	//return $ngos;
    	return view('admin.track_fund.index',compact('ngos'));
    }

    public function beneficiary_track($id){
    	$beneficiaries = Beneficiary::where('ngo_id','=',$id)->where('status','!=',1)->get();
    	$ids = Beneficiary::where('ngo_id','=',$id)->pluck('id');
    	$user = User::find($id);
    	$total_amount= Payment::whereIN('beneficiary_id',$ids)->where('payment_status','=','Success')->sum('amount');
    	return view('admin.track_fund.beneficiary_track',compact('beneficiaries','total_amount','user','id'));
    }

    public function track_fund_details($id){
    	$categories = Category::where('status', '=', 1)->get();
        $features = Feature::where('status', '=', 1)->get();
        $beneficiary = Beneficiary::find($id);
        $ngo_user = NgoUser::where('id', '=', $beneficiary->ngo_user_id)->first();
        $ngo_user['age'] = Carbon::parse($ngo_user->date_of_birth)->age;
        $date1_ts = strtotime($beneficiary->start_date);
        $date2_ts = strtotime($beneficiary->end_date);
        $diff = $date2_ts - $date1_ts;
        $no_of_days = round($diff / 86400);
        return view('admin.track_fund.track_details', compact('beneficiary', 'categories', 'features','ngo_user','no_of_days'));
    }

    public function download_csv(Request $request){
        $id =$request->get('id');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        $beneficiaries = Beneficiary::where('ngo_id','=',$id)->where('status','!=',1)->get();
    	$ids = Beneficiary::where('ngo_id','=',$id)->pluck('id');
    	$ngo = User::find($id);
        $users= Payment::whereIN('beneficiary_id',$ids)->where('payment_status','=','Success')->whereBetween('created_at',[$from_date,$to_date])->get();
        $filename = "Payment.csv";
        $i=1;
        $handle = fopen($filename, 'w+');
        fputcsv($handle,['No','Date','Donor Name','Donor Mail','Pan Card','Donor Mobile Number','NGO Name','Cause Title','Benficiary Name','Amount Donated']);
        foreach ($users as $value) {
            fputcsv($handle,[$i++,date('Y-m-d',strtotime($value->created_at)),$value->users->name,$value->users->email,'',$value->users->mobile_no,$ngo->name,$value->beneficiary->title,$value->beneficiary->ngo_users->name,$value->amount]);
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'Payment.csv', $headers);

    }
}
