function updateCartItem(obj,id){
  $.get("cartActions.php", {action:"updateCartItem", id:id, quantity:obj.value}, function(data){
      if(data == 'ok'){
          location.reload();
      }else{
          alert('Cart update failed, please try again.');
      }
  });
}
