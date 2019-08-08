@extends('layouts.super_admin_layout')

@section('content')
  <main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage Beneficiaries
        </li>
        <li class="breadcrumb-item"> Edit Beneficiary</li>
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
                 	<strong>Edit Beneficiary</strong>
                 </div>
                 <div class="card-body">
                   <form action="{{url('admin/ngo_users/'.$ngo_user->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="col-md-4">
                        <div class="form-group">
                           <label>Beneficiary Name</label>
                           <input type="text" name="name" value="{{$ngo_user->ngo_profile->users->name}}" disabled required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" value="{{$ngo_user->name}}" required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Date of Birth</label>
                          <input type="date" value="{{$ngo_user->date_of_birth}}" name="date_of_birth" class="form-control">
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