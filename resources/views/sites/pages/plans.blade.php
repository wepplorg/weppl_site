@extends('layouts.users')
@section('content')
<main>
   <div class="container-fluid">
      <h3 class="works_sub_title plan_title"><b>Plans & Pricing</b></h3>
      <div class="row plan_row">
         <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card plans_card">
               <h5 class="card_heading">NGO Standard</h5>
               <hr>
               <p class="text-center">Platform Fee (Inclusive GST) 12.5%*</p>
               <hr>
               <h5 class="card_heading mb-3">NGO Standard Features</h5>
               <div  class="text-center">
                  <p>Applicable when beneficiary is NGO</p>
                  <p>Local+Foreign payment gateways**</p>
                  <p>Multiple fundraisers</p>
                  <p>Campaign Manager</p>
                  <p>Embed Button</p>
                  <p>Real time support</p>
                  <p>Content Curation</p>
                  <p>Custom URL</p>
               </div>
               <hr>
               <div class="text-center">
                  <p><b>Remark</b></p>
                  <p>* Additional payment gateway fee applicable as per the type of transaction ** Only applicable for FCRA complied organizations </p>
               </div>
            </div>
         </div>
         <!--col-md-3-->
         <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card plans_card">
               <h5 class="card_heading">NGO Plus & Amplify</h5>
               <hr>
               <p class="text-center"> NGO Standard Fee + 5%*</p>
               <hr>
               <h5 class="card_heading mb-3">NGO Standard Features</h5>

               <div class="text-center" style="padding-bottom:5.5rem;">
                  <p>On selected fundraisers as per mutual agreement</p>
                  <p>All standard features +</p>
                  <p>Social Media Outreach</p>
                  <p>Content creation</p>
                  <p>Promotions & Advertising</p>
               </div>
               <hr>
               <div class="text-center">
                  <p><b>Remark</b></p>
                  <p>* Additional payment gateway fee applicable as per the type of transaction ** Only applicable for FCRA complied organizations </p>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection