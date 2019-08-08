@extends('layouts.users')
@section('content')
<main>
      <div class="container-fluid">
            <h3 class="contact_title">How it works</h3>
       <div class="row plan_row border_right">
         <div class="col-md-6 col-lg">
           <div class="card how_it_works_card p-2 text-center">
             <span class="step float-left">1</span>
          <img src="{{asset('img/how_it_works/boy-girl-raising-their-hands_7710-73.jpg')}}" alt="" width="100%" class="donor_partner_img mx-auto d-block rounded-circle"  />
          <span><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
          <p class="dotted_box text-center">Beneficiaries in need of help,connect with weppl via NGOs & SHGs</p>
          </div>
       </div>
        <div class="col-md-6 col-lg">
            <div class="card how_it_works_card  p-2 text-center">
                <span class="step float-left">2</span>
            <img src="{{asset('img/how_it_works/Cartoon-House-and-Children.gif')}}" alt="" class="donor_partner_img mx-auto d-block rounded-circle" width="100%"/>
               <span><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
          <p class="dotted_box text-center ">NGO/Self Help Groups registers beneficiaries on weppl</p>
            </div>
        </div>
           <div class="col-md-6 col-lg">
              <div class="card text-center how_it_works_card p-2">
                  <span class="step float-left">3</span>
            <img src="{{asset('img/how_it_works/weppl_logo.png')}}"  class="donor_partner_img mx-auto d-block rounded-circle" alt="" width="100%"/>
               <span><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
          <p class="dotted_box">Weppl ensures awareness & transparency among donors through due diligence on all causes</p>
        </div>
         </div>
           <div class="col-md-6 col-lg">
              <div class="card text-center how_it_works_card p-2">
                  <span class="step float-left">4</span>
               <img src="{{asset('img/how_it_works/cartoon-dancing-people-clipart-35.jpg')}}" class="donor_partner_img mx-auto d-block rounded-circle mb-4" alt="" width="100%"/>
                <p class="dotted_box">Changemakers,Donors&corporates to crowdfund the causes on Weppl</p>
              </div>
          </div>
       </div>
   </div>
</ain>
@endsection