@extends('layouts.super_admin_layout')

@section('content')
<main class="main">
  <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage Donor
        </li>

        <li class="breadcrumb-item active">Donor</li>
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
        @if(Session::has('message'))
                <div class="row">
                  <div class="col-md-12">
                    <div class="alert alert-success" id="success-alert">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>{{ Session::get('message') }}</strong> 
                    </div>
                  </div>
                 </div>
            @endif
    		<div class="row">
               <div class="col-sm-12">
               	 <div class="card">
                    <div class="card-header">
                       Manage Donors
                    </div>
                    <div class="card-body">
                      <button type="button" class="btn btn-primary float-right categories_create_btn" data-toggle="modal" data-target="#myModal">
                Create New Donor
              </button><br/>
                       <table class="display nowrap table table-hover table-striped table-bordered" style="width:100%" id="donors_table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Userame</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                     @foreach($donors as $donor)
                                       <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$donor->name}}</td>
                                          <td>{{$donor->mobile_no}}</td>
                                          <td>{{$donor->email}}</td>
                                          <td><button type="button" class="btn btn-primary categories_create_btn"  data-toggle="modal" data-target="#myModal{{$donor->id}}">
              Change Role
              </button></td>
                                       </tr>
                                     @endforeach  
                                </tbody>
                        </table>
                    </div>
               	 </div>
               </div>
    		</div>
    	</div>
    </div>
       <!-- The role  Modal -->
  @foreach($donors as $donor)     
  <div class="modal" id="myModal{{$donor->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change the Role</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form action="{{url('admin/role_change')}}" method="POST" id="role_form">
        	{{ csrf_field()}}
          <input type="hidden" name="user_id" value="{{$donor->id}}">
        <div class="modal-body">  
            <div class="form-group">
              <label>User Email</label>
              <input type="text" name="email" value="{{$donor->email}}" disabled class="form-control">
            </div>         
            <div class="form-group">
               <label>Role</label>
               <input type="radio" name="role" value="2" required> Ngo
                
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" value="Submit" class="btn btn-primary">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
  <!-- End category modal -->

     <!-- create new category modal -->
    <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">New State</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form action="{{url('admin/donor_register')}}" method="POST">
          {{ csrf_field()}}
        <div class="modal-body">
            <div class="form-group">
               <label>Donor Name</label>
               <input type="text" name="name" class="form-control" required> 
            </div>
            <div class="form-group">
               <label>Donor Email</label>
               <input type="email" name="email" id="donor_email" class="form-control" required> 
               <p id="error" style="color:red;"></p>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" value="Submit" id="donor_submit"  class="btn btn-primary">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End category modal -->
</main>
@endsection