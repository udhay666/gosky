$(window).load(function(){
  //calculate equal height
  var Rheight  = $('.searchResultsSection').height();
  $('.searchFiltersSection').css('min-height', Rheight + 60);
});

$('.filter-button').on('click', function(){
  $(this).toggleClass('open');
  $('.filter-button').toggleClass('open');
});

// $('.open-flight-details').click(function(event){
//     $(this).parents('.results-row').find('.flight-details-Cntr').slideToggle(500);
//     $(this).parents('.results-row').find('.fa-arrow-down').toggleClass('fa-arrow-up');
//     setTimeout(function(){
//       var Rheight  = $('.searchResultsSection').height();
//       $('.searchFiltersSection').css('min-height', Rheight + 60);
//     },500);
// });
