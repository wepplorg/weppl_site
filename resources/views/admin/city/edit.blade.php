@extends('layouts.super_admin_layout')

@section('content')
  <main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage City
        </li>
        <li class="breadcrumb-item"> Edit City</li>
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
                 	<strong>Edit City</strong>
                 </div>
                 <div class="card-body">
                   <form action="{{url('admin/city/'.$city->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="col-md-4">
                        <div class="form-group">
                           <label>State Name</label>
                           <select name="state_id" class="form-control" required>
                           @foreach($states as $state)
                              @if($state->id == $city->state_id)
                                 <option value="{{$state->id}}" selected>{{$state->state_name}}</option>
                              @else
                                 <option value="{{$state->id}}" >{{$state->state_name}}</option>
                              @endif
                           @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                           <label>State Name</label>
                           <input type="text" name="city_name" value="{{$city->city_name}}" required class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          @if($city->status == 1)
                            <input type="radio" name="status" value="1" required checked> Active
                            @else
                            <input type="radio" name="status" value="1" required > Active
                          @endif 
                          @if($city->status == 0)
                            <input type="radio" name="status" value="0" required checked>In-Active 
                            @else
                            <input type="radio" name="status" value="0" required > In-Active
                          @endif   
                        </div>
                        <div class="form-group">
                          <input type="submit" value="Submit" class="btn btn-primary">
                          <a href="{{url('admin/city')}}" class="btn btn-danger">Cancel</a>
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