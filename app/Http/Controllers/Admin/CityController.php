<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\City;
use Session;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();
        $cities=City::all();
        return view('admin.city.index',compact('states','cities'));
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
        $create = City::create($data);
        if($create){
            Session::flash('message', 'Successfully created the City!');
            return redirect('admin/city');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/city');
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
        $city = City::find($id);
        $states = State::all();
        return view('admin.city.edit',compact('states','city'));
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
        $update = City::where('id','=',$id)->update($data);
        if($update){
            Session::flash('message', 'Successfully Updated the City!');
            return redirect('admin/city');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/city');
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
        $delete = City::where('id','=',$id)->delete();
        if($delete){
            Session::flash('message', 'Successfully Deleted the City!');
            return redirect('admin/city');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/city');
        }
    }
}
