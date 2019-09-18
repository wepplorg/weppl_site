<?php

namespace App\Http\Controllers\Sites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Beneficiary;
use App\Models\Payment as PaymentDetail;
use Session;
use Keygen;
use Tzsk\Payu\Facade\Payment;
use Razorpay\Api\Api;
use Mail;
use PDF;
use App\Models\Role;
class PaymentController extends Controller
{
    public function proceed_to_pay(Request $request){
       //Input items of form
        
        
     /* $beneficiary = Beneficiary::find($request->get('id')); 	
       if($request->get('amount')){
           $amount = $request->get('amount');
       }else{
           $amount = $request->get('user_amount');
       }
      $request->session()->put('beneficiary_id',$beneficiary->id);
      $txnid = Keygen::numeric(10)->generate();
      $payment['order_id']=$txnid;
      $payment['beneficiary_id']=$beneficiary->id;
      $payment['user_id']=Auth::user()->id;
      $payment['amount']=$amount;
      $payment_detail =PaymentDetail::create($payment);
      $request->session()->put('payment_id',$payment_detail->id);
      $data =[
                       'txnid'       =>$txnid,
                       'amount'      =>$amount,
                       'productinfo' => $beneficiary->title,
                       'firstname'   => Auth::user()->name,
                       'email'       => Auth::user()->email,
                       'phone'       => '1234567890',
                       'surl'        => '192.168.1.7:8000/payumoney_status',
                       'furl'        => '192.168.1.7:8000/payumoney_status',
             ];
      return Payment::make($data, function($then) {
		    $then->redirectTo('payumoney_status'); # Your Status page endpoint.
		   
		});  */     
     
    }

    public function payumoney_status(Request $request){
    	$payment_id = $request->session()->get('payment_id');
      $payment_detail = PaymentDetail::find($payment_id); 
        $transaction = Payment::capture();
        if($transaction['status'] == "Completed"){
            $payment['payment_type']=$transaction['mode'];
            $payment['payment_status']="Success";         
            $payment['tracking_id']=$transaction['mihpayid'];
            $payment['payment_gateway']="PayUmoney";

            $success = PaymentDetail::where('id','=',$payment_id)->update($payment);
            if($success){
               Session::flash('message', 'Successfully payment as done!');
               return redirect('beneficiary_detail/'.$payment_detail->beneficiary_id);
            }
        }else if($transaction['status'] == "Failure"){
            $payment['payment_type']=$transaction['mode'];
            $payment['payment_status']=$transaction['status'];         
            $payment['tracking_id']=$transaction['mihpayid'];
            $payment['payment_gateway']="PayUmoney";

            $success = PaymentDetail::where('id','=',$payment_id)->update($payment);
            if($success){
              Session::flash('message', 'Payment as not done!');
               return redirect('beneficiary_detail/'.$payment_detail->beneficiary_id);
            }
        }
    }

    public function success(Request $request){
     // return $request->get('product_id');
      $data['tracking_id'] = $request->get('razorpay_payment_id');
      $data['amount'] = $request->get('totalAmount');
      $data['beneficiary_id'] = $request->get('product_id');
      $data['payment_status']= "Success";
      $data['payment_gateway']= "razorpay";
      $data['tickets_count']=$request->get('ticket_count');
      $data['user_id']=Auth::user()->id;
      $data['order_id'] = Keygen::numeric(10)->generate();
      $lastInvoiceNo = PaymentDetail::where('payment_status', 'Success')->orderBy('id', 'desc')->where('invoice_no', '!=', null)->first();
      $invoiceNo=null;
      if($lastInvoiceNo){
                $data['invoice_no'] = $lastInvoiceNo->invoice_no+1;
      }else{
                $data['invoice_no'] =1;
     }
      $store = PaymentDetail::create($data);
      $beneficiary = Beneficiary::find($request->get('product_id'));
      $user = Auth::user();
      $invoice['payment']=$store;
      $invoice['beneficiary']=$beneficiary;
      $invoice['order_id'] ="ORD".''.date('Ymd').$store->invoice_no; 
       $total_impacted = PaymentDetail::where('user_id','=',$user->id)->groupBy('beneficiary_id')->where('payment_status','=','Success')->count();
      $total_amount = PaymentDetail::where('user_id','=',$user->id)->where('payment_status','=','Success')->sum('amount');
      //pdf file attahment
      $pdf = PDF::loadView('email.invoice', $invoice);
      Mail::send('email.invoice_email',[ 'name' => $user->name,'beneficiary'=>$beneficiary,'payment'=>$store,'total_amount'=>$total_amount,'total_impacted'=>$total_impacted],function($message) use($user,$pdf) {
                     $message->to($user->email,$user->name);
                     $message->subject('You are a Changemaker!');
                    $message->attachData($pdf->output(), "invoice.pdf");
      });
      if($store){
        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
        return Response()->json($arr);    
      }else{
         $arr = array('error' => 'Payment unsucsess ', 'status' => true);
         return Response()->json($arr); 
      }
    }


    //donate without login
    public function donate_without_login(Request $request){
      $data['tracking_id'] = $request->get('razorpay_payment_id');
      $data['amount'] = $request->get('totalAmount');
      $data['beneficiary_id'] = $request->get('product_id');
      $data['payment_status']= "Success";
      $data['payment_gateway']= "razorpay";
      $data['tickets_count']=$request->get('ticket_count');
      $email = $request->get('email');
      $check_user = User::where('email','=',$email)->first();
      if($check_user){
         $update['name'] =$request->get('name');
         $update['mobile_no']=$request->get('mobile_number');
         User::where('email','=',$email)->update($update);
         $data['user_id']=$check_user->id;
         $user = User::where('email','=',$email)->first();
      }else{
          $create['name'] =$request->get('name');
          $create['mobile_no']=$request->get('mobile_number');
          $create['email']=$request->get('email');
          $user=User::create($create);
          $user->attachRole(3);
          $data['user_id']=$user->id;
      }
      $data['order_id'] = Keygen::numeric(10)->generate();
      $lastInvoiceNo = PaymentDetail::where('payment_status', 'Success')->orderBy('id', 'desc')->where('invoice_no', '!=', null)->first();
      $invoiceNo=null;
      if($lastInvoiceNo){
                $data['invoice_no'] = $lastInvoiceNo->invoice_no+1;
      }else{
                $data['invoice_no'] =1;
     }
      $store = PaymentDetail::create($data);
      $beneficiary = Beneficiary::find($request->get('product_id'));
      $invoice['payment']=$store;
      $invoice['beneficiary']=$beneficiary;
      $invoice['order_id'] ="ORD".''.date('Ymd').$store->invoice_no; 
      //pdf file attahment
      $pdf = PDF::loadView('email.invoice', $invoice);
        $total_impacted = PaymentDetail::where('user_id','=',$user->id)->groupBy('beneficiary_id')->where('payment_status','=','Success')->count();
      $total_amount = PaymentDetail::where('user_id','=',$user->id)->where('payment_status','=','Success')->sum('amount');
      Mail::send('email.invoice_email',[ 'name' => $user->name,'beneficiary'=>$beneficiary,'payment'=>$store,'total_amount'=>$total_amount,'total_impacted'=>$total_impacted],function($message) use($user,$pdf) {
                     $message->to($user->email,$user->name);
                     $message->subject('You are a Changemaker!');
                    $message->attachData($pdf->output(), "invoice.pdf");
      });
      if($store){
        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
        return Response()->json($arr);    
      }else{
         $arr = array('error' => 'Payment unsucsess ', 'status' => true);
         return Response()->json($arr); 
      }
    }
}
