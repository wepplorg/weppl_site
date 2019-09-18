@extends('layouts.users')
@section('content')
<?php 
 use App\Models\Payment;
?>
<main>
	<div class="container-fluid ">
     @if(Session::has('message'))
         <div class="row">
            <div class="col-md-12">
               <div class="alert alert-success" id="success-alert">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>{{ Session::get('message') }}</strong> 
               </div>
            </div>
        </div>
    @endif
    @if(Auth::user())
      <input type="hidden" id="email" value="{{Auth::user()->email}}">
      <input type="hidden" id="mobile_number" value="{{Auth::user()->mobile_no}}">
    @else

    @endif
		<h3 class="text-center bank_details_title"><b>{{$beneficiary->title}}</b></h3>
    <input type="hidden" id="beneficiary_id" value="{{$beneficiary->id}}">
		<div class="row beneficiary-row">
			<div class="col-md-8">
				<div class="card beneficiary_story_card">
           <div id="story_carousel" class="carousel slide" data-ride="carousel">
             <div class="carousel-inner">
               <div class="carousel-item active">
        					<div class="beneficiary_img_sec">
        				    <img src="{{$beneficiary->images->image}}" alt="image" width="100%" height="100%"/>
                  </div>
                </div>
                 <div class="carousel-item">
                   <div class="beneficiary_img_sec">
                    <img src="{{$beneficiary->images->image}}" alt="image" width="100%" height="100%"/>
                  </div>
                 </div>
              </div>
               <a class="carousel-control-prev" href="#story_carousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#story_carousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
            </div>
           <span class="donate_btn_sec">
            @guest
             <a href="#" class="btn btn-warning btn-lg mobile_donate_button float-left" data-toggle="modal" data-target="#without_login_donate">Donate Now</a>
              @else
                <button type="button" class="btn btn-warning  btn-lg mobile_donate_button float-left"  data-toggle="modal" data-target="#beneficiary_detail_modal">
                 Donate Now
                </button>
                @endguest
						 <div class="dropdown">
						  <button type="button" class="btn btn-primary btn-lg drop_down_share_btn float-right" data-toggle="dropdown">
						  <i class="fa fa-share-alt story_share_icon" aria-hidden="true"></i>Share this fundraiser
						  </button>
						  <div class="dropdown-menu">
						    <a class="dropdown-item facebook_text" href="https://www.facebook.com/sharer/sharer.php?u={{url('beneficiary_detail/'.$beneficiary->id)}}"><i class="fa fa-facebook facebook_icon" aria-hidden="true"></i>Facebook</a>
                 <!--<a class="dropdown-item whtsapp_text" href="https://wa.me/?text=http://jorenvanhocht.be"><i class="fa fa-whatsapp whatsapp_icon" aria-hidden="true"></i>Whatsapp</a> -->
						  </div>
						</div>
          </span>
					<ul class="nav nav-tabs bank_tabs" role="tablist">
					    <li class="nav-item">
					      <a class="nav-link active" data-toggle="tab" href="#home">About</a>
					    </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#documents">Documents</a>
              </li>
					    <li class="nav-item">
					      <a class="nav-link" data-toggle="tab" href="#menu1">Updates</a>
					    </li>
					</ul>
					  <!-- Tab panes -->
					  <div class="tab-content bank_tab_content">
					    <div id="home" class="container tab-pane active"><br>
					      <h5>About the Fundraiser</h5>
					       
                 <p class="read-more-content">{!! $beneficiary->description !!}</p>	     
					     		      
					    </div>
              <div id="documents" class="container tab-pane fade"><br>
                <h5>Related Documents</h5>
                
              </div>
					    <div id="menu1" class="container tab-pane fade"><br>
					      <h5>Updates</h5>
					      <!--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
					    </div>
					  </div><!--tab-content-->
			    </div><!--card-->
			  <div class="clearfix"></div>
				 <div class="card comments_sec">
				 	  <span class="total_comment"><i class="fa fa-comment-o" aria-hidden="true"></i>
	                 	<a href="#"  id="total_comment"> Comments</a></span>
	                 	<div class="card-body ">
                          <div class="row">
                          	<div class="col-1 col-sm-1 col-md-1 col-lg-1">
	                    		  <img src="{{asset('img/icons/Avatar.png')}}" alt="avatar" />
	                    	    </div>
                          	<div class="col-10 col-sm-8 col-md-8 col-lg-9">
                          	<form action="" class="comment_form_sec" id="comment_form" method="POST" role="form">
                          		{{ csrf_field()}}
                          		<input type="hidden" name="beneficiary_id"  value="{{$beneficiary->id}}">
            							    <div class="form-group">
            							      <textarea class="form-control" rows="1" id="comment" name="message" placeholder="Write something" required></textarea>
            							   </div>
            							
                          </div>
                          <div class="col-12 col-sm-3 col-md-3 col-lg-2">
                           
                             @guest
                              <a href="{{route('login')}}" class="btn btn-success post_btn">Post</a>
                             @else
                          	 <input type="submit" class="btn btn-success post_btn" value="Post">
                          	 @endguest
                          
                           </form>
                           </div>
                      </div><!--row-->
                        <hr>
	                      <div class="row comment_row" id="comment_row">
	                      </div>
	                 </div><!--card-body-->
                 </div><!--card-->
              <div class="clearfix"></div>
                         
			</div><!--col-md-8-->

			<div class="col-md-4">
               @guest
                 <button type="button" class="btn btn-warning  btn-block beneficiary_donate_btn text-white"  data-toggle="modal" data-target="#without_login_donate">
                 Donate Now
              </button>
                @else
                <button type="button" class="btn btn-warning  btn-block beneficiary_donate_btn text-white"  data-toggle="modal" data-target="#beneficiary_detail_modal">
                 Donate Now
              </button>
                @endguest
                <div class="progress_sec">
                      <?php $raised_amount = Payment::where('beneficiary_id','=',$beneficiary->id)->where('payment_status','=','Success')->sum('amount'); 
                             $count_people = Payment::where('beneficiary_id','=',$beneficiary->id)->where('payment_status','=','Success')->groupBy('user_id')->get();
                           if($raised_amount){
                               $percentage = round(($raised_amount/$beneficiary->goal_amount)*100); 
                             }else{
                                 $percentage=0;
                             }
                      ?>
                        <span>Raised of
                        	<span class="left_beneficiary-text">{{moneyFormat($raised_amount,'INR')}}</span>
                        </span>
                        <span class="right_beneficiary-text">{{$percentage}}%</span>
                        <div class="clearfix"></div>
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="max-width:{{$percentage}}%">
                            </div>
                          </div>
                          <span><b>{{ count($count_people)}}</b> Supporters</span>
                          <?php $date = Carbon\Carbon::parse($beneficiary->end_date);
                                $current= $date->diffInDays();?>
                          <span class="text-right"><b>{{$current}}</b> days left</span>
                            <div class="clearfix"></div>
                    </div>
               <div class="clearfix"></div>
                <button type="button" class="btn btn-success btn-block beneficiary_rupee_btn">{{moneyFormat($beneficiary->goal_amount, 'INR')}}</button>
                    <div class="clearfix"></div>
                    <div class="card contact_card">
                    	<div class="card-body">
                         <div class="row justify-content-end contact_sec">
                         	    <a href="#">Contact</a>
                         </div>
                    	<div class="row">

                    	<!-- 	<div class="col-3 col-md-4 col-lg-3 col-xl-3">
                    			 <img src="{{asset('img/icons/Avatar.png')}}" alt="avatar" width="100%"/>
 -->
                    		<div class="col-3 col-md-4 col-lg-3">
                    			 <img src="{{$beneficiary->users->ngo_profiles->logo}}" alt="avatar" width="100%"/>

                    		</div>
                    		<div class="col-9 col-md-8 col-lg-9 col-xl-9">
                    			<p>Campaigner </p>
                    			<p><b>{{$beneficiary->users->name}}</b></p>
                    			<span>{{$beneficiary->users->ngo_profiles->cities->city_name}},{{$beneficiary->users->ngo_profiles->states->state_name}}
                    			<a href="#" class="text-right">Verified</a></span>
                    		</div>
                    	</div>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="card contact_card">
                    	<div class="card-body">
                     	<div class="row">

                     <!-- 		<div class="col-3 col-md-4 col-lg-3 col-xl-3">
                     		 <img src="{{asset('img/icons/Avatar.png')}}" alt="avatar" width="100%"/> -->

                     		<div class="col-3 col-md-4 col-lg-3">
                     		 <!--<img src="{{asset('img/icons/Avatar.png')}}" alt="avatar" width="100%"/>-->

                    		</div>
                    			<div class="col-9 col-md-8 col-lg-9 col-xl-9">
                    			<p>Beneficiary </p>
                    			<p><b>{!! $beneficiary->ngo_users->name !!}</b></p>
                    			<p>{{$beneficiary->location}}</p>
                    		</div>
                    	</div>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="card donors-card">
                    	<div class="card-header">
                    			<div class="row">
                    			<div class="col-2 col-md-3 col-lg-2">
                    				<img src="{{asset('img/icons/5.png')}}" alt="" width="100%"/>
                    			</div>
                    			<div class="col-10 col-md-9 col-lg-10">
                    				<h5>Top Donors</h5>
                    			</div>
                    		</div>
                    	</div>
                    	<div class="card-body beneficiary_right-panel">
                    		<div class="row right-panel" id="top_donors">
                    		</div>
                    	</div>
                    </div><!--card-->
                    <div class="clearfix"></div>
                     <!--<div class="card donors-card">
                    	<div class="card-header">
                    			<div class="row">
                    				<div class="col-2 col-md-3 col-lg-2">
                    				   <img src="{{asset('img/icons/6.png')}}" alt="" width="100%"/>
                    			    </div>
                    			    <div class="col-10 col-md-9 col-lg-10">
                    				    <h5>Most Raised from Social Sharing</h5>
                    			    </div>
                    		    </div>
                    	</div>
                    	<div class="card-body beneficiary_right-panel">
                    		<div class="row right-panel">
                    			<div class="col-3 col-md-4 col-lg-3">
                    				<img src="{{asset('img/icons/SP.png')}}" alt="avatar" width="100%"/>
                    			</div>
                    			<div class="col-4 col-md-4 col-lg-4">
                    				<p class="right-panel_text">Seetal P</p>
                    			</div>
                    				<div class="col-5 col-md-4 col-lg-5">
                    				<i class="fa fa-inr right-panel_text" aria-hidden="true"></i>2500
                    			</div>
                    			
                    		</div>
                    		
                    		<div class="row right-panel">
                    			<div class="col-3 col-md-4 col-lg-3">
                    				<img src="{{asset('img/icons/SC.png')}}" alt="avatar" width="100%"/>
                    			</div>
                    			<div class="col-4 col-md-4 col-lg-4">
                    					<p class="right-panel_text">Sham</p>
                    			</div>
                    			<div class="col-5 col-md-4 col-lg-5">
                    				<i class="fa fa-inr right-panel_text" aria-hidden="true"></i>5000
                    			</div>
                    			
                    		</div>

                    		<div class="row">
                    			<div class="col-4 col-md-3 col-lg-4"></div>
                    			<div class="nav-item dropdown">
								    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Show more</a>
								    <div class="dropdown-menu">
								      <a class="dropdown-item" href="#">Link 1</a>
								     
								    </div>
								  </div>
                    		</div>
                    	</div>
                    </div>--><!--card-->
                     <!--<div class="card donors-card">
                    	<div class="card-header">
                    			<h5>{{count($beneficiary->payments)}} Supporters</h5>		
                    	</div>
                    	<div class="card-body beneficiary_right-panel">
                        @foreach($beneficiary->payments as $payment)
                    		<div class="row right-panel">
                    			<div class="col-3 col-md-4 col-lg-3">
                    				<img src="{{asset('img/icons/SP.png')}}" alt="avatar" width="100%"/>
                    			</div>
                    			<div class="col-4 col-md-4 col-lg-6">
                    				<p class="right-panl_text">{{$payment->users->name}}</p>
                    				<p class="right-panel_sub_text"></p>
                    			</div>
                    			<div class="col-5 col-md-4 col-lg-3">
                    				{{ moneyFormat($payment->amount,'INR')}}
                    			</div>	
                    		</div>
                        @endforeach
                    		
                    	
                    	</div>
                    </div>--><!--card-->
                   
			</div><!--col-md-4-->
		</div><!--row-->
	</div><!--container-->

  <!-- without login donate modal -->
