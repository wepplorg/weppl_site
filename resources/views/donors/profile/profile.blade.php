@extends('layouts.users')

@section('content')
<main>
<?php
   use App\Models\Payment;

   $payments = Payment::where('payment_status','=','Success')->where('user_id','=',Auth::user()->id)->orderBy('id','desc')->get();
?>
<main>

  <div class="container-fluid profile_container">
           <ul class="nav nav-tabs profile_tabs" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">
                           <h5>Profile</h5>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc" role="tab" aria-controls="doc" aria-selected="false">
                           <h5>Donations</h5>
                        </a>
                     </li>
                  </ul>
  
                 <div class="tab-content profile_content">
                  <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="nav-info-tab">
             <div id="accordion">           
                <div class="card">
    <div class="card-header">
      <a class="card-link" data-toggle="collapse" href="#collapseOne">
      Personal Details
      </a>
    </div>
    <div id="collapseOne" class="collapse show" data-parent="#accordion">
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
      <form action="{{url('user_profile_update')}}" method="POST" enctype="multipart/form-data">
        {{  csrf_field()}}
      <div class="card-body">
        <div class="row">
         <div class="form-group col-md-6">
                      <label for="first_name">Full Name*</label>
                      <input type="text" class="form-control" name="name" id="full_name" placeholder="Enter your full name" value="{{Auth::user()->name}}">
          </div>
           <div class="form-group col-md-6">
                                 <label for="form_email" >Email *</label>
                                 <input id="email" type="email" name="email" class="form-control" disabled placeholder="Enter your email" required="required" data-error="Valid email is required." value="{{Auth::user()->email}}">
                                 <div class="help-block with-errors"></div>
          </div>
           <div class="form-group col-md-6">
                                 <label for="form_phone">Phone</label>
                                 <input id="phone" type="number" required name="mobile_no" class="form-control "  placeholder="Enter your phone number" value="{{Auth::user()->mobile_no}}">
                                 <div class="help-block with-errors"></div>
            </div>
            <div class="form-group col-md-6">
                          <label class="col-md-4 control-label">Image</label>
                            <div class="col-md-6">
                               <img src="{{Auth::user()->image}}" width="50px;" height="50px;">
                            </div>   
                        </div>
                        <div class="form-group col-md-6">
                          <label class="col-md-4 control-label">If you want change the image?</label>
                            <div class="col-md-6">
                               <input type="radio" name="change_image_boolean" onchange="change_image()" id="image_change" value="1"> Yes
                               <input type="radio" name="change_image_boolean" onchange="change_image()" id="image_change" value="0"> No
                            </div>   
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} col-md-6" id="image_show" style="display:none;">
                            <label for="image" class="col-md-4 control-label">Images</label>

                            <div class="col-md-6">
                                <input type="file" name="image" accept="image/*">

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="col-md-4 control-label">If you want change the password?</label>
                            <div class="col-md-6">
                               <input type="radio" name="change_password_boolean" onchange="change_password()" id="password_change" value="1"> Yes
                               <input type="radio" name="change_password_boolean" onchange="change_password()" id="password_change" value="0"> No
                            </div>   
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6" id="password_show" style="display:none;">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="text" name="password" id="password" placeholder="Enter Password" class="form-control" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            </div>
            <button type="submit" class="btn btn-success float-right mb-3">Update</button>   
      </div>
    </form>
    </div>
  </div>
        </div>        
        </div>
                  <div class="tab-pane fade show" id="doc" role="tabpanel" aria-labelledby="doc-tab">
                     <table class="table table-striped table-bordered" style="width:100%" id="donation"> 
                         <thead>
                         <tr>
                           <th>No</th>
                           <th>Payment Id</th>
                           <th>Cause Name</th>
                           <th>Amount</th>
                           <th>Donated Date</th>
                         </tr>
                       </thead>
                       <?php $i=1;?>
                       <tbody>
                         @foreach($payments as $payment)
                            <tr>
                              <th>{{$i++}}</th>
                              <th>{{$payment->tracking_id}}</th>
                              <th><a href="{{url('beneficiary_detail/'.$payment->beneficiary->slug)}}">{{$payment->beneficiary->title}}</a></th>
                              <th>Rs.{{$payment->amount}}</th>
                              <th>{{date('d F,Y H:i:sa',strtotime($payment->created_at))}}</th>
                            </tr>
                         @endforeach
                       </tbody>
                     </table>
                  </div>
                </div>
  
</div>
</main>
<script>
 function change_image()
    {
        var change_image_val= document.querySelector('input[name="change_image_boolean"]:checked').value;
        if(change_image_val == 1)
        {
           $("#image_show").show();
        }
        else {
            $("#image_show").hide();
        }
    }
    function change_password()
    {
        var change_image_val= document.querySelector('input[name="change_password_boolean"]:checked').value;
        if(change_image_val == 1)
        {
           $("#password_show").show();
           
        }
        else {
            $("#password_show").hide();
            $("#password").removeAttr('required',true);
        }
    }
</script>

@endsection