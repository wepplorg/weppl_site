<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <style>
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
<p>Hi {{$name}},</p>

<p>Firstly, let me say thank you on behalf of entire Weppl team for your donation for the cause "<b>{{$beneficiary->title}}</b>” listed on Weppl platform. You are now part of our family who is out there to make the world a better place.</p>
<p>We have attached an acknowledgement receipt of your payment. If you have donated to an organization which is offering tax-exemption, you will receive the tax-exemption receipt once the NGO issues it. For any information about the status of your order, please mail <a href="support@weppl.org">support@weppl.org</a>
</p>
<p>At any point you face any issues please use the support button on our page to reach out to us.
</p>
<div>
<p>
Sincerely,<br/>
The weppl Team,
</p>
<span>
<a href="https://www.instagram.com/weppl_org/" target="_blank"><img src="{{asset('img/socail_icons/Insta-35x35.png')}}"></a>
<a href="https://www.facebook.com/weppl.org" target="_blank"><img src="{{asset('img/socail_icons/FC_35x35.png')}}"></a>	
<a href="https://www.youtube.com/channel/UCmdoiAeJbx3gw6UdMYvieSQ" target="_blank"><img src="{{asset('img/socail_icons/Youtube_35x35.png')}}"></a>
<a href=" https://twitter.com/weppl_org" target="_blank"><img src="{{asset('img/socail_icons/Twitter_35x35.png')}}"></a>
<a href=" https://www.linkedin.com/company/weppl" target="_blank"> <img src="{{asset('img/socail_icons/linked_35x35.png')}}"></a>
</span>
</div>

</body>
</html>
