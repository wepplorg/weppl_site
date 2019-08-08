<?php

namespace App\Http\Controllers\NGO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Auth;
use App\User;
use App\Models\BeneficiaryUpdate;
use Session;
class BeneficiaryUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $beneficiary_updates = BeneficiaryUpdate::where('beneficiary_id','=',$id)->get();
        return view('ngo.updates.index',compact('beneficiary_updates','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "hi";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data=array_except($request->all(), ['_token']);
      $data['ngo_id']=Auth::user()->id;
      $data['status']=1;
      $beneficiary_id = $request->get('beneficiary_id');
      $update = BeneficiaryUpdate::create($data);
      if($update){
          Session::flash('message', 'Successfully added the beneficiary updates!');
          return redirect()->back();
       }else{
          Session::flash('message', 'Something went wrong!');
          return redirect()->back();
       }
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
}
