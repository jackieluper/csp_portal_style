$( window ).unload(function(callback){ 
    var intervalID = window.setInterval(checkReady, 500);

    function checkReady() {
        if (document.getElementsByTagName('a')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
});

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}

$( window ).ready(function(){
    show('page', true);
    show('loading', false);
});