<!-- The Modal -->
  <div class="modal donation_modal" id="without_login_donate">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">      
           
        <!-- Modal Header -->
        <div class="modal-header "> 
          <div class="text-center">     
          <h5 class="modal-title">Donate without Login  &nbsp;or&nbsp;
              <a href="{{url('login')}}" class="btn btn-primary modal_login_button">Log in </a>
          </h5>
        </div>
          <button type="button" class="close " data-dismiss="modal">&times;</button>  
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
         <form id="donate_without_login_deatil" method="POST" action=""> 
          <input type="hidden" id="beneficiary_id" value="{{$beneficiary->id}}">
           <h5 class="text-center pb-2">Please fill your details</h5>
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
             <label class=" " ><h5>Donate as anonymous?</h5></label>
             <div class="row justify-content-center">
              <input type="radio" name="ticket_count"  class="required" required value="1" style="margin-right:0.3rem;padding:0.5rem;">Yes &nbsp;&nbsp;
              <input type="radio" name="ticket_count" checked class="required" required value="0" style="margin-right:0.3rem;padding:0.5rem;">No
             </div>
           </div>
          </div>  
         <div class="row justify-content-center donate_amount_sec">
            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="other_amount">
              <label class="btn btn-light active">
                <input type="radio" name="with_out_login_amount" id="option1" autocomplete="off" required checked value="50"> 50
              </label>
              <label class="btn btn-light">
                <input type="radio" name="with_out_login_amount" id="option2" autocomplete="off" required value="100"> 100
              </label>
              <label class="btn btn-light">
                <input type="radio" name="with_out_login_amount" id="option3" autocomplete="off" value="other"> Other Amount
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
  <div class="modal donation_modal" id="beneficiary_detail_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <span class="row">
              <div class="col-md-3"></div>
            <h5 class="modal-title col-10 col-md-6">Choose Donation Amount</h5>
            <button type="button" class="close col-2 col-md-3" data-dismiss="modal">&times;</button>
           </span>
          </div>
          <div class="modal-body">
          <div class="row justify-content-center">
            <div class="form-group">
             <label class=" " ><h4>Donate as anonymous?</h4></label>
             <div class="row justify-content-center">
              <input type="radio" name="ticket_count" checked class="required" required value="1" style="margin-right:0.3rem;padding:0.5rem;">Yes &nbsp;&nbsp;
              <input type="radio" name="ticket_count" class="required" required value="0" style="margin-right:0.3rem;padding:0.5rem;">No
             </div>
           </div>
          </div>  
         <div class="row justify-content-center donate_amount_sec">
            <div class="btn-group btn-group-toggle" data-toggle="buttons" id="other_amount">
              <label class="btn btn-light active">
                <input type="radio" name="amount" id="option1" autocomplete="off" required checked value="1"> 1
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
              <button id="buy_now" class="btn btn-success btn-md buy_now_detail">Proceed To Pay</button>
          </div>
      </div>
    </div>
  </div>
  <!-- End of payment modal -->

  <!-- payment success modal -->
     <div class="modal fade" id="success_payment">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>
                    <div class="modal-body">   
            <div class="thank-you-pop">
              <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
              <h1>Thanks for  Your supporting!</h1>
              <p></p> 
            </div>     
                </div>
                </div>
            </div>
        </div>

  <!-- end of payment success modal -->




