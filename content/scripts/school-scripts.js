$(function() {
    $('#messages li').click(function() {
        $(this).fadeOut();
    });
    $('#messages li.info').onmouseover(function () {
        $(this).fadeOut();
    });
});

