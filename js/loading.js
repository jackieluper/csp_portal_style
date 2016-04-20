$( window ).click(function(callback){ 
    var intervalID = window.setInterval(checkReady, 500);

    function checkReady() {
        if (document.getElementsByTagName('div')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
});

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}

$(window).finish(function () {
    show('page', true);
    show('loading', false);
});