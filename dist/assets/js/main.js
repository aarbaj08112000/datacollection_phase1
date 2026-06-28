
$( document ).ready(function() {
    app.init();
});

const app = {
  init: function(){
   $('[data-toggle="tooltip"]').tooltip();
      // $(document).on("click",'.layout-menu-toggle',function(){
      //     if($(this).find('i').hasClass("bx-chevron-right")){
      //         $(this).find('i').removeClass("bx-chevron-right").addClass("bx-chevron-left")
      //         $('html').addClass("layout-compact").removeClass("layout-menu-collapsed").removeClass("layout-menu-hover")
      //     }else{
      //         $('html').removeClass("layout-compact").addClass("layout-menu-collapsed")
      //         $(this).find('i').removeClass("bx-chevron-left").addClass("bx-chevron-right")
      //         $(this).addClass("hide")
      //     }

      // })

      // $("#layout-menu").on("mouseover",function(){
      //   if(!$('html').hasClass("layout-compact")){
      //     $('html').addClass("layout-menu-hover")

      //   }
      //     // $(this).find('i').removeClass("bx-chevron-right").addClass("bx-chevron-left")
      // })
      // $('#layout-menu').on('mouseleave',function(){
      //   if(!$('html').hasClass("layout-compact")){
      //       $('html').removeClass("layout-menu-hover")
      //   }
        
      //   // $(this).find('i').removeClass("bx-chevron-left").addClass("bx-chevron-right")
      // });
      $(".menu-item").on("click",function(){
        
         if(!$(this).hasClass("open-menu")){
            $(this).addClass("open-menu")
         }else{
            $(this).removeClass("open-menu")
         }
         $(this).find('.menu-sub').slideToggle('slow')
      })
  }
}