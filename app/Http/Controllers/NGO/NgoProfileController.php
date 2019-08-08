<?php

namespace App\Http\Controllers\NGO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\State;
use App\Models\City;
use App\Models\NgoProfile;
use Session;
use App\Models\NgoDocument;
use Storage;
class NgoProfileController extends Controller
{
    public function general(){
    	$states= State::with('cities')->get();
    	$cities = City::all();
        //return $states;
    	return view('ngo.profile.general',compact('states','cities'));
    }

    public function documents(){
        $profile = NgoProfile::where('ngo_id','=',Auth::user()->id)->first();
    	return view('ngo.profile.documents',compact('profile'));
    }

    public function getCity(Request $request){
    	$cities = City::where('state_id','=',$request->get('state_id'))->get();
    	return response()->json($cities);
    }

    //updating general
    public function update_general(Request $request){
        //return $request->all();
         if($request->get('name')){
            $user['name'] = $request->get('name');
            User::where('id',Auth::user()->id)->update($user);
         }
         if($request->get('new_password')){
            $user['password'] = bcrypt($request->get('new_password'));
            User::where('id',Auth::user()->id)->update($user);
         }
        // return $request->get('city_id');
         $profile = array_except($request->all(),['name','new_password','logo','_token']);
         $profile['verify']=0;
         $profile['status']=1;
         $profile_check = NgoProfile::where('ngo_id','=',Auth::user()->id)->first();
         if($profile_check){
             $update = NgoProfile::where('ngo_id','=',Auth::user()->id)->update($profile);
             if($request->file('logo')){
                $photo = $request->file('logo');
                $imageName =  time().'.'.$request->file('logo')->getClientOriginalExtension();
                $image =$photo;
                $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/logo/'.$imageName, file_get_contents($image), 'Gallery');
                $url='ngo/'.Auth::user()->id.'/logo/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
                $profile_logo['logo']=$imageName;
                 NgoProfile::where('ngo_id','=',Auth::user()->id)->update($profile_logo);
            }
         }else{
             $profile['ngo_id']=Auth::user()->id;
             $create = NgoProfile::create($profile);
             if($request->file('logo')){
                $photo = $request->file('logo');
                $imageName =  time().'.'.$request->file('logo')->getClientOriginalExtension();
                $image =$photo;
                $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/logo/'.$imageName, file_get_contents($image), 'Gallery');
                $url='ngo/'.Auth::user()->id.'/logo/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
                $profile_logo['logo']=$imageName;
                NgoProfile::where('ngo_id','=',Auth::user()->id)->update($profile_logo);
            }
         }
        Session::flash('message', 'Successfully Updated!'); 
        return redirect()->back();
    }

