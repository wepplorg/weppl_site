<?php

namespace App\Http\Controllers\Sites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BeneficiaryComment;
use App\Models\Beneficiary;
use App\User;
use Auth;
use Session;
use App\Models\Payment;
class CommentController extends Controller
{
    public function get_comments(Request $request){
        $comments=BeneficiaryComment::with('users')->where('beneficiary_id','=',$request->get('beneficiary_id'))->orderBy('id','desc')->get();
        foreach($comments as $comment){
        	$comment['time']= $comment->created_at->diffForHumans();
        }
        return response()->json(['success'=>$comments]);
    }

    public function store_comment(Request $request){
    	$data = array_except($request->all(), ['_token']);
    	$data['user_id']=Auth::user()->id;
        $create = BeneficiaryComment::create($data);
        if($create){
        	$comments = $comments=BeneficiaryComment::with('users')->where('beneficiary_id','=',$request->get('beneficiary_id'))->orderBy('id','desc')->get();
        	foreach($comments as $comment){
        	   $comment['time']= $comment->created_at->diffForHumans();
            }
            return response()->json($comments);
        }else{
        	return response()->json(['error'=>'Something went wrong!']);
        }
    }

   public function top_donors(Request $request){
      //return Payment::where('')
      $donors = Payment::with('users')->where('beneficiary_id','=',$request->get('beneficiary_id'))->orderBy('amount','desc')->take(2)->get();
      return $donors;
   }
}
