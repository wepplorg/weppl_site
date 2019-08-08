<!DOCTYPE html>
<html lang="en">
<head>
  <title>weppl</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="{{ asset('css/payment.css')}}" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">

.payment_title{
   color:#006BA6;
   padding:0.5rem;
}
.gray_text,.gray_text a{
	color:#ccc;
}
.gray_text a{
	text-decoration: underline;
}
.grey_sec{
	padding:1rem 0;
}
footer,.address_sec{
	margin-bottom:0.4rem;

}
.logo_sec img{
	margin-bottom: -28px;
}
.invoice_sec{
	margin:0 1rem!important;

}

}
</style>
</head>
<body>

	<?php use NumberToWords\NumberToWords; ?>
	
	<header>
		<div class="container">
			  <div class="row log_sec">        
		        <div class="col-4">
		          <div class="text-center">
		            <img src="https://www.weppl.org/img/icons/weppl_logo.png" width="120" height="120"/>
		          </div>     
		        </div>
		    </div>
	     	<div class="row gray_text address_sec">
	     		<p class="text-center">Weppl Social Ventures Pvt Ltd| Workadda,2082,24th Main Rd,Vanganahalli,1st Sector,HSR Layout,Bengaluru,Karnataka,560102|www.weppl.org| admin@weppl.org</p>
	     	</div>
	      </div>
	</header>
	<div class="container-fluid ">
		<div class="row invoice_sec justify-content-center">
			<h3 class="payment_title text-center">Ackowledgement of Payment</h3>
		</div>
		<section class="payment_sec invoice_sec">
				<p>Receipt No: {{$order_id}} </p>
				<p>Date: {{date('Y F,d',strtotime($payment->created_at))}}</p>
				<p>You are awesome!</p>
				<p>A big thank you from weppl for your donation of Rs.{{$payment->amount}},through <a href="https://www.weppl.org">Weppl</a>,for the fundrasier "{{$beneficiary->title}}"</p>
				<p><b>Details of your Donation</b></p>
				<!--<p>Payment mode:ORDYYYYMMDDXXXX</p>-->
				<p>Date of Donation:{{date('Y F,d',strtotime($payment->created_at))}}</p>
				<p><b>Details of your Compaign</b></p>
			    <p>Campaign Name:{{$beneficiary->title}}</p>
				<p>Campaign Owner: {{$beneficiary->users->name}}</p>
		</section>
		<section class="grey_sec invoice_sec">
			<p class="gray_text">This document is only on acknowledgement of your payment.If you have donated to an organization,which is offering tex-exemption,you will receive the tax-exemption receipt once the NGO issues it.</p>
			<p class="gray_text">For further queries about your contribution,please write to admin@weppl.org</p>
		</section>
     </div>

     <footer align="center">
     <!--<footer class="row justify-content-center">

>>>>>>> d706c6ac5a10aca5543a6149e291e20e04bea321
     		<h5 class="text-center gray_text"><a href="https://www.weppl.org">www.weppl.org</a>| <a>admin@weppl.org</a></h5>

     </footer>-->
</body>
</html>