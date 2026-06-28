$( document ).ready(function() {
    app.init();
});
var table_data ;
if($("body .dashboard-block").length == 0){
  // console.log("k")
$(document).ajaxStart(function() {
  if($("body").hasClass("modal-open")){
     setTimeout(function(){
       $(".main-loader-box").show();
       $("body").addClass("loader-show");
      },100)
  }else{
    $(".main-loader-box").show();
       $("body").addClass("loader-show");
  }
});
$(document).ajaxStop(function() {
  if($("body").hasClass("modal-open")){
    setTimeout(function(){
      $(".main-loader-box").hide();
      $("body").removeClass("loader-show");
    },1500)
  }else{
    $(".main-loader-box").hide();
      $("body").removeClass("loader-show");
  }
   
});
}
const app = {
  init: function(){
    this.toggleGrid();
    $(".dropdownUser").on("click",function(){
      if($(this).hasClass("inactive")){
        $(this).removeClass("inactive").addClass("active");
      }else{
        $(this).removeClass("active").addClass("inactive");
      }
      $(".dropdownUserNav").toggleClass("open-user-info-drop")
    })
   
        $("#close-vertical-btn").on("click",function(e){
          $('html').removeClass("layout-menu-hover")
            // $(this).find('i').removeClass("bx-chevron-right").addClass("bx-chevron-left")
        })
        $('#toggle-horizontal-menu-bar').on('click',function(){
          $('html').addClass("layout-menu-hover")
          
          // $(this).find('i').removeClass("bx-chevron-left").addClass("bx-chevron-right")
        });
      $(".menu-item").on("click",function(){
        
         if(!$(this).hasClass("open-menu")){
            $(this).addClass("open-menu")
         }else{
            $(this).removeClass("open-menu")
         }
         $(this).find('.menu-sub').slideToggle('slow')
      })

      $(".filter-icon,.close-filter-btn").on('click',function(){
        if($(".filter-popup-block").hasClass("show")){
          $(".filter-popup-block").removeClass("show")
          $(".filter-popup-block").animate({
            width: 0
          },100)
        }else{
          let width = 330;
          var viewportWidth = $(window).width();
          if( viewportWidth < 700){
              width = 253;
          }
          $(".filter-popup-block").addClass("show")
          $(".filter-popup-block").animate({
            width: width
          },100)
        }
        
      })
      $(".filter-row .search-show-hide").on("click",function(){
         var element = $(this).parents(".filter-row");
         var cursor_element = $(this).find("i.ti-minus");
         if(cursor_element.length > 0){
          $(this).html("<i class='ti ti-plus'></i>")
         }else{
          $(this).html("<i class='ti ti-minus'></i>")
         }
         $(element).find(".sidebar-item").toggle()
      })
      $("#downloadPDFBtn").on("click",function(){
          $(".buttons-pdf").trigger("click");
      })
      $("#downloadCSVBtn").on("click",function(){
          $(".buttons-csv").trigger("click");
      })
      $(".select2-init,.select2").select2();

      $(".breadcrumb .backlisting-link").attr("href","javascript:void(0)");
      $(".breadcrumb .backlisting-link").attr("title","");
      this.allowNumber();
      this.removeValidationMessage();
      this.initResponsive();
      $(".quick-menu-bar").on("click",function(){
        if($(this).hasClass("active")){
          $("#menu_overlay").removeClass("open");
          $(this).removeClass("active");
          $("body").removeClass("loader-show")
        }else{
          $("#menu_overlay").addClass("open");
          $(this).addClass("active");
          $("body").addClass("loader-show")
        }
        
      })
  },
  allowNumber:function(){
    $(document).on('keypress','.onlyNumericInput', function(event) {
      var charCode = (event.which) ? event.which : event.keyCode;

      var value = $(this).val();
      if (value.includes('.')  && charCode == 46 ) {
          event.preventDefault();
      }
        // Allow only digits (0-9) and some specific control keys
      if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
              event.preventDefault();
      }
      $(this).val(this.value.replace(/[^0-9.]/g, ''));
      console.log(this.value.replace(/[^0-9.]/g, ''));
        
    });
    $(document).on('input','.onlyNumericInput', function(event) {
      var charCode = (event.which) ? event.which : event.keyCode;

      var value = $(this).val();
      if (value.includes('.')  && charCode == 46 ) {
          event.preventDefault();
      }
        // Allow only digits (0-9) and some specific control keys
      if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
              event.preventDefault();
      }
      $(this).val(this.value.replace(/[^0-9.]/g, ''));
      console.log(this.value.replace(/[^0-9.]/g, ''));
        
    });
  },
  removeValidationMessage: function(){
    $(".modal").attr("tabindex","n")
    $(document).on("change input",".custom-form .required-input",function(){
        var value = $(this).val();
        if (value !=''){
          $(this).parents(".form-group").find("label.error").remove()
        }
    })
  },
  initResponsive: function(){
    var viewportWidth = $(window).width();
    // console.log(viewportWidth)
    // if(viewportWidth > 400 && viewportWidth < 500){
    //     var $element = $('.paginate_button.last');
            
    //       // Get the absolute position of the element
    //     var offset = $element.offset();
            
    //     // Get the current scroll position
    //     var scrollTop = $(window).scrollTop();
    //     var scrollLeft = $(window).scrollLeft();
            
    //         // Calculate the position relative to the viewport
    //     var relativeTop = offset.top - scrollTop;
    //     var relativeLeft = offset.left - scrollLeft;
    //     var elementWidth = $element.outerWidth();
    //     var elementHeight = $element.outerHeight();
    //     var relativeBottom = relativeTop + elementHeight;
    //     var relativeRight = relativeLeft + elementWidth;
    //     $(".dataTables_length label").attr("style","left:"+relativeLeft+"px")
    // }
    if( viewportWidth < 700){
        let that= this;
        $('.modal').on('shown.bs.modal', function () {
          if($(this).find(".dataTable.scrollable").length == 0){
            let element = $(this).find(".table.scrollable");
            that.initiateDataTableRes(element);
            $(this).find(".table-responsive").attr("style","width:96% !important");
          }
        });
        // this.initiateDataTableRes(".table.scrollable");
        // $(".dropdownUser").on("click",function(){
        //     $(this).parents(".dropdown").find(".dropdownUserNav").addClass("open-user-info-drop")
        // })
    }
    this.initiateDataTableRes(".table.scrollable.scrollable-seachable");

  }, 
  initiateDataTableRes: function(calss_val =""){
    // console.log(calss_val)
      var $targetElement = $('.table.scrollable');
      $($targetElement).addClass("w-100")
      var $previousElement = $targetElement.parent("div");
      $previousElement.addClass('table-responsive text-nowrap w-100');
        table_data = $(calss_val).DataTable({
            dom: "",
            searching: true,
            scrollX: true,
            scrollY: true,
            "ordering": false,
            "paging":false
           
        });
        
        $('#serarch-filter-input').on('keyup', function() {
            table_data.search(this.value).draw();
        });
      }
  ,
  toggleGrid: function(){
    $(".toggle-grid-btn li").on("click",function(){
      var type = $(this).attr("data-value");
      var parent_ele = $(this).parents(".toggle-grid-btn");
      
      if(!$(this).hasClass("active")){
        $(this).addClass("active");
        if(type == "Table"){
            $(parent_ele).find(".grid").removeClass("active");
            $(".grid-block").addClass("hide-grid-table");
            $(".dataTables_scroll").removeClass("hide-grid-table");
            $("body").removeClass("grid-layout");
        }else{
            $(parent_ele).find(".table").removeClass("active");
            $(".dataTables_scroll").addClass("hide-grid-table");
            $(".grid-block").removeClass("hide-grid-table");
            $("body").addClass("grid-layout");
        }
      }
      
    })
  }
}