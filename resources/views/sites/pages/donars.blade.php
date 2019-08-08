@extends('layouts.users')
@section('content')
<main>
   <div class="container-fluid">
      <div class="row justify-content-center">
      <h3 class="contact_title">How it works</h3>
   </div>
      <h5 class="works_sub_title">Steps for Donors</h5>
      <div class="row plan_row">
         <div class="col-md-6 col-lg-3">
            <div class="card cad_ngo">
               <h5 class="text-center card_heading">Create a profile</h5>
               <hr>
               <div>
                  <p class="text-center">Create a profile on our page to keep your actions updated.</p>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card cad_ngo">
               <h5 class="text-center card_heading">Choose a cause</h5>
               <hr>
               <div>
                  <p class="text-center">From an enlisted cause choose one or more to support</p>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card cad_ngo">
               <h5 class="text-center card_heading"> Donate</h5>
               <hr>
               <div>
                  <ul>
                     <li>
                        <p class="text-center">You can donate for one or more causes with our secured payment gateway.</p>
                     </li>
                     <li>
                        <p class="text-center">You can choose to remain anonymous while making the payments.</p>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card cad_ngo">
               <h5 class="text-center card_heading">Donate Randomly</h5>
               <hr>
               <div>
                  <p class="text-center">Alternatively you choose donate randomly & donate any amount which will automatically get allocated to one of the cause & we will let you know.</p>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card cad_ngo">
               <h5 class="text-center card_heading">Share your experience</h5>
               <hr>
               <div>
                  <p class="text-center">After the donation please share your experience in your social circle as it matters most to reach out to more people for something good.</p>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card cad_ngo">
               <h5 class="text-center card_heading">Keep visiting to stay updated</h5>
               <hr>
               <div>
                  <p class="text-center">Keep on checking your profile’s dashboard for progress on causes you have impacted & be involved.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection