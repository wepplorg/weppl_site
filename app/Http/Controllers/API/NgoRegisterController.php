<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\User;
use App\Models\NgoProfile;
use Validator;
use Mail;
class NgoRegisterController extends Controller
{
    public function states(){
    	$states = State::with('cities')->where('status','=',1)->get();
    	if($states){
    		return response()->json(['states'=>$states],200);
    	}else{
    		return response()->json(['error'=>"Something went wrong"],201);
    	}
    }

    //ngo register
    public function ngo_register(Request $request){
        $validator = Validator::make($request->all(), [
    		'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'mobile_no' =>'required',
            'state_id' =>'required',
            'city_id' =>'required',
            'logo' =>'required|mimes:jpeg,png',
            'address' =>'required',
            'description' =>'required',
            'pincode' =>'required',
            'terms' =>'required',
            'document' =>'required|mimes:pdf,docx,doc',

    	]);

    	if ($validator->fails()) {
    		return response()->json(['error' => $validator->errors()], 422);
    	}

    	$data = array_except($request->all(), ['state_id','city_id','logo','address','description','pincode','terms','document']);
    	$data['password'] = bcrypt($request['password']);
    	$user = User::create($data);
    	if($user){
    		$user->attachRole(2);
    		if($request->file('logo')){
    			 $logo =$request->file('logo');
                 $logo = $logo->store('public/ngo/logo');
                 $logo = str_replace('public/ngo/logo/', '', $logo);
                 $profile['logo']=$logo;
    		}else{
    			 $profile['logo']=NULL;
    		}
    		if($request->file('document')){
    			 $document =$request->file('document');
                 $doument = $document->store('public/ngo/document');
                 $document = str_replace('public/ngo/document/', '', $document);
                 $profile['document']=$document;
    		}else{
    			 $profile['document']=NULL;
    		}
            $profile['state_id'] = $request->get('state_id'); 
            $profile['city_id'] = $request->get('city_id');
            $profile['address'] = $request->get('address');
            $profile['description'] = $request->get('description');
            $profile['pincode'] = $request->get('pincode');
            $profile['terms'] = $request->get('terms');
            $profile['ngo_id']=$user->id;
            $profile['verify']=0;
            $profile['status'] =1;
            $ngo = NgoProfile::create($profile);
            $mail=  Mail::send('email.ngo_register',[ 'name' => $request->get('name')],function($message) use($user) {
                 $message->to($user->email,$user->name)
                ->subject('Register successful: WePpl');
            });
      
            if($ngo){
            	return response()->json(['success' => 'Thank you for submitting'], 200);
            }else{
            	return response()->json(['error' =>'Bad Request'], 201);
            }
    	}	else{
    		   return $response()->json(['error' =>"Something went wrong!"],401);
    	}
    }
}