    public function update_document(Request $request){
        //return Auth::user()->ngo_profiles->id;
        $profile_check = NgoDocument::where('ngo_profile_id','=',Auth::user()->ngo_profiles->id)->first();
        if(!$profile_check){
          if($request->file('registration_document')){
                 $registration_document =$request->file('registration_document');
                 $imageName =  time().'.'.$request->file('registration_document')->getClientOriginalExtension();
                 $image =$registration_document;
                 $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/document/reg_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.Auth::user()->id.'/document/reg_doc/'.$imageName;
                 $registration_document = Storage::disk('s3')->url($url);
               //  $registration_document = $registration_document->store('public/ngo/'.Auth::user()->id.'/document');
                // $registration_document = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $registration_document);
                 $document['registration_document']=$registration_document;
            }
            if($request->file('reg_12a_doc')){
                 $reg_12a_doc =$request->file('reg_12a_doc');
                 $imageName =  time().'.'.$request->file('reg_12a_doc')->getClientOriginalExtension();
                 $image =$reg_12a_doc;
                 $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/document/reg_12a_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.Auth::user()->id.'/document/reg_12a_doc/'.$imageName;
                 $reg_12a_doc = Storage::disk('s3')->url($url);
                // $reg_12a_doc = $reg_12a_doc->store('public/ngo/'.Auth::user()->id.'/document');
                // $reg_12a_doc = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $reg_12a_doc);
                 $document['reg_12a_doc']=$reg_12a_doc;
            }
            if($request->file('reg_80g_doc')){
                 $reg_80g_doc =$request->file('reg_80g_doc');
                 $imageName =  time().'.'.$request->file('reg_80g_doc')->getClientOriginalExtension();
                 $image =$reg_80g_doc;
                 $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/document/reg_80g_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.Auth::user()->id.'/document/reg_80g_doc/'.$imageName;
                 $reg_80g_doc = Storage::disk('s3')->url($url);
               //  $reg_80g_doc = $reg_80g_doc->store('public/ngo/'.Auth::user()->id.'/document');
                 //$reg_80g_doc = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $reg_80g_doc);
                 $document['reg_80g_doc']=$reg_80g_doc;
            }
            if($request->file('audi_statement')){
                 $audi_statement =$request->file('audi_statement');
                 $imageName =  time().'.'.$request->file('audi_statement')->getClientOriginalExtension();
                 $image =$audi_statement;
                 $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/document/audi_statement/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.Auth::user()->id.'/document/audi_statement/'.$imageName;
                 $audi_statement = Storage::disk('s3')->url($url);
               //  $audi_statement = $audi_statement->store('public/ngo/'.Auth::user()->id.'/document');
                // $audi_statement = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $audi_statement);
                 $document['audi_statement']=$audi_statement;
            }
            $document['ngo_profile_id']=Auth::user()->ngo_profiles->id;
            $document['pan_number']=$request->get('pan_number');
            $profile = array_except($request->all(),['registration_document','reg_12a_doc','reg_80g_doc','audi_statement','pan_number','_token']);
            NgoProfile::where('ngo_id','=',Auth::user()->id)->update($profile);
            $create = NgoDocument::create($document);
            if($create){
                Session::flash('message', 'Successfully Updated!'); 
                return redirect()->back();
            }

        }else{
              if($request->file('registration_document')){
                 $registration_document =$request->file('registration_document');
                 $imageName =  time().'.'.$request->file('registration_document')->getClientOriginalExtension();
                 $image =$registration_document;
                 $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/document/reg_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.Auth::user()->id.'/document/reg_doc/'.$imageName;
                 $registration_document = Storage::disk('s3')->url($url);
                // $registration_document = $registration_document->store('public/ngo/'.Auth::user()->id.'/document');
                // $registration_document = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $registration_document);
                 $document['registration_document']=$registration_document;
            }
            if($request->file('reg_12a_doc')){
                 $reg_12a_doc =$request->file('reg_12a_doc');
                 $imageName =  time().'.'.$request->file('reg_12a_doc')->getClientOriginalExtension();
                 $image =$reg_12a_doc;
                 $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/document/reg_12a_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.Auth::user()->id.'/document/reg_12a_doc/'.$imageName;
                 $reg_12a_doc = Storage::disk('s3')->url($url);
               //  $reg_12a_doc = $reg_12a_doc->store('public/ngo/'.Auth::user()->id.'/document');
                // $reg_12a_doc = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $reg_12a_doc);
                 $document['reg_12a_doc']=$reg_12a_doc;
            }
            if($request->file('reg_80g_doc')){
                 $reg_80g_doc =$request->file('reg_80g_doc');
                 $imageName =  time().'.'.$request->file('reg_80g_doc')->getClientOriginalExtension();
                 $image =$reg_80g_doc;
                 $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/document/reg_80g_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.Auth::user()->id.'/document/reg_80g_doc/'.$imageName;
                 $reg_80g_doc = Storage::disk('s3')->url($url);
                // $reg_80g_doc = $reg_80g_doc->store('public/ngo/'.Auth::user()->id.'/document');
                // $reg_80g_doc = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $reg_80g_doc);
                 $document['reg_80g_doc']=$reg_80g_doc;
            }
            if($request->file('audi_statement')){
                 $audi_statement =$request->file('audi_statement');
                    $imageName =  time().'.'.$request->file('audi_statement')->getClientOriginalExtension();
                 $image =$audi_statement;
                 $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/document/audi_statement/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.Auth::user()->id.'/document/audi_statement/'.$imageName;
                 $audi_statement = Storage::disk('s3')->url($url);
                // $audi_statement = $audi_statement->store('public/ngo/'.Auth::user()->id.'/document');
                // $audi_statement = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $audi_statement);
                 $document['audi_statement']=$audi_statement;
            }
           // return  $document;
            $profile = array_except($request->all(),['registration_document','reg_12a_doc','reg_80g_doc','audi_statement','pan_number','_token']);
            NgoProfile::where('ngo_id','=',Auth::user()->id)->update($profile);
            $document['pan_number']=$request->get('pan_number');
            $update = NgoDocument::where('ngo_profile_id','=',$profile_check->ngo_profile_id)->update($document);
            if($update){
                Session::flash('message', 'Successfully Updated!'); 
                return redirect()->back();
            }
        }
        
        
    }
}