</main>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script> 
<script type="text/javascript">
  var beneficiary_id = "{{$beneficiary->id}}";
   $.ajax({
   	  url:"{{url('get_comments')}}",
   	  type:'GET',
   	  data:{beneficiary_id:beneficiary_id},
   	  dataType:'JSON',
   	  success:function(data){
   	  	  //console.log(data.success);
   	  	  var total ='';
   	  	  $("#total_comment").html(data.success.length +" Comments");
   	  	  var empty='';
          $.each(data.success,function(index,value){
              empty +='<div clas="col-1 col-md-1">';
              empty +='<img src="{{asset('img/icons/Avatar.png')}}" alt="avatar">';
              empty +='</div>'; 
              empty +='<div class="col-9 col-md-11">';
              empty +='<div class="row comment_content_sec">';
              empty +='<div class="col-md-4 col-lg-3">';
              empty +='<p><b>'+value.users.name+'</b></p>';
              empty +='</div>';
              empty +='<div class="col-md-3 col-lg-3">';
              empty +='<p>'+value.time+'</p>';
              empty +='</div>';
              empty +='<div class="col-md-12">';
              empty +='<p>'+value.message+'</p>';
              empty +='</div>';
              empty +='</div>';
              empty +='</div>';
          });
          $("#comment_row").html(empty);
   	  }
   });

  $("#comment_form").on('submit',function(e){
  	  e.preventDefault(e);
  	 // alert("hi");
  	  var data= new FormData(this);
        $.ajax({
           url:"{{url('comment_store')}}",
           data:data,
           cache: false,
           processData: false,
           contentType: false,
           type: 'POST',
           success:function(data){
           	   var empty ='';
               $("#comment_form")[0].reset();
              // var url = "{{url('beneficiary_detail/'.$beneficiary->slug)}}";
           	   $("#comment_row").load("#comment_row"); 
               if(data.success){
                   $.each(data.success,function(index,value){
                    
		              empty +='<div clas="col-md-1">';
		              empty +='<img src="{{asset('img/icons/Avatar.png')}}" alt="avatar">';
		              empty +='</div>'; 
		              empty +='<div class="col-md-11">';
		              empty +='<div class="row comment_content_sec">';
		              empty +='<div class="col-md-4">';
		              empty +='<p><b>'+value.users.name+'</b></p>';
		              empty +='</div>';
		              empty +='<div class="col-md-3">';
		              empty +='<p>'+value.time+'</p>';
		              empty +='</div>';
		              empty +='<div class="col-md-12">';
		              empty +='<p>'+value.message+'</p>';
		              empty +='</div>';
		              empty +='</div>';
		              empty +='</div>';
                     
		          });             
                  var total ='';
                  $("#comment").val('');
   	  	          $("#total_comment").html(data.success.length +" Comments");
                 
		              $("#comment_row").html(empty);
               }
           }
        })
  });

