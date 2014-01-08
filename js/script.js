/**
 * @file
 * Javascript for itchefer theme.
 */

(function ($) {
  Drupal.behaviors.itchefer = {
    attach: function (context) {

     $(".block-menu-block ul.sub_menus li.active-trail ul.sub_menu3").css("display", "block");
     $(".block-menu-block ul.menu li.active ul.sub_menus").css("display", "block");
     $(".block-menu-block ul.menu li.active-trail ul.sub_menus").css("display", "block");

     $(document).ready(function(){
/* Menu active class */
        if (location.pathname.split("/")[1] && (location.pathname.split("/")[1] != 'dokumenter' || location.pathname.split("/")[1] != 'user')) {
          $('#block-system-navigation .nav li a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');    
          $('.region-sidebar-first .nav li a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');

        }
        if (location.pathname.split("/")[1] =='dokumenter') {
          $('#block-system-navigation .nav li a[href="/dokumenter"]').addClass('active');


     }
         $('#block-system-navigation .nav li a[href="/user/logout"]').css('font-weight','normal');
     });

  // End of attach
  }


// end of drupal.behaviors
}
})(jQuery);
