$(document).ready(function($) {
  $("#formRestePassword").validate({
    rules: {
     password: {
       required: true,
       minlength: 8,
       strongPassword: true
     },
     confirm_password : {
     	required: true,
     }
   },
   messages: {
     
     password: {
       required: "Please enter your password",
       minlength: "Your password must be 8 characters",
       strongPassword: "Your password must be strong (include at least one uppercase letter, one lowercase letter, one digit, and one special character)"
     },
     confirm_password: {
       required: "Please enter your confirm password",
     }
   },
    errorElement: "div",
    errorPlacement: function(error, element)
    {
    	console.log(element)
      var element_id = element[0]['id'] ;
      error.appendTo(`#${element_id}Err`)
    },
    submitHandler: function(form) {
      var formdata = new FormData(form);
      $.ajax({
        url: "user/Login/reset_password_action",
        data:formdata,
        processData:false,
        contentType:false,
        cache:false,
        type:"post",
        success: function(result){
          var data = JSON.parse(result);
          if (data.success == 1) {
              toaster("success",data.messages);
              setTimeout(function () {
                window.location.href = base_url+data.redirect_url;
            }, 2000);
          }else{
            toaster("error",data.messages);
          }

        }
      });
    }

  });

  $.validator.addMethod("strongPassword", function(value, element) {
   return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
 }, "Your password must include at least one uppercase letter, one lowercase letter, one digit, and one special character");
 $("#clientId").select2({
  minimumResultsForSearch: Infinity
 })

 $(document).on("click","#pwd_show_hide i",function(){
   var status =  $(this).attr("data-status");
   console.log(status)
   if(status == "show"){
    $("#password").attr("type","text");
    $(this).removeClass("ti-lock").addClass("ti-lock-open").attr("data-status","hide");
   }else{
    $("#password").attr("type","password");
    $(this).removeClass("ti-lock-open").addClass("ti-lock").attr("data-status","show");
   }
 })




});
