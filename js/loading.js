$(document).live("onchange", function () {
    show('page', false);
    show('loading', true);
});

$(window).load(function () {
    show('page', true);
    show('loading', false);
});