@extends('layouts.users')
@section('content')
<?php use App\Models\Payment; ?>
<?php
      use App\Models\Beneficiary;
      $from_date = date('Y-m-d');
      $to_date= date('Y-m-d',strtotime($from_date.' + 100 days'));
      $story = Beneficiary::WhereBetween('end_date',[$from_date,$to_date])->where('status','=',2)->take(1)->first();
 ?>

 @if(Auth::user())
      <input type="hidden" id="email" value="{{Auth::user()->email}}">
      <input type="hidden" id="mobile_number" value="{{Auth::user()->mobile_no}}">
    @else

    @endif
       <div id="demo" class="carousel slide main_carosuel" data-ride="carousel">
            <ul class="carousel-indicators">
               <li data-target="#demo" data-slide-to="0" class="active"></li>
               <li data-target="#demo" data-slide-to="1"></li>
               <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
               <div class="carousel-item active">
                 @guest
                   <a href="https://shop.weppl.org" target="_blank">
                    <img src="{{asset('img/Banner_img/Banner_1.jpg')}}" alt="ggg" width="100%" class="large_device"/>
                     <button class="btn">IMPACT NOW</button>
                    <img src="{{asset('img/Banner_img/4.jpg')}}" alt="ggg" width="100%" class="mobile"/>
                  </a>
                 @else
                  <a href="https://shop.weppl.org" target="_blank">
                    <img src="{{asset('img/Banner_img/Banner_1.jpg')}}" alt="ggg" width="100%" class="large_device"/>
                    <button class="btn">IMPACT NOW</button>
                    <img src="{{asset('img/Banner_img/4.jpg')}}" alt="ggg" width="100%" class="mobile"/>
                  </a>
                 @endif
                  
               </div>
               <div class="carousel-item">
                @guest
                  <a href="https://shop.weppl.org" target="_blank">
                    <img src="{{asset('img/Banner_img/Banner_2.jpg')}}" alt="EERER" width="100%"class="large_device" />
                     <button class="btn">IMPACT NOW</button>
                      <img src="{{asset('img/Banner_img/2.jpg')}}" alt="ggg" width="100%" class="mobile"/>
                  </a>
                  @else
                  <a href="https://shop.weppl.org" target="_blank">
                    <img src="{{asset('img/Banner_img/Banner_2.jpg')}}" alt="EERER" width="100%"class="large_device" />
                    <button class="btn">IMPACT NOW</button>
                      <img src="{{asset('img/Banner_img/2.jpg')}}" alt="ggg" width="100%" class="mobile"/>
                  </a>
                  @endif
               </div>
               <div class="carousel-item">
                @guest
                   <a href="https://shop.weppl.org" target="_blank">
                    <img src="{{asset('img/Banner_img/Banner_3.jpg')}}" alt="banner2" width="100%" class="large_device"/>
                    <button class="btn">IMPACT NOW</button>
                      <img src="{{asset('img/Banner_img/3.jpg')}}" alt="ggg" width="100%" class="mobile"/>
                  </a>
                  @else
                   <a href="https://shop.weppl.org" target="_blank">
                    <img src="{{asset('img/Banner_img/Banner_3.jpg')}}" alt="banner2" width="100%" class="large_device"/>
                    <button class="btn">IMPACT NOW</button>
                      <img src="{{asset('img/Banner_img/3.jpg')}}" alt="ggg" width="100%" class="mobile"/>
                  </a>
                  @endif
               </div>
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
         </div>
         <div class="clearfix"></div>
       <div class="container-fluid">
          <div class="row justify-content-center">
               <h3 class="cause_sec">Featured Causes</h3>
             </div>
            <div class="row justify-content-center">
           
            <div class="col-md-10">
            <div class="row  feature_sec">
            
              @foreach($stories as $story)
               <div class="col-md-4 fund_card">
                    <a href="{{url('beneficiary_detail/'.$story->slug)}}" class="fund_card_link">
                      <div class="card welcome_card">
                        <div class="image_sec">
                        <img src="{{$story->images->image}}" alt="RDH" width="100%" style="object-fit: cover;" class="fund_card_img"/>
                         <div class="overlay"></div>
                       </div>
                     <div class="feature_content_sec">
                        <p class="feature_sub_title">{{$story->title}}</p>
                        <p class="ngo_name">by {{$story->users->name}}</p>
                        <p class="short_discription">{{$story->summary}}</p>
                         <div class="row justify-content-end read_more_sec">
                            <a href="{{url('beneficiary_detail/'.$story->slug)}}" class="read-more-link">Read More >
                            </a>
                          </div>
                     </div>
                 
                  <!-- <div class="progress_sec welcome_progress">
                      <div class="text">
                       <?php $raised_amount = Payment::where('beneficiary_id','=',$story->id)->where('payment_status','=','Success')->sum('amount'); 
                             $count_people = Payment::where('beneficiary_id','=',$story->id)->where('payment_status','=','Success')->groupBy('user_id')->get();
                            if($raised_amount){
                               $percentage = ($raised_amount/$story->goal_amount)*100; 
                             }else{
                                 $percentage=0;
                             }
                            
                      ?>  
                      <span class="left-text">{{moneyFormat($raised_amount,'INR')}}</span>
                      <span>Raised</span>
                      </div>
                      <div class="clearfix"></div>
                      <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="max-width:{{$percentage}}%">
                          </div>
                      </div>
                      <div class="support_sec">
                           <?php $date = Carbon\Carbon::parse($story->end_date);
                                $current= $date->diffInDays();?>
                           <span class="days">{{$current}} days left</span>
                           <span class="vl"></span>
                          <span class="support">{{ count($count_people)}} supporters</span>
                      </div>
                  </div> -->
             
                   </div>
               </a>
               </div>
               @endforeach
             </div>
           </div><!--col-md-10-->
          
        </div><!--row-->
           <div class="row justify-content-end view_more_btn_sec">
               <a href="{{url('beneficiary_lists')}}"  class="btn btn-link">Browse more</a>
           </div>
           <div class="row justify-content-center">
             <h3 class="charity-content-title">About Weppl</h3>
           </div>
            <div class="row charity-sec">
               <div class="col-md-6 charity-content">
                    <div class="vision_mission_sec">
                        <h5>Vision:</h5>
                        <p>A product to transform the world for a better tomorrow by all inclusive progress.</p>
                        <h5>Mission:</h5>
                        <p>To strengthen underprivileged individuals & communities by bringing support from various stakeholders by leveraging technology. </p>
                    </div>
                   <h5 class="salient_feature">Salient Features:</h5>
                   <p><b>We are a crowdfunding platform working towards following:</b></p>

                   <div class="row goal-sub_Sec">
                      <div class="col-6 col-md-6 col-lg text-center">
                                  <img src="{{asset('img/icons/social-capital.png')}}" alt="" width="100%" />
                                <p>To build social capital</p>
                      </div>
                      <div class="col-6 col-md-6 col-lg text-center">
                          <!-- <div class="row ">
                            <div class="col-3 col-md-5 col-lg-3"> -->
                               <img src="{{asset('img/icons/social-inclusion.png')}}" alt="" width="100%"/>
                            <!--   </div>
                                 <div class="col-9 col-md-7 col-lg-9"> -->
                            <p>To be socially inclusive</p>
                            <!--   </div>
                           </div> -->
                      </div>
                   
                      <div class="col-6 col-md-6 col-lg text-center">
                         <!--  <div class="row ">
                              <div class="col-3 col-md-5 col-lg-3"> -->
                               <img src="{{asset('img/icons/Redistribution-of-opportunity.png')}}" alt="" width="100%"/>
                             <!--  </div>
                                 <div class="col-9 col-md-7 col-lg-9"> -->
                              <p>Redistribution of opportunities</p>
                              </div>
                          <!--  </div>
                      </div> -->
                       <div class="col-6 col-md-6 col-lg text-center">
                        <!--   <div class="row ">
                             <div class="col-3 col-md-5 col-lg-3"> -->
                                  <img src="{{asset('img/icons/reason-to-be-good.png')}}" alt="" width="100%"/>
                            <!--   </div>
                               <div class="col-9 col-md-7 col-lg-9"> -->
                             <p> A reason to be good</p>
                          <!--     </div>
                           </div> -->
                      </div>
                    </div>
             </div><!--col-md-6-->
               <div class="col-md-6">
                  <img src="{{asset('img/photo-1488521787991-ed7bbaae773c.jpeg')}}" alt="image" width="100%"/>
               </div>
            </div>
         
            <!--charity-sec-->

               <!-- <h3 class="text-center fund-title"><b>OUR TOP FUNDRAISER</b></h3>
           <div class="row blue-Sec">

             <h3 class="text-center fund-title"><b>OUR TOP FUNDRAISER</b></h3> -->
           <!--  <div class="row blue-Sec">

               <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                  <div class="row fund_content">
                     <div class="col-md-2 col-lg-1"></div>
                     <div class="col-md-2 col-lg-2">
                        <i class="fas fa-wallet wallet-icon"></i>
                      </div>
                  <div class="col-lg-3 fundd-sec">
                     <h2>1,234Crore+</h2>
                     <h4>RAISED</h4>
                  </div>
                   </div>
               </div>
              <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                   <div class="row fund_content">
                     <div class="col-md-2 col-lg-1"></div>
                  <div class="col-md-2 col-lg-2">
                     <i class="fas fa-handshake fa-rotate-90 hand_icon" aria-hidden="true"></i>
                  </div>
                  <div class="col-lg-3 fundd-sec">
                     <h2>1,23,000+</h2>
                     <h4>SUPPORTERS</h4>
                  </div>
               </div>
               </div>
               <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                   <div class="row fund_content">
                  <div class="col-md-2 col-lg-1"></div>
                  <div class="col-12 col-md-2 col-lg-2">
                     <i class="fa fa-users user-icon" aria-hidden="true"></i>
                  </div>
                  <div class="col-12 col-lg-3 fund-sec">
                     <h2>12,000+</h2>
                     <h4>FUNDRAISER</h4>
                  </div>
               </div>
               </div>

            </div>-->
               <!--  <h3 class="text-center testimonial-title">TESTIMONIALS</h3>

            </div> -->
                 <!--<h3 class="text-center testimonial-title">TESTIMONIALS</h3>

               <div class="row carousel-sec">
                  <div class="col-lg-10">
                     <div class="owl-carousel carousel-main">
                    <a href="#">
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                           <div class="col-lg-3">
                             <img src="{{asset('img/image1.jpg')}}" alt="image1" width="100%">
                           </div>
                              <div class="col-lg-9">
                               <h5>LOREM IPSUM</h5>
                               <p><b>Lorem ipsum is empty</b></p>
                              <p>It is the most stable version of Bootstrap, and it is still supported by the team for critical bugfixes and documentation changes. However, no new features will be added to it.</p>
                              <p>Lorem ipsum is empty</p>
                               </div>
                            </div>
                        </div>
                     </div>
               </a>
               <a href="#" >
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                           <div class="col-lg-3">
                             <img src="{{asset('img/image1.jpg')}}" alt="image1" width="100%">
                           </div>
                               <div class="col-lg-9">
                               <h5>LOREM IPSUM</h5>
                               <p><b>Lorem ipsum is empty</b></p>
                              <p>It is the most stable version of Bootstrap, and it is still supported by the team for critical bugfixes and documentation changes. However, no new features will be added to it.</p>
                              <p>Lorem ipsum is empty</p>
                               </div>
                            </div>
                        </div>
                     </div>
               </a>
                     </div>
                  </div>
               </div>-->
            </div><!--container-->

 <!-- without login donate modal -->
