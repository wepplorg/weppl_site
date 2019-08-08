@extends('layouts.admin_layout')
@section('content')
  <main class="main">
     <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">NGO</li>
          <li class="breadcrumb-item">
            Profile
          </li>
          <li class="breadcrumb-item active">Documents</li>
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
                <div class="card">
                   <div class="card-header">
                       <strong>General Form</strong>
                 	</div>
                 	<form action="{{ url('ngo/ngo_profile_document')}}" method="post" enctype="multipart/form-data">
                 		{{ csrf_field()}}
                 	<div class="card-body">
                      <div class="row">
                      	<div class="col-md-6">
                          <div class="form-group">
                             <label>PAN Number*</label>
                             <input class="form-control" id="name"  name="pan_number" type="text"  placeholder="Enter PAN Number" value="@if($profile->documents){{$profile->documents->pan_number}}@endif" required>
                          </div>
                      	</div>
                      	<div class="col-md-6">
                          <div class="form-group">
                             <label>Registration Document*(Trust, Society or Sec 25 Company*)</label>
                                <div class="row logo_sec">
                             <p>@if($profile->documents){{$profile->documents->registration_document}}@endif</p>
                             <input class="form-control-file" id="registration_document" name="registration_document" type="file" onchange="register_document(this)"  required accept=".pdf,.docx,.xls">
                              <span class="logo_img_extension">pdf,doc,xls. 5MB File Limit</span>
                          </div>
                        </div>
                      	</div>
                      </div>
                      <div class="row">
                      	<div class="col-md-6">
                          <div class="form-group">
                             <label>12 A Registration Doc*</label>
                                <div class="row logo_sec">
                             <p>@if($profile->documents){{$profile->documents->reg_12a_doc}}@endif</p>
                             <input class="form-control-file" id="12a_reg_doc" name="reg_12a_doc" type="file" required accept=".pdf,.docx,.xls" onchange="reg_12a_document(this)">
                              <span class="logo_img_extension">pdf,doc,xls. 5MB File Limit</span>
                          
                             </div>
                            </div>
                      	</div>
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>80 G Registration Doc</label>
                               <div class="row logo_sec">
                             <p>@if($profile->documents){{$profile->documents->reg_80g_doc}}@endif</p>
                             <input class="form-control-file" id="80g_reg_doc" name="reg_80g_doc" type="file" onchange="reg_80g_document()" accept=".pdf,.docx,.xls" >
                             <span class="logo_img_extension">pdf,doc,xls. 5MB File Limit</span>
                           </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Latest Audit Statement*</label>
                              <div class="row logo_sec">
                             <p>@if($profile->documents){{$profile->documents->audi_statement}}@endif</p> 
                            <input class="form-control-file" id="audi_statement" name="audi_statement" type="file" onchange="audi_stat_document(this)" required accept=".pdf,.docx,.xls">
                              <span class="logo_img_extension">pdf,doc,xls. 5MB File Limit</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      	<div class="col-md-12">
                          <div class="form-group">

                           <!--  <div class="form-check checkbox">

                               <input class="form-check-input" id="check1" type="checkbox" value="">
                               <label class="form-check-label information_sec" for="check1" ></label>
                            </div> -->
                            <div class="form-check checkbox">
                             <!--   <input class="form-check-input" id="check1" type="checkbox" value="">
                               <label class="form-check-label information_sec" for="check1"></label> -->
                               @if(Auth::user()->ngo_profiles)
                                @if(Auth::user()->ngo_profiles->document_terms == 1) 
                                  <input class="form-check-input checkbox_input" checked id="check1" name="document_terms" type="checkbox" value="1" required>
                                @else
                                  <input class="form-check-input checkbox_input"  id="check1" name="document_terms" type="checkbox" value="1" required>
                                @endif
                                @else
                                  <input class="form-check-input checkbox_input"  id="check1" name="document_terms" type="checkbox" value="1" required>
                                @endif
                               <label class="form-check-label information_sec" for="check1">The information submitted herewith above is correct and true to my knowledge. All the documents uploaded are genuine and valid. I hereby agree to inform weppl in case of any changes in my organisation's status.</label>
                            </div>
                            <div class="form-check checkbox">
                                @if(Auth::user()->ngo_profiles)
                                 @if(Auth::user()->ngo_profiles->document_agree == 1) 
                                  <input class="form-check-input information_sec checkbox_input" checked id="check1" name="document_agree" type="checkbox" value="1" required>
                                  @else
                                    <input class="form-check-input information_sec checkbox_input"  id="check1" name="document_agree" type="checkbox" value="1" required>
                                  @endif
                                  @else
                                     <input class="form-check-input information_sec checkbox_input"  id="check1" name="document_agree" type="checkbox" value="1" required>
                                  @endif
                               <label class="form-check-label" for="check1">I hereby declare that I have read and agree to adhere to weppl's terms of use, FAQs, pricing and privacy policy.</label>
                          </div>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-2 col-md-3"></div>
                        <div class="col-4 col-md-4">
                          <div class="form-group">
                            @if(Auth::user()->ngo_profiles)
                            @if(Auth::user()->ngo_profiles->status ==2)
                              <input type="submit" disabled class="btn btn-primary" value="Update">
                            @else
                              <input type="submit" class="btn btn-primary" value="Update">
                            @endif
                            @else
                              <input type="submit" class="btn btn-primary" value="Update">
                            @endif
                          </div>
                        </div>
                      </div>
                 	</div>
                 </div>
                 </form>
                </div><!--card-->
              </div><!--col-md-12-->
            </div><!--row-->
          </div><!--animated-->
        </div><!--container-->
  </main>
@endsection