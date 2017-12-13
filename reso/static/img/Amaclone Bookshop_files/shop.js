$(document).ready(function() {
var i =0;
  $('.btn-primary.collapsor').on('click', function() {
    var target = $(this).attr('data-target');
    if ($(target).hasClass('show')) {
      $(target).removeClass('show');
    } else {
      $(target).addClass('show');
    }
  });

$('#callUs').on('click', function(){
  if (i%2==0){
  $('#phoneNo').attr('style','color: #febd68;');
  i++;
} else {
  $('#phoneNo').attr('style','color: #ffffff;');
  i++;
}
});

});