<!-- The Modal -->
  <div class="modal donation_modal" id="without_login">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
         <div class="text-center">     
             <h5 class="modal-title">Donate without Login  &nbsp;or&nbsp;
                <a href="{{url('login')}}" class="btn btn-primary">Log in </a>
             </h5>
           </div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <form id="donate_without_login" method="POST" action=""> 
           <h5>Please fill your details</h5>
           <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
           </div>
           <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" id="email" required> 
           </div>
           <div class="form-group">
             <label>Mobile Number</label>
             <input type="number" class="form-control" required id="mobile_number" name="mobile_number">
           </div>
           <div class="row justify-content-center">
            <div class="form-group">
             <label class=" " ><h4>Donate as anonymous?</h4></label>
             <div class="row justify-content-center">
              <input type="radio" name="ticket_count"  class="required" required value="1" style="margin-right:0.3rem;padding:0.5rem;">Yes &nbsp;&nbsp;
              <input type="radio" name="ticket_count" checked class="required" required value="0" style="margin-right:0.3rem;padding:0.5rem;">No
             </div>
           </div>
          </div>  
         <div class="row justify-content-center donate_amount_sec">
            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="other_amount">
              <label class="btn btn-light active">
                <input type="radio" name="amount" id="option1" autocomplete="off" required checked value="50"> 50
              </label>
              <label class="btn btn-light">
                <input type="radio" name="amount" id="option2" autocomplete="off" required value="100"> 100
              </label>
              <label class="btn btn-light">
                <input type="radio" name="amount" id="option3" autocomplete="off" value="other"> Other Amount
              </label>
            </div>
          </div>
           <div class="other_amount_sec" id="amount_other" style="display:none;">
              <input type="number" class="form-control" name="custom_amount" id="custom_amount">
           </div>
            <div class="row justify-content-center">
              <input type="submit" id="" class="btn btn-success btn-md" value="Proceed To Pay">
          </div>
         </form>
        </div>
        
        <!-- Modal footer -->
       <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>-->
        
      </div>
    </div>
  </div>
  
  
