$(document).ready(function() {

    $('#tabs li a:not(:first)').addClass('inactive');
    $('.tab-page').hide();
    $('.tab-page:first').show();
  
    $('#tabs li a').click(function() {
      var t = $(this).attr('id');
      if ($(this).hasClass('inactive')) { //this is the start of our condition 
        $('#tabs li a').addClass('inactive');
        $(this).removeClass('inactive');
  
        $('.tab-page').hide();
        $('#' + t + 'C').fadeIn('fast');
      }
    });

    
  
});