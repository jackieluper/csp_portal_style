$(document).click(function () {
    show('page', false);
    show('loading', true);

});

$(document).ready()(function () {
    show('page', true);
    show('loading', false);
});