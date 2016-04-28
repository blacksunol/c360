function initMenu() {
  $('#menu-vertical ul').hide();
  $('#menu-vertical ul:first').show();
  $('div#menu-vertical li a').click(
    function() {
        $(this).next().slideToggle('normal');	
      }
    );
  }
$(document).ready(function() {initMenu();});