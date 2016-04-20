$( window ).click(function(){ 
    show('page', false);
    show('loading', true);
});

$( window ).ready(function(){ 
    show('page', true);
    show('loading', false);
});