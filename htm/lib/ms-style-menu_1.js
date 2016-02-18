$(document).ready(function(){
//makes the Microsoft style nav bar float in and out with the menu button.
    var bodyEl = $('body'),
              navToggleBtn = bodyEl.find('.nav-toggle-btn');
              
              navToggleBtn.on('click', function(e){
                  bodyEl.toggleClass("active-nav");
                  e.preventDefault();
              });
});
