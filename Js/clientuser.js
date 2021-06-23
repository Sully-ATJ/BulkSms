$(document).ready(function() {

    $('.navBar .tab-links:not(:first)').addClass('inactive');
    $('.tab-page').hide();
    $('.tab-page:first').show();
  
    $('.navBar .tab-links').click(function() {
      var t = $(this).attr('id');
      if ($(this).hasClass('inactive')) { //this is the start of our condition 
        $('.navBar .tab-links').addClass('inactive');
        $(this).removeClass('inactive');
  
        $('.tab-page').hide();
        $('#' + t + 'C').fadeIn('fast');
      }
    });

    
  
});