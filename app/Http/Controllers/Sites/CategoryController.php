<?php

namespace App\Http\Controllers\Sites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Beneficiary;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Payment;
class CategoryController extends Controller
{
    public function beneficiary_lists(Request $request){
        $date = date('Y-m-d');
    	$categories = Category::all();
    	$features = Feature::all();
    	$stories = Beneficiary::where('status','=',2)->where('end_date', '>=', $date)->paginate(6);
        if ($request->ajax()) {
            $view = view('stories',compact('stories','categories'))->render();
            return response()->json(['html'=>$view]);
        }
    	return view('categories',compact('categories','features','stories'));
    }

    public function category_fileters(Request $request,$id){
        $date = date('Y-m-d');
    	$categories = Category::all();
    	$features = Feature::all();
    	if($id == "all"){
           // return $id;
           $stories = Beneficiary::where('status','=',2)->where('end_date', '>=', $date)->paginate(6);
           if ($request->ajax()) {
           // return "hi";
            $view = view('stories',compact('stories','categories'))->render();
            return response()->json(['html'=>$view]);
        }

    	}else{
            $slug = Category::where('slug','=',$id)->first();
    		$stories = Beneficiary::where('status','=',2)->where('end_date', '>=', $date)->where('category_id','=',$slug->id)->paginate(6);
            if ($request->ajax()) {
            $view = view('stories',compact('stories','categories'))->render();
            return response()->json(['html'=>$view]);
           }
    	}
    	return view('category_search',compact('stories','categories','features','stories','id'));
    }

    public function feature_fileters(Request $request,$id){
        //return $id;
        $date = date('Y-m-d');
        $from_date = date('Y-m-d');
        $to_date= date('Y-m-d',strtotime($from_date.' + 10 days'));
    	$categories = Category::all();
    	$features = Feature::all();
    	if($id == "all"){
           $stories = Beneficiary::where('status','=',2)->where('end_date', '>=', $date)->paginate(6);
    	}else{
            $stories = Beneficiary::where('status','=',2)->where('end_date', '>=', $date)->get();
            foreach ($stories as $key => $value) {
                $payments = Payment::where('beneficiary_id','=',$value->id)->where('payment_status','=',"Success")->sum('amount');
                $value = Beneficiary::where('status','=',2)->where('goal_amount','>=',$payments)->paginate(6);
               
            }
    		$stories = Beneficiary::where('status','=',2)->WhereBetween('end_date',[$from_date,$to_date])->paginate(6);
    	}
        if ($request->ajax()) {
            $view = view('stories',compact('stories','categories'))->render();
            return response()->json(['html'=>$view]);
        }
    	
    	return view('feature_search',compact('stories','categories','features','stories','id'));
    }

    public function live_search(Request $request){
         $date = date('Y-m-d');
        $search = $request->get('term');   
        $result = Beneficiary::where('end_date', '>=', $date)->where('title', 'LIKE', '%'. $search. '%')->get();
        return response()->json($result);
    }

    public function search_result(Request $request){
        $title = $request->get('title');
        $stories= Beneficiary::where('title','LIKE', '%'. $title. '%')->paginate(6);
        $categories = Category::all();
        $features = Feature::all();
        if($stories){
            if ($request->ajax()) {
            $view = view('stories',compact('stories','categories'))->render();
            return response()->json(['html'=>$view]);
           }
            return view('search_results',compact('stories','categories','features'));
        }else{
           return view('search_results.empty',compact('categories','features'));
        }
        
    }
}
