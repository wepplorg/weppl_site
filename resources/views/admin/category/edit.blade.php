@extends('layouts.super_admin_layout')

@section('content')
  <main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage Category
        </li>
        <li class="breadcrumb-item"> Edit Category</li>
        <!-- Breadcrumb Menu-->
        <!--<li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="#">
                <i class="icon-speech"></i>
              </a>
              <a class="btn" href="./">
                <i class="icon-graph"></i>  Dashboard</a>
              <a class="btn" href="#">
                <i class="icon-settings"></i>  Settings</a>
            </div>
          </li>-->
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="row">
           <div class="col-md-12">
              <div class="card">
                 <div class="card-header">
                 	<strong>Edit Category</strong>
                 </div>
                 <div class="card-body">
                   <form action="{{url('admin/category/'.$category->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="col-md-4">
                        <div class="form-group">
                           <label>Category Name</label>
                           <input type="text" name="name" value="{{$category->name}}" required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          @if($category->status == 1)
                            <input type="radio" name="status" value="1" required checked> Active
                            @else
                            <input type="radio" name="status" value="1" required > Active
                          @endif 
                          @if($category->status == 0)
                            <input type="radio" name="status" value="0" required checked>In-Active 
                            @else
                            <input type="radio" name="status" value="0" required > In-Active
                          @endif   
                        </div>
                        <div class="form-group">
                          <input type="submit" value="Submit" class="btn btn-primary">
                          <a href="{{url('admin/category')}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                   </form>
                 </div>
              </div>
           </div>
        </div>
      </div>
    </div>
  </main>
@endsection