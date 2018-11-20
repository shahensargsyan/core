$(document).ready(function() {
    var disabled = false;
    var windowWidth = $(window).width();
    var isSidebarOpen = true;
  
    $('.sidebar-toggle').click(function() { 
        
        setSidebar(isSidebarOpen);
        isSidebarOpen = !isSidebarOpen; 
    });
   
    function setSidebar(state) {  
        if (state) {
            $('.MAIN-FIX-LEFT').addClass('hide-left-bar');
            $('.MAIN-FIX-CARCASS-PAD').addClass('modify-fix-carcass');
            $('.main-fix-top-fix-pad').addClass('modify-header');
        } else {
            $('.MAIN-FIX-LEFT').removeClass('hide-left-bar');
            $('.MAIN-FIX-CARCASS-PAD').removeClass('modify-fix-carcass');
            $('.main-fix-top-fix-pad').removeClass('modify-header');
        }
    };
    // ================TOASTER ==========================

    /*    toastr.options = {
           "closeButton": false,
           "debug": false,
           "newestOnTop": false,
           "progressBar": false,
           "positionClass": "toast-bottom-right",
           "preventDuplicates": false,
           "onclick": null,
           "showDuration": "30000",
           "hideDuration": "1000",
           "timeOut": "5000",
           "extendedTimeOut": "1000",
           "showEasing": "swing",
           "hideEasing": "linear",
           "showMethod": "fadeIn",
           "hideMethod": "fadeOut"
       }; */
});