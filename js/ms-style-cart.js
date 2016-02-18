/* 
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
*/
$(document).ready(function(){
//makes the Microsoft style nav bar float in and out with the menu button.
    var bodyEl = $('body'),
              cartToggleBtn = bodyEl.find('.cart-toggle-btn');
              
              cartToggleBtn.on('click', function(e){
                  bodyEl.toggleClass("active-cart");
                  e.preventDefault();
              });
});
