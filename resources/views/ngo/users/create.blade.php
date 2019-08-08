@extends('layouts.admin_layout')

@section('content')
  <main class="main">
  	  <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">
            <a href="#">NGO</a>
          </li>
          <li class="breadcrumb-item active">Beneficiaries</li>
          <!-- Breadcrumb Menu-->
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              
              
              <a  href="{{url('ngo/users')}}">
                Back</a>
            </div>
          </li>
        </ol>
        <div class="container-fluid">
        	<div class="animated-fadeIn">
            @if(Session::has('message'))
                   <div class="row">
                        <div class="col-md-12">
                      <p class="alert alert-info">{{ Session::get('message') }}</p>
                    </div>
                  </div>
            @endif
        		<div class="row">

        			<div class="col-md-12">
                 
        				 <form action="{{url('ngo/users')}}" method="POST">
                    {{ csrf_field()}}
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" id="name" class="form-control" required> 
                    </div>
                    <div class="form-group">
                      <label>Date of Birth</label>
                      <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required> 
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                 </form>
        			</div>
        		</div>
        	</div>
        </div>
  </main>
  
@endsection