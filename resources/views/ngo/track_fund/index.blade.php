@extends('layouts.admin_layout')

@section('content')
<?php use App\Models\Payment; ?>
  <main class="main">
  	  <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">
            <a href="#">NGO</a>
          </li>
          <li class="breadcrumb-item active">Track Fundraise</li>
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
        	<div class="animated-fadeIn">
           <div class="well well-sm"><marquee><p style="font-size: 12pt">Total Amount raised <b>{{moneyFormat($total_amount,'INR')}}</b></p></marquee></div>
        		<div class="row">
        			@if(Session::has('message'))
                <div class="row">
                  <div class="col-md-12">
                       <p class="alert alert-info">{{ Session::get('message') }}</p>
                     </div>
                   </div>
                    @endif
        			<div class="col-md-12">
                <div class="row justify-content-md-end user_btn_sec">
        				   
                 </div>
            		 <table class="display nowrap table table-hover table-striped table-bordered ngo_users_table" style="width:100%" id="ngo_users">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Beneficiary Name</th>
                                        <th>Title</th> 
                                        <th>Goal Amount</th>
                                        <th>Total Raised Amount</th>
                                        <th>No.of Supporters</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                     @foreach($beneficiaries as $beneficiary)
                                      <?php $raised_amount = Payment::where('beneficiary_id','=',$beneficiary->id)->where('payment_status','=','Success')->sum('amount');?>
                                       <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$beneficiary->ngo_users->name}}</td>
                                          <td>{{$beneficiary->title}}</td>
                                          <td>{{moneyFormat($beneficiary->goal_amount,'INR')}}</td>
                                          <td>{{ moneyFormat($raised_amount,'INR')}}</td>
                                          <td>{{ count($beneficiary->payments)}}</td>
                                          <td><a href="{{url('ngo/track_details/'.$beneficiary->id)}}" class="btn btn-info btn-sm">View Details</a></td>
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