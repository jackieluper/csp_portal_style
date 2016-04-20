$( window ).click(function(callback){ 
    var intervalID = window.setInterval(checkReady, 500);

    function checkReady() {
        if ($(window).finish(function () {
    show('page', true);
    show('loading', false);
})) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
});

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}

