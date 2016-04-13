$(function () {
    $("li").on("click", function () {
        var intervalID = window.setInterval(checkReady, 1000);

        show('page', true);
        show('loading', false);
    });
});

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}

onClick(function () {
    show('page', true);
    show('loading', false);
});