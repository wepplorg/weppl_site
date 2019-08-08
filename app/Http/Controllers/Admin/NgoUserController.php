<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NgoUser;
use Session;
class NgoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ngo_users = NgoUser::all();
        return view('admin.ngo_users.index',compact('ngo_users'));
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
        $ngo_user = NgoUser::find($id);
        return view('admin.ngo_users.edit',compact('ngo_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return "edit";
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
        $update = NgoUser::where('id','=',$id)->update($data);
        if($update){
            Session::flash('message', 'Successfully Updated the NGO User name!');
            return redirect('admin/ngo_users');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/ngo_users');
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
       $delete = NgoUser::where('id','=',$id)->delete();
        if($delete){
            Session::flash('message', 'Successfully Deleted the NGO User!');
            return redirect('admin/ngo_users');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/ngo_users');
        }
    }
}
