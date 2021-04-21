jQuery(document).ready(function ($) {

    const $menu = $(".header");

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

    // $(document).mouseup(function (e){ 
    // 	const $div = $(".mobile_menu");
    // 	if (!$div.is(e.target) && $div.has(e.target).length === 0) {
    //             $('.mobile_menu').removeClass('active');
    //             $('.hamburger').removeClass('is-active');
    // 	}
    // });

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
        autoplaySpeed: 5000,
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
        autoplaySpeed: 5000,
        arrows: true,
        variableWidth: true,
        nextArrow: '<span class="prev"><i class="fas fa-caret-left"></i></span>',
        prevArrow: '<span class="next"><i class="fas fa-caret-right"></i></span>',
        dots: true,
        responsive: [
            {
                breakpoint: 1024,
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
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    variableWidth: false,
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

    if ( $(window).width() < 992 ) {
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

    $('.packages_item').hover(function () {
        $(this).addClass('cur')
        $(this).parent().siblings().find('.packages_item').removeClass('cur')
    }, function () {
        $(this).removeClass('cur');
        $('.packages_col:nth-child(2n+2)').children('.packages_item').addClass('cur')
    });


    $('.packages_btn').on('click', function (e) {
        e.preventDefault();

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

    let curLang = $('#lang_switcher').find('.active').children('a').text()
    $('.lang_current').append(curLang)

    $('.lang_switch_wrap').hover(function () {
        $('.qtranxs_widget').find('.language-chooser-item:not(.active)').slideDown();
        // $('.lang_current').fadeOut()
    }, function () {
        $('.qtranxs_widget').find('.language-chooser-item:not(.active)').slideUp();
    })

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

    if (pathname === '/about/') {
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
        if($(this).hasClass('open')) {
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

        console.log(pathname)
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

            let data = {action: 'packages_result', 'catID': catId , field: field, taxonomy: taxonomy};

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

    $('.js-btn').on('click', function(e) {
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

    // anchor code
    // var $page = $('html, body');
    // $('a[href*="#"]').click(function() {
    //
    //     $page.animate({
    //         scrollTop: $($.attr(this, 'href')).offset().top
    //     }, 1000);
    //     return false;
    // });


})