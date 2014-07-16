jQuery(function ($) {
    'use strict';

    // Helper for pym.js to pass the data-url attribute to it

    $("div.pym").each(function(i, el) {
        pym.Parent($(el).attr('id'), $(el).data('url'));
    });

    // Switch to mobile source for infographics when viewing on small screens

    if ($(window).width() <= 768) {
      $("img.infographic-img").removeAttr("src");
      $("img.infographic-img").attr("src", $("img.infographic-img").data('mobilesrc'));
    }

    // Make sure the triangle hover changes colour when you're hovering over the link above it

    $(".beta-message a").hover(function() {
      $(".triangle").toggleClass("hover");
    });

});