<!-- end without login donate button  -->


            <!-- payment modal starts here -->
  <div class="modal donation_modal" id="payment_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <span class="row">
              <div class="col-md-3"></div>
            <h5 class="modal-title col-md-6">Choose Donation Amount</h5>
            <button type="button" class="close col-md-3" data-dismiss="modal">&times;</button>
           </span>
          </div>
          <div class="modal-body">
        <div class="row justify-content-center">
           <div class="form-group">
               @if(isset($story))
              <h2>{{$story->title}}</h2>
              <input type="hidden" id="story_id" value="{{$story->id}}">
              @endif
              <p>Would like to donate for other causes? - <a href="{{url('beneficiary_lists')}}">browse more</a></p>
           </div>
        </div>  
         <div class="row justify-content-center">
            <div class="form-group">
             <label class=" " ><h4>Donate as anonymous?</h4></label>
             <div class="row justify-content-center">
             <input type="radio" name="ticket_count" checked class="required" value="1" style="margin-right:0.3rem;padding:0.5rem;">Yes &nbsp;&nbsp;
             <input type="radio" name="ticket_count" class="required" value="0" style="margin-right:0.3rem;padding:0.5rem;">No
             </div>
           </div>
          </div>    
         <div class="row justify-content-center donate_amount_sec">
            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="other_amount">
              <label class="btn btn-light active">
                <input type="radio" name="amount" id="option1" autocomplete="off" required checked value="50"> 50
              </label>
              <label class="btn btn-light">
                <input type="radio" name="amount" id="option2" autocomplete="off" required value="100"> 100
              </label>
              <label class="btn btn-light">
                <input type="radio" name="amount" id="option3" autocomplete="off" value="other"> Other Amount
              </label>
            </div>
          </div>
           <div class="other_amount_sec" id="amount_other" style="display:none;">
              <input type="number" class="form-control" name="custom_amount" id="custom_amount">
           </div>
            <div class="row justify-content-center">
              <button id="buy_now" class="btn btn-success btn-md buy_now">Proceed To Pay</button>
          </div>
      </div>
    </div>
  </div>
  <!-- End of payment modal -->
     <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
      <script>
         var user_detail = "{{Auth::user()}}";
        
         if(user_detail == ""){      
            var  user_email = "";
            var  user_mobile_number ="";
         }else{
            var  user_email = document.getElementById('email').value;
            var  user_mobile_number =document.getElementById('mobile_number').value;
         }
         var SITEURL = '{{URL::to('')}}';
         $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
         }); 
         $('body').on('click', '.buy_now', function(e){
           var totalAmount =document.querySelector('input[name="amount"]:checked').value;
           if(totalAmount == "other"){

               totalAmount = document.getElementById('custom_amount').value;
           }else{
               $totalAmount = document.querySelector('input[name="amount"]:checked').value;
           }
           var product_id =document.getElementById('story_id').value;
           var ticket_count = document.querySelector('input[name="ticket_count"]:checked').value;
           var options = {
           "key": "rzp_live_FCT6BUW05yQpLf",
           "amount": (totalAmount*100), // 2000 paise = INR 20
           "name": "Weppl",
           "description": "Payment",
           "image": "{{asset('img/weppl-logo.png')}}",
           "handler": function (response){
            // console.log(response.email);
                 $.ajax({
                   url: "{{ url('paysuccess')}}",
                   type: 'POST',
                   dataType: 'JSON',
                   beforeSend: function(){
                      $('#buy_now').prop('disabled', true);
                    },
                   data: {
                    razorpay_payment_id: response.razorpay_payment_id,response:response, 
                     totalAmount : totalAmount ,product_id : product_id,"_token": "{{ csrf_token() }}",ticket_count:ticket_count,
                   }, 
                   success: function (msg) {
                     
                      window.location.href = "{{url('payment_success')}}";
                   }
               });
             
           },
          "prefill": {
             
                "contact": user_mobile_number,
                 "email": user_email,      
           },
           "theme": {
               "color": "#FFd700"
           }
         };
         var rzp1 = new Razorpay(options);
         rzp1.open();
         e.preventDefault();
         });
         /*document.getElementsClass('buy_plan1').onclick = function(e){
           rzp1.open();
           e.preventDefault();
         }*/

      //donate without login
  $("#donate_without_login").on('submit',function(e){
         // alert("hi");
          e.preventDefault();
          var name=document.getElementById('name').value;
          var email=document.getElementById('email').value;
          var mobile_number=document.getElementById('mobile_number').value;
          var product_id =document.getElementById('story_id').value;
           //alert(email);
          var totalAmount =document.querySelector('input[name="amount"]:checked').value;
           if(totalAmount == "other"){

               totalAmount = document.getElementById('custom_amount').value;
           }else{
               $totalAmount = document.querySelector('input[name="amount"]:checked').value;
           }
           var ticket_count = document.querySelector('input[name="ticket_count"]:checked').value;
           var options = {
           "key": "rzp_live_FCT6BUW05yQpLf",
           "amount": (totalAmount*100), // 2000 paise = INR 20
           "name": "Weppl",
           "description": "Payment",
           "image": "{{asset('img/weppl-logo.png')}}",
           "handler": function (response){
             //console.log(response);
                 $.ajax({
                   url: "{{ url('donate_without_login')}}",
                   type: 'POST',
                   dataType: 'JSON',
                   beforeSend: function(){
                    $(':input[type="submit"]').prop('disabled', true);
                   },
                   data: {
                    razorpay_payment_id: response.razorpay_payment_id,response:response, 
                     totalAmount : totalAmount ,product_id : product_id,name:name,email:email,mobile_number:mobile_number,"_token": "{{ csrf_token() }}",ticket_count:ticket_count,
                   }, 
                   success: function (msg) {
                     
                      window.location.href = "{{url('payment_success')}}";
                   }
               });
             
           },
          "prefill": {
             
                "contact": mobile_number,
                 "email": email,      
           },
           "theme": {
               "color": "#FFD700"
           }
         };
         var rzp1 = new Razorpay(options);
         rzp1.open();
         e.preventDefault();
  })          
      </script>
       
@endsection
   
      
