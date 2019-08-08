@extends('layouts.super_admin_layout')

@section('content')
  <main class="main">
    <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin</li>
          <li class="breadcrumb-item">Manage Beneficiary
          </li>
          <li class="breadcrumb-item active">Beneficiary</li>
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
               <div class="col-md-12">
                 <!-- <a href="{{url('ngo/beneficiary/create')}}" class="btn btn-info float-right">Add New Beneficiary</a>-->
                  <ul class="nav nav-tabs beneficiary_tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#pending_beneficiary" role="tab" aria-controls="home">Pending Beneficiary<span class="badge badge-primary">{{count($pending_beneficiaries)}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#approved_beneficiary" role="tab" aria-controls="profile">Approved Beneficiary<span class="badge badge-primary">{{count($approved_beneficiaries)}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#completed_beneficiary" role="tab" aria-controls="profile">Completed Beneficiary<span class="badge badge-primary">{{count($completed_beneficiaries)}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#rejected_beneficiary" role="tab" aria-controls="messages">Rejected Beneficiary<span class="badge badge-primary">{{count($rejected_beneficiaries)}}</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="pending_beneficiary" role="tabpanel">
                            <table class="table table-striped table-bordered" style="width:100%" id="beneficairy_pending" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NGO Name</th>
                                        <th>Beneficiary Name</th>
                                        <th>Title</th>
                                        <th>Goal Amount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                     @foreach($pending_beneficiaries as $beneficiary)
                                       <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$beneficiary->users->name}}</td>
                                          <td>{{$beneficiary->ngo_users->name}}</td>
                                          <td>{{$beneficiary->title}}</td>
                                          <td>{{$beneficiary->goal_amount}}</td>
                                          <td> {{ date('F d, Y', strtotime($beneficiary->start_date)) }}</td>
                                          <td> {{ date('F d, Y', strtotime($beneficiary->end_date)) }}</td>
                                          <td>
                                            <div class="row justify-content-center">
                                            <a href="{{url('admin/beneficiary/'.$beneficiary->id.'/edit')}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>&nbsp;<a href="{{url('admin/beneficiary/'.$beneficiary->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>&nbsp;    
                                             <form action="{{url('admin/beneficiary/'.$beneficiary->id)}}" class="delete" method="POST">
                                                {{ method_field('DELETE') }}{{csrf_field()}}
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                             </form>
                                           </div>
                                          </td>
                                       </tr>
                                     @endforeach  
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="approved_beneficiary" role="tabpanel">
                           <table class="table table-striped table-bordered" style="width:100%" id="beneficairy_approved">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NGO Name</th>
                                        <th>Beneficiary Name</th>
                                        <th>Title</th>
                                        <th>Goal Amount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                     @foreach($approved_beneficiaries as $beneficiary)
                                       <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$beneficiary->users->name}}</td>
                                          <td>{{$beneficiary->ngo_users->name}}</td>
                                          <td>{{$beneficiary->title}}</td>
                                          <td>{{$beneficiary->goal_amount}}</td>
                                          <td>{{ date('F d, Y', strtotime($beneficiary->start_date)) }}</td>
                                          <td>{{ date('F d, Y', strtotime($beneficiary->end_date)) }}</td>
                                          <td>
                                            <div class="row justify-content-center">
                                            <a href="{{url('admin/beneficiary/'.$beneficiary->id.'/edit')}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>&nbsp;<a href="{{url('admin/beneficiary/'.$beneficiary->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>&nbsp; 
                                            <form action="{{url('admin/beneficiary/'.$beneficiary->id)}}" class="delete" method="POST">
                                                {{ method_field('DELETE') }}{{csrf_field()}}
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                             </form>   
                                           </div>
                                       </tr>
                                     @endforeach 
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="completed_beneficiary" role="tabpanel">
                           <table class="table table-striped table-bordered" style="width:100%" id="beneficairy_completed" class="completed_beneficiary_table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NGO Name</th>
                                        <th>Beneficiary Name</th>
                                        <th>Title</th>
                                        <th>Goal Amount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                     @foreach($completed_beneficiaries as $beneficiary)
                                       <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$beneficiary->users->name}}</td>
                                          <td>{{$beneficiary->ngo_users->name}}</td>
                                          <td>{{$beneficiary->title}}</td>
                                          <td>{{$beneficiary->goal_amount}}</td>
                                          <td> {{ date('F d, Y', strtotime($beneficiary->start_date)) }}</td>
                                          <td> {{ date('F d, Y', strtotime($beneficiary->end_date)) }}</td>
                                          <td>
                                            <div class="row justify-content-center">
                                              <a href="{{url('admin/beneficiary/'.$beneficiary->id.'/edit')}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>&nbsp;<a href="{{url('admin/beneficiary/'.$beneficiary->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>&nbsp; 
                                              <form action="{{url('admin/beneficiary/'.$beneficiary->id)}}" class="delete" method="POST">
                                                  {{ method_field('DELETE') }}{{csrf_field()}}
                                                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                               </form>   
                                           </div>
                                          </td>
                                       </tr>
                                     @endforeach 
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="rejected_beneficiary" role="tabpanel">
                           <table class="table table-striped table-bordered" style="width:100%" id="beneficairy_rejected">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NGO Name</th>
                                        <th>Beneficiary Name</th>
                                        <th>Title</th>
                                        <th>Goal Amount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                     @foreach($rejected_beneficiaries as $beneficiary)
                                       <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$beneficiary->users->name}}</td>
                                          <td>{{$beneficiary->ngo_users->name}}</td>
                                          <td>{{$beneficiary->title}}</td>
                                          <td>{{$beneficiary->goal_amount}}</td>
                                          <td> {{ date('F d, Y', strtotime($beneficiary->start_date)) }}</td>
                                          <td> {{ date('F d, Y', strtotime($beneficiary->end_date)) }}</td>
                                          <td>
                                            <div class="row justify-content-center">
                                              <a href="{{url('admin/beneficiary/'.$beneficiary->id.'/edit')}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>&nbsp;<a href="{{url('admin/beneficiary/'.$beneficiary->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>&nbsp; 
                                              <form action="{{url('admin/beneficiary/'.$beneficiary->id)}}" class="delete" method="POST">
                                                  {{ method_field('DELETE') }}{{csrf_field()}}
                                                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
          </div>
        </div>
  </main>
@endsection