<title>weppl</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="{{asset('img/icons/fevicon.png')}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">

 

<!-- new design custom css and js -->
  <!-- Icons-->
    <link href="{{ asset('assets/@coreui/icons/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main styles for this application-->
    

    <link href="{{ secure_url('css/style.css')}}" rel="stylesheet">
    <link href="{{ secure_url('admin/css/style.css')}}" rel="stylesheet">
    <link href="{{ secure_url('css/sidenav.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mediaquery.css')}}">
    <!--<link href="{{ asset('assets/pace-progress/css/pace.min.css')}}" rel="stylesheet">-->
    
     
      
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>

     <!-- CoreUI and necessary plugins-->
    <script src="{{secure_url('assets/jquery/dist/jquery.min.js')}}"></script>
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="{{asset('assets/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/pace-progress/pace.min.js')}}"></script>
    <script src="{{asset('assets/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/@coreui/coreui/dist/js/coreui.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
     <!-- datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="{{asset('js/sticky.js')}}"></script>
    <script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0086/2507.js" async="async"></script>
    <script>
    $(document).ready(function() {
        $('.carousel-main').owlCarousel({
              items: 1,
              loop: true,
              autoplay: false,
              autoplayTimeout:1500,
              margin: 10,
              nav: true,
              dots:false,
              navText: ['<span class="fas fa-chevron-left fa-2x"></span>','<span class="fas fa-chevron-right fa-2x"></span>'],
         });
         $('#summernote').summernote({
                placeholder: 'Write',
                tabsize:2,
                height: 100
        });
        $('.partner-carousel').owlCarousel({
              items:5,
              loop: true,
              autoplay: false,
              autoplayTimeout:1500,
              margin: 10,
              nav: true,
              dots:false,
              navText: ['<span class="fas fa-chevron-left fa-2x"></span>','<span class="fas fa-chevron-right fa-2x"></span>'],
                responsive:{
                  0:{
                  items:2
                  },
                  500:{
                  items:2
                  },
                  600:{
                  items:2
                  },
                  700:{
                  items:3
                  },
                  1000:{
                  items:4
                  },
                  1100:{
                  items:5
                  },

                  }
         });
      
      // function setWindowHeight(){
      //         var windowHeight = window.innerHeight;
      //         document.getElementById('body').style.height = windowHeight + "px";
      // }        
     });
 
   </script>

