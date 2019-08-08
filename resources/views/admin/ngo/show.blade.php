@extends('layouts.super_admin_layout') @section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage NGO
        </li>
        <li class="breadcrumb-item active">NGO Profile Edit</li>
        <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
                <a class="btn" href="">

                </a>
                <a href="{{url('admin/ngo')}}">
                Back</a>
                <!--<a class="btn" href="#">
                <i class="icon-settings"></i>  Settings</a>-->
            </div>
        </li>
    </ol>

     <div class="container-fluid">
       @if(Session::has('message'))
                
                    <div class="alert alert-success" id="success-alert">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>{{ Session::get('message') }}</strong> 
                    </div>
                 
            @endif
        <div class="row">
          
            <div class="col-9 col-md-10"></div>
            <div class="col-3 col-md-2">
                <!--<a href="{{url('admin/ngo')}}" class="btn btn-primary btn-md">Back</a>-->
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10 profile_content">
                <div class="text-center profile_title">
                    <h2>NGO Profile Edit</h2>
                </div>
                <div class="ngo_profile_form">

                    <ul class="nav nav-tabs ngo_profile_tabs " role="tablist">
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link active" href="#info">Basic Information</a>
                        </li>
                        <li class="nav-item">
                            @if($ngo->ngo_profiles->documents)
                            <a data-toggle="tab" class="nav-link" href="#doc">Documents</a> @else
                            <a data-toggle="tab" class="nav-link " href="#doc">Documents</a> @endif
                        </li>
                        <li class="nav-item">
                            @if($ngo->ngo_profiles->documents)
                            <a data-toggle="tab" class="nav-link" href="#verify">Verification</a> @else
                            <a data-toggle="tab" class="nav-link " href="#verify">Verification</a> @endif
                        </li>
                    </ul>
                    <div class="tab-content profile_view_content">
                        <div class="tab-pane active" id="info" role="tabpanel">
                            <form action="{{url('admin/ngo/update')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field()}}
                                <input type="hidden" name="ngo_id" value="{{$ngo->id}}">
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Name</label>
                                    <input class="col-lg-12 input_result_sec" name="name" placeholder="" value="{{$ngo->name}}">
                                    <!--  <div class="col-md-7"></div> -->
                                </div>

                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Email</label>
                                    <input class="col-lg-12 form-control" placeholder="" value="{{$ngo->email}}" disabled>
                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Mobile Number</label>
                                    <input class="col-lg-12 form-control" placeholder=" "  name="mobile_no" value="{{$ngo->mobile_no}}">
                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">State</label>
                                    <select class="form-control" name="state_id" id="state_id">
                                        <option value="">Choose city</option>
                                        @foreach($states as $state) @if($ngo->ngo_profiles->state_id == $state->id)
                                        <option value="{{$state->id}}" selected>{{$state->state_name}}</option>
                                        @else
                                        <option value="{{$state->id}}">{{$state->state_name}}</option>
                                        @endif @endforeach
                                    </select>
                                    <!--  <div class="col-md-7"></div> -->

                                </div>

                                <div class="col-md-6 col-lg-6  ngo_content_sec">
                                    <label class="col-lg-12">City</label>
                                    <select class="form-control" name="city_id" id="city_id" required>
                                        <option value=""></option>

                                    </select>

                                </div>

                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Address</label>
                                    <textarea name="address" class="form-control" required>{{$ngo->ngo_profiles->address}}</textarea>
                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Contact Person Name</label>
                                    <input class="col-lg-12 form-control" placeholder="" name="contact_person_name" value="{{$ngo->ngo_profiles->contact_person_name}}" required>

                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Contact Person Designation</label>
                                    <input class="col-lg-12 form-control" placeholder="" name="contact_person_designation" value="{{$ngo->ngo_profiles->contact_person_designation}}" required>

                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Bank Name</label>
                                    <input class="col-lg-12 form-control" placeholder="" name="bank_name" value="{{$ngo->ngo_profiles->bank_name}}" required>

                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Account Number</label>
                                    <input class="col-lg-12 form-control" placeholder="" name="account_number" value="{{$ngo->ngo_profiles->account_number}}" required>

                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Account Type</label>
                                    <input class="col-lg-12 form-control" placeholder="" name="account_type" value="{{$ngo->ngo_profiles->account_type}}" required>

                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">IFSC Code</label>
                                    <input class="col-lg-12 form-control" placeholder="" name="ifsc_code" value="{{$ngo->ngo_profiles->ifsc_code}}" required>

                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Facebook Share</label>
                                    <input class="col-lg-12 form-control" placeholder="" name="facebook_share" value="{{$ngo->ngo_profiles->facebook_share}}">

                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Twitter Share</label>
                                    <input class="col-lg-12 form-control" placeholder="" name="twitter_share" value="{{$ngo->ngo_profiles->twitter_share}}">

                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Description</label>
                                    <textarea id="summernote" name="description" class="form-control" required>{{$ngo->ngo_profiles->description}}</textarea>
                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    @if($ngo->ngo_profiles->logo)
                                    <label class="col-lg-12">Logo</label>
                                    <img src="{{ $ngo->ngo_profiles->logo }}" height="150px;" width="200px;"> @endif
                                </div>
                                @if($ngo->ngo_profiles->logo)
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">If you want change the logo?</label>
                                    <div class="col-md-6">
                                        <input type="radio" name="change_image_boolean" onchange="change_image()" id="image_change" value="1"> Yes
                                        <input type="radio" name="change_image_boolean" onchange="change_image()" id="image_change" value="0"> No
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 ngo_content_sec" id="image_show" style="display:none;">
                                    <label for="image" class="col-lg-12">Upload logo</label>

                                    <div class="col-md-6">
                                        <input type="file" name="logo" accept="image/*"> @if ($errors->has('image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span> @endif
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <label class="col-lg-12">Upload logo</label>
                                    <input type="file" name="logo" accept="image/*" class="form-control">
                                </div>
                                @endif
                                <div class="col-md-6 col-lg-6 ngo_content_sec">
                                    <!--<button type="button" class="btn btn-success float-right btn-md update_button">Next</button>-->

                                    <button type="submit" class="btn btn-success float-right btn-md update_button">Update</button>

                                </div>
                           </form>
                        </div>
                        <!--/tab-pane1-->
                        <div class="tab-pane" id="doc" role="tabpanel">
                            <form action="{{url('admin/ngo/documents_update')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field()}}
                                <input type="hidden" name="ngo_profile_id" value="{{$ngo->ngo_profiles->id}}">
                                <input type="hidden" name="ngo_id" value="{{$ngo->id}}">
                                <div class="col-lg-12 document_sec">
                                    <label class="col-lg-12">Pancard Number</label>
                                    @if($ngo->ngo_profiles->documents)
                                     <input class="col-lg-4 input_result_sec" placeholder="Enter Your Pancard Number" name="pan_number"  value="{{$ngo->ngo_profiles->documents->pan_number}}">
                                    @else
                                      <input class="col-lg-4 input_result_sec" placeholder="Enter Your Pancard Number" name="pan_number">
                                    @endif
                                </div>
                                <div class="col-lg-12 document_sec">
                                    <!--  <label class="col-md-12" >Document</label>
                                 <a href="{{ asset('storage/ngo/document/'.$ngo->ngo_profiles->document)}}" traget="_blank">View Document</a> -->
                                    <label class="col-lg-12">Registration Document</label>
                                     @if($ngo->ngo_profiles->documents)
                                      <a href="{{ $ngo->ngo_profiles->documents->registration_document }}" target="_blank" class="btn btn-info ">Preview</a>
                                      <a href="{{ $ngo->ngo_profiles->documents->registration_document }}" target="_blank" class="btn btn-success ">Download</a>
                                    @endif
                                    <input type="file" class="form-control" id="registration_document" name="registration_document" onchange="register_document(this)" required accept=".pdf,.docx,.xls">
                                </div>

                                <div class="col-lg-12 document_sec">
                                    <label class="col-lg-12">12ARegistration Document</label>
                                    @if($ngo->ngo_profiles->documents)
                                    <a href="{{ $ngo->ngo_profiles->documents->reg_12a_doc }}" target="_blank" class="btn btn-info ">Preview</a>
                                    <a href="{{ $ngo->ngo_profiles->documents->reg_12a_doc }}" target="_blank" class="btn btn-success ">Download</a>
                                    @endif
                                     <input type="file" class="form-control" name="reg_12a_doc" id="reg_12a_doc" required accept=".pdf,.docx,.xls" onchange="reg_12a_document(this)">
                                </div>
                                <div class="col-lg-12 document_sec">
                                    <label class="col-lg-12">80GRegistration Document</label>
                                    @if($ngo->ngo_profiles->documents)
                                    <a href="{{ $ngo->ngo_profiles->documents->reg_80g_doc }}" target="_blank" class="btn btn-info ">Preview</a>
                                    <a href="{{ $ngo->ngo_profiles->documents->reg_80g_doc }}" target="_blank" class="btn btn-success ">Download</a> @else
                                    @endif
                                    <input type="file" class="form-control" name="reg_80g_doc" id="reg_80g_doc" onchange="reg_80g_document()" accept=".pdf,.docx,.xls">
                                </div>
                                <div class="col-lg-12 document_sec">
                                    <label class="col-lg-12">Latest Audit Statements</label>
                                    @if($ngo->ngo_profiles->documents)
                                     <a href="{{ $ngo->ngo_profiles->documents->audi_statement }}" target="_blank" class="btn btn-info ">Preview</a>
                                     <a href="{{ $ngo->ngo_profiles->documents->audi_statement }}" target="_blank" class="btn btn-success ">Download</a>
                                    @endif
                                    <input type="file" class="form-control" name="audi_statement" id="audi_statement" onchange="audi_stat_document(this)" required accept=".pdf,.docx,.xls">
                                </div>
                                <div class="ngo_content_sec">
                                    <input type="submit" class="btn btn-success float-right btn-md update_button" value="Update">
                                </div>
                                
                            </form>
                        </div>
                        <div class="tab-pane" id="verify" role="tabpanel">
                            <form action="{{url('admin/ngo/'.$ngo->ngo_profiles->id)}}" method="POST">
                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                <span class="col-lg-12">
                                    <label  class="col-lg-5">Verification</label> :

                                    <label class="radio-inline verify_sec">
                                    <span class="col-lg-6">
                                      @if($ngo->ngo_profiles->verify == 1) 
                                    <input type="radio" value="1"  name="verify" checked required> Verifed&nbsp;&nbsp;
                                    @else
                                    <input type="radio" value="1"  name="verify" checked required> Verify&nbsp;&nbsp;
                                    @endif
                                    </span>

                                </label>

                                <div class="col-lg-7"></div>
                                </span>
                                <span class="col-lg-12">
                                    <label  class="col-lg-5">Status</label>:
                                    <label class="radio-inline verify_sec">
                                    <div class="col-lg-6">
                                     @if($ngo->ngo_profiles->status == 2)  
                                       <input type="radio" value="2"  name="status" checked  id="approve" required> Approved&nbsp;&nbsp;&nbsp;
                                       @else
                                       <input type="radio" value="2"  name="status"  id="approve" required> Approve&nbsp;&nbsp;&nbsp;
                                       @endif
                                    </div>
                                    <div class="col-lg-6">
                                      @if($ngo->ngo_profiles->status == 3)
                                        <input type="radio" value="3"  name="status" id="reject" checked required> Rejected
                                      @else
                                        <input type="radio" value="3"  name="status" id="reject"  required> Reject
                                      @endif
                                     </div>
                                    </label>
                                 </span>
                                <span class="col-lg-7" id="comments" style="display:none;">
                                  <label>Write Comments</label>
                                    <textarea class="form-control" required name="comments" id=""></textarea>
                                 </span>
                                <div class="col-lg-10"></div>
                                <div class="col-lg-2">
                                    <input type="submit" class="btn btn-success btn-md pull-right">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--tab-content-->
                </div>
            </div>
            <!--col-md-10-->
        </div>
        <!--row-->
    </div>
    <!--container-->

</main>
<script src="{{ asset('assets/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript">
    var state_id = $("#state_id :selected").attr('value');
    //console.log(state_id);
    if (state_id == "") {
        //console.log("hi");
    } else {
        //console.log("hello")
        $.ajax({
            url: "{{ url('admin/get_city')}}",
            type: 'GET',
            data: {
                state_id: state_id
            },
            dataType: 'JSON',
            success: function(data) {
                var empty = '';

                var city_id = "{{$ngo->ngo_profiles->city_id}}";
                empty += '<option value="">' + "Choose City" + '</option>';
                $.each(data, function(index, value) {
                    if (value.id == city_id) {
                        empty += '<option value=' + value.id + ' selected>' + value.city_name + '</option>';
                    } else {
                        empty += '<option value=' + value.id + '>' + value.city_name + '</option>';
                    }

                });
                $("#city_id").html(empty);
            }
        });
    }
    $("#state_id").on('change', function() {
        var state_id = $(this).val();
        $.ajax({
            url: "{{ url('admin/get_city')}}",
            type: 'GET',
            data: {
                state_id: state_id
            },
            dataType: 'JSON',
            success: function(data) {
                var empty = '';
                empty += '<option value="">' + "Choose City" + '</option>';
                $.each(data, function(index, value) {
                    empty += '<option value=' + value.id + '>' + value.city_name + '</option>';
                });
                $("#city_id").html(empty);
            }

        })
    });

    function change_image() {
        var change_image_val = document.querySelector('input[name="change_image_boolean"]:checked').value;
        if (change_image_val == 1) {
            $("#image_show").show();
        } else {
            $("#image_show").hide();
        }
    }
</script>
@endsection