$(document).ready(function () {

    $('.alert').delay(3000).fadeOut('slow');

    $('.clickable').click(function () {
        location.href = $(this).attr('data-href');
    });

    $('a.trash').click(function () {
        $('form.trash').submit();
    });

});