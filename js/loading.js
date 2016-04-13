$(document).ready(function () {
    $('a').click(function () {

        show('page', false);
        show('loading', true);

    });
    show('page', true);
    show('loading', false);
});