$(document).ready(function () {
    //IMC

    $('#estatura').on('change', function (e) {
        setIMC();
    });


    $('#peso').on('change', function (e) {
        setIMC();
    });

    function setIMC() {
        let estatura = parseFloat($('#estatura').val()) / 100;
        let peso = parseFloat($('#peso').val());
        let imc;
        if (!isNaN(peso) && !isNaN(estatura)) {
            imc = peso / (Math.pow(estatura, 2));
            $('#imc').val(parseFloat(imc).toFixed(2));
        }
    }

    //Menu button : Mobile
    $('.menu-button').click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.menu').removeClass('active');
        } else {
            $(this).addClass('active');
            $('.menu').addClass('active');
        }
    });

    $('.menu li').click(function (e) {

        $('.menu-button').removeClass('active');
        $('.menu').removeClass('active');


    });



    // Tab buttons
    $('.tab-button').click(function (e) {
        e.preventDefault();
        $('.tab-cont').fadeOut();
        let cont = $(this).attr('data-cont');
        $('#' + cont).fadeIn();
    });

    // Sliders
    $('.testimonios-slider').owlCarousel({
        loop: true,
        margin: 10,
        padding: 10,
        nav: true,
        dots: true,
        items: 1
    });

    $('.team-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        dots: true,
        items: 1
    })


    // Form submit
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
            dataType: 'json',
            type: 'POST',
            async: true,
            url: url,
            data: values,
            beforeSend: function () {
                $('.success-cont').addClass('active');
                $('.success-cont .text').html('Enviando').delay(3000);
                $('#sending_mail').show();

            },
            error: function (error) {
                console.log(error, 'error');
            },
            success: function (result) {
                /*
                * Se ejecuta cuando termina la petición y esta ha sido
                * correcta
                * */


                if (result['type'] === 'success') {

                    let inputs_success = $('#contact-form input');
                    console.table(inputs_success);
                    inputs_success.each(function (index, element) {

                        if (element.type != 'submit') {
                            $(element).removeClass('success');
                            $(element).val('');
                        }
                    });


                    setTimeout(function () {
                        $('.success-cont .text').html('Gracias por tu mensaje. <br> En breve nos pondremos en contacto contigo.');
                        $('#sending_mail').hide();

                        $('#success_mail_icon').show();
                        $('#entendido').delay(1000).fadeIn();
                    }, 5000);



                } else if (result['type'] === 'error') {

                    setTimeout(function () {
                        $('.success-cont').addClass('error');
                        $('.success-cont .text').html('Ha ocurrido un error');
                        $('#sending_mail').hide();
                        $('#error_mail_icon').show();
                        $('#intentar').delay(1000).fadeIn();
                    }, 5000);

                }




            }
        });
        return false;
    }

    $('#contact-form').bind("submit", function (e) {
        e.preventDefault();
        if (CheckForm()) {
            SendMail($(this));
        }
        return 0;
    });
    // Form submit

    // Boton entendido
    $('#entendido, #intentar').click(function (e) {
        e.preventDefault();

        $('.success-cont')
            .animate({
                opacity: 1,
                top: '100%',
            }, 800);

        setTimeout(function () {
            $('.success-cont')
                .removeClass('active')
                .removeClass('error')
        }, 800);
        $('#success_mail_icon').hide();
        $('#error_mail_icon').hide();

        $('#entendido').delay(1000).hide();
        $('#intentar').delay(1000).hide();
    });

    // Display option
    $('.procedimientos-options-container .item').click(function (e) {
        $('.procedimientos-options-container .item').removeClass('active');
        $(this).addClass('active');

        var item_option = $('.procedimientos-options-container .item').index(this);
        $('.procedimientos-content-container .container').removeClass('active');
        // console.log(item_option);
        $('#option-' + item_option).addClass('active')
            .css({ opacity: '0' }).animate({
                opacity: '1'
            }, 550, 'linear');

        $('#option-' + item_option + ' img').addClass('active');



        $('html,body').animate({
            scrollTop: $('.procedimientos-content-container').offset().top - 60
        });
    });


    $('.item-link').click(function (e) {
        $('.procedimientos-options-container .item').removeClass('active');
        // $(this).addClass('active');

        var item_option = $(this).attr('data-item');
        $('.procedimientos-options-container .item').eq(item_option).addClass('active');
        $('.procedimientos-content-container .container').removeClass('active');

        $('#option-' + item_option).addClass('active')
            .css({ opacity: '0' }).animate({
                opacity: '1'
            }, 550, 'linear');

        $('#option-' + item_option + ' img').addClass('active');



        $('html,body').animate({
            scrollTop: $('.procedimientos-content-container').offset().top - 60
        });
    });
    // Display option



    // Menu fixed


    if ($(window).width() >= 990) {
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            // console.log(scroll);

            if (scroll >= 150) {
                $('nav').addClass('scrolled');
            } else {
                $('nav').removeClass('scrolled');

            }
        });
    }
});