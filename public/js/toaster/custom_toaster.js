const button = document.querySelector("button"),
toast = document.querySelector(".toast");
closeIcon = document.querySelector(".close"),
progress = document.querySelector(".progress");
let timer1, timer2;
$(document).ready(function () {

$(".button").click(function () {
   toaster("warning");

});

$(document).on("click",".fa-xmark", function(){
  $(".toast").remove()
  setTimeout(() => {
     $(".progress").removeClass("active");
  }, 300);
    clearTimeout(timer1);
    clearTimeout(timer2);
});

});
function toaster(type,message){
	clearTimeout(timer1);
    clearTimeout(timer2);
    var element = '';
    message = (message != "" && message != undefined && message != null) ? message :'';
     $(".toast").remove()
     var icon_class = "";
     var progress_class = "";
     var text_msg = '';
		  	if(type == "success"){
		  		icon_class = "fa-check";
		  		progress_class = "success";
		  		text_msg =  "Success";
			}else if(type == "error"){
				icon_class = "fa-times";
		  		progress_class = "fail";
		  		text_msg =  "Failure";
			}else if(type == "warning"){
				icon_class = "fa-exclamation-triangle";
		  		progress_class = "warning";
		  		text_msg =  "Warning";
				$(".toast-content i ").attr("class","").addClass("fas fa-solid fa-exclamation-triangle")
				$(".toast .progress").attr("class","").addClass("progress warning active")
				$(".toast-content .message .text-1").html("Warning");
			}
		$(".outer-div-box").append(`<div class="toast"><div class="toast-content"><i class="fas fa-solid ${icon_class}"></i><div class="message">
                <span class="text text-1">${text_msg}</span><span class="text text-2">${message}</span></div>
            </div><i class="fa-solid fa-xmark close"></i><div class="progress ${progress_class} "></div></div>`);
		
		 setTimeout(() => {
    		element  = $(".toast").addClass("active")
					$(".progress").addClass("active")
		    }, 500);
		  timer1 = setTimeout(() => {
		    $(".toast").removeClass("active");
		   
		  }, 5000); //1s = 1000 milliseconds

		  timer2 = setTimeout(() => {
		    $(".progress").removeClass("active");
		    $(".toast").remove();
		  }, 5300);

 //  	},700)						
    
	
}