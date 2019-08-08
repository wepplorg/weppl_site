@extends('layouts.users')
@section('content')
    <div class="container-fluid" style="margin-top:2rem; margin-bottom:0.5rem; ">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <div class="card-body p-4">
             <form action="{{route('register')}}" method="POST">
             {{ csrf_field()}} 
              <h2>Donor Register</h2>
              <p class="text-muted">Create your account</p>
              <div class="input-group mb-3">
               <!--  <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div> -->
                <input class="form-control" type="text" name="name" required placeholder="Name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                     <div class="col-md-12">
                   <span class="help-block">
                      <strong style="color:red;">{{ $errors->first('name') }}</strong>
                   </span>
                   </div>
               
                @endif
              </div>
              <div class="input-group mb-3">
               <!--  <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div> -->
                <input class="form-control" type="email" name="email" required placeholder="Email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                  <div class="col-md-12">
                   <span class="help-block">
                      <strong style="color:red;">{{ $errors->first('email') }}</strong>
                   </span>
                 </div>
                @endif
              </div>
              <div class="input-group mb-3">
                <!-- <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div> -->
                <input class="form-control" type="type" name="mobile_no" required placeholder="Phone Number" value="{{ old('mobile_no') }}">
                @if ($errors->has('mobile_no'))
                  <div class="col-md-12">
                   <span class="help-block">
                      <strong style="color:red;">{{ $errors->first('mobile_no') }}</strong>
                   </span>
                 </div>
                @endif
              </div>
              <div class="input-group mb-3">
               <!--  <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-lock"></i>
                  </span>
                </div> -->
                <input class="form-control" type="password" required name="password" placeholder="Password">
                @if ($errors->has('password'))
                  <div class="col-md-12">
                   <span class="help-block">
                      <strong style="color:red;">{{ $errors->first('password') }}</strong>
                   </span>
                 </div>
                @endif
              </div>
              <div class="input-group mb-4">
                <!-- <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-lock"></i>
                  </span>
                </div> -->
                <input class="form-control" type="password" required id="id="password-confirm"" name="password_confirmation" placeholder="Confirm password">
              </div>
              <button class="btn btn-block btn-success" type="submit">Create Account</button>
            </div>
            </form>
            <!--<div class="card-footer p-4">
              <div class="row">
                <div class="col-6">
                  <a  href="{{ url('login/facebook') }}" class="btn btn-block btn-facebook" >
                    <i class="fa fa-facebook"></i><span> facebook</span>
                  </a>
                </div>
                <div class="col-6">
                  <a href="{{ url('google/redirect') }}" class="btn btn-block btn-twitter">
                    <i class="fab fa-google-plus-g"></i> <span> Google</span>
                  </a>
                </div>
              </div>
            </div>-->
          </div>
        </div>
      </div>
    </div>
  @endsection 

