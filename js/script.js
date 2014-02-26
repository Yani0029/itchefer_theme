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
       $(".not-logged-in .view-dokumenter .views-exposed-form").css('display','none');
       $(".not-logged-in .view-display-id-attachment_1").removeClass("well");
        $(".node-type-itchefer-invoice .user-picture").css('display','none');
       $(".print-content .user-picture").css('display','none');
       $(".page-user- h3.location-locations-header").text("Fakturaadresse");
        /* Menu active class */
        if (location.pathname.split("/")[1] && (location.pathname.split("/")[1] != 'dokumenter' || location.pathname.split("/")[1] != 'user')) {
          $('#block-system-navigation .nav li a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');    
          $('.region-sidebar-first .nav li a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');

        }
        if (location.pathname.split("/")[1] =='dokumenter') {
          $('#block-system-navigation .nav li a[href="/dokumenter"]').addClass('active');


        }
        $('#block-system-navigation .nav li a[href="/user/logout"]').css('font-weight','normal');
        $('.view-search-user .feed-icon a').append('Exportér til xls');
        $('#block-system-main .views-field span.field-content img').css({'max-width':'100%','height':'inherit'});
     });
//        $('.view-search-user .feed-icon a').text().append('<img src="/sites/all/modules/views_export_xls/images/xls-icon.jpg" />');
     $(".main-container .button").addClass('btn');
     $('.author_date ul.list-inline li.comment-comments').append(' <i class="icon-bubble"><i> ');
  // End of attach
  }


// end of drupal.behaviors
}
})(jQuery);
