@extends('layouts.users')
@section('content')
<main>
   <div class="container-fluid" style="margin-top:5rem; margin-bottom:5.5rem;" >
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card-group ">
               <div class="card p-4">
                  <h3 class="text-center"><b>Join Us!</b></h3>
                  <!--  <p class="text-center"></p> -->
                  <div class="form-group">
                     <label for="document">First Name*</label>
                     <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname" required="required" data-error="Firstname is required.">
                  </div>
                  <div class="form-group">
                     <label for="document">Last Name*</label>
                     <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname" required="required" data-error="Lastname is required.">
                  </div>
                  <div class="form-group">
                     <label for="document">Email*</label>
                     <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email" required="required" data-error="Valid email is required.">
                     <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group row">
                     <label for="document" class="col-md-12">Upload Resume</label>
                     <span class="col-md-12">
                     <input type="file" name="document"   accept=".pdf,.docx,"> </span>   
                  </div>
                  <button type="button" class="btn btn-success btn-block ">Signup</button>
               </div>
               <div class="card text-white login_right_sec d-md-down-none" style="width:44%">
                  <div class="card-body right_content">
                     <div>
                        <p class="text-center">"Passion is the difference between having a job or having a career."</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</main>
@endsection