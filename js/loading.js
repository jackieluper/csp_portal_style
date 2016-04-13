$(document).live("onchange", function () {
    show('page', false);
    show('loading', true);
});

$(document).ready(function()
{
    $(document).live("onchange",function()
    {
        show('page', true);
    show('loading', false);
    });
});