// This is the JavaScript file that creates cookies on event - it needs to be JavaScript, because PhP is server side

// We create two cookies. The first called cartAdd stores the product id and the number of clicks of an element to put into the cart. The second cookie, which is called descView stores the number of times the customer has looked at the description of an item.

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}


// We first obtain our list of add to cart buttons
var list = document.getElementsByClassName("cartAdd");


// For each add to cart button, we add an event listener, which creates a cookie called cartAdd with value the link to the cart actions page - each click currently overwrites

for (var k=0; k<list.length; k++){
  list[k].addEventListener('click', function(){
    var cookieData = '';
    var tempArray = this.getAttribute('href').split('=');
    var productId = tempArray[tempArray.length-1];
    var clicks = 1;
    var currentCookie = readCookie('cartAdd');
    if (currentCookie!=null){
    var cookieArray = currentCookie.split(':');
    console.log(cookieArray);
    var alreadyThere = false;
    for (var l=0; l<cookieArray.length; l++){
      if (cookieArray[l]=='id '+productId){
        clicks = parseInt(cookieArray[l+1].split(' ')[1])+1;
        cookieArray[l+1]='clicks '+clicks;
        alreadyThere=true;
      }
    }
    cookieData = cookieArray.join(':');
    if (!alreadyThere){
      cookieData+='id '+productId+':clicks '+clicks+':';
    }
  } else {
    cookieData = 'id '+ productId+':clicks '+clicks+':';
  }
    document.cookie= 'cartAdd='+cookieData+'; expires= Fri, 8 Dec 2017 20:47:11 UTC; path=/';
  })
}

// We now create a second list of all the products which the customer just looks at the modal view for
var list2 = document.getElementsByClassName("descView");

// For each description view button we add an event listener such that when clicked we store a cookie called descView and it takes the unique value of the data-target attribute - each click currently overwrites

for (var j=0; j<list2.length; j++){
  list2[j].addEventListener('click', function(){
    var cookieData = '';
    var tempArray = this.getAttribute('data-target').split('_');
    console.log(tempArray);
    var productId = tempArray[tempArray.length-1];
    var clicks = 1;
    var currentCookie = readCookie('descView');
    if (currentCookie!=null){
    var cookieArray = currentCookie.split(':');
    console.log(cookieArray);
    var alreadyThere = false;
    for (var l=0; l<cookieArray.length; l++){
      if (cookieArray[l]=='id '+productId){
        clicks = parseInt(cookieArray[l+1].split(' ')[1])+1;
        cookieArray[l+1]='clicks '+clicks;
        alreadyThere=true;
      }
    }
    cookieData = cookieArray.join(':');
    if (!alreadyThere){
      cookieData+='id '+productId+':clicks '+clicks+':';
    }
  } else {
    cookieData = 'id '+ productId+':clicks '+clicks+':';
  }
  document.cookie='descView='+cookieData+'; expires= Fri, 8 Dec 2017 20:47:11 UTC; path=/';
})
}
