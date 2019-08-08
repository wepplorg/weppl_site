<?php

namespace App\Http\Controllers\NGO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NgoUser;
use Session;
use Auth;
class NgoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = NgoUser::where('ngo_profile_id','=',Auth::user()->ngo_profiles->id)->get();
        return view('ngo.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ngo.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_user = NgoUser::where('date_of_birth','=',$request->get('date_of_birth'))->first();
        if($check_user){
            Session::flash('message', 'User Already Exists!');
            return redirect()->back();
        }
        else{
             $data = array_except($request->all(), ['_token']);
             $data['ngo_profile_id']= Auth::user()->ngo_profiles->id;
             $create = NgoUser::create($data);
             if($create){
                Session::flash('message', 'Successfully Added!');
                return redirect('ngo/users');
             }
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
