@extends('layouts.super_admin_layout')

@section('content')
 <main class="main">
   <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage State
        </li>
        <li class="breadcrumb-item">State</li>
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
         <div class="row justify-content-center">
         	
         <div class="col-md-10">
           <div class="row justify-content-end">
               <button type="button" class="btn btn-primary float-right categories_create_btn" data-toggle="modal" data-target="#file">
                Upload File
              </button>
              <button type="button" class="btn btn-primary float-right categories_create_btn" data-toggle="modal" data-target="#myModal">
                Create New State
              </button>
          </div>
         
             <table class="table table-striped table-bordered " style="width:100%" id="categories">
               <thead>
                 <tr>
                   <th>No</th>
                   <th>State Name</th>
                   <th>Status</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
               	  <?php $i=1;?>
                  @foreach($states as $state)
                    <tr>
                       <td>{{$i++}}</td>
                       <td>{{$state->state_name}}</td>
                       <td>@if($state->status == 1)<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">In-Active</p>@endif</td>
                       <td>
                          <div class="row justify-content-center">
                        <a href="{{url('admin/state/'.$state->id)}}" class="btn btn-info"><i class="fa fa-edit"></i>
                        </a>
                         &nbsp;&nbsp;
            						<form action="{{url('admin/state/'.$state->id)}}" class="delete"  method="POST">
            							{{ method_field('DELETE') }}{{csrf_field()}}
            							<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            						</form>
                      </div>
                      </td>
                    </tr>
                  @endforeach
               </tbody>
             </table>
           </div>
         </div>
      </div>
    </div>

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
        <form action="{{url('admin/state')}}" method="POST">
        	{{ csrf_field()}}
        <div class="modal-body">
            <div class="form-group">
               <label>State Name</label>
               <input type="text" name="state_name" class="form-control" required> 
            </div>
            <div class="form-group">
               <label>Status</label>
               <input type="radio" name="status" value="1" required> Active
                <input type="radio" name="status" value="0" required> In-Active
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
  <!-- End category modal -->

   <!-- The File upload modal -->
  <div class="modal" id="file">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Upload File</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form action="{{url('admin/csv_upload')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field()}}
        <div class="modal-body">
            <div class="form-group">
               <label>Choose File</label>
               <input type="file" name="file" class="form-control" required> 
            </div>
            <!--<div class="form-group">
               <label>Status</label>
               <input type="radio" name="status" value="1" required> Active
                <input type="radio" name="status" value="0" required> In-Active
            </div>-->
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
  <!-- End file upload modal -->
 </main>
@endsection