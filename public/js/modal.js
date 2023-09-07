$(function() {
    $('.js-close-button').click(function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $('body').css('overflow-y', 'auto');
        $(target).hide();
        return false;
    });

    $('.js-open-button').click(function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $('body').css('overflow-y', 'hidden');
        $(target).show();
        return false;
    });
})