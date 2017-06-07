/* globals $ */

var dxw = window.dxw || {};

dxw.ToggleMenu = (function($) {
  'use strict';
  var init = function () {
    $('button.navigation-toggle').click(function () {
      if ($('div.menu-header').hasClass('expanded')) {
        $('div.expanded').removeClass('expanded').slideUp(250)
        $(this).removeClass('open')
      } else {
        $('div.menu-header').addClass('expanded').slideDown(250)
        $(this).addClass('open')
      }
    })
  };
  return {
    init: init
  };
})($);

module.exports = dxw.ToggleMenu;
