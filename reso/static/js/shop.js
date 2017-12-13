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

$('#clearSearch').on('click', function(){

})
// I'm trying to create a function here which automatically closes the modal corresponding to 'order successfully added' after a period of time
$('#addToCartModal').on('shown.bs.modal', function () {
setTimeout(function(){
  $('#addToCartModal').modal('toggle');
},1000);
});
$('.addToCart').on('click', function(){
  $('#addToCartModal').modal('toggle');
  setTimeout(function(){
    window.location.href = 'cartActions.php?action=addToCart&id='+this.id;
  }, 1100);

})
