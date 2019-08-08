<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use Session;
use Excel;
use File;
use App\Models\City;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();
        return view('admin.state.index',compact('states'));
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
        $create = State::create($data);
        if($create){
            Session::flash('message', 'Successfully created the State!');
            return redirect('admin/state');
        }else{
            Session::flash('error', 'Something went wrong!');
            return redirect('admin/state');
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
        $state = State::find($id);
        return view('admin.state.edit',compact('state'));
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
        $update = State::where('id','=',$id)->update($data);
        if($update){
            Session::flash('message', 'Successfully Updated the State!');
            return redirect('admin/state');
        }else{
            Session::flash('error', 'Something went wrong!');
            return redirect('admin/state');
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
        $delete = State::where('id','=',$id)->delete();
        if($delete){
            Session::flash('message', 'Successfully Deleted the State!');
            return redirect('admin/state');
        }else{
            Session::flash('error', 'Something went wrong!');
            return redirect('admin/state');
        }
    }

    public function csv_upload(Request $request){
       if($request->hasFile('file')){
         $extension = File::extension($request->file->getClientOriginalName());
         //return "hi";
          if($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
               $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){
                    foreach($data as $key => $value) {
                       // return $value->city_name;
                       $state_check = State::where('state_name','=',$value->state_name)->first();
                       if($state_check){
                         $city_check = City::where('state_id','=',$state_check->id)->where('city_name','=',$value->city_name)->first();
                         if($city_check){
                            $city['state_id']=$state_check->id;
                            $city['city_name'] = trim($value->city_name);
                            $city['status']=1;
                           // return $city;
                            City::where('id','=',$city_check->id)->update($city);
                         }else{
                            $city['state_id']=$state_check->id;
                            $city['city_name'] = trim($value->city_name);
                            $city['status']=1;
                           // return $city;
                            City::create($city);
                         }
                       }else{
                           $state['state_name']=trim($value->state_name);
                           $state['status']=1;
                           $state_create =  State::create($state);
                           $city['state_id']=$state_create->id;
                           $city['city_name'] = trim($value->city_name);
                           $city['status']=1;
                          // return $city;
                           City::create($city);
                       }
                    }
                }
                Session::flash('message','Successfully uploaded');
                return redirect('admin/state');
          }
       }
    }
}
