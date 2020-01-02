$(document).ready(function()
{
    $('.remove').click(function()
    {
        var id=$(this).attr('data-id');
        var url=$(this).attr('data-url');
        $('.form').attr("action",url);
    });
});