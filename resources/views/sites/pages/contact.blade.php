@extends('layouts.users')
@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<main>
   <div class="container-fluid">
     <div class="row justify-content-center">
      <h3 class="text-center contact_title">Contact Us</h3>
      </div>
      <div class="row plan_row contact_us_row">
         <div class="col-md-6">
            <div class="card">
               <div class="card-body">
                  <form id="contact_form" method="post" action="" role="form">
                     {{ csrf_field() }}
                     <div class="messages"></div>
                     <div class="controls">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_name">Firstname *</label>
                                 <input id="form_name" type="text" name="first_name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_lastname">Lastname *</label>
                                 <input id="form_lastname" type="text" name="last_name" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_email">Email *</label>
                                 <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_phone">Phone</label>
                                 <input id="form_phone" type="number" name="phone" class="form-control"  placeholder="Please enter your phone">
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="form_message">Message *</label>
                                 <textarea id="form_message" name="message" required class="form-control" placeholder="Message for me *" rows="4" required data-error="Please,leave us a message."></textarea>
                                 <div class="help-block with-errors"></div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <input type="submit" class="btn btn-success btn-send" value="Send message">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <!--card-->
         </div>
         <div class="col-md-1"></div>
         <div class="col-md-5">
           <address class="address_sec">
            <h5><b>Office:</b></h5>
             <p class="office">Weppl Social Ventures Pvt Ltd</p>
             <p>Workadda, 2082, 24th Main Rd,</p>
              <p>Vanganahalli, 1st Sector,</p> 
              <p>HSR Layout, Bengaluru,</p> 
              <p>Karnataka 560102.</p>
           </address>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.912097088233!2d77.64654831430389!3d12.91337101964852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1517241a0931%3A0xc3cf367d849d7cad!2sWorkAdda!5e0!3m2!1sen!2sin!4v1554372080316!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
         </div>
      </div>
   </div>
   <!-- success modal -->
   <!-- Modal HTML -->
   <div id="successModal" class="modal fade">
      <div class="modal-dialog modal-confirm modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <div class="icon-box">
                  <i class="material-icons">&#xE876;</i>
               </div>
               <h4 class="modal-title">Thank you for contacting us!</h4>
            </div>
            <div class="modal-body">
               <p class="text-center">we will get back to you!</p>
            </div>
            <div class="modal-footer">
               <button class="btn btn-success btn-block" data-dismiss="modal">Ok</button>
            </div>
         </div>
      </div>
   </div>
   <!-- end success modal -->
</main>
<script src="{{ asset('assets/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
   $("#contact_form").on('submit',function(e){
       e.preventDefault(e);
        var data= new FormData(this);
        $.ajax({
           url:"{{url('contact_store')}}",
           data:data,
           cache: false,
           processData: false,
           contentType: false,
           type: 'POST',
           success:function(data){
               if(data.success){
                     $('#contact_form').trigger("reset");
                     $("#successModal").modal("show");
               }
           }
        })
   });
</script>
@endsection