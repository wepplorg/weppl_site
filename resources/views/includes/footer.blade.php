<?php
      use App\Models\Beneficiary;
      $from_date = date('Y-m-d');
      $to_date= date('Y-m-d',strtotime($from_date.' + 100 days'));
      $story = Beneficiary::WhereBetween('end_date',[$from_date,$to_date])->where('status','=',2)->orderBy('id','asc')->take(1)->first();
 ?>

 @if(Auth::user())
      <input type="hidden" id="email" value="{{Auth::user()->email}}">
      <input type="hidden" id="mobile_number" value="{{Auth::user()->mobile_no}}">
    @else

    @endif
<div class="container-fluid footer">
	<div class="ngo_conteiner">
	<div class="row ">
		<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
			  <a href="{{url('/')}}">
	         <img src="{{ asset('img/Logo.png')}}" class="logo" alt="logo"/>
	         </a>
	    </div>
  
	   <!--  <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
	    	<div class="row">
	    	<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
	           <div class="separator"></div>
	        </div>
	       <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
	           <div class="separator"></div>
	        </div>
	       <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
	           <div class="separator"></div>
	        </div>
	         </div>
        </div> -->
     </div>
	<div class="row">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
	     <p class="address-sec">"All its takes is the first step to start a meaningful journey”</p>
       <p>Join us in our various social platforms to be involved.</p>
	     
       </div><!--col-xl-6-->
      
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
       	<div class="row">
       	   <div class="col-md-4 col-lg-4 col-xl-4 footer-content-sec">
       	   	 <h4 class="mb-3">About Us</h4>
       	   	  <ul class="details">
	            <li> <a href="{{url('partners')}}" >Our Partners</a></li>
	             <!-- <li> <a href="{{url('blog')}}" >Blog</a></li> -->
	            <li> <a href="{{url('careers')}}">Careers</a></li>
	           </ul>
       	   </div>
       	   <div class="col-md-4 col-lg-4 col-xl-4 footer-content-sec">
       	   	 <h4 class="mb-3">Support</h4>
       	   	   <ul class="details">
       	   	   	<li> <a href="{{url('plans')}}" >Plans & Pricing</a></li>
    		        <li><a href="{{url('faq')}}" >FAQ</a></li>
    		        <li> <a href="{{url('contact')}}" >Contact Us</a></li>
    		        <li> <a href="{{url('privacypolicy')}}">Privacy Policy</a></li>
    		        <li> <a href="{{url('terms')}}">Terms & Conditions</a></li>
	           </ul>
       	   </div>
            <div class="col-md-4 col-lg-4 col-xl-4 footer-content-sec">
             <h4 class="mb-3">Follow Us</h4>
              <ul class="social-media-links">
              <li><a href="https://www.instagram.com/weppl_org/" target="_blank"><i class="fab fa-instagram"></i></a></li>
              <li> <a href="https://www.facebook.com/weppl.org" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
              <li> <a href="https://www.youtube.com/channel/UCmdoiAeJbx3gw6UdMYvieSQ" target="_blank"><i class="fab fa-youtube"></i></a></li>
               <li> <a href=" https://twitter.com/weppl_org" target="_blank"><i class="fab fa-twitter"></i></a></li>
               <li> <a href=" https://www.linkedin.com/company/weppl" target="_blank"> <i class="fab fa-linkedin-in"></i></a></li>
       </ul>
           </div>
       	 <!--   <div class="col-md-4 col-lg-4 col-xl-4 footer-content-sec">
       	   	 <h4>How it Works</h4>
       	   	   <ul class="details">
  	            <li><a href="{{url('ngos')}}" >NGOs</a></li>
  	            <li> <a href="{{url('donars')}}">Donors</a></li>
	           </ul>
       	   </div> -->
       	</div><!--row-->
        </div><!--col-xl-6-->
     </div><!--row-->
 </div>
      <a id="back2Top" href="#support" style="display: block;"  data-toggle="modal" ><i class="fa fa-comment-o" aria-hidden="true"></i></a>
</div><!--container-->

<div class="modal" id="support">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Contact Us</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
              <form id="support_form" method="post" action="" role="form">
                   {{ csrf_field()}}
                     <div class="contact">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="form_email">Email</label>
                                 <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email" required="required" data-error="Valid email is required.">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="form_message">Message</label>
                                 <textarea id="form_message" name="message" required class="form-control"  rows="2" required data-error="Please,leave us a message."></textarea>
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <input type="submit" class="btn btn-success btn-send float-right" value="Send message">
                           </div>
                        </div>
                     </div>
                  </form>
      </div>
    </div>
  </div>
</div>
 <div id="test">
     <span class="short-text"><img src="{{asset('img/icons/white-donation-icon-300x300.png')}}" alt="heart" class="side_nav_logo" ></span>
   @guest
    <a href="#" data-toggle="modal" data-target="#without_login"> <span class="long-text">
      <p>D</p>
      <p>O</p>
      <p>N</p>
      <p>A</p>
      <p>T</p>
      <p>E</p>
    </span></a>
   @else             
    <a href="#" data-toggle="modal" data-target="#payment_modal"> <span class="long-text">
      <p>D</p>
      <p>O</p>
      <p>N</p>
      <p>A</p>
      <p>T</p>
      <p>E</p>
    </span></a>
    @endif
  </div>

   <!-- success modal -->
   <!-- Modal HTML -->
   <div id="successModal" class="modal fade">
      <div class="modal-dialog modal-confirm modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <div class="icon-box">
                  <i class="material-icons">&#xE876;</i>
               </div>
               <h4 class="modal-title text-center">Thank you for contacting us!</h4>
            </div>
            <div class="modal-body">
               <p class="text-center">we will get back to you!</p>
            </div>
            <div class="modal-footer">
               <button class="btn btn-success btn-block" data-dismiss="modal">Ok</button>
            </div>
         </div>
      </div>
   </div>
   <!-- end success modal -->

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
            <h5 class="modal-title col-9 col-md-6">Choose Donation Amount</h5>
            <button type="button" class="close col-2 col-md-3" data-dismiss="modal">&times;</button>
           </span>
          </div>
          <div class="modal-body">
            <div class="row justify-content-center">
           <div class="form-group">
             @if(isset($story))
              <h4 class="text-center">{{$story->title}}</h4>
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
  <script>
  $(document).ready(function() {
  
    $("#test").hover(function() {
    $(".long-text").addClass("show-long-text");   
}, function () {
    $(".long-text").removeClass("show-long-text");
});

     $("#support_form").on('submit',function(e){
       e.preventDefault(e);
      // alert("hi");
        var data= new FormData(this);
        $.ajax({
           url:"{{url('support_email')}}",
           data:data,
           cache: false,
           processData: false,
           contentType: false,
           type: 'POST',
           beforeSend: function() {
            $(':input[type="submit"]').prop('disabled', true);
            },
           success:function(data){
               if(data.success){
                     $('#support_form').trigger("reset");
                     $("#support").modal('hide');
                     $("#successModal").modal("show");
               }
           }
        })
   });
     });
</script>
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
          // alert("footer");
           var totalAmount =document.querySelector('input[name="amount"]:checked').value;
           if(totalAmount == "other"){

               totalAmount = document.getElementById('custom_amount').value;
           }else{
               $totalAmount = document.querySelector('input[name="amount"]:checked').value;
           }
           var product_id =document.getElementById('story_id').value;
           var ticket_count = document.querySelector('input[name="ticket_count"]:checked').value;
           var options = {
           "key": "rzp_live_5mA4A7HTopwv2e",
           "amount": (totalAmount*100), // 2000 paise = INR 20
           "name": "Weppl",
           "description": "Payment",
           "image": "{{asset('img/we-love-ppl.jpg')}}",
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
               "color": "#528FF0"
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
          // alert(email);
          var totalAmount =document.querySelector('input[name="amount"]:checked').value;
           if(totalAmount == "other"){

               totalAmount = document.getElementById('custom_amount').value;
           }else{
               $totalAmount = document.querySelector('input[name="amount"]:checked').value;
           }
           var ticket_count = document.querySelector('input[name="ticket_count"]:checked').value;
           var options = {
           "key": "rzp_live_5mA4A7HTopwv2e",
           "amount": (totalAmount*100), // 2000 paise = INR 20
           "name": "Weppl",
           "description": "Payment",
           "image": "{{asset('img/we-love-ppl.jpg')}}",
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
               "color": "#528FF0"
           }
         };
         var rzp1 = new Razorpay(options);
         rzp1.open();
         e.preventDefault();
  })
      </script>
