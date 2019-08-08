@extends('layouts.super_admin_layout')

@section('content')
  <main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage NGO
        </li>
        <li class="breadcrumb-item active">NGO Profile View</li>
        <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="">
                
              </a>
              <a  href="{{url('admin/ngo')}}">
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

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                	@if($ngo->ngo_profiles->logo)
                                	<img src="{{ $ngo->ngo_profiles->logo }}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail">   
                                	@else
                                    <img src="http://placehold.it/150x150" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                     @endif
                                    <!--<div class="middle">
                                        <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                        <input type="file" style="display: none;" id="profilePicture" name="file" />
                                    </div>-->
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">{{$ngo->name}}</a></h2>
                                    <h6 class="d-block"><a href="javascript:void(0)">{{count($ngo->beneficiaries)}}</a> Beneficiary Posted</h6>
                                    <h6 class="d-block"><a href="javascript:void(0)">{{moneyFormat($total_amount,'INR')}}</a> Total Amount Raised</h6>
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs admin_nav_tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#basic_info" role="tab" aria-controls="home">Basic Info</a>
                                    </li>
                                    <li class="nav-item">
                                        @if($ngo->ngo_profiles->documents) 
                                         <a data-toggle="tab" class="nav-link" href="#documents">Documents</a>
                                        @else
                                         <a data-toggle="tab" class="nav-link disabled" href="#documents">Documents</a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($ngo->beneficiaries)
                                          <a data-toggle="tab" class="nav-link"  href="#beneficiary_lists">Beneficiary Lists</a>
                                        @else
                                          <a data-toggle="tab" class="nav-link disabled" href="">Beneficiary Lists</a>
                                        @endif
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane active" id="basic_info" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Full Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$ngo->name}}
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Email</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$ngo->email}}
                                            </div>
                                        </div>
                                        <hr />
                                        
                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Mobile Number</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$ngo->mobile_no}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">State</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$ngo->ngo_profiles->states->state_name}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">City</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$ngo->ngo_profiles->cities->city_name}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Address</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {!! $ngo->ngo_profiles->address !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Contact Person Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                               {{$ngo->ngo_profiles->contact_person_name}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Contact Person Designation</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$ngo->ngo_profiles->designation}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Bank Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {!! $ngo->ngo_profiles->bank_name !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Account Number</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {!! $ngo->ngo_profiles->account_number !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Account Type</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {!! $ngo->ngo_profiles->account_type !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">IFSC Code</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {!! $ngo->ngo_profiles->ifsc_code !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Facebook Share</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {!! $ngo->ngo_profiles->facebook_share !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Twitter Share</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {!! $ngo->ngo_profiles->tiwtter_share !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Description</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {!! $ngo->ngo_profiles->description !!}
                                            </div>
                                        </div>
                                        <hr />

                                    </div>
                                    @if($ngo->ngo_profiles->documents)
                                    <div class="tab-pane" id="documents" role="tabpanel">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Pan Card</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$ngo->ngo_profiles->documents->pan_number}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Registration Document</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            	@if($ngo->ngo_profiles->documents->registration_document)
                                               <a href="{{ $ngo->ngo_profiles->documents->registration_document }}" target="_blank" class="btn btn-info ">Preview</a>
                                               <a href="{{ $ngo->ngo_profiles->documents->registration_document }}" target="_blank" class="btn btn-success ">Download</a>  
                                               @endif  
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">12ARegistration Document</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            	@if($ngo->ngo_profiles->documents->reg_12a_doc)
                                                 <a href="{{ $ngo->ngo_profiles->documents->reg_12a_doc }}" target="_blank" class="btn btn-info ">Preview</a>
                                                 <a href="{{ $ngo->ngo_profiles->documents->reg_12a_doc }}" target="_blank" class="btn btn-success ">Download</a>    
                                               @endif  
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">80GRegistration Document</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            	@if($ngo->ngo_profiles->documents->reg_80g_doc)
                                                 <a href="{{ $ngo->ngo_profiles->documents->reg_80g_doc }}" target="_blank" class="btn btn-info ">Preview</a>
                                                 <a href="{{ $ngo->ngo_profiles->documents->reg_80g_doc }}" target="_blank" class="btn btn-success ">Download</a>    
                                               @endif  
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Latest Audit Statements</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                            	@if($ngo->ngo_profiles->documents->audi_statement)
                                                 <a href="{{ $ngo->ngo_profiles->documents->audi_statement }}" target="_blank" class="btn btn-info ">Preview</a>
                                                 <a href="{{ $ngo->ngo_profiles->documents->audi_statement }}" target="_blank" class="btn btn-success ">Download</a>    
                                               @endif  
                                            </div>
                                        </div>
                                        <hr />

                                    </div>
                                    @endif
                                    @if($ngo->beneficiaries)
                                      <div class="tab-pane" id="beneficiary_lists" role="tabpanel">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Beneficiary Lists</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                               <label>Detail</label>
                                            </div>
                                        </div>
                                        <hr/>
                                        @foreach($ngo->beneficiaries as $beneficiary)
                                           <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">{{$beneficiary->ngo_users->name}}</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                               <label>Detail</label>
                                            </div>
                                        </div>
                                        <hr/>
                                        @endforeach
                                      </div>
                                    @endif
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
@endsection