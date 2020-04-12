$(document).ready(function () {

    function CheckForm() {
        let errors = 0;
        const inputs = $('#contact-form input');

        $('#errors-display').html('');
        inputs.each(function (index, element) {
            if (element.value == '' || !element.value) {
                $(element).addClass('error');
                errors++;
            } else if (!element.value == '') {
                $(element).removeClass('error');
                $(element).addClass('success');
            } else {
                $(element).addClass('success');
            }
        });

        if (errors == 1) {
            $('#errors-display').fadeIn().html('Un campo está vacío.');
            return false;
        } else if (errors > 1) {
            $('#errors-display').fadeIn().html('Algunos campos están vacíos.');
            return false;

        } else {
            $('#errors-display').fadeOut().html('');
            return true;
        }
    }

    function SendMail(element) {


    }
    $('#contact-form').bind("submit", function (e) {
        // e.preventDefault();
        if (CheckForm()) {
            // SendMail($(this));
            let values = $(this).serialize();
            let type = $(this).attr("method");
            let url = $(this).attr("action");
            console.info(values, type, url);

            // $.ajax({
            //     type: type,
            //     url: url,
            //     data: values
            // });

        }
        // return 0;
    });


    $('.procedimientos-options-container .item').click(function (e) {
        $('.procedimientos-options-container .item').removeClass('active');
        $(this).addClass('active');

        var item_option = $('.procedimientos-options-container .item').index(this);
        $('.procedimientos-content-container .container').removeClass('active');

        $('#option-' + item_option).addClass('active')
            .css({ opacity: '0' }).animate({
                opacity: '1'
            }, 550, 'linear');

        $('#option-' + item_option + ' img').addClass('active');



        $('html,body').animate({
            scrollTop: $('.procedimientos-content-container').offset().top
        });
    });
});