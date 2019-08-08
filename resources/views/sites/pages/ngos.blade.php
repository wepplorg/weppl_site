@extends('layouts.users')
@section('content')
<main>
   <div class="container-fluid">
      <div class="row justify-content-center">
      <h3 class="contact_title">How it works</h3>
      </div>
      <h5 class="works_sub_title">Steps for NGOs</h5>
      <div class="row plan_row">
         <div class="col-md-6 col-lg-3">
            <div class="card card_ngo">
               <h5 class="text-center card_heading">Need Funds for a cause!</h5>
               <hr>
               <p class="text-center">Falling short of funds required to achieve your goal, dream or need?</p>
               <p class="text-center"><b>E.g.</b> </p>
               <p class="text-center">10 year Vikas needs funds to support his education</p>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card card_ngo ">
               <h5 class="text-center  card_heading">Start a fundraiser</h5>
               <hr>
               <p class="text-center">
                  Sign up for the process by registering & create a beneficiary profile.
               </p>
               <p class="text-center"><b>E.g.</b></p>
               <p class="text-center">The NGO affiliated with Vikas’s education registered on weppl & created Vikas’s profile</p>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card card_ngo ">
               <h5 class="text-center  card_heading">Share Your Fundraiser</h5>
               <hr>
               <p class="text-center">Share the link with your known social network to get maximum
                  fundraising from donors.
               </p>
               <p class="text-center"><b>E.g.</b></p>
               <p class="text-center">The NGO shared the link with their network to raise the funds</p>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card card_ngo ">
               <h5 class="text-center card_heading">Raise Funds and withdraw in your Bank account</h5>
               <hr>
               <p class="text-center">Raise Funds and withdraw in your Bank account</p>
               <p class="text-center">Once the funds are raised you can withdraw funds on a regular interval from weppl</p>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection