$('#approve').click(function() {
  if ($(this).is(':checked')) {
     $("#comments").show();
  }else{
      $("#comments").hide();
  }
});

$('#reject').click(function() {
  if ($(this).is(':checked')) {
     $("#comments").show();
  }else{
      $("#comments").hide();
  }
});



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

$(".delete").on("submit", function(){
        return confirm("Are you sure want to delete?");
});


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