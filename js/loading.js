function onClick(callback) {
    var intervalID = window.setInterval(checkReady, 100);

    function checkReady() {
        if (document.getElementsByTagName('div')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
}

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}

onClick(function () {
    show('page', true);
    show('loading', false);
});