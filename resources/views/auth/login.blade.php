@extends('layouts.users')
@section('content')
    <div class="container-fluid" style="margin-top:5rem; margin-bottom:5.5rem; ">
     <form class="form-horizontal" method="POST" action="{{ route('login') }}">
       {{ csrf_field() }}
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
                <h2 class="text-center">Login</h2>
                  <div class="row social_media_btns">
                    <div class="col-sm-6 col-md-6">
                     <a href="{{url('login/facebook')}}"  class="btn btn-primary btn-block facebook_btn"><i class="fa fa-facebook facebook_icon" aria-hidden="true"></i>Facebook</a>
                    </div>
                     <div class="col-sm-6 col-md-6">
                     <a href="{{ url('google/redirect') }}" class="btn btn-danger btn-block google_plus_btn"><i class="fa fa-google-plus google_plus_icon" aria-hidden="true"></i>Google+</a>
                    </div>
                   </div>
                    <p class="text-center login_option_text">OR</p>
                  <div class="input-group mb-3">
             
                  <input class="form-control" type="email" name="email" required placeholder="E-mail">
                  @if ($errors->has('email'))
                 
                  <div class="col-md-12">
                   <span class="help-block">
                       <strong style="color:red;">{{ $errors->first('email') }}</strong>
                   </span>
                 </div>
                
                  @endif
                </div>
                <div class="input-group mb-4">
                 
                  <input class="form-control" type="password" name="password" required placeholder="Password">
                  @if ($errors->has('password'))
                 
                  <div class="col-md-12">
                   <span class="help-block">
                       <strong style="color:red;">{{ $errors->first('passowrd') }}</strong>
                   </span>
               </div>
              
                  @endif
                </div>
                <button class="btn btn-success btn-block px-4" type="submit">Login</button>
                <a class="btn btn-link mt-3 px-0 forgot_password_text mr-auto" href="{{ route('password.request') }}">
                                    Forgot  Password?
                </a>
            </div><!--card-->
            <div class="card text-white login_right_sec d-md-down-none" style="width:44%">
              <div class="card-body text-center right_content">
                <div>
                  <h2>Sign up</h2>
                  <p>“Sign up & together, let’s start the journey of making this world a better place.”</p>
                  <a href="{{ url('donor_register') }}" class="btn btn-primary register_btn active mt-3">Register Now!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  @endsection
