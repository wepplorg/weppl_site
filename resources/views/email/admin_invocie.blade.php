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
        width: 600px;
        background-color: #fff;
        text-align: center;
        /* border: 1px solid #000; */
        margin: auto;
        font-family: 'Karla', sans-serif;
	  }
	  .email-template-body {
		  padding: 20px;
	  }
	  .email-template-body p {
		  font-size: 16px;
		  color: rgb(22, 22, 22);
  			line-height: 1.5;
  			text-align: left;
	  }
	  .benificiary-details ,.karma-profile-details {
		  padding:20px;
          box-sizing: border-box;
	  }
	  .benificiary-details h2, .karma-profile-details h2 {
		font-size: 18px;
		color: rgb(22, 22, 22);
		font-weight: bold;
		line-height: 1.333;
		text-align: left;
	}
    .karma-profile-details tr {
        list-style: none;
        padding: 0px;
        margin-bottom: 40px;
    }
    .karma-profile-details td{
        display: inline-block;
        padding: 20px;
        text-align: center;
        max-width: 160px;
        border-radius: 20px;
        background: #f5f5f5;
        margin: 0px 20px;
    }
    .karma-profile-details td img{
        width: 40px;
        height: 40px;
        object-fit: cover;
        object-position: center;
    }
    .email-cta a {
        padding: 14px 60px;
        background: #ffd700;
        text-decoration: none;
        color: black;
        border-radius: 30px;
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
.email-footer-1 {
    margin-top: 20px;
    border-top: 1px solid #f5f5f5;
    padding: 20px;
}

</style>
</head>
<body>
<img src="https://support.weppl.org/img/changemaker-header.png">
<div class="email-template-body">
	<p>Hi {{$name}},</p>
	<p>Firstly, let me say thank you on behalf of entire Weppl team for your contribution on Weppl. You are now part of our family who is out there to make the world a better place.</p>
	<p>At any point you face any issues please use the support button on our page to reach out to us.
	</p>
	<p>
	Sincerely,<br/>
	The Weppl Team<br/>
	<img src="http://support.weppl.org/img/Logo.png">
	</p>
</div>
<div class="benificiary-details">
<h2>Cause you have Impacted</h2>
<table style="width:600px;">
	<tr>
		<td style="width: 60px; border-radius: 50%; float:left;"><img src="{{$beneficiary->images->image}}" alt="Benificiary Image"></td>
		<td style="text-align:left;"><b>Benificiary: </b>{{$beneficiary->ngo_users->name}}<br/>
			<b>Campaigner: </b>{{$beneficiary->users->name}}</td>
	</tr>
</table>
</div>
<div class="mt-4">
            <h4>Your Karma Profile:</h4>
            <div class="d-flex text-center mt-4 mb-4">
                <div class="row">
                    <div class="col-4">
                        <div class="karma-stats">
                            <img src="https://cdn.shopify.com/s/files/1/0259/4547/3117/files/how-it-works-1.png?1693" alt="Causes Impacted">
                            <p>Causes Impacted</p>
                            <h4>{{$total_impacted}}</h4>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="karma-stats">
                            <img src="https://cdn.shopify.com/s/files/1/0259/4547/3117/files/how-it-works-2.png?1693" alt="Total Contribution">
                            <p>Total Contribution</p>
                            <h4>{{$total_amount}}</h4>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="karma-stats">
                            <img src="https://cdn.shopify.com/s/files/1/0259/4547/3117/files/how-it-works-3.png?1693" alt="You are always awesome">
                            <h6>You are always awesome.</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 mb-5 email-cta text-center">
            <a href="https://weppl.org">Do More</a>
        </div>
        <div class="email-footer-1 text-center">
            <h2 class="mb-4">BE GOOD, BUY GOOD.</h2>
            <a href="https://www.instagram.com/weppl_org/" target="_blank"><img src="https://cdn.shopify.com/s/files/1/0259/4547/3117/files/instagram-icon.png?1697"></a>
            <a href="https://www.facebook.com/weppl.org" target="_blank"><img src="https://cdn.shopify.com/s/files/1/0259/4547/3117/files/facebook-icon.png?1697"></a>
            <a href="https://twitter.com/weppl_org" target="_blank"><img src="https://cdn.shopify.com/s/files/1/0259/4547/3117/files/twitter-icon.png?1697"></a>
            <a href="https://www.youtube.com/channel/UCmdoiAeJbx3gw6UdMYvieSQ" target="_blank"> <img src="https://cdn.shopify.com/s/files/1/0259/4547/3117/files/youtube-icon.png?1697"></a>
        </div>
        
</body>
</html>


