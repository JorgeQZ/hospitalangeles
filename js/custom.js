$(document).ready(function () {
    $('.procedimientos-options-container .item').click(function (e) {
        $('.procedimientos-options-container .item').removeClass('active');
        $(this).addClass('active');

        var item_option = $('.procedimientos-options-container .item').index(this);
        $('.procedimientos-content-container .container').removeClass('active');

        $('#option-' + item_option).addClass('active').css({ opacity: '0' }).animate({
            opacity: '1'
        }, 550, 'linear');

        $('html,body').animate({
            scrollTop: $('.procedimientos-content-container').offset().top
        });
    });
});