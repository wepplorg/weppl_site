@extends('layouts.users')
@section('content')
<main>
   <div class="container-fluid">
   <div class="row justify-content-center">
      <h2 class="donor_dashboard_title">Donor Dashboard</h2>
   </div>
   <div class="clearfix"></div>
   <div class="row donor_dashboard_sec">
      <div class="col-md-4 col-lg-4 col-xl">
         <h4 class="text-center content_text_donor">Ratings</h4>
         <div class="card blue_card" >
            <span class="logo_sec">
               <img src="{{ asset('img/Logo.png')}}" class="float-left" alt="logo" width="60" height="30"/>
               <p class="float-right text-white">#Be Good</p>
            </span>
            <p class="text-center"> <img src="{{ asset('img/donor/smiley_icon.png')}}" alt="smiley_icon" width="60"/></p>
            <p class="text-center text-white">My Weppl Ratings</p>
            <p class="text-center">
               @if(($average_rating >= 1) && ($average_rating <= 149))
                 <i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i>
               @elseif(($average_rating >= 150) && ($average_rating <= 450))
                 <i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i>
               @elseif(($average_rating >= 450) && ($average_rating <= 750))
                 <i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i>
               @elseif(($average_rating >= 750) && ($average_rating <= 900))
                 <i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i>
               @elseif(($average_rating >= 900))
                 <i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i><i class="fa fa-star star_icon" aria-hidden="true"></i>
               @elseif(($average_rating == 0))
                 <i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i><i class="fa fa-star-o star_iconn" aria-hidden="true"></i> 
               @endif
            </p>
            <div class="row justify-content-end">
               <i class="fa fa-upload upload_icon" aria-hidden="true"></i>  
            </div>
         </div>
      </div>
         <div class="col-md-4 col-lg-4 col-xl">
         <h4 class="text-center content_text_donor">Supported Causes</h4>
         <div class="card violet_card">
            <span class="logo_sec">
               <img src="{{ asset('img/Logo.png')}}" class="float-left" alt="logo" width="60" height="30"/>
               <p class="float-right text-white">#Be Good</p>
            </span>
            <p class="text-center"> <img src="{{ asset('img/donor/smiley_icon.png')}}" alt="smiley_icon" width="60"/></p>
            <p class="text-center text-white ">Contributed Causes</p>
            <p class="text-center text-white counts">{{count($supported_causes)}}</p>
            <div class="row justify-content-end">
               <i class="fa fa-upload upload_icon" aria-hidden="true"></i>
            </div>
         </div>
      </div>
        <div class="col-md-4 col-lg-4 col-xl">
         <h4 class="text-center content_text_donor">Impacted People</h4>
         <div class="card green_card">
            <span class="logo_sec">
               <img src="{{ asset('img/Logo.png')}}" class="float-left" alt="logo" width="60" height="30"/>
               <p class="float-right text-white">#Be Good</p>
            </span>
            <p class="text-center"> <img src="{{ asset('img/donor/smiley_icon_2.png')}}" alt="smiley_icon" width="60"/></p>
            <p class="text-center text-white">People Impacted </p>
            <p class="text-center text-white counts">{{count($impacted_people)}}</p>
            <div class="row justify-content-end">
               <i class="fa fa-upload upload_icon" aria-hidden="true"></i>
            </div>
         </div>
      </div>
        <div class="col-md-4 col-lg-4 col-xl">
         <h4 class="text-center content_text_donor">Contribution</h4>
         <div class="card peech_card">
            <span class="logo_sec">
               <img src="{{ asset('img/Logo.png')}}" class="float-left" alt="logo" width="60" height="30"/>
               <p class="float-right text-white">#Be Good</p>
            </span>
            <p class="text-center"> <img src="{{ asset('img/donor/smiley_icon.png')}}" alt="smiley_icon" width="60"/></p>
            <p class="text-center text-white">My Social Capital Score </p>
            <p class="text-center text-white"><b class="counts">{{$contribution}}</b> Credits</p>
            <div class="row justify-content-end">
               <i class="fa fa-upload upload_icon" aria-hidden="true"></i>
            </div>
         </div>
      </div>
   </div><!--row-->
   <div class="clearfix"></div>

   <!--donor_dashboard_sec-->

   <!-- <div class="row  donor_dashboard_sec">

  <div class="row  donor_dashboard_sec">

      <div class="col-md-1"></div>
      <div class="col-md-4">
         <h3 class="text-center tag_title">TAGs</h3>
         <div class="owl-carousel owl-theme carousel-main">
            <div class="item">
               <div class="card black_card">
                  <span class="logo_sec">
                     <img src="{{ asset('img/Logo.png')}}" class="float-left" alt="logo" />
                     <p class="float-right text-white">#Be Good</p>
                  </span>
                  <div class="row justify-content-center smiley_sec">
                     <img src="{{ asset('img/donor/smiley_icon.png')}}" alt="smiley_icon" class="smiley_icon"/>
                  </div>
                  <h3 class="text-center text-white tag_text">Feeling proud to be top 10%</h3>
                  <h3 class="text-center text-white tag_text">impactor in April'19</h3>
                  <div class="row justify-content-end">
                        <i class="fa fa-upload upload_icon tag_icon" aria-hidden="true"></i>
                  </div>
                  <p class="text-center text-white">Contribute.Involve.Engage.Be Good</p>
               </div>
            </div>
            <div class="item">
               <div class="card black_card">
                  <span class="logo_sec">
                     <img src="{{ asset('img/Logo.png')}}" class="float-left" alt="logo" />
                     <p class="float-right text-white">#Be Good</p>
                  </span>
                  <div class="row justify-content-center smiley_sec">
                     <img src="{{ asset('img/donor/smiley_icon.png')}}" alt="smiley_icon" class="smiley_icon"/>
                  </div>
                  <h3 class="text-center text-white tag_text">Feeling proud to be top 10%</h3>
                  <h3 class="text-center text-white tag_text">impactor in April'19</h3>
                   <div class="row justify-content-end">
                        <i class="fa fa-upload upload_icon tag_icon" aria-hidden="true"></i>
                  </div>
                  <p class="text-center text-white">Contribute.Involve.Engage.Be Good</p>
               </div>
            </div>
         </div>
      </div>
     
      <div class="col-md-1"></div>
      <div class="col-md-1"></div>
      <div class="col-md-4">
         <h3 class="text-center badge_title">Badges</h3>
         <div class="owl-carousel owl-theme carousel-main">
            <div class="item">
               <div class="card lightgreen_card">
                  <span class="logo_sec">
                     <img src="{{ asset('img/Logo.png')}}" class="float-left" alt="logo" />
                     <p class="float-right text-white">#Be Good</p>
                  </span>
                  <div class="row justify-content-center">
                     <div class="col-5 col-md-5">
                        <img src="{{ asset('img/donor/2.png')}}" alt="icon" width="100%" height="100%" class="stand_smiley_img"/>
                     </div>
                     <div class="col-6 col-md-5 heart_icon_sec">
                        <div class="row justify-content-center">
                           <img src="{{ asset('img/donor/1.png')}}" alt="icon"/>
                        </div>
                        <h1 class="text-center text-white">100</h1>
                        <h5 class="text-center text-white">people impacted</h5>
                     </div>
                  </div>
                  <div class="row justify-content-end">
                     <i class="fa fa-upload upload_icon badge_icon" aria-hidden="true"></i>
                  </div>
               </div>
            </div>
            <div class="item">
               <div class="card lightgreen_card">
                  <span class="logo_sec">
                     <img src="{{ asset('img/Logo.png')}}" class="float-left" alt="logo" />
                     <p class="float-right text-white">#Be Good</p>
                  </span>
                  <div class="row justify-content-center">
                     <div class="col-5 col-md-5">
                        <img src="{{ asset('img/donor/2.png')}}" alt="icon" width="100%" height="100%"/>
                     </div>
                     <div class="col-6 col-md-5 heart_icon_sec">
                        <div class="row justify-content-center">
                           <img src="{{ asset('img/donor/1.png')}}" alt="icon"/>
                        </div>
                        <h1 class="text-center text-white">100</h1>
                        <h5 class="text-center text-white">people impacted</h5>
                     </div>
                  </div>
                  <div class="row justify-content-end">
                     <i class="fa fa-upload upload_icon badge_icon" aria-hidden="true"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-1"></div>
      </div>

   </div> -->
   </div>
   <!--container-fluid-->
</main>
@endsection