//dispalying the top donors
$.ajax({
    url:"{{url('top_donors')}}",
    type:'GET',
    data:{beneficiary_id:"{{$beneficiary->id}}"},
    dataType:'JSON',
    success:function(data){
        var empty='';
        $.each(data,function(index,value){
            empty +='<div class="col-3 col-md-3 col-md-4 col-lg-3">';
           // empty +='<img src="{{asset('img/icons/SP.png')}}" alt="avatar" width="100%"/>';
            empty +='</div>';
            empty +='<div class="col-6 col-md-4 col-lg-4">';
            if(value.tickets_count == 1){
               empty +='<p class="right-panel_text">'+"Anonymous"+'</p>';
            }else{
                empty +='<p class="right-panel_text">'+value.users.name+'</p>';
            }    
            empty +='</div>';
            empty +='<div class="col-3 col-md-4 col-lg-5">';
            empty +='<i class="fa fa-inr right-panel_text" aria-hidden="true"></i>'+value.amount+'';
            empty +='</div>';
           
        });
       $("#top_donors").html(empty);
    }
})

//amount customization
$(document).ready(function(){
   $("#option3").on('click',function(){
 // alert("hi");  
   var value =document.querySelector('input[name="amount"]:checked').value;
   if(value == "other"){
    //alert("hi");
     $("#amount_other").show();
     $("#other_amount").hide();
     $(".amount").prop('required',false)
     
   }else{

   }
 })
})


