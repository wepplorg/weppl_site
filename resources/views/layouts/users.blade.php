<!doctype html>
<html lang="{{ app()->getLocale() }}">
   <head>
      @include('includes.head')
   </head>
   <body style="background-color:#fff;">
      <header>
         @include('includes.header')
      </header>
       <div class="clear"></div>
      <div id="main">
      	   @yield('content')
      </div>
      <div class="clear"></div>
       <footer class="footer_sec">
         @include('includes.footer')
      </footer>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140492425-1');
</script>
      <script>

$('.moreless-button').click(function() {
  $('.moretext').slideToggle();
  if ($('.moreless-button').text() == "Read more") {
    $(this).text("Read less")
  } else {
    $(this).text("Read more")
  }
});
// $('#beneficairy_pending').DataTable();
 $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#success-alert").slideUp(500);
        });   
       $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#success-alert").slideUp(500);
        });
      </script>
  </body>
  </html>
