<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Session;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
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
        $create = Category::create($data);
        if($create){
            Session::flash('message', 'Successfully created the Category!');
            return redirect('admin/category');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/category');
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
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
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
        $update = Category::where('id','=',$id)->update($data);
        if($update){
            Session::flash('message', 'Successfully Updated the Category!');
            return redirect('admin/category');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/category');
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
        $delete = Category::where('id','=',$id)->delete();
        if($delete){
            Session::flash('message', 'Successfully Deleted the Category!');
            return redirect('admin/category');
        }else{
            Session::flash('message', 'Something went wrong!');
            return redirect('admin/category');
        }
    }
}
