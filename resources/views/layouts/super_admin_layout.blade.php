<!doctype html>
<html>
<head>
    @include('includes.super_admin_head')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
   <header class="app-header navbar super_admin_header">
      @include('includes.super_admin_header')
   </header>
   <div class="app-body">
      <div class="sidebar">
         @include('includes.super_admin_sidebar')
      </div> 
      @yield('content')
   </div>
   @include('includes.super_admin_footer')
     <!-- CoreUI and necessary plugins-->
     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css">
    <script src="{{ asset('assets/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/pace-progress/pace.min.js')}}"></script>
    <script src="{{ asset('assets/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/@coreui/coreui/dist/js/coreui.min.js')}}"></script>
    <!-- Plugins and scripts required by this view-->
   <!-- <script src="{{ asset('assets/chart.js/dist/Chart.min.js')}}"></script>-->
    <script src="{{ asset('assets/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js')}}"></script>
    <!-- include summernote css/js -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
    <script src="{{ asset('admin/js/main.js')}}"></script>
    <script src="{{ asset('js/superadmin/ngo_profile.js')}}"></script>
    <script>
     $(document).ready(function(){
        $('#summernote').summernote({
           toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']],
              ['link', ['linkDialogShow', 'unlink']],
              ['insert',['picture']],
              ['popovers', ['lfm']]
            ],

        });
       /* var options = {
          filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
          filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace(summernote,{
            language:'en-gb'
          });*/

       



        $('#beneficairy_pending').DataTable( {
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ]
        });
        $("#beneficairy_approved").DataTable();
        $("#beneficairy_rejected").DataTable();
        $("#beneficairy_completed").DataTable();
        $("#donors_table").DataTable();

 //     var table = $('#ngo_pending').DataTable( {
 //        dom: 'Bfrtip',
 //        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
 //    } );
 
 // var table = $('#ngo_approved').DataTable( {
 //        dom: 'Bfrtip',
 //        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
 //    } );
    

        $('#ngo_approved').DataTable( {
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ]
        });
        $('#ngo_rejected').DataTable( {
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ]
        });
        $('#ngo_pending').DataTable( {
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ]
        });
        $("#categories").DataTable();

        //success alert
        
       $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#success-alert").slideUp(500);
        });   
       $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#success-alert").slideUp(500);
        });

        $("#donor_email").on('change',function(){
             var email = $(this).val();
             $.ajax({
                url:"{{url('admin/donor_email_check')}}",
                type:'GET',
                data:{email:email},
                dataType:'JSON',
                success:function(data){
                   if(data.success){
                      $("#error").html(data.success);
                      $("#donor_submit").prop("disabled",true);
                   }else{
                      $("#donor_submit").prop("disabled",false);
                   }
                }

             })
        })
     })
    </script>
</body>
</html>