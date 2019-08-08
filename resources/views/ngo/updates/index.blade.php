@extends('layouts.admin_layout')

@section('content')
  <main class="main">
     <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">
            <a href="#">NGO</a>
          </li>
          <li class="breadcrumb-item active">Beneficiary Updates</li>
          <!-- Breadcrumb Menu-->
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="{{url('ngo/beneficiary')}}">
                 Back
              </a>
              
            </div>
          </li>
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
              <div class="col-md-12">      	
	           <div class="row justify-content-end">
	              <button type="button" class="btn btn-primary float-right categories_create_btn"  data-toggle="modal" data-target="#myModal">
	              Create New Update
	              </button>
	           </div>
                  <table class="display nowrap table table-hover table-striped table-bordered" style="width:100%" id="beneficairy_pending">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Beneficiary Name</th>
                                        <th>Updates</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                     @foreach($beneficiary_updates as $beneficiary)
                                       <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$beneficiary->beneficiary->ngo_users->name}}</td>
                                          <td>{!! $beneficiary->description !!}</td>
                                          <td>@if($beneficiary->status == 1)<span class="badge badge-info">Pending</span>@elseif($beneficiary->status== 2)<span class="badge badge-success">Approved</span>@elseif($beneficiary->status == 3)<span class="badge badge-danger">Rejected</span>@endif</td>     
                                          <td>
                                           
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
          <h4 class="modal-title">New Update</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form action="{{url('ngo/benficiary_update_store')}}" method="POST">
        	{{ csrf_field()}}
        	<input type="hidden" value="{{$id}}" name="beneficiary_id">
        <div class="modal-body">        
            <div class="form-group">
               <label>Description</label>
              <textarea name="description" id="description" class="form-control" required></textarea>
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
  </main>

@endsection