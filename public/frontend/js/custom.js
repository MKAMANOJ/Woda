$(document).ready(function(){
  $('.toggle-menu').on('click', function(){
    $('.main-menu').slideToggle();
    $('body').toggleClass('overflow-hidden');
    $(this).toggleClass('menu-shown');
  });//toggle-menu click
});//document.ready
