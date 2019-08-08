@extends('layouts.users')
@section('content')
    <div class="container-fluid" style="margin-top:2rem; margin-bottom:0.5rem; ">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <div class="card-body p-4">
             <form class="form-horizontal" method="POST" action="{{ url('ngo') }}">
             {{ csrf_field()}} 
              <h2 class="text-center">NGO Register</h2>
              <p class="text-muted text-center">Create your account</p>
             <!--  <div class="row social_media_btns">
                    <div class="col-md-6">
                     <a href="#"  class="btn btn-primary btn-block facebook_btn"><i class="fa fa-facebook facebook_icon" aria-hidden="true"></i>Facebook</a>
                    </div>
                     <div class="col-md-6">
                     <a href="#" class="btn btn-danger btn-block google_plus_btn"><i class="fa fa-google-plus google_plus_icon" aria-hidden="true"></i>Google+</a>
                    </div>
              </div> -->
              <!--  <p class="text-center login_option_text">OR</p> -->
              <div class="input-group mb-3">
             
                <input class="form-control" type="text" name="name" placeholder="NGO Name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                     <div class="col-md-12">
                   <span class="help-block">
                      <strong style="color:red;">{{ $errors->first('name') }}</strong>
                   </span>
                   </div>
               
                @endif
              </div>
              <div class="input-group mb-3">
              
                <input class="form-control" type="email" name="email" required="true" placeholder="Email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                  <div class="col-md-12">
                   <span class="help-block">
                      <strong style="color:red;">{{ $errors->first('email') }}</strong>
                   </span>
                 </div>
                @endif
              </div>
              <div class="input-group mb-3"> 
                <input class="form-control" type="number" name="mobile_no"  placeholder="Phone Number" value="{{ old('mobile_no') }}" required>
                @if ($errors->has('mobile_no'))
                  <div class="col-md-12">
                   <span class="help-block">
                      <strong style="color:red;">{{ $errors->first('mobile_no') }}</strong>
                   </span>
                 </div>
                @endif
              </div>
              <div class="input-group mb-3">         
                <input class="form-control" type="password"  name="password"  placeholder="Password" required>
                @if ($errors->has('password'))
                  <div class="col-md-12">
                   <span class="help-block">
                      <strong style="color:red;">{{ $errors->first('password') }}</strong>
                   </span>
                 </div>
                @endif
              </div>
              <div class="input-group mb-4">
               
                <input class="form-control" type="password"  id="password-confirm" name="password_confirmation" placeholder="Confirm password" required>
              </div>
              <button class="btn btn-block btn-success" type="submit">Create Account</button>

               <span><p class="text-center account_login_text">Already have an Account?<a  href="{{route('login')}}">Login Here</a></p></span>
            </form>
          </div>
        </div>
      </div>
    </div>
 </div>
  @endsection 

