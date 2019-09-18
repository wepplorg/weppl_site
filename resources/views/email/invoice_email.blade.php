<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Weppl- Be Good, Buy Good.</title>
    <style>
        html {
            background-color: #f5f5f5;
        }
        body {
            background-color: #fff;
            padding: 40px;
        }
        .karma-stats {
            background: #f5f5f5;
            padding: 12px 6px;
            border-radius: 12px;
        }
        .karma-stats img {
            width: 60px;
            padding: 10px;
        }
        .karma-stats p {
            margin-bottom: 0.4rem;
        }
        .email-cta a {
            padding: 14px 60px;
            background: #ffd700;
            text-decoration: none;
            color: black;
            border-radius: 30px;
        }
        .email-footer-1 {
            margin-top: 20px;
            border-top: 1px solid #f5f5f5;
            padding: 20px;
        }
        .email-footer-1 a {
            margin: 0px 10px;
        }
    </style>
  </head>
  <body style="width:600px;margin: auto;">
        <div class="text-center mb-4">
            <img style="width:100%" src="https://ci6.googleusercontent.com/proxy/sa7QTylldZwuMlFUO7StiMqDdSDtn6frYkNIqFdTO-n2HwICQ4LC0FwNfp1Ew8ynEbs4n6j0J-_SPpZyFBblsho2SgdBL0Q=s0-d-e1-ft#https://support.weppl.org/img/changemaker-header.png" alt="You Are Changemaker!">
        </div>
        <div>
            <p>Hi {{$name}},</p>
            <p>Firstly, let me say thank you on behalf of entire Weppl team for your contribution on Weppl. You are now part of our family who is out there to make the world a better place.</p>
            <p>At any point you face any issues please use the support button on our page to reach out to us.</p>
            Sincerely,<br/>
            The Weppl Team<br/>
            <a href="https://weppl.org/"><img style="width:100px"src="https://support.weppl.org/img/Logo.png" alt="Weppl Logo"></a>
        </div>
        <div class="mt-4">
            <h4>Cause(s) you have Impacted:</h4>
            <div class="pb-3 mb-2" style="border-bottom:1px solid #f5f5f5;">
                <table style="margin-top: 16px;">
                
                    <tr style="padding: 20px">
                        <td style="padding-right: 16px;"><a href="{{url('beneficiary_detail/'.$beneficiary->slug)}}"><img style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; object-position: center;" src="{{$beneficiary->images->image}}" alt="Benificiary Image"></a></td>
                        <td style="text-align:left;"><a style="text-decoration:none; color: inherit;" href="#"><b>Benificiary: </b>{{$beneficiary->ngo_users->name}}<br/>
                            <b>Campaigner: </b>{{$beneficiary->users->name}}</td></a>
                    </tr>
                </table>
            </div>
            <!--<div class="pb-3 mb-2" style="border-bottom:1px solid #f5f5f5;">
                <table style="margin-top: 16px;">
                
                    <tr style="padding: 20px">
                        <td style="padding-right: 16px;"><a href="#"><img style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; object-position: center;" src="https://weppl.s3.ap-south-1.amazonaws.com/ngo/56/beneficiary/20/images/1556607922.png" alt="Benificiary Image"></a></td>
                        <td style="text-align:left;"><a style="text-decoration:none; color: inherit;" href="#"><b>Benificiary: </b><br/>
                            <b>Campaigner: </b>{{$beneficiary->users->name}}</td></a>
                    </tr>
                </table>
            </div>-->
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
        


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
