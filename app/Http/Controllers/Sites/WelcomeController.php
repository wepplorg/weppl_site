<?php

namespace App\Http\Controllers\Sites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Contact;
use App\Models\Payment;
use Mail;
class WelcomeController extends Controller
{
	public function index(){
	//return "hi";
    	$from_date = date('Y-m-d');
    	$to_date= date('Y-m-d',strtotime($from_date.' + 100 days'));
    	$stories = Beneficiary::WhereBetween('end_date',[$from_date,$to_date])->where('status','=',2)->take(3)->get();
    	//return $stories;
    	return view('welcome',compact('stories'));
    }

    public function contact_store(Request $request){
    	$data = array_except($request->all(), ['_token']);
    	$create = Contact::create($data);
    	if($create){
    		return response()->json(['success'=>'Successfully Added!'],200);
    	}
    }

    public function support_email(Request $request){
        $data = array_except($request->all(), ['_token']);
        $email =$request->get('email');
        $text = $request->get('message');
       // return $text;
        $mail = Mail::send('email.support_email',['mail' => $email,'description'=>$text],function($message)  {
                 $message->to("support@weppl.org","Weppl");
                 $message->subject('Support');
               });

            return response()->json(['success'=>'Successfully Added!'],200);
    }
}
