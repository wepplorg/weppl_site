<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Auth;
use App\User;
use App\Models\NgoProfile;
use Mail;
use App\Models\NgoProfileStatus;
use Session;
use App\Models\State;
use App\Models\City;
use App\Models\Beneficiary;
use App\Models\Payment;
use App\Models\NgoDocument;
use Storage;
class NgoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ngos = Role::where('name','ngo')->first()->users()->orderBy('id','desc')->get(); 
        return view('admin.ngo.index',compact('ngos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ngo = User::find($id);
        $states = State::all();
        $cities = City::all();
        return view('admin.ngo.show',compact('ngo','states','cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $ngo = User::find($id);  
      $ids = Beneficiary::where('ngo_id','=',$id)->pluck('id');
      $total_amount= Payment::whereIN('beneficiary_id',$ids)->where('payment_status','=','Success')->sum('amount');
      return view('admin.ngo.edit',compact('ngo','total_amount'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_except($request->all(), ['_token','_method','comments']);
        $update = NgoProfile::where('id','=',$id)->update($data);
        if($request->get('status') == 2){
           $profile_status['status']="Approved";   
        }else{
            $profile_status['status']="Rejected";
        }
        
        $profile_status['ngo_profile_id']=$id;
        $profile_status['comments']=$request->get('comments');
        $status=NgoProfileStatus::create($profile_status);
        if($update){
            if($request->status == 2){

                $user_info = NgoProfile::where('id','=',$id)->first();
                $mail=  Mail::send('email.ngo_profile_approve',[ 'name' => $user_info->users->name,'status'=>$status],function($message) use($user_info,$status) {
                        $message->to($user_info->users->email,$user_info->users->name);
                        $message->subject('Partner Registration Approved');
                        $message->attach(public_path('guide/Weppl_Beneficiary_Story_Guide_Document_for_NGO.pdf'));
                });
            Session::flash('message', 'Successfully approved the Ngo!');    
            return redirect('admin/ngo');

            }else if($request->get('status') == 3){
                $user_info = NgoProfile::where('id','=',$id)->first();
                $mail=  Mail::send('email.ngo_profile_reject',[ 'name' => $user_info->users->name,'status'=>$status],function($message) use($user_info,$status) {
                     $message->to($user_info->users->email,$user_info->users->name)
                    ->subject('NGO Registration issue on weppl');
                });
            Session::flash('message', 'Successfully rejected the Ngo!');
            return redirect('admin/ngo');
            }
            
        }else{
            return "Something went wrong";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::where('id','=',$id)->delete();
        if($delete){
             Session::flash('message', 'Successfully deleted the Ngo!');
            return redirect('admin/ngo');
        }else{
             Session::flash('message', 'Something went wrong!');
            return redirect('admin/ngo');
        }
    }

    public function update_ngo(Request $request){
        if($request->get('name')){
            $user['name'] = $request->get('name');
            $user['mobile_no']=$request->get('mobile_no');
            User::where('id','=',$request->get('ngo_id'))->update($user);
         }
         
        // return $request->get('city_id');
         $profile = array_except($request->all(),['name','logo','_token','mobile_no','change_image_boolean']);
         
         $profile_check = NgoProfile::where('ngo_id','=',$request->get('ngo_id'))->first();
         if($profile_check){
             $update = NgoProfile::where('ngo_id','=',$request->get('ngo_id'))->update($profile);
             if($request->file('logo')){
                // $logo =$request->file('logo');
                $photo = $request->file('logo');
                $imageName =  time().'.'.$request->file('logo')->getClientOriginalExtension();
                $image =$photo;
                $t = Storage::disk('s3')->put('ngo/'.$request->get('ngo_id').'/logo/'.$imageName, file_get_contents($image), 'Gallery');
                $url='ngo/'.$request->get('ngo_id').'/logo/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
                $profile_logo['logo']=$imageName;
              //   $logo = $logo->store('public/ngo/'.$request->get('ngo_id').'/logo');
                // $logo = str_replace('public/ngo/'.$request->get('ngo_id').'/logo/', '', $logo);
                // $profile_logo['logo']=$logo;
                 NgoProfile::where('ngo_id','=',$request->get('ngo_id'))->update($profile_logo);
            }
         }else{
             $profile['ngo_id']=$request->get('ngo_id');
            $create = NgoProfile::create($profile);
             if($request->file('logo')){
                $photo = $request->file('logo');
                $imageName =  time().'.'.$request->file('logo')->getClientOriginalExtension();
                $image =$photo;
                $t = Storage::disk('s3')->put('ngo/'.$request->get('ngo_id').'/logo/'.$imageName, file_get_contents($image), 'Gallery');
                $url='ngo/'.$request->get('ngo_id').'/logo/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
                $profile_logo['logo']=$imageName;
                 NgoProfile::where('ngo_id','=',Auth::user()->id)->update($profile_logo);
            }
         }
        Session::flash('message', 'Successfully updated the ngo information!'); 
        return redirect()->back();
    }

    public function documents_update(Request $request){
        $ngo_profile_id = $request->get('ngo_profile_id');
        $ngo_id = $request->get('ngo_id');
        $profile_check = NgoDocument::where('ngo_profile_id','=',$ngo_profile_id)->first();
        if(!$profile_check){
          if($request->file('registration_document')){
                 $registration_document =$request->file('registration_document');
                 $imageName =  time().'.'.$request->file('registration_document')->getClientOriginalExtension();
                 $image =$registration_document;
                 $t = Storage::disk('s3')->put('ngo/'.$ngo_id.'/document/reg_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.$ngo_id.'/document/reg_doc/'.$imageName;
                 $registration_document = Storage::disk('s3')->url($url);
               //  $registration_document = $registration_document->store('public/ngo/'.Auth::user()->id.'/document');
                // $registration_document = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $registration_document);
                 $document['registration_document']=$registration_document;
            }
            if($request->file('reg_12a_doc')){
                 $reg_12a_doc =$request->file('reg_12a_doc');
                 $imageName =  time().'.'.$request->file('reg_12a_doc')->getClientOriginalExtension();
                 $image =$reg_12a_doc;
                 $t = Storage::disk('s3')->put('ngo/'.$ngo_id.'/document/reg_12a_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.$ngo_id.'/document/reg_12a_doc/'.$imageName;
                 $reg_12a_doc = Storage::disk('s3')->url($url);
                // $reg_12a_doc = $reg_12a_doc->store('public/ngo/'.Auth::user()->id.'/document');
                // $reg_12a_doc = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $reg_12a_doc);
                 $document['reg_12a_doc']=$reg_12a_doc;
            }
            if($request->file('reg_80g_doc')){
                 $reg_80g_doc =$request->file('reg_80g_doc');
                 $imageName =  time().'.'.$request->file('reg_80g_doc')->getClientOriginalExtension();
                 $image =$reg_80g_doc;
                 $t = Storage::disk('s3')->put('ngo/'.$ngo_id.'/document/reg_80g_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.$ngo_id.'/document/reg_80g_doc/'.$imageName;
                 $reg_80g_doc = Storage::disk('s3')->url($url);
               //  $reg_80g_doc = $reg_80g_doc->store('public/ngo/'.Auth::user()->id.'/document');
                 //$reg_80g_doc = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $reg_80g_doc);
                 $document['reg_80g_doc']=$reg_80g_doc;
            }
            if($request->file('audi_statement')){
                 $audi_statement =$request->file('audi_statement');
                 $imageName =  time().'.'.$request->file('audi_statement')->getClientOriginalExtension();
                 $image =$audi_statement;
                 $t = Storage::disk('s3')->put('ngo/'.$ngo_id.'/document/audi_statement/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.$ngo_id.'/document/audi_statement/'.$imageName;
                 $audi_statement = Storage::disk('s3')->url($url);
               //  $audi_statement = $audi_statement->store('public/ngo/'.Auth::user()->id.'/document');
                // $audi_statement = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $audi_statement);
                 $document['audi_statement']=$audi_statement;
            }
            $document['ngo_profile_id']=$ngo_profile_id;
            $document['pan_number']=$request->get('pan_number');
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
                 $t = Storage::disk('s3')->put('ngo/'.$ngo_id.'/document/reg_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.$ngo_id.'/document/reg_doc/'.$imageName;
                 $registration_document = Storage::disk('s3')->url($url);
                // $registration_document = $registration_document->store('public/ngo/'.Auth::user()->id.'/document');
                // $registration_document = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $registration_document);
                 $document['registration_document']=$registration_document;
            }
            if($request->file('reg_12a_doc')){
                 $reg_12a_doc =$request->file('reg_12a_doc');
                 $imageName =  time().'.'.$request->file('reg_12a_doc')->getClientOriginalExtension();
                 $image =$reg_12a_doc;
                 $t = Storage::disk('s3')->put('ngo/'.$ngo_id.'/document/reg_12a_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.$ngo_id.'/document/reg_12a_doc/'.$imageName;
                 $reg_12a_doc = Storage::disk('s3')->url($url);
               //  $reg_12a_doc = $reg_12a_doc->store('public/ngo/'.Auth::user()->id.'/document');
                // $reg_12a_doc = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $reg_12a_doc);
                 $document['reg_12a_doc']=$reg_12a_doc;
            }
            if($request->file('reg_80g_doc')){
                 $reg_80g_doc =$request->file('reg_80g_doc');
                 $imageName =  time().'.'.$request->file('reg_80g_doc')->getClientOriginalExtension();
                 $image =$reg_80g_doc;
                 $t = Storage::disk('s3')->put('ngo/'.$ngo_id.'/document/reg_80g_doc/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.$ngo_id.'/document/reg_80g_doc/'.$imageName;
                 $reg_80g_doc = Storage::disk('s3')->url($url);
                // $reg_80g_doc = $reg_80g_doc->store('public/ngo/'.Auth::user()->id.'/document');
                // $reg_80g_doc = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $reg_80g_doc);
                 $document['reg_80g_doc']=$reg_80g_doc;
            }
            if($request->file('audi_statement')){
                 $audi_statement =$request->file('audi_statement');
                    $imageName =  time().'.'.$request->file('audi_statement')->getClientOriginalExtension();
                 $image =$audi_statement;
                 $t = Storage::disk('s3')->put('ngo/'.$ngo_id.'/document/audi_statement/'.$imageName, file_get_contents($image), 'Gallery');
                 $url='ngo/'.$ngo_id.'/document/audi_statement/'.$imageName;
                 $audi_statement = Storage::disk('s3')->url($url);
                // $audi_statement = $audi_statement->store('public/ngo/'.Auth::user()->id.'/document');
                // $audi_statement = str_replace('public/ngo/'.Auth::user()->id.'/document/', '', $audi_statement);
                 $document['audi_statement']=$audi_statement;
            }
           // $document['ngo_profile_id']=Auth::user()->ngo_profiles()->id;
            //$profile = array_except($request->all(),['registration_document','reg_12a_doc','reg_80g_doc','audi_statement','pan_number','_token']);
          //  NgoProfile::where('ngo_id','=',Auth::user()->id)->update($profile);
            $document['pan_number']=$request->get('pan_number');
            $update = NgoDocument::where('ngo_profile_id','=',$ngo_profile_id)->update($document);
            if($update){
                Session::flash('message', 'Successfully Updated!'); 
                return redirect()->back();
            }
        }
    }
}
