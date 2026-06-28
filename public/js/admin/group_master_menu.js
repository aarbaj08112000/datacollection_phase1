var table = '';
var file_name = "process";
var pdf_title = "Process";

$(document).ready(function() {
	// alert("ok");
    
    group_master.init();

    // Custom search filter event
  


});

const group_master = {
    init: function(){
        this.updateForm();
        $(".extend-icon").on("click",function(){
            $(this).parents(".menu-category-block").find(".category-menu-list").slideToggle();
            $(this).toggleClass("close");
        })
    },
    updateForm: function(){
        $('#updateGroupMenuRight').validate({
            rules: {
                namess: {
                    // required: true
                }
            },
            messages: {
                namess: {
                    // required: "Please enter the process name."
                }
            },
            submitHandler: function(form) {
                // Submit the form via AJAX
                $.ajax({
                    url: "user/user/updateGroupMenuRight", // Use the form's action attribute as the URL
                    type: 'POST',
                    data: new FormData(form), // Send the form data
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Parse the JSON response
                        let res = JSON.parse(response);
                        console.log(res.message)
                        if(res.success == 1){
                            // Show success message
                            toaster("success",res.message);
                            setTimeout(() => {
                                window.location.href = base_url+"group_master";
                                // window.location.reload();
                            },1000);
                        } else {
                            // Show error message
                            toaster("error",res.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle the error
                        toastr.error('An error occurred: ' + errorThrown);
                    }
                });
                return false; // Prevent the default form submission
            }
        });
    }
}
