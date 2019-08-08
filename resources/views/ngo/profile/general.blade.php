@extends('layouts.admin_layout')

@section('content')
  <main class="main">
   <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">NGO</li>
          <li class="breadcrumb-item">
            Profile
          </li>
          <li class="breadcrumb-item active">General</li>
          <!-- Breadcrumb Menu-->
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="#">
                <i class="icon-speech"></i>
              </a>
             <!-- <a class="btn" href="./">
                <i class="icon-graph"></i> �Dashboard</a>
              <a class="btn" href="#">
                <i class="icon-settings"></i> �Settings</a>-->
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
                 <div class="card">
                  <form action="{{url('ngo/ngo_profile_general')}}" method="POST" enctype="multipart/form-data">
                     {{ csrf_field()}}    
                  <div class="card-header">
                       <strong>General Form</strong>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Organization Name*</label>
                             <input class="form-control" id="name" name="name" type="text" value="{{Auth::user()->name}}" placeholder="Enter your organization name">
                          </div>
                        </div><!--col-md-6-->
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Organization Email*</label>
                             <input class="form-control" id="email" name="email"  disabled type="text" value="{{Auth::user()->email}}" placeholder="Enter your organization email">
                          </div>
                         </div><!--col-md-6-->
                      </div><!--row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Upload Logo</label>
                              <div class="row logo_sec">
                             <div class="col-md-3">
                              @if(Auth::user()->ngo_profiles)
                               <img class="img-thumbnail" src="{{ Auth::user()->ngo_profiles->logo }}">
                               @endif
                             </div>
                         
                            <div class="col-lg-9">
                              <input type="file" class="form-control-file" name="logo" id="logo"  onchange="ValidateSize(this)"  value="">
                              <span class="logo_img_extension">JPG, PNG, ICO or BMP. 1MB File Limit</span>
                            </div>
                           <!--   <input class="form-control" id="logo" name="logo" type="file" value="{{Auth::user()->name}}" placeholder="Enter your organization name">
                             </div> -->
                           </div>
                        </div>
                      </div><!--col-md-6-->
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Address*</label>
                             <textarea class="form-control" id="address" name="address" required>@if(Auth::user()->ngo_profiles){{Auth::user()->ngo_profiles->address}}@endif</textarea>
                          </div>
                        </div><!--col-md-6-->
                      </div><!--row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <label for="state">Choose State*</label>
                             <select class="form-control" name="state_id" id="state_id" required>
                                <option value="">Choose State</option>
                                @foreach($states as $state)
                                  @if(Auth::user()->ngo_profiles)
                                  @if(Auth::user()->ngo_profiles->state_id == $state->id)
                                    <option value="{{$state->id}}" selected>{{$state->state_name}}</option>
                                  @else
                                    <option value="{{$state->id}}">{{$state->state_name}}</option>
                                  @endif
                                  <script src="{{ asset('assets/jquery/dist/jquery.min.js')}}"></script>   
                                  <script type="text/javascript">
                                     //selected state id with respect to get cities

                                    var state_id = $("#state_id :selected").attr('value');
                                    //console.log(state_id);
                                    if(state_id  == ""){
                                     //console.log("hi");
                                    }else{
                                      //console.log("hello")
                                       $.ajax({
                                            url:"{{ url('ngo/profile/get_city')}}",
                                            type:'GET',
                                            data:{state_id:state_id},
                                            dataType:'JSON',
                                            success:function(data){
                                                var empty='';
                                                 
                                                 var city_id = "{{Auth::user()->ngo_profiles->city_id}}";
                                                 empty+='<option value="">'+"Choose City"+'</option>';
                                                $.each(data,function(index,value){
                                                    if(value.id == city_id){
                                                       empty +='<option value=' + value.id + ' selected>'+ value.city_name+'</option>';
                                                    }else{
                                                       empty +='<option value=' + value.id + '>'+ value.city_name+'</option>';
                                                    }
                                                    
                                                });
                                                $("#city_id").html(empty);
                                            }
                                      }); 
                                  }
                                  </script>
                                  @else
                                  <option value="{{$state->id}}">{{$state->state_name}}</option>
                                  @endif
                                @endforeach
                             </select>
                          </div>
                        </div><!--col-md-6-->
                        <div class="col-md-6">
                          <div class="form-group">
                             <label for="city">City*</label>
                             <select class="form-control" name="city_id" id="city_id" required>
                                <option value=""></option>
                                
                             </select>
                          </div>
                        </div><!--col-md-6-->
                      </div><!--row-->
                       <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Organization Website</label>
                             <input class="form-control" id="website" name="website_url" type="url" value="@if(Auth::user()->ngo_profiles){{Auth::user()->ngo_profiles->website_url}}@endif"  placeholder="Enter your organization website">
                          </div>
                       </div><!--col-md-6-->
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Organization Phone*</label>
                             <input class="form-control" id="phone" name="mobile_no"  disabled type="text" required value="{{Auth::user()->mobile_no}}" placeholder="Enter your organization phone number">
                          </div>
                       </div><!--col-md-6-->
                      </div><!--row-->
                      <div class="row">
                        <div class="col-md-6">
                        <div class="social-share">
                    <label  for="Social share button">Social Share button</label>
                    <p class="social-check">Check which social networks you want to use for sharing your posts</p>
                    
                      <div class="form-inline form-group social_help">
                       
                          <label class="form-check-label  col-xl-2 col-md-12 facebook_sec" for="check1">
                            <input type="checkbox" class="form-check-input" id="facebook" name="" value="something">Facebook
                          </label>
                       
                          <div class="col-xl-10 col-md-12 facebook_input">
                            <div class="row control-group ">
                           <input  id="facebook_share" type="text" class="form-control facebook_input" name="facebook_share"  value="@if(Auth::user()->ngo_profiles){{Auth::user()->ngo_profiles->facebook_share}}@endif" disabled="disabled" >
                            </div>
                          </div>
                       </div>
                         <div class="form-inline form-group social_help">
                       
                          <label class="form-check-label col-xl-2 col-md-12 twiter_sec" for="check2" style="padding-left: 0;">
                            <input type="checkbox" class="form-check-input" id="twitter" name="" value="twitter" >Twitter
                          </label>
                       
                          <div class="col-xl-10 col-md-12 facebook_input">
                            <div class="row control-group ">
                           <input  id="twitter_share" type="text" class="form-control facebook_input" name="twitter_share"  value="@if(Auth::user()->ngo_profiles){{Auth::user()->ngo_profiles->twitter_share}}@endif" disabled="disabled" >
                            </div>
                          </div>
                       </div>
                     </div>
                        </div><!--col-md-6-->
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>About*</label>
                             <textarea class="form-control summernote" name="description" id="summernote"  required autofocus>@if(Auth::user()->ngo_profiles){{ Auth::user()->ngo_profiles->description  }}@endif</textarea>
                          </div>
                       </div><!--col-md-6-->
                      </div><!--row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Contact Person Name*</label>
                             <input type="text" name="contact_person_name" class="form-control" value="@if(Auth::user()->ngo_profiles){{Auth::user()->ngo_profiles->contact_person_name}}@endif" required>
                          </div>
                        </div><!--col-md-6-->
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Contact Person Designation*</label>
                             <input type="text" name="contact_person_designation" class="form-control" required value="@if(Auth::user()->ngo_profiles){{Auth::user()->ngo_profiles->contact_person_designation}}@endif">
                          </div>
                        </div><!--col-md-6-->
                      </div><!--row-->
                      <hr/>
                      <h3>Bank Details</h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Bank Name*</label>
                             <input type="text" name="bank_name" class="form-control" required value="@if(Auth::user()->ngo_profiles){{Auth::user()->ngo_profiles->bank_name}}@endif">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Account Number*</label>
                             <input type="text" name="account_number" class="form-control" required value="@if(Auth::user()->ngo_profiles){{Auth::user()->ngo_profiles->account_number}}@endif">
                          </div>
                        </div>
                      </div><!--row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Account Type*</label>
                             <select name="account_type" class="form-control" required>
                               <option value="">Select Account Type</option>
                               @if(Auth::user()->ngo_profiles)
                                 @if(Auth::user()->ngo_profiles->account_type == "Current")
                                 <option value="Current" selected>Current</option>
                                 @else
                                 <option value="Current" >Current</option>
                                 @endif
                                @if(Auth::user()->ngo_profiles->account_type == "Savings")
                                 <option value="Savings" selected>Savings</option>
                                 @else
                                 <option value="Savings" >Savings</option>
                                 @endif
                               @else
                                  <option value="Current" >Current</option>
                                  <option value="Savings" >Savings</option>
                               @endif
                             </select>
                          </div>
                        </div><!--col-md-6-->
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>IFSC Code*</label>
                             <input type="text" name="ifsc_code" class="form-control" required value="@if(Auth::user()->ngo_profiles){{Auth::user()->ngo_profiles->ifsc_code}}@endif">
                          </div>
                         </div><!--col-md-6-->
                      </div><!--row-->
                      <hr/>
                     <!-- <h3>Change Password</h3> 
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                             <label>New Password</label>
                             <input class="form-control" id="new_password" name="new_password" type="password" value="" placeholder="Enter your new password">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                             <label>Confirm Password</label>
                             <input class="form-control" id="confirm_password" name="confirm_password"  disabled type="password"  placeholder="">
                          </div>
                        </div>

                      </div>-->
                       <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="form-check checkbox">
                               @if(Auth::user()->ngo_profiles)
                                @if(Auth::user()->ngo_profiles->terms == 1) 
                                 <input class="form-check-input checkbox_input" id="terms" type="checkbox" value="1" name="terms" checked required>
                                 @else
                                 <input class="form-check-input checkbox_input" id="terms" type="checkbox" value="1" name="terms"  required>
                                 @endif
                               @else
                                  <input class="form-check-input checkbox_input" id="terms" type="checkbox" value="1" name="terms"  required>
                               @endif
                               <label class="form-check-label information_sec" for="check1">The information submitted herewith above is correct and true to my knowledge. All the documents uploaded are genuine and valid. I hereby agree to inform weppl in case of any changes in my organisation's status.</label>
                            </div>
                            <div class="form-check checkbox">
                               @if(Auth::user()->ngo_profiles)
                                @if(Auth::user()->ngo_profiles->decalration == 1) 
                                 <input class="form-check-input checkbox_input" id="decalration" type="checkbox" value="1" checked name="decalration" required>
                                 @else
                                  <input class="form-check-input checkbox_input" id="decalration" type="checkbox" value="1"  name="decalration" required>
                                @endif
                               @else
                                 <input class="form-check-input checkbox_input" id="decalration" type="checkbox" value="1"  name="decalration" required>
                               @endif 
                               <label class="form-check-label" for="check1">I hereby declare that I have read and agree to adhere to weppl's terms of use, FAQs, pricing and privacy policy.</label>  
                            </div>     
                          </div>
                        </div><!--col-md-12-->
                        </div><!--row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            @if(Auth::user()->ngo_profiles)
                            @if(Auth::user()->ngo_profiles->status ==2)
                            <input type="submit" disabled class="btn btn-primary" value="Update">
                            @else
                            <input type="submit"  class="btn btn-primary" value="Update">
                            @endif
                            @else
                            <input type="submit"  class="btn btn-primary" value="Update">
                            @endif
                          </div>
                       </div><!--col-md-6-->
                      </div><!--row-->
                    </div><!--cardbody-->
                  </form>
                  </div><!--card-->
                  </div><!--col-md-12-->
                 </div><!--row-->
               </div><!--animated fadeIn-->
            </div><!--container-->
  </main>
 <script src="{{ asset('assets/jquery/dist/jquery.min.js')}}"></script>   
<script type="text/javascript">
$("#state_id").on('change',function(){
  var state_id = $(this).val();
  $.ajax({
    url:"{{ url('ngo/profile/get_city')}}",
    type:'GET',
    data:{state_id:state_id},
    dataType:'JSON',
    success:function(data){
      var empty='';
       empty+='<option value="">'+"Choose City"+'</option>';
      $.each(data,function(index,value){
        empty +='<option value=' + value.id + '>'+ value.city_name+'</option>';
      });
      $("#city_id").html(empty);
    }

  })
});
    </script>
@endsection