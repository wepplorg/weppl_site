<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Session;
class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::all();
        return view('admin.feature.index',compact('features'));
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
        $data = array_except($request->all(), ['_token']);
        $create = Feature::create($data);
        if($create){
            Session::flash('message', 'Successfully created the Feature!');
            return redirect('admin/feature');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/feature');
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
        $feature = Feature::find($id);
        return view('admin.feature.edit',compact('feature'));
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
        $data = array_except($request->all(), ['_token','_method']);
        $update = Feature::where('id','=',$id)->update($data);
        if($update){
            Session::flash('message', 'Successfully Updated the Feature!');
            return redirect('admin/feature');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/feature');
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
        $delete = Feature::where('id','=',$id)->delete();
        if($delete){
            Session::flash('message', 'Successfully Deleted the Feature!');
            return redirect('admin/feature');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/feature');
        }
    }
}
