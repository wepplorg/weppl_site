<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Karla|Unica+One&display=swap" rel="stylesheet">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <style>
	  body {
		  width:600px;
		  background-color:#fff;
		  border: 1px solid #000;
	  }
	  .email-template-body {
		  padding: 20px;
	  }
	  .email-template-body p {
		  font-family: 'Karla', sans-serif;
		  font-size: 16px;
		  color: rgb(22, 22, 22);
  			line-height: 1.5;
  			text-align: left;
	  }
	  .benificiary-details {
		  padding:20px;
	  }
	  .benificiary-details h2, .karma-profile-details h2 {
		font-size: 18px;
		font-family: "Karla";
		color: rgb(22, 22, 22);
		font-weight: bold;
		line-height: 1.333;
		text-align: left;
	}

.social_media_links li{
  list-style: none;
}
.social_media_links{
	display: inline;
}
.social_media_links li a{
	color:#000;
}

</style>
</head>
<body>
<img src="{{asset('img/changemaker-header.png')}}" alt="You Are Changemaker!">
<div class="email-template-body">
	<p>Hi {{$name}},</p>
	<p>Firstly, let me say thank you on behalf of entire Weppl team for your donation for the cause "<b>{{$beneficiary->title}}</b>” listed on Weppl platform. You are now part of our family who is out there to make the world a better place.</p>
	<p>Firstly, let me say thank you on behalf of entire Weppl team for your contribution on Weppl. You are now part of our family who is out there to make the world a better place.</p>
	<p>At any point you face any issues please use the support button on our page to reach out to us.
	</p>
	<p>
	Sincerely,<br/>
	The Weppl Team<br/>
	<img src="logo" alt="Weppl Logo">
	</p>
</div>
<div class="benificiary-details">
<h2>Cause you have Impacted</h2>
<table style="widht:600px;">
	<tr>
		<td style="width: 60px; border-radius: 50%; float:left;"><img src="" alt="Benificiary Image"></td>
		<td><b>Benificiary: </b>Etika Khatoon<br/>
			<b>Campaigner: </b>VAANI Deaf Children's Foundation</td>
	</tr>
</table>
</div>
<div class="karma-profile-details">
<h2>Your Karma Profile</h2>
<table style="widht:600px;">
	<tr>
		<td style="width: 60px; border-radius: 50%; float:left;"><img src="" alt="Benificiary Image"></td>
		<td><b>Benificiary: </b>Etika Khatoon<br/>
			<b>Campaigner: </b>VAANI Deaf Children's Foundation</td>
	</tr>
</table>
</div>
<span>
<a href="https://www.instagram.com/weppl_org/" target="_blank"><img src="{{asset('img/socail_icons/Insta-35x35.png')}}"></a>
<a href="https://www.facebook.com/weppl.org" target="_blank"><img src="{{asset('img/socail_icons/FC_35x35.png')}}"></a>	
<a href="https://www.youtube.com/channel/UCmdoiAeJbx3gw6UdMYvieSQ" target="_blank"><img src="{{asset('img/socail_icons/Youtube_35x35.png')}}"></a>
<a href="https://twitter.com/weppl_org" target="_blank"><img src="{{asset('img/socail_icons/Twitter_35x35.png')}}"></a>
<a href="https://www.linkedin.com/company/weppl" target="_blank"> <img src="{{asset('img/socail_icons/linked_35x35.png')}}"></a>
</span>
</body>
</html>
