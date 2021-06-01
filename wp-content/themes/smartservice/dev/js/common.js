jQuery(document).ready(function ($) {

    const $menu = $(".header");

    $('main, footer').mouseup(function (e) {
        var div = $("#mobile_menu");
        var humb = $('hamburger')
        if (!div.is(e.target) && div.has(e.target).length === 0) {
            $('.mobile_menu').removeClass('active');
            $('.hamburger').removeClass('is-active');
        }
    });

    // hamburger 
    $('.hamburger').click(function (e) {
        e.preventDefault();

        if ($(this).hasClass('is-active')) {
            // $('.bg').removeClass('active');
            $('.mobile_menu').removeClass('active');
            $(this).removeClass('is-active');
            // $("html,body").css("overflow","auto");
        } else {
            // $('.bg').addClass('active');
            $('.mobile_menu').addClass('active');
            $('.hamburger').addClass('is-active');
            // $("html,body").removeAttr('style');

        }

    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $menu.addClass('fix')
        } else {
            $menu.removeClass('fix')
        }
    });

    $('.js-service').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3500,
        arrows: false,
        nextArrow: '<span class="prev"></span>',
        prevArrow: '<span class="next"></span>',
        dots: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    }).on('setPosition', function (event, slick) {
        slick.$slides.css('height', slick.$slideTrack.height() + 'px');
    });

    $('.reviews_slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3500,
        arrows: true,
        variableWidth: true,
        nextArrow: '<span class="prev"><i class="fas fa-caret-left"></i></span>',
        prevArrow: '<span class="next"><i class="fas fa-caret-right"></i></span>',
        dots: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 770,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    variableWidth: false,
                    arrows: false,
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    }).on('setPosition', function (event, slick) {
        slick.$slides.css('height', slick.$slideTrack.height() + 'px');
    });

    if ($(window).width() < 992) {
        $('.packages_row').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false,
            nextArrow: '<span class="prev"></span>',
            prevArrow: '<span class="next"></span>',
            dots: true
        })
    }

    // $(document).on('hover', '.packages_item', function () {
    //     $(this).addClass('cur')
    //     $(this).parent().siblings().find('.packages_item').removeClass('cur')
    // }, function () {
    //     $(this).removeClass('cur');
    //     $('.packages_col:nth-child(2n+2)').children('.packages_item').addClass('cur')
    // });

    $('#packages_row').on({
        mouseenter: function () {
            $(this).addClass('cur')
            $(this).parent().siblings().find('.packages_item').removeClass('cur')
        },
        mouseleave: function () {
            $(this).removeClass('cur');
            $('.packages_col:nth-child(2n+2)').children('.packages_item').addClass('cur')
        }
    }, '.packages_item');


    $('.packages_btn').on('click', function (e) {
        e.preventDefault();
        $(this).addClass('active');
        $(this).parent().siblings().find('.packages_btn').removeClass('active');

        let tax = $(this).data();
        tax = tax.tax

        data = {action: 'packages_toggle', 'tax': tax};

        $.ajax({
            url: ajax_web_url,
            data: data,
            type: 'post',
            success: function (response) {
                $('#packages_row').html(response);
            },
        });


    })

    // $('.lang_switch_wrap').hover(function () {
    //     $('.qtranxs_widget').find('.language-chooser-item:not(.active)').slideDown();
    //     // $('.lang_current').fadeOut()
    // }, function () {
    //     $('.qtranxs_widget').find('.language-chooser-item:not(.active)').slideUp();
    // })

    $('.accordion-small_title').on('click', function () {
        if (!$(this).hasClass('open')) {

            $(this).addClass('open').siblings().slideDown();
            $(this).find('i').removeClass('fa-plus').addClass('fa-minus')

            $(this).parent().siblings().find('.accordion-small-content').slideUp();
            $(this).parent().siblings().find('.accordion-small_title').removeClass('open');
            $(this).parent().siblings().find('i').removeClass('fa-minus').addClass('fa-plus')

        } else {
            $(this).removeClass('open').siblings().slideUp()
            $(this).find('i').removeClass('fa-minus').addClass('fa-plus')
        }


    })

    let pathname = window.location.pathname;

    if (pathname === '/about/' || pathname === '/ru/about/') {
        const counter = $('#cool_counter');
        let status = true;

        let dig1 = $('.num1').data('num');
        let dig2 = $('.num2').data('num');

        $(window).scroll(function () {
            let scrollEvent = ($(window).scrollTop() > (counter.position().top - $(window).height()));

            if (scrollEvent && status) {
                status = false;

                $('.num1').numScroll({
                    number: dig1
                })
                $('.num2').numScroll({
                    number: dig2
                })
            }
        })
    }

    $('.js-calc').on('click', '.js-calc-toggle', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open').siblings('.calc_content_item_desc').slideUp()
            $(this).find('i').removeClass('rotate')
        } else {
            $(this).addClass('open').siblings('.calc_content_item_desc').slideDown();
            $(this).find('i').addClass('rotate');
            $(this).closest('.calc_content_item')
                .siblings().find('.js-calc-toggle')
                .removeClass('open')
                .siblings('.calc_content_item_desc')
                .slideUp()
            $(this).closest('.calc_content_item')
                .siblings().find('i').removeClass('rotate')
        }

    })

    function togglePacks(el) {

        let slug = $(el).data('hash');
        let catId = $(el).data('cat');
        let field = 'fl';
        let taxonomy = 'packages_flats';
        if (pathname === '/calc-houses/') {
            field = 'hm';
            taxonomy = 'packages_home';
        }

        window.location.hash = slug;
        slug = slug.replace('#', '')
        $(el).addClass('activate').parent().siblings().find('.js-btn').removeClass('activate');

        const calc = $('.js-calc')
        $.each(calc, function (index, value) {
            let item = $(this), itemData = item.data('slug')

            if (itemData === slug) {
                $(item).fadeIn()
            } else {
                $(item).fadeOut()
            }

            let data = {action: 'packages_result', 'catID': catId, field: field, taxonomy: taxonomy};

            $.ajax({
                url: ajax_web_url,
                data: data,
                type: 'post',
                success: function (response) {
                    $('.calc_check').html(response);
                },
            });
        })

        return false;
    }

    $('.js-btn').on('click', function (e) {
        e.preventDefault();
        togglePacks(this)
    })

    if (pathname === '/flats-calc/') {
        let hash = window.location.hash
        let btnHash = $('.js-btn');
        $.each(btnHash, function (index, value) {
            let item = $(this).data('hash')
            if (hash === item)
                $(this).trigger('click');
        })
    }

    if (pathname === '/calc-houses/') {
        let hash = window.location.hash
        let btnHash = $('.js-btn');
        $.each(btnHash, function (index, value) {
            let item = $(this).data('hash')
            if (hash === item)
                $(this).trigger('click');
        })
    }

    $('.calc_buttons_select').change(function () {
        let curValue = $(this).val()

        if (curValue != 'indi') {
            let slug = $(this).children('option:selected').data('hash');
            let catId = $(this).children('option:selected').data('cat');
            let field = 'fl';
            let taxonomy = 'packages_flats';
            if (pathname === '/calc-houses/') {
                field = 'hm';
                taxonomy = 'packages_home';
            }

            window.location.hash = slug;
            slug = slug.replace('#', '')

            const calc = $('.js-calc')
            $.each(calc, function (index, value) {
                let item = $(this), itemData = item.data('slug')

                if (itemData === slug) {
                    $(item).fadeIn()
                } else {
                    $(item).fadeOut()
                }

                let data = {action: 'packages_result', 'catID': catId, field: field, taxonomy: taxonomy};

                $.ajax({
                    url: ajax_web_url,
                    data: data,
                    type: 'post',
                    success: function (response) {
                        $('.calc_check').html(response);
                    },
                });
            })
        } else {
            console.log(curValue)
            return false;
        }
    })

    $('.js-hover').hover(function () {
            $(this).find('.team_item_show').slideUp()
            $(this).find('.team_item_hide').slideDown()
        },
        function () {
            $(this).find('.team_item_show').slideDown()
            $(this).find('.team_item_hide').slideUp()
        })

    if ($(window).width() < 1120) {
        $('.team').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false,
            dots: true,
            responsive: [
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        variableWidth: false,
                        arrows: false,
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        })
    }

    $('.custom_packs_select select, .custom_packs_check input').styler();

    // anchor code
    // var $page = $('html, body');
    // $('a[href*="#"]').click(function() {
    //
    //     $page.animate({
    //         scrollTop: $($.attr(this, 'href')).offset().top
    //     }, 1000);
    //     return false;
    // });

    // TODO: custom packages scripts beginning

    $(document).on('click', '.custom_packs_btn', function () {
        if ($(this).hasClass('now')) return;

        let text = $(this).text()
        let dataType = $(this).data('type')
        $(this).addClass('now').siblings().removeClass('now')
        $('.custom_packs_result_header').find('strong').text(text)

    })

    $(document).on('click', '.js-col', function () {
        if ($(this).hasClass('open')) {
            $(this).find('.angle_icon').removeClass('rotate');
            $(this).removeClass('open').parent().siblings('.custom_packs_serv_text').slideUp();
        } else {
            $(this).addClass('open');
            $(this).find('.angle_icon').addClass('rotate')
            $(this).parent().siblings('.custom_packs_serv_text').slideDown();
            $(this).closest('.custom_packs_el').siblings().find('.js-col').removeClass('open').find('.angle_icon').removeClass('rotate');
            $(this).closest('.custom_packs_el').siblings().find('.custom_packs_serv_text').slideUp();
        }
    })

    $(document).on('click', '.js-next', function () {
        $(this).closest('.custom_packs_item').removeClass('p-current')
        $(this).closest('.custom_packs_item').next().addClass('p-current')
    })

    $(document).on('click', '.js-prev', function () {
        $(this).closest('.custom_packs_item').removeClass('p-current')
        $(this).closest('.custom_packs_item').prev().addClass('p-current')
    })

    let resultBody = $('.custom_packs_result_body_item')

    let $cookie = $.cookie('calc');
    let priceView = $('.custom_packs_result_price').find('b');

    services = [];
    let data = JSON.stringify(services)
    $.cookie('calc', data)
    $(document).on('change', '#period', function () {

        $('.custom_packs_result_btn').removeClass('disabled').removeAttr('disabled')
        let $this = $(this);

        let slug = $this.children('option:selected').data('cat')
        let cat = $this.closest('.custom_packs_content').siblings('.custom_packs_name').find('h4').text()
        let name = $this.closest('.custom_packs_serv_col').siblings('.js-col').find('h5').text()
        let type = $('.now').data('type')
        let period = $this.val()
        let price = $this.children('option:selected').data(type)

        if (resultBody.children('.result_item').length) {

            let total = priceView.html()
            let curPrice = resultBody.children('.result_item').find('li:contains(' + name + ')').data('cur')

            if (period == 0) {
                console.log('delete elm')
                priceView.html(parseInt(total) - parseInt(curPrice))
                resultBody.children('.result_item').find('li:contains(' + name + ')').remove();

            } else {
                console.log('add elm')
                if (resultBody.children('.result_item').hasClass(slug)) {

                    let isName = resultBody.children('.' + slug).find('li:contains(' + name + ')').text();
                    let text = resultBody.children('.' + slug).find('li:contains(' + name + ')').parent()

                    if (isName) {
                        console.log('add is name')
                        if (period == 0) {
                            console.log('period is 0')
                            priceView.html(parseInt(total) - parseInt(curPrice))
                        } else {
                            console.log('add not is name')
                            priceView.html((parseInt(total) - parseInt(curPrice)) + parseInt(price))
                            resultBody.children('.' + slug).find('li:contains(' + name + ')').children('.result_period').html(period)
                        }

                    } else {
                        $('.' + slug).find('ul').not(text).append('<li data-cur="' + price + '"><span class="result_name">' + name + '</span><span' +
                            ' class="result_period">'+ period +'</span></li>')
                        priceView.html(parseInt(total) + parseInt(price))

                    }

                } else {
                    console.log('add new cat')
                    startAddElems(resultBody, slug, cat, name, period, price);
                    priceView.html(parseInt(total) + parseInt(price))
                }
            }

        } else {
            console.log('first add')

            if (period == 0) {
                resultBody.children('.result_item').find('li:contains(' + name + ')').closest('.result_item').remove()
            } else {
                startAddElems(resultBody, slug, cat, name, period, price);

                priceView.html(price)
            }

        }


    })

    $('.custom_packs_result_btn').click(function () {
        const arr = [];
        const list = resultBody.find('.result_item').find('li');
        const total = $('.custom_packs_result_price').find('b').text();
        let type = $('.custom_packs_buttons').find('.now').text();

        list.each(function (index, value) {
            let text = value.childNodes[0].innerHTML
            let period = value.childNodes[1].innerHTML
            arr.push(text + ' - ' + period)
        })

        const string = arr.join(' || ')
        $('.js-type').text(type)
        $('#type').val(type)
        $('#packages_list').val(string)
        $('#total').val(total)


        $.fancybox.open({
            src: $('#custom_pcks_form'),
            type: 'inline'
        })


    })
    // caustom packages end

    $(document).on('click', '.js-flats', function () {
        let title = $(this).closest('.calc').siblings('.page-hero').find('h1').text()
        let pack = $(this).closest('.row').find('.activate').text()
        pack = $.trim(pack)
        console.log(title)
        $('#pack').val(title)
        $('#pcs_name').val(pack)
        $('.callback_form_header').find('h2').text(title)
        $('.js-subtitle').text(pack)

        $.fancybox.open({
            src: $('#packs_flats'),
            type: 'inline'
        })
    })



});

function startAddElems(elm, slug, cat, name, period, price) {
    elm.append('<div class="result_item ' + slug + '">' +
        '<h5>' + cat + '</h5>' +
        '<ul>' +
        '<li data-cur="' + price + '"><span class="result_name">' + name + '</span><span class="result_period">'+ period +'</span></li>' +
        '</ul>' +
        '</div>');
}