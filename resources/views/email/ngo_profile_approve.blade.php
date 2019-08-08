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
<p>
   Your account has been approved. You can start adding beneficiaries to raise funds. Kindly log in to get started.
</p>
<p>At any point you face any issues please use the support button on our page to reach out to us.</p>
<p>Alternatively, you can click the following link to reach out to us <a href="https://www.weppl.org/contact">click here</a></p>

<div>	
<p>
Sincerely,<br/>
The weppl Team.
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
