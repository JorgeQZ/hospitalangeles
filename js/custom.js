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
        let values = $(element).serialize();
        let type = $(element).attr("method");
        let url = 'mail.php';

        $.ajax({
            type: type,
            url: url,
            data: values,
            beforeSend: function () {
                $('#success-display').fadeIn().html('Enviando');
            },
            complete: function (data) {
                /*
                * Se ejecuta al termino de la petición
                * */

                console.log(data, 'complete');

            },
            success: function (data) {
                /*
                * Se ejecuta cuando termina la petición y esta ha sido
                * correcta
                * */
                console.log(data, 'success');
                const inputs_success = $('#contact-form input');

                inputs_success.each(function (index, element) {
                    $(element).value = '';
                });
            },
        });

    }
    $('#contact-form').bind("submit", function (e) {
        e.preventDefault();
        if (CheckForm()) {
            SendMail($(this));
        }
        return 0;
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