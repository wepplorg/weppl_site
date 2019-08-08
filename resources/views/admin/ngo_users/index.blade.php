@extends('layouts.super_admin_layout')

@section('content')
 <main class="main">
   <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage Beneficiaries
        </li>
        <li class="breadcrumb-item">Beneficiaries</li>
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
              <!--<button type="button" class="btn btn-primary float-right categories_create_btn"  data-toggle="modal" data-target="#myModal">
             
              </button>-->
           </div>
             <table class="table table-striped table-bordered " style="width:100%" id="categories">
               <thead>
                 <tr>
                   <th>No</th>
                   <th>Beneficiary Name</th>
                   <th>User Name</th>
                   <th>Date of Birth</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
               	  <?php $i=1;?>
                  @foreach($ngo_users as $user)
                    <tr>
                       <td>{{$i++}}</td>
                       <td>{{$user->ngo_profile->users->name}}</td>
                       <td>{{$user->name}}</td>
                       <td>{{ date('d F,Y',strtotime($user->date_of_birth)) }}</td>
                       <td>
                          <div class="row justify-content-center">
                        <a href="{{url('admin/ngo_users/'.$user->id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                         &nbsp;&nbsp;
						<form action="{{url('admin/ngo_users/'.$user->id)}}" class="delete" method="POST">
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
 </main>
@endsection