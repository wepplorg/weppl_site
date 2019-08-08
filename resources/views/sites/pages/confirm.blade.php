@extends('layouts.users')
@section('content')
<main>
  <div class="container-fluid">
  	<div class="row justify-content-center payment_donation_sec">
  <div class="jumbotron col-md-6 donation_sec">
  <p class="text-center"><i class="fa fa-check-circle"></i></p>
  <h3 class="text-center"><b>"Thank you - You are a change-maker"</b></h3>
  <p class="lead text-center">Please check your inbox for more info</p>
  <hr>
  <p class="text-center">
    Having trouble? <a href="{{url('contact')}}">Contact us</a>
  </p>
  <p class="lead text-center">
    <a class="btn btn-success btn-md" href="{{url('/')}}" role="button">Continue to homepage</a>
  </p>
</div>
</div>
  </div>
</main>
@endsection