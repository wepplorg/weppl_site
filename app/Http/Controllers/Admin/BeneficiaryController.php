<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Beneficiary;
use App\Models\BeneficiaryMedia;
use Auth;
use Session;
use Mail;
use App\Models\NgoUser;
use Carbon\Carbon;
use Storage;
use Illuminate\Support\Str;
use App\Models\Role;
class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');
        $pending_beneficiaries = Beneficiary::where('status','=',1)->orderBy('id','desc')->get();
        $approved_beneficiaries = Beneficiary::where('status','=',2)->where('end_date','>=',$date)->orderBy('id','desc')->get();
        $rejected_beneficiaries = Beneficiary::where('status','=',3)->orderBy('id','desc')->get();
        $completed_beneficiaries = Beneficiary::where('status','=',2)->where('end_date','<',$date)->orderBy('id','desc')->get();

        return view('admin.beneficiary.index',compact('pending_beneficiaries','approved_beneficiaries','rejected_beneficiaries','completed_beneficiaries'));
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
        $beneficiary = Beneficiary::find($id);
        $categories = Category::where('status','=',1)->get();
        $features = Feature::where('status','=',1)->get(); 
        $ngo_user = NgoUser::where('id', '=', $beneficiary->ngo_user_id)->first();
        $ngo_user['age'] = Carbon::parse($ngo_user->date_of_birth)->age;
        $date1_ts = strtotime($beneficiary->start_date);
        $date2_ts = strtotime($beneficiary->end_date);
        $diff = $date2_ts - $date1_ts;
        $no_of_days = round($diff / 86400);
        return view('admin.beneficiary.show',compact('beneficiary','categories','features','ngo_user','no_of_days'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beneficiary = Beneficiary::find($id);
        $categories = Category::where('status','=',1)->get();
        $features = Feature::where('status','=',1)->get(); 
        $donors = Role::where('name','donor')->first()->users()->get();
        return view('admin.beneficiary.edit',compact('beneficiary','categories','features','donors'));
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
       $data = array_except($request->all(), ['_token','_method','main_display_image','document','change_image_boolean','campaign_duration']);
       $data['slug']=Str::slug($request->get('title'), '-');
       $duration = $request->get('campaign_duration');
       $data['start_date'] = date('Y-m-d');
       $data['end_date']=date('Y-m-d',strtotime("+ $duration days"));
       $beneficiary = Beneficiary::where('id','=',$id)->update($data);
       //return $data['end_date'];
       $beneficiary_detail = Beneficiary::find($id);
       if($request->file('image')){
         //return "hi";
           $files = $request->file('image');
         
           $i=1;
           foreach($files as $file) {
                         //return $file;
            
             $imageName =  time().'.'.$file->getClientOriginalExtension();
             $image =$file;
             $t = Storage::disk('s3')->put('ngo/'.$beneficiary_detail->ngo_id.'/beneficiary/'.$id.'/document/'.$imageName, file_get_contents($image), 'Gallery');
             $url='ngo/'.$beneficiary_detail->ngo_id.'/beneficiary/'.$id.'/document/'.$imageName;
             $imageName = Storage::disk('s3')->url($url);            
             //$document[''] = $imageName;
           //  $filename = $file->store('public/ngo/'.$beneficiary_detail->ngo_id.'/beneficiary/'.$id.'/images');
           //  $filename = str_replace('public/ngo/'.$beneficiary_detail->ngo_id.'/beneficiary/'.$id.'/images/', '', $filename);
             $photo['image']=$imageName;
            // $photo['beneficiary_id']=$beneficiary_detail->id;
             $i++;
             BeneficiaryMedia::where('beneficiary_id','=',$beneficiary_detail->id)->update($photo);
            // Beneficiary::where('beneficiary_id','=',$beneficiary_detail->id)->update($photo);
            // Beneficiary::where('id','=',$beneficiary_detail->id)->update($photo);
           }
       }
       if($request->file('document')){
           $files = $request->file('document');
         //return $files;
           $i=1;
           foreach($files as $file) {
                         //return $file;
             $imageName =  time().'.'.$file->getClientOriginalExtension();
             $image =$file;
             $t = Storage::disk('s3')->put('ngo/'.$beneficiary_detail->ngo_id.'/beneficiary/'.$id.'/document/'.$imageName, file_get_contents($image), 'Gallery');
             $url='ngo/'.$beneficiary_detail->ngo_id.'/beneficiary/'.$id.'/document/'.$imageName;
             $imageName = Storage::disk('s3')->url($url);            
             $document['document'] = $imageName;
            // $filename = $file->store('public/ngo/'.$beneficiary_detail->ngo_id.'/beneficiary/'.$id.'/document');
             //$filename = str_replace('public/ngo/'.$beneficiary_detail->ngo_id.'/beneficiary/'.$id.'/document/', '', $filename);
             $i++;
             Beneficiary::where('id','=',$beneficiary->id)->update($document);
           }
       }
       if($beneficiary){
          Session::flash('message', 'Successfully updated the beneficiary!');
          return redirect('admin/beneficiary');
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
        $delete = Beneficiary::where('id','=',$id)->delete();
        if($delete){
             Session::flash('message', 'Successfully deleted the beneficiary!');
             return redirect('admin/beneficiary');
        }else{
            Session::flash('message', 'Something went wrong!');
             return redirect('admin/beneficiary');
        }
    }


    //approve beneficiary
    public function approve_beneficiary(Request $request,$id){
        $data['status']=2;
        $data['start_date'] = date('Y-m-d');
        $update=Beneficiary::where('id','=',$id)->update($data);
        $beneficiary = Beneficiary::find($id);
        $user = $beneficiary->users;
        $url = $request->root().'beneficiary_detail/'.$beneficiary->slug;
        $mail = Mail::send('email.beneficiary_approve',[ 'name' => $user->name,'beneficiary_name'=>$beneficiary->ngo_users->name,'url'=>$url],function($message) use($user) {
                 $message->to($user->email,$user->name)
                ->subject('weppl beneficiary approval');
            });
        if($update){
             Session::flash('message', 'Successfully approved the beneficiary!');
             return redirect('admin/beneficiary');
        }else{
            Session::flash('message', 'Something went wrong!');
             return redirect('admin/beneficiary');
        }
    }

    //reject beneficiary
    public function reject_beneficiary($id){
        $data['status']=3;
        $update=Beneficiary::where('id','=',$id)->update($data);
        $beneficiary = Beneficiary::find($id);
        $user = $beneficiary->users;
        if($update){
             $mail = Mail::send('email.beneficiary_reject',[ 'name' => $user->name,'beneficiary_name'=>$beneficiary->ngo_users->name],function($message) use($user) {
                 $message->to($user->email,$user->name)
                ->subject('Adding beneficiary issue on weppl');
            });
             Session::flash('message', 'Successfully rejected the beneficiary!');
             return redirect('admin/beneficiary');
        }else{
            Session::flash('message', 'Something went wrong!');
             return redirect('admin/beneficiary');
        }
    }
}
