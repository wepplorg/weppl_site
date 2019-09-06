<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use Session;
use Keygen;
use App\Models\Payment;
use Mail;
use App\Models\Beneficiary;
class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donors = Role::where('name','donor')->first()->users()->get(); 
        return view('admin.donor.index',compact('donors'));
    }

    public function role_change(Request $request){
       $user = User::find($request->get('user_id'));
       $role = $user->roles()->sync([$request->input('role')]);
       if($role){
          Session::flash('message', 'Successfully changed the role!');
            return redirect('admin/donors');
       }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function email_check(Request $request){
        $email =  $request->get('email');
        $email_check = User::where('email','=',$email)->first();
        if($email_check){
           return response()->json(['success'=>'Email Exists'],200);
        }else{
           return response()->json(['error'=>'Email does not exist'],201);
        }
    }

    public function donor_register(Request $request){
        $data['name']=$request->get('name');
        $data['email']=$request->get('email');
        $password="123456";
        $data['password']=bcrypt($password);
        $create = User::create($data); 
        if($create){
            $create->attachRole(3);
            Session::flash('message', 'Successfully created the donor!');
            return redirect('admin/donors');
        }
    }

    public function donor_payment(Request $request){
      $data['amount'] = $request->get('amount');
      $data['beneficiary_id'] = $request->get('beneficiary_id');
      $data['payment_status']= "Success";
      $data['payment_gateway']= "manual";
     // $data['tickets_count']=$request->get('ticket_count');
      $data['user_id']=$request->get('user_id');
      $data['order_id'] = Keygen::numeric(10)->generate();
      $lastInvoiceNo = Payment::where('payment_status', 'Success')->orderBy('id', 'desc')->where('invoice_no', '!=', null)->first();
      $invoiceNo=null;
      if($lastInvoiceNo){
                $data['invoice_no'] = $lastInvoiceNo->invoice_no+1;
      }else{
                $data['invoice_no'] =1;
     }
      $store = Payment::create($data);
      $user = User::find($request->get('user_id'));
      $beneficiary = Beneficiary::find($request->get('beneficiary_id'));
      Mail::send('email.admin_invocie',[ 'name' => $user->name,'beneficiary'=>$beneficiary,'payment'=>$store],function($message) use($user) {
                     $message->to($user->email,$user->name);
                     $message->subject('You are a Changemaker!');
                     
      });
      if($store){
        Session::flash('message', 'Successfully created the payment for donor!');
        return redirect('admin/beneficiary/'.$request->get('beneficiary_id').'/edit');
      }
    }
}
