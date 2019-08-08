$("#new_password").on('keydown',function(e){
	//alert("hi");
	$("#confirm_password").prop('disabled',false);
});

//social share text fields enable
//facebook
$('#facebook').click(function() {
  if ($(this).is(':checked')) {
     $("#facebook_share").prop('disabled',false);
  }else{
      $("#facebook_share").prop('disabled',true);
  }
});

//twitter
$('#twitter').click(function() {
  if ($(this).is(':checked')) {
     $("#twitter_share").prop('disabled',false);
  }else{
      $("#twitter_share").prop('disabled',true);
  }
});


//delete 
$(".delete").on("submit", function(){
        return confirm("Are you sure want to delete?");
});

//logo size validation
function ValidateSize(file) {
        //var FileSize = file.files[0].size / 1024; // in MB
        // alert(FileSize);
         var size = file.files[0].size;

         if (size < 1048576) {
             //alert("file size is less than 1mb");
         } else {
             alert("file size should not exceed more than 1MB");
             $("#logo").val('');
             return false;
         }
}

function register_document(file){
	var size = file.files[0].size;
    
         if (size < 5242880) {
             //alert("file size is less than 1mb");
         } else {
             alert("file size should not exceed more than 5MB");
             $("#registration_document").val('');
             return false;
         }
}

function reg_12a_document(file){
   var size = file.files[0].size;
    
         if (size < 5242880) {
             //alert("file size is less than 1mb");
         } else {
             alert("file size should not exceed more than 5MB");
             $("#12a_reg_doc").val('');
             return false;
         }
}

function reg_80g_document(file){
	var size = file.files[0].size;
    
         if (size < 5242880) {
             //alert("file size is less than 1mb");
         } else {
             alert("file size should not exceed more than 5MB");
             $("#80g_reg_doc").val('');
             return false;
         }
}

function audi_stat_document(file){
	var size = file.files[0].size;
    
         if (size < 5242880) {
             //alert("file size is less than 1mb");
         } else {
             alert("file size should not exceed more than 5MB");
             $("#audi_statement").val('');
             return false;
         }
}

//word limit showing beneficiary creation time
//title
$('#title' ).keyup(function(){
    len = this.value.length
    if(len > 70){
        return false;
    }
    else if (len > 0) {
        $( "#remainingTC" ).html( "Remaining characters: " +( 70 - len ) );
    }
    else {
        $( "#remainingTC" ).html( "Remaining characters: " +( 70 ) );
    }
})

//short description
$('#summary' ).keyup(function(){
    len = this.value.length
    if(len > 160){
        return false;
    }
    else if (len > 0) {
        $( "#remainingSC" ).html( "Remaining characters: " +( 160 - len ) );
    }
    else {
        $( "#remainingSC" ).html( "Remaining characters: " +( 160 ) );
    }
})



