$(document).ready(function($) {
  $("#formAuthentication").validate({
    rules: {
     email: {
       required: true,
       email: true
     },
     password: {
       required: true,
       // minlength: 8,
       // strongPassword: true
     }
   },
   messages: {
     email: {
       required: "Please enter your username",
       email: "Please enter a valid username"
     },
     password: {
       required: "Please enter your password",
       // minlength: "Your password must be 8 characters",
       // strongPassword: "Your password must be strong (include at least one uppercase letter, one lowercase letter, one digit, and one special character)"
     }
   },
    errorElement: "div",
    errorPlacement: function(error, element)
    {
      var element_id = element[0]['id'] ;
      error.appendTo(`#${element_id}Err`)
      // if(element[0].localName == "select"){
      //   $(element).parents("div").find(".select2-container").append(error);
      // }else{
      //   error.insertAfter( element );
      // }
    },
    submitHandler: function(form) {
      var formdata = new FormData(form);
      $.ajax({
        url: "user/Login/signin",
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

 $(document).on("click","#show_forgot_pwd",function(){
    $("#login_div").hide();
    $("#forgot_div").show();
    $(".error-msg").html("");
 })
 $(document).on("click","#back_to_login",function(){
    $("#login_div").show();
    $("#forgot_div").hide();
    $(".error-msg").html("");
 })

 $("#formRestePassword").validate({
    rules: {
     username: {
       required: true,
       email: true
     },
     // password: {
     //   required: true,
     //   // minlength: 8,
     //   // strongPassword: true
     // }
   },
   messages: {
     username: {
       required: "Please enter your username",
       email: "Please enter a valid username"
     },
     // password: {
     //   required: "Please enter your password",
     //   // minlength: "Your password must be 8 characters",
     //   // strongPassword: "Your password must be strong (include at least one uppercase letter, one lowercase letter, one digit, and one special character)"
     // }
   },
    errorElement: "div",
    errorPlacement: function(error, element)
    {
      var element_id = element[0]['id'] ;
      error.appendTo(`#${element_id}Err`)
      // if(element[0].localName == "select"){
      //   $(element).parents("div").find(".select2-container").append(error);
      // }else{
      //   error.insertAfter( element );
      // }
    },
    submitHandler: function(form) {
      var formdata = new FormData(form);
      $.ajax({
        url: "user/Login/reset_password",
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
               $("#back_to_login").trigger("click");
            }, 2000);
          }else{
            toaster("error",data.messages);
          }

        }
      });
    }

  });

});
