<?php

namespace App\Http\Controllers\Sites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Payment;
use App\Models\Beneficiary;
use Session;
use Storage;
class DonorController extends Controller
{
    public function donor_dashboard(){
    	//$from_date = date('Y-m-d',strtotime('first day of last month'));
        $from_date = date('2019-01-01');
       // $to_date = date('Y-m-d',strtotime('last day of last month'));
        $to_date = date('Y-m-d');
    	$supported_causes = Payment::where('payment_status','=','Success')->where('user_id','=',Auth::user()->id)->groupBy('beneficiary_id')->get();
    	$contribution = Payment::where('payment_status','=','Success')->where('user_id','=',Auth::user()->id)->sum('amount');
        //return $supported_causes;
    	$impacted_people = Payment::where('payment_status','=','Success')->whereBetween('created_at',[$from_date,$to_date])->groupBy('beneficiary_id')->get();
    	$rating = Payment::where('payment_status','=','Success')->whereBetween('created_at',[$from_date,$to_date])->groupBy('beneficiary_id')->get();
        $total_contribution =Payment::where('payment_status','=','Success')->sum('amount');
        //return $total_contribution;
    	if($total_contribution != 0){
    		$average_rating = $total_contribution/count($rating);
           // return $average_rating;
    	}else{
    		$average_rating = 0;
    	}
    	//return $average_rating;
        return view('sites.pages.donorboard',compact('supported_causes','contribution','impacted_people','average_rating'));
    }

    public function user_profile_update(Request $request){
        $data = array_except($request->all() , ['_token','image','change_image_boolean','change_password_boolean','password']);
        //return $request->file('image');
        if($request->file('image')){
            $file = $request->file('image');
          //  return $file;
            $imageName =  time().'.'.$file->getClientOriginalExtension();
                $image =$file;
                $t = Storage::disk('s3')->put('user/'.Auth::user()->id.'/'.$imageName, file_get_contents($image), 'Gallery');
                $url='user/'.Auth::user()->id.'/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
              //$filename = $file->store('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/document');
              //$filename = str_replace('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/document/', '', $filename);
                $data['image'] = $imageName;
        }
        if($request->get('password')){
            $data['password']=bcrypt($request->get('password'));
        }
        $update = User::where('id','=',Auth::user()->id)->update($data);
        if($update){
            Session::flash('message', 'Successfully updated!');
            return redirect()->back();
        }
    }
}
