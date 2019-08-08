@extends('layouts.super_admin_layout')

@section('content')
<?php use App\Models\Payment; ?>
  <main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage Beneficiary
        </li>
        <li class="breadcrumb-item active">Beneficiary View</li>
        <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="">
                
              </a>
              <a  href="{{url('admin/beneficiary')}}">
                Back</a>
              <!--<a class="btn" href="#">
                <i class="icon-settings"></i>  Settings</a>-->
            </div>
          </li>
    </ol>
    <div class="container-fluid">
      <div class="animated-fadeIn">
         <div class="row">
            <div class="col-12">
                <div class="card">
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
                    <div class="card-body">
                        <div class="card-title mb-4" style="margin-bottom:20px;">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                	@if($beneficiary->images->image)
                                	<img src="{{$beneficiary->images->image}}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail">   
                                	@else
                                    <img src="http://placehold.it/150x150" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                     @endif
                                    <!--<div class="middle">
                                        <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                        <input type="file" style="display: none;" id="profilePicture" name="file" />
                                    </div>-->
                                </div>
                                <?php $raised_amount = Payment::where('beneficiary_id','=',$beneficiary->id)->where('payment_status','=',"Success")->sum('amount');?>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">{{$beneficiary->title}}</a></h2>
                                    <h6 class="d-block"><a href="javascript:void(0)">by {{$beneficiary->ngo_users->name}}</a></h6>
                                    <h6 class="d-block"><a href="javascript:void(0)">{{count($beneficiary->payments)}}</a> Supporters</h6>
                                    <h6 class="d-block"><a href="javascript:void(0)">{{moneyFormat($raised_amount,'INR')}}</a> of Goal Amount {{moneyFormat($beneficiary->goal_amount,'INR')}}</h6>

                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                                </div>

                            </div>
                            <br/>
                            <a href="{{$beneficiary->images->image}}" class="btn btn-info" target="_blank">Download Picture</a>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Create Payment</button>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs admin_nav_tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#basic_info" role="tab" aria-controls="home">Basic Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="tab" href="#documents" role="tab" aria-controls="home">Supporters & Amount</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane active" id="basic_info" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Title</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{ $beneficiary->title}}
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Beneficiary Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$beneficiary->ngo_users->name}}
                                            </div>
                                        </div>
                                        <hr />
                                        
                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Category</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$beneficiary->category->name}}
                                            </div>
                                        </div>
                                        <hr />
                                        <!--<div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Feature</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                
                                            </div>
                                        </div>-->
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Age</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{ $beneficiary->age}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Location of Beneficiary</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$beneficiary->location}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Start Date</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{ date('F d, Y', strtotime($beneficiary->start_date)) }}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">End Date</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{ date('F d, Y', strtotime($beneficiary->end_date)) }}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Goal Amount</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                 {{moneyFormat($beneficiary->goal_amount,'INR')}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Short Description</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                 {!! $beneficiary->summary !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Brief Description</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {!! $beneficiary->description !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <!--<div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">IFSC Code</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Facebook Share</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Tiwtter Share</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Description</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                               
                                            </div>
                                        </div>
                                        <hr />-->

                                    </div>
                                    <div class="tab-pane" id="documents" role="tabpanel">
                                        
                                        <div class="row">
                                            <div class="col-sm-4 ">
                                                <label style="font-weight:bold;">Supporters Details & Total amount raised</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            	
                                            </div>
                                        </div>
                                        <hr />
                                        @foreach($beneficiary->payments as $payment)
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">{{ $payment->users->name}}</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            	{{ moneyFormat($payment->amount,'INR')}}
                                            </div>
                                        </div>
                                        <hr />
                                        @endforeach
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Total Amount Raised</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                               {{moneyFormat($raised_amount,'INR')}}
                                            </div>
                                        </div>
                                        <hr />

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
      </div>
    </div>
  </main>
  <!-- adding payment method -->

  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change the Role</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form action="{{url('admin/donor_payment')}}" method="POST" id="role_form">
        	{{ csrf_field()}}
          <input type="hidden" name="beneficiary_id" value="{{$beneficiary->id}}">
        <div class="modal-body">  
            <div class="form-group">
              <label>Choose User</label>
             <select name="user_id">
               <option value="">Choose Donor</option>
               @foreach($donors as $donor)
                 <option value="{{$donor->id}}">{{$donor->name}}</option>
               @endforeach
             </select>
            </div>         
            <div class="form-group">
               <label>Amount</label>
               <input type="number" name="amount" class="form-control" required>
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
@endsection