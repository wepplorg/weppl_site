<!doctype html>
<html lang="{{ app()->getLocale() }}">
   <head>
      @include('includes.head')
   </head>
   <body>
      <header>
         @include('includes.header')
      </header>
      <div id="form">
      	<div class="container form-sec">
	<!-- 	  <h2 class="text-center form-title">NGO REGISTRATION FORM</h2> -->
		  <div class="row justify-content-md-center">
		  	<div class="col-md-6">
		  	<div class="card">
              <div class="card-body">
  
		  <form method="" action="">

		   <!--  <div class="form-group ">
		      <input type="email" class="form-control" id="name" placeholder="NGO Name" name="" required>
		      <p id="NameErr" class="text-danger"></p>
		    </div>
		    <div class="form-group ">
		      <input type="email" class="form-control " id="email" placeholder="NGO Email" name="email" required>
		      <p id="EmailErr" class="text-danger"></p>
		     
		    </div>
		     <div class="form-group ">
		      <input type="text" class="form-control" id="phoneno" placeholder="Phone  Number" name="" required>
		      <p id="phonenoErr" class="text-danger"></p>
		    </div>
		    <div class="form-group ">
		      <input type="password" class="form-control" id="psword" placeholder="Create a Password" name="pswd"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
		       <p id="passwordErr" class="text-danger"></p>
			
		    </div>
		        <button type="submit" class="btn btn-success btn-block btn-lg" >Sign Up</button>
		        
		       <p class="text-center">By signing up you agree to our <a>Terms of Use</a> and <a>Privacy Policy</a></p> -->
		 
		  </form>
		  </div>
		  </div>
		  </div>
		</div><!--col-md-6-->
		</div><!--row-->
		</div><!--container-->
      </div><!--form-->
      <footer class="footer_sec">
         @include('includes.footer')
      </footer>
      <script>
  (function() {
  "use strict";
  window.addEventListener("load", function() {
    var form = document.getElementById("needs-validation");
    form.addEventListener("submit", function(event) {
      if (form.checkValidity() == false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add("was-validated");
    }, false);
  }, false);
}());
  </script>
   </body>
</html>