//read less and more 
 $('.read-more-content').addClass('hide_content')
            $('.read-more-show, .read-more-hide').removeClass('hide_content')

            // Set up the toggle effect:
            $('.read-more-show').on('click', function(e) {
              $(this).next('.read-more-content').removeClass('hide_content');
              $(this).addClass('hide_content');
              e.preventDefault();
            });

            // Changes contributed by @diego-rzg
            $('.read-more-hide').on('click', function(e) {
              var p = $(this).parent('.read-more-content');
              p.addClass('hide_content');
              p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
              e.preventDefault();
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
         $('body').on('click', '.buy_now_detail', function(e){
          //alert("hi");
           var totalAmount =document.querySelector('input[name="amount"]:checked').value;
           if(totalAmount == "other"){

               totalAmount = document.getElementById('custom_amount').value;
           }else{
               totalAmount = document.querySelector('input[name="amount"]:checked').value;
           }
          // alert(totalAmount);
           var product_id =document.getElementById('beneficiary_id').value;
           //alert(product_id);
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
               "color": "#FFD700"
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
  $("#donate_without_login_deatil").on('submit',function(e){
          // alert("hi");
          e.preventDefault();
          var name=document.getElementById('name').value;
          var email=document.getElementById('email').value;
          var mobile_number=document.getElementById('mobile_number').value;
          var product_id =document.getElementById('beneficiary_id').value;
           //alert(email);
          var totalAmount =document.querySelector('input[name="with_out_login_amount"]:checked').value;
           if(totalAmount == "other"){

               totalAmount = document.getElementById('custom_amount').value;
           }else{
               $totalAmount = document.querySelector('input[name="with_out_login_amount"]:checked').value;
           }
           var ticket_count = document.querySelector('input[name="ticket_count"]:checked').value;
           var options = {
           "key": "rzp_live_FCT6BUW05yQpLf",
           "amount": (totalAmount*100), // 2000 paise = INR 20
           "name": "Weppl",
           "description": "Payment",
           "image": "{{secure_asset('img/weppl-logo.png')}}",
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
