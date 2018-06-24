/*
   Tabs Widget
   ======================================= */
jQuery(function ($) {
    $('.nav-tabs li:first-child a').tab('show')
});

/*
   Make Mobile Menu Clickable
   ======================================= */

jQuery(function ($) {
    if ($(window).width() < 767) {
        $(".dropdown-toggle").attr('data-toggle', 'dropdown');
        $('.dropdown').on('show.bs.dropdown', function () {
            $(this).siblings('.open').removeClass('open').find('a.dropdown-toggle').attr('data-toggle', 'dropdown');
            $(this).find('a.dropdown-toggle').removeAttr('data-toggle');
        });
    } else {
        $(".dropdown-toggle").removeAttr('data-toggle dropdown');
    }
});

/*
   Navbar Dropdown Hover Effect
   ======================================= */

jQuery(function ($) {
    'use strict';

    // DROPDOWNHOVER CLASS DEFINITION
    // =========================

    var Dropdownhover = function (element, options) {
        this.options = options;
        this.$element = $(element);

        var that = this;

        // Defining if navigation tree or single dropdown
        this.dropdowns = this.$element.hasClass('dropdown-toggle') ? this.$element.parent().find('.dropdown-menu').parent('.dropdown') : this.$element.find('.dropdown');

        this.dropdowns.each(function () {
            $(this).on('mouseenter.bs.dropdownhover', function (e) {
                that.show($(this).children('a, button'))
            })
        });
        this.dropdowns.each(function () {
            $(this).on('mouseleave.bs.dropdownhover', function (e) {
                that.hide($(this).children('a, button'))
            })
        })

    };

    Dropdownhover.TRANSITION_DURATION = 300;
    Dropdownhover.DELAY = 150;
    Dropdownhover.TIMEOUT;

    Dropdownhover.DEFAULTS = {
        animations: ['fadeInDown', 'fadeInRight', 'fadeInUp', 'fadeInLeft'],
    };

    // Opens dropdown menu when mouse is over the trigger element
    Dropdownhover.prototype.show = function (_dropdownLink) {


        var $this = $(_dropdownLink);

        window.clearTimeout(Dropdownhover.TIMEOUT);
        // Close all dropdowns
        $('.dropdown').not($this.parents()).each(function () {
            $(this).removeClass('open');
        });

        var effect = this.options.animations[0];

        if ($this.is('.disabled, :disabled')) return;

        var $parent = $this.parent();
        var isActive = $parent.hasClass('open');

        if (!isActive) {

            var $dropdown = $this.next('.dropdown-menu');
            var relatedTarget = {relatedTarget: this};

            $parent
                .addClass('open');

            var side = this.position($dropdown);
            side == 'top' ? effect = this.options.animations[2] :
                side == 'right' ? effect = this.options.animations[3] :
                    side == 'left' ? effect = this.options.animations[1] :
                        effect = this.options.animations[0];

            $dropdown.addClass('animated ' + effect);

            var transition = $dropdown.hasClass('animated');

            transition ?
                $dropdown
                    .one('bsTransitionEnd', function () {
                        $dropdown.removeClass('animated ' + effect)
                    })
                    .emulateTransitionEnd(Dropdownhover.TRANSITION_DURATION) :
                $dropdown.removeClass('animated ' + effect)
        }

        return false
    };

    // Closes dropdown menu when moise is out of it
    Dropdownhover.prototype.hide = function (_dropdownLink) {

        var that = this;
        var $this = $(_dropdownLink);
        var $parent = $this.parent();
        Dropdownhover.TIMEOUT = window.setTimeout(function () {
            $parent.removeClass('open')
        }, Dropdownhover.DELAY)
    };

    // Calculating position of dropdown menu
    Dropdownhover.prototype.position = function (dropdown) {

        var win = $(window);

        // Reset css to prevent incorrect position
        dropdown.css({bottom: '', left: '', top: '', right: ''}).removeClass('dropdownhover-top');

        var viewport = {
            top: win.scrollTop(),
            left: win.scrollLeft()
        };
        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();

        var bounds = dropdown.offset();
        bounds.right = bounds.left + dropdown.outerWidth();
        bounds.bottom = bounds.top + dropdown.outerHeight();
        var position = dropdown.position();
        position.right = bounds.left + dropdown.outerWidth();
        position.bottom = bounds.top + dropdown.outerHeight();

        var side = '';

        var isSubnow = dropdown.parents('.dropdown-menu').length;

        if (isSubnow) {

            if (position.left < 0) {
                side = 'left';
                dropdown.removeClass('dropdownhover-right').addClass('dropdownhover-left')
            } else {
                side = 'right';
                dropdown.addClass('dropdownhover-right').removeClass('dropdownhover-left')
            }

            if (bounds.left < viewport.left) {
                side = 'right';
                dropdown.css({
                    left: '100%',
                    right: 'auto'
                }).addClass('dropdownhover-right').removeClass('dropdownhover-left')
            } else if (bounds.right > viewport.right) {
                side = 'left';
                dropdown.css({
                    left: 'auto',
                    right: '100%'
                }).removeClass('dropdownhover-right').addClass('dropdownhover-left')
            }

            if (bounds.bottom > viewport.bottom) {
                dropdown.css({bottom: 'auto', top: -(bounds.bottom - viewport.bottom)})
            } else if (bounds.top < viewport.top) {
                dropdown.css({bottom: -(viewport.top - bounds.top), top: 'auto'})
            }

        } else { // Defines special position styles for root dropdown menu

            var parentLi = dropdown.parent('.dropdown');
            var pBounds = parentLi.offset();
            pBounds.right = pBounds.left + parentLi.outerWidth();
            pBounds.bottom = pBounds.top + parentLi.outerHeight();

            if (bounds.right > viewport.right) {
                dropdown.css({left: -(bounds.right - viewport.right), right: 'auto'})
            }

            if (bounds.bottom > viewport.bottom && (pBounds.top - viewport.top) > (viewport.bottom - pBounds.bottom) || dropdown.position().top < 0) {
                side = 'top';
                dropdown.css({
                    bottom: '100%',
                    top: 'auto'
                }).addClass('dropdownhover-top').removeClass('dropdownhover-bottom')
            } else {
                side = 'bottom';
                dropdown.addClass('dropdownhover-bottom')
            }
        }

        return side;

    };


    // DROPDOWNHOVER PLUGIN DEFINITION
    // ==========================

    function Plugin(option) {
        return this.each(function () {
            var $this = $(this);
            var data = $this.data('bs.dropdownhover');
            var settings = $this.data();
            if ($this.data('animations') !== undefined && $this.data('animations') !== null)
                settings.animations = $.isArray(settings.animations) ? settings.animations : settings.animations.split(' ');

            var options = $.extend({}, Dropdownhover.DEFAULTS, settings, typeof option == 'object' && option);

            if (!data) $this.data('bs.dropdownhover', (data = new Dropdownhover(this, options)))

        })
    }

    var old = $.fn.dropdownhover;

    $.fn.dropdownhover = Plugin;
    $.fn.dropdownhover.Constructor = Dropdownhover;


    // DROPDOWNHOVER NO CONFLICT
    // ====================

    $.fn.dropdownhover.noConflict = function () {
        $.fn.dropdownhover = old;
        return this
    };


    // APPLY TO STANDARD DROPDOWNHOVER ELEMENTS
    // ===================================

    var resizeTimer;
    $(document).ready(function () {
        $('[data-hover="dropdown"]').each(function () {
            var $target = $(this);
            Plugin.call($target, $target.data())
        })
    });
    $(window).on('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            if ($(window).width() >= 768) // Breakpoin plugin is activated (728px)
                $('[data-hover="dropdown"]').each(function () {
                    var $target = $(this);
                    Plugin.call($target, $target.data())
                });
            else  // Disabling and clearing plugin data if screen is less 768px
                $('[data-hover="dropdown"]').each(function () {
                    $(this).removeData('bs.dropdownhover');
                    if ($(this).hasClass('dropdown-toggle'))
                        $(this).parent('.dropdown').find('.dropdown').andSelf().off('mouseenter.bs.dropdownhover mouseleave.bs.dropdownhover');
                    else
                        $(this).find('.dropdown').off('mouseenter.bs.dropdownhover mouseleave.bs.dropdownhover')
                })
        }, 200)
    })

});

/*
   Carousel Slider Arrows
   ======================================= */

jQuery(function ($) {
    $('div#slide_holder').hover(function () {
        $(this).find('.arrow span').stop(true, true).fadeIn(200).show(10);
    }, function () {
        $(this).find('.arrow span').stop(true, true).fadeOut(200).hide(10);
    });
});

/*
   Tooltips
   ======================================= */

jQuery(function ($) {
    $('[data-toggle="tooltip"]').tooltip()
});

/*
   Add Menu Effect To WPML Menu Items
   ======================================= */

jQuery(document).ready(function () {
    jQuery('.navbar .menu-item-language a, .sticky-header .menu-item-language a').each(function () {
        var el = jQuery(this);
        plan_text = el.text();
        if (jQuery(this).find('img').length) {
            img_src = jQuery(this).find('img').attr('src');
            jQuery(this).find('img').remove();
            el.html('<img src="' + img_src + '"> <span data-hover=" ' + plan_text + '"> ' + plan_text + '</span>');
        } else {
            el.html('<span data-hover="' + plan_text + '">' + plan_text + '</span>');
        }
    });
});

if (typeof evolve_js_local_vars.woocommerce !== 'undefined') {

    /*
       For WooCommerce Product page, Checkout page and Cart page
       ======================================= */

    jQuery(document).ready(function ($) {

        jQuery('.woocommerce .images #carousel a').click(function (e) {
            e.preventDefault();
        });

        jQuery('.catalog-ordering .orderby .current-li a').html(jQuery('.catalog-ordering .orderby ul li.current a').html());
        jQuery('.catalog-ordering .sort-count .current-li a').html(jQuery('.catalog-ordering .sort-count ul li.current a').html());
        jQuery('.woocommerce .woocommerce-input-wrapper').addClass('col-sm-8');
        jQuery('.woocommerce .shop_table .variation dd').after('<br />');
        jQuery('.woocommerce .evolve-myaccount-data th.order-actions').text(evolve_js_local_vars.order_actions);

        jQuery('.rtl .woocommerce .wc-forward').each(function () {
            jQuery(this).val(jQuery('.rtl .woocommerce .wc-forward').val().replace('\u2192', '\u2190'));
        });

        jQuery('.woocommerce input').each(function () {
            if (!jQuery(this).has('#coupon_code')) {
                name = jQuery(this).attr('id');
                jQuery(this).attr('placeholder', jQuery(this).parent().find('label[for=' + name + ']').text());
            }
        });

        if (jQuery('.woocommerce #reviews #comments .comment_container .comment-text').length) {
            jQuery('.woocommerce #reviews #comments .comment_container').append('<div class="clear"></div>');
        }

        if (jQuery('.woocommerce.single-product .related.products > h2').length) {
            jQuery('.woocommerce.single-product .related.products > h2').wrap('<div class="title"></div>');
            jQuery('.woocommerce.single-product .related.products > .title').append('<div class="title-sep-container"><div class="title-sep"></div></div>');
        }

        if (jQuery('.woocommerce.single-product .upsells.products > h2').length) {
            jQuery('.woocommerce.single-product .upsells.products > h2').wrap('<div class="title"></div>');
            jQuery('.woocommerce.single-product .upsells.products > .title').append('<div class="title-sep-container"><div class="title-sep"></div></div>');
        }

        if (jQuery('body #sidebar').css('display') == "block") {
            jQuery('body').addClass('has-sidebar');
            calcTabsLayout('.woocommerce-tabs .tabs-horizontal');
        }

        if (jQuery('body.archive.woocommerce #sidebar').css('display') == "block") {
            jQuery('#main ul.products').removeClass('products-1');
            jQuery('#main ul.products').removeClass('products-2');
            jQuery('#main ul.products').removeClass('products-4').addClass('products-3');
        }

        if (jQuery('body.single.woocommerce #sidebar').css('display') == "block") {
            jQuery('.upsells.products ul.products,.related.products ul.products').removeClass('products-1');
            jQuery('.upsells.products ul.products,.related.products ul.products').removeClass('products-2');
            jQuery('.upsells.products ul.products,.related.products ul.products').removeClass('products-4').addClass('products-3');
            jQuery('.upsells.products ul.products').html(jQuery('.upsells.products ul.products li').slice(0, 3));
            jQuery('.related.products ul.products').html(jQuery('.related.products ul.products li').slice(0, 3));
        }

        jQuery('#sidebar .products,.footer-area .products').each(function () {
            jQuery(this).removeClass('products-4');
            jQuery(this).removeClass('products-3');
            jQuery(this).removeClass('products-2');
            jQuery(this).addClass('products-1');
        });
        jQuery('.products-4 li, .products-3 li, .products-3 li').removeClass('last');

        $('.woocommerce-tabs ul.tabs li a').unbind('click');
        $('.woocommerce-tabs > ul.tabs li a').click(function () {

            var $tab = $(this);
            var $tabs_wrapper = $tab.closest('.woocommerce-tabs');

            $('ul.tabs li', $tabs_wrapper).removeClass('active');
            $('div.panel', $tabs_wrapper).hide();
            $('div' + $tab.attr('href'), $tabs_wrapper).show();
            $tab.parent().addClass('active');

            return false;
        });

        jQuery('.woocommerce-checkout-nav a,.continue-checkout').click(function (e) {
            e.preventDefault();

            var data_name = $(this).attr('data-name');
            var name = data_name;
            if (data_name != '#order-review') {
                name = '.' + data_name;
            }

            jQuery('.woocommerce-checkout-nav li').removeClass('active');
            jQuery('.woocommerce-checkout-nav').find('[data-name=' + data_name + ']').parent().addClass('active');
        });

        jQuery('a.add_to_cart_button').click(function (e) {
            var link = this;
            jQuery(link).closest('.product').find('.cart-loading').find('i').removeClass('t4p-icon-ok').addClass('t4p-icon-ok');
            jQuery(this).closest('.product').find('.cart-loading').fadeIn();
            setTimeout(function () {
                jQuery(link).closest('.product').find('.product-images img').animate({opacity: 0.75});
                jQuery(link).closest('.product').find('.cart-loading').find('i').hide().removeClass('t4p-icon-repeat').addClass('t4p-icon-ok').fadeIn();

                setTimeout(function () {
                    jQuery(link).closest('.product').find('.cart-loading').fadeOut().closest('.product').find('.product-images img').animate({opacity: 1});
                }, 2000);
            }, 2000);
        });

        jQuery('li.product').mouseenter(function () {
            if (jQuery(this).find('.cart-loading').find('i').hasClass('t4p-icon-ok')) {
                jQuery(this).find('.cart-loading').fadeIn();
            }
        }).mouseleave(function () {
            if (jQuery(this).find('.cart-loading').find('i').hasClass('t4p-icon-ok')) {
                jQuery(this).find('.cart-loading').stop().fadeOut('400');
            }
        });

        jQuery('.sep-boxed-pricing,.full-boxed-pricing').each(function () {
            jQuery(this).addClass('columns-' + jQuery(this).find('.column').length);
        });

    });

    /*
       WooCommerce Checkout and Account Tabs
       ======================================= */

    jQuery(function ($) {
        $('#checkout-tab a[href="#checkout-billing"]').tab('show');
        $('#account-tab a[href="#account-dashboard"]').tab('show');

        $('.continue').click(function () {
            $('.nav-pills > .active').next('a').trigger('click');
        });

        $(".view-orders-link").click(function () {
            $("a#account-orders-tab").click();
        });

        $(".edit-address-link").click(function () {
            $("a#account-address-tab").click();
        });

        $(".edit-account-link").click(function () {
            $("a#account-edit-tab").click();
        });
    });

    /*
       WooCommerce Quantity buttons add-back
       ======================================= */

    jQuery(function ($) {
        if (typeof evolve_js_local_vars.woocommerce_23 !== 'undefined') {
            var $testProp = $('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').find('qty');
            if ($testProp && $testProp.prop('type') != 'date') {
                // Quantity buttons
                //$('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />');

                // Target quantity inputs on product pages
                $('input.qty:not(.product-quantity input.qty)').each(function () {

                    var min = parseFloat($(this).attr('min'));

                    if (min && min > 0 && parseFloat($(this).val()) < min) {
                        $(this).val(min);
                    }
                });

                $(document).on('click', '.plus, .minus', function () {

                    // Get values
                    var $qty = $(this).closest('.quantity').find('.qty'),
                        currentVal = parseFloat($qty.val()),
                        max = parseFloat($qty.attr('max')),
                        min = parseFloat($qty.attr('min')),
                        step = $qty.attr('step');

                    // Format values
                    if (!currentVal || currentVal === '' || currentVal === 'NaN')
                        currentVal = 0;
                    if (max === '' || max === 'NaN')
                        max = '';
                    if (min === '' || min === 'NaN')
                        min = 0;
                    if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
                        step = 1;

                    // Change the value
                    if ($(this).is('.plus')) {

                        if (max && (max == currentVal || currentVal > max)) {
                            $qty.val(max);
                        } else {
                            $qty.val(currentVal + parseFloat(step));
                        }

                    } else {

                        if (min && (min == currentVal || currentVal < min)) {
                            $qty.val(min);
                        } else if (currentVal > 0) {
                            $qty.val(currentVal - parseFloat(step));
                        }

                    }

                    // Trigger change event
                    $qty.trigger('change');
                });
            }
        }
    });

    /*
       For WooCommerce Edit-addresss Form
       ======================================= */

    jQuery('#account-tab a.account-tab').click(function (e) {
        e.preventDefault();

        jQuery('.editaddress_billing').hide();
        jQuery('.editaddress_shipping').hide();

    });

    jQuery(document).ready(function ($) {

        jQuery('.woo_editaddress').click(function (e) {
            e.preventDefault();

            var editaddress = $(this).attr('id');

            if (editaddress == 'editaddress_billing') {
                jQuery('.editaddress_billing').fadeIn();
                jQuery('.editaddress_shipping').hide();
            } else if (editaddress == 'editaddress_shipping') {
                jQuery('.editaddress_shipping').fadeIn();
                jQuery('.editaddress_billing').hide();
            }
        });

        jQuery('#saveaddress').click(function () {
            var formvalue = $('#formvalue').val();

            if (formvalue == 'billing') {
                jQuery('.editaddress_billing').fadeIn();
                jQuery('.editaddress_shipping').hide();
            } else if (formvalue == 'shipping') {
                jQuery('.editaddress_shipping').fadeIn();
                jQuery('.editaddress_billing').hide();
            }
        });

    });

    /*
       Change Lightbox img When Change Variation img In WooCommerce Product Description Page
       ======================================= */

    jQuery(document).ready(function ($) {

        jQuery('.attachment-shop_single').on('load', function () {
            var img_src = jQuery(".woocommerce-product-gallery__image .attachment-shop_single").attr('src');
            jQuery(".woocommerce-product-gallery__image").attr("href", img_src);
        });

    });

}

/*
   Back To Top Button (Scroll to Top)
   ======================================= */

if (evolve_js_local_vars.scroll_to_top === '1') {

    jQuery(function ($) {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#backtotop').fadeIn();
            } else {
                $('#backtotop').fadeOut();
            }
        });
        $('#backtotop').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });

}

/*
   Parallax Slider
   ======================================= */

if (evolve_js_local_vars.parallax_slider === '1') {

    jQuery(function ($, undefined) {

        /*
         * Slider object.
         */
        $.Slider = function (options, element) {

            this.$el = $(element);

            this._init(options);

        };

        $.Slider.defaults = {
            current: 0, // index of current slide
            bgincrement: 50, // increment the bg position (parallax effect) when sliding
            autoplay: false, // slideshow on / off
            interval: 4000  // time between transitions
        };

        $.Slider.prototype = {
            _init: function (options) {

                this.options = $.extend(true, {}, $.Slider.defaults, options);

                this.$slides = this.$el.children('div.da-slide');
                this.slidesCount = this.$slides.length;

                this.current = this.options.current;

                if (this.current < 0 || this.current >= this.slidesCount) {

                    this.current = 0;

                }

                this.$slides.eq(this.current).addClass('da-slide-current');

                var $navigation = $('<nav class="da-dots"/>');
                for (var i = 0; i < this.slidesCount; ++i) {

                    $navigation.append('<span/>');

                }
                $navigation.appendTo(this.$el);

                this.$pages = this.$el.find('nav.da-dots > span');
                this.$navNext = this.$el.find('span.da-arrows-next');
                this.$navPrev = this.$el.find('span.da-arrows-prev');

                this.isAnimating = false;

                this.bgpositer = 0;

                this.cssAnimations = Modernizr.cssanimations;
                this.cssTransitions = Modernizr.csstransitions;

                if (!this.cssAnimations || !this.cssAnimations) {

                    this.$el.addClass('da-slider-fb');

                }

                this._updatePage();

                // load the events
                this._loadEvents();

                // slideshow
                if (this.options.autoplay) {

                    this._startSlideshow();

                }

            },
            _navigate: function (page, dir) {

                var $current = this.$slides.eq(this.current), $next, _self = this;

                if (this.current === page || this.isAnimating)
                    return false;

                this.isAnimating = true;

                // check dir
                var classTo, classFrom, d;

                if (!dir) {

                    (page > this.current) ? d = 'next' : d = 'prev';

                } else {

                    d = dir;

                }

                if (this.cssAnimations && this.cssAnimations) {

                    if (d === 'next') {

                        classTo = 'da-slide-toleft';
                        classFrom = 'da-slide-fromright';
                        ++this.bgpositer;

                    } else {

                        classTo = 'da-slide-toright';
                        classFrom = 'da-slide-fromleft';
                        --this.bgpositer;

                    }

                    this.$el.css('background-position', this.bgpositer * this.options.bgincrement + '% 0%');

                }

                this.current = page;

                $next = this.$slides.eq(this.current);

                if (this.cssAnimations && this.cssAnimations) {

                    var rmClasses = 'da-slide-toleft da-slide-toright da-slide-fromleft da-slide-fromright';
                    $current.removeClass(rmClasses);
                    $next.removeClass(rmClasses);

                    $current.addClass(classTo);
                    $next.addClass(classFrom);

                    $current.removeClass('da-slide-current');
                    $next.addClass('da-slide-current');

                }

                // fallback
                if (!this.cssAnimations || !this.cssAnimations) {

                    $next.css('left', (d === 'next') ? '100%' : '-100%').stop().animate({
                        left: '0%'
                    }, 1000, function () {
                        _self.isAnimating = false;
                    });

                    $current.stop().animate({
                        left: (d === 'next') ? '-100%' : '100%'
                    }, 1000, function () {
                        $current.removeClass('da-slide-current');
                    });

                }

                this._updatePage();

            },
            _updatePage: function () {

                this.$pages.removeClass('da-dots-current');
                this.$pages.eq(this.current).addClass('da-dots-current');

            },
            _startSlideshow: function () {

                var _self = this;

                this.slideshow = setTimeout(function () {

                    var page = (_self.current < _self.slidesCount - 1) ? page = _self.current + 1 : page = 0;
                    _self._navigate(page, 'next');

                    if (_self.options.autoplay) {

                        _self._startSlideshow();

                    }

                }, this.options.interval);

            },
            page: function (idx) {

                if (idx >= this.slidesCount || idx < 0) {

                    return false;

                }

                if (this.options.autoplay) {

                    clearTimeout(this.slideshow);
                    this.options.autoplay = false;

                }

                this._navigate(idx);

            },
            _loadEvents: function () {

                var _self = this;

                this.$pages.on('click.cslider', function (event) {

                    _self.page($(this).index());
                    return false;

                });

                this.$navNext.on('click.cslider', function (event) {

                    if (_self.options.autoplay) {

                        clearTimeout(_self.slideshow);
                        _self.options.autoplay = false;

                    }

                    var page = (_self.current < _self.slidesCount - 1) ? page = _self.current + 1 : page = 0;
                    _self._navigate(page, 'next');
                    return false;

                });

                this.$navPrev.on('click.cslider', function (event) {

                    if (_self.options.autoplay) {

                        clearTimeout(_self.slideshow);
                        _self.options.autoplay = false;

                    }

                    var page = (_self.current > 0) ? page = _self.current - 1 : page = _self.slidesCount - 1;
                    _self._navigate(page, 'prev');
                    return false;

                });

                if (this.cssTransitions) {

                    if (!this.options.bgincrement) {

                        this.$el.on('webkitAnimationEnd.cslider animationend.cslider OAnimationEnd.cslider', function (event) {

                            if (event.originalEvent.animationName === 'toRightAnim4' || event.originalEvent.animationName === 'toLeftAnim4') {

                                _self.isAnimating = false;

                            }

                        });

                    } else {

                        this.$el.on('webkitTransitionEnd.cslider transitionend.cslider OTransitionEnd.cslider', function (event) {

                            if (event.target.id === _self.$el.attr('id'))
                                _self.isAnimating = false;

                        });

                    }

                }

            }
        };

        var logError = function (message) {
            if (this.console) {
                console.error(message);
            }
        };

        $.fn.cslider = function (options) {

            if (typeof options === 'string') {

                var args = Array.prototype.slice.call(arguments, 1);

                this.each(function () {

                    var instance = $.data(this, 'cslider');

                    if (!instance) {
                        logError("cannot call methods on cslider prior to initialization; " +
                            "attempted to call method '" + options + "'");
                        return;
                    }

                    if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
                        logError("no such method '" + options + "' for cslider instance");
                        return;
                    }

                    instance[options].apply(instance, args);

                });

            } else {

                this.each(function () {

                    var instance = $.data(this, 'cslider');
                    if (!instance) {
                        $.data(this, 'cslider', new $.Slider(options, this));
                    }
                });

            }

            return this;

        };

    });

    /*!
     * modernizr v3.6.0
     * Build https://modernizr.com/download?-cssanimations-csstransitions-setclasses-dontmin
     *
     * Copyright (c)
     *  Faruk Ates
     *  Paul Irish
     *  Alex Sexton
     *  Ryan Seddon
     *  Patrick Kettner
     *  Stu Cox
     *  Richard Herrera

     * MIT License
     */

    /*
     * Modernizr tests which native CSS3 and HTML5 features are available in the
     * current UA and makes the results available to you in two ways: as properties on
     * a global `Modernizr` object, and as classes on the `<html>` element. This
     * information allows you to progressively enhance your pages with a granular level
     * of control over the experience.
    */

    (function (window, document, undefined) {
        var classes = [];


        var tests = [];


        /**
         *
         * ModernizrProto is the constructor for Modernizr
         *
         * @class
         * @access public
         */

        var ModernizrProto = {
            // The current version, dummy
            _version: '3.6.0',

            // Any settings that don't work as separate modules
            // can go in here as configuration.
            _config: {
                'classPrefix': '',
                'enableClasses': true,
                'enableJSClass': true,
                'usePrefixes': true
            },

            // Queue of tests
            _q: [],

            // Stub these for people who are listening
            on: function (test, cb) {
                // I don't really think people should do this, but we can
                // safe guard it a bit.
                // -- NOTE:: this gets WAY overridden in src/addTest for actual async tests.
                // This is in case people listen to synchronous tests. I would leave it out,
                // but the code to *disallow* sync tests in the real version of this
                // function is actually larger than this.
                var self = this;
                setTimeout(function () {
                    cb(self[test]);
                }, 0);
            },

            addTest: function (name, fn, options) {
                tests.push({name: name, fn: fn, options: options});
            },

            addAsyncTest: function (fn) {
                tests.push({name: null, fn: fn});
            }
        };


        // Fake some of Object.create so we can force non test results to be non "own" properties.
        var Modernizr = function () {
        };
        Modernizr.prototype = ModernizrProto;

        // Leak modernizr globally when you `require` it rather than force it here.
        // Overwrite name so constructor name is nicer :D
        Modernizr = new Modernizr();


        /**
         * is returns a boolean if the typeof an obj is exactly type.
         *
         * @access private
         * @function is
         * @param {*} obj - A thing we want to check the type of
         * @param {string} type - A string to compare the typeof against
         * @returns {boolean}
         */

        function is(obj, type) {
            return typeof obj === type;
        }

        /**
         * Run through all tests and detect their support in the current UA.
         *
         * @access private
         */

        function testRunner() {
            var featureNames;
            var feature;
            var aliasIdx;
            var result;
            var nameIdx;
            var featureName;
            var featureNameSplit;

            for (var featureIdx in tests) {
                if (tests.hasOwnProperty(featureIdx)) {
                    featureNames = [];
                    feature = tests[featureIdx];
                    // run the test, throw the return value into the Modernizr,
                    // then based on that boolean, define an appropriate className
                    // and push it into an array of classes we'll join later.
                    //
                    // If there is no name, it's an 'async' test that is run,
                    // but not directly added to the object. That should
                    // be done with a post-run addTest call.
                    if (feature.name) {
                        featureNames.push(feature.name.toLowerCase());

                        if (feature.options && feature.options.aliases && feature.options.aliases.length) {
                            // Add all the aliases into the names list
                            for (aliasIdx = 0; aliasIdx < feature.options.aliases.length; aliasIdx++) {
                                featureNames.push(feature.options.aliases[aliasIdx].toLowerCase());
                            }
                        }
                    }

                    // Run the test, or use the raw value if it's not a function
                    result = is(feature.fn, 'function') ? feature.fn() : feature.fn;


                    // Set each of the names on the Modernizr object
                    for (nameIdx = 0; nameIdx < featureNames.length; nameIdx++) {
                        featureName = featureNames[nameIdx];
                        // Support dot properties as sub tests. We don't do checking to make sure
                        // that the implied parent tests have been added. You must call them in
                        // order (either in the test, or make the parent test a dependency).
                        //
                        // Cap it to TWO to make the logic simple and because who needs that kind of subtesting
                        // hashtag famous last words
                        featureNameSplit = featureName.split('.');

                        if (featureNameSplit.length === 1) {
                            Modernizr[featureNameSplit[0]] = result;
                        } else {
                            // cast to a Boolean, if not one already
                            if (Modernizr[featureNameSplit[0]] && !(Modernizr[featureNameSplit[0]] instanceof Boolean)) {
                                Modernizr[featureNameSplit[0]] = Boolean(Modernizr[featureNameSplit[0]]);
                            }

                            Modernizr[featureNameSplit[0]][featureNameSplit[1]] = result;
                        }

                        classes.push((result ? '' : 'no-') + featureNameSplit.join('-'));
                    }
                }
            }
        }

        /**
         * docElement is a convenience wrapper to grab the root element of the document
         *
         * @access private
         * @returns {HTMLElement|SVGElement} The root element of the document
         */

        var docElement = document.documentElement;


        /**
         * A convenience helper to check if the document we are running in is an SVG document
         *
         * @access private
         * @returns {boolean}
         */

        var isSVG = docElement.nodeName.toLowerCase() === 'svg';


        /**
         * setClasses takes an array of class names and adds them to the root element
         *
         * @access private
         * @function setClasses
         * @param {string[]} classes - Array of class names
         */

        // Pass in an and array of class names, e.g.:
        //  ['no-webp', 'borderradius', ...]
        function setClasses(classes) {
            var className = docElement.className;
            var classPrefix = Modernizr._config.classPrefix || '';

            if (isSVG) {
                className = className.baseVal;
            }

            // Change `no-js` to `js` (independently of the `enableClasses` option)
            // Handle classPrefix on this too
            if (Modernizr._config.enableJSClass) {
                var reJS = new RegExp('(^|\\s)' + classPrefix + 'no-js(\\s|$)');
                className = className.replace(reJS, '$1' + classPrefix + 'js$2');
            }

            if (Modernizr._config.enableClasses) {
                // Add the new classes
                className += ' ' + classPrefix + classes.join(' ' + classPrefix);
                if (isSVG) {
                    docElement.className.baseVal = className;
                } else {
                    docElement.className = className;
                }
            }

        }

        /**
         * If the browsers follow the spec, then they would expose vendor-specific styles as:
         *   elem.style.WebkitBorderRadius
         * instead of something like the following (which is technically incorrect):
         *   elem.style.webkitBorderRadius

         * WebKit ghosts their properties in lowercase but Opera & Moz do not.
         * Microsoft uses a lowercase `ms` instead of the correct `Ms` in IE8+
         *   erik.eae.net/archives/2008/03/10/21.48.10/

         * More here: github.com/Modernizr/Modernizr/issues/issue/21
         *
         * @access private
         * @returns {string} The string representing the vendor-specific style properties
         */

        var omPrefixes = 'Moz O ms Webkit';


        var cssomPrefixes = (ModernizrProto._config.usePrefixes ? omPrefixes.split(' ') : []);
        ModernizrProto._cssomPrefixes = cssomPrefixes;


        /**
         * List of JavaScript DOM values used for tests
         *
         * @memberof Modernizr
         * @name Modernizr._domPrefixes
         * @optionName Modernizr._domPrefixes
         * @optionProp domPrefixes
         * @access public
         * @example
         *
         * Modernizr._domPrefixes is exactly the same as [_prefixes](#modernizr-_prefixes), but rather
         * than kebab-case properties, all properties are their Capitalized variant
         *
         * ```js
         * Modernizr._domPrefixes === [ "Moz", "O", "ms", "Webkit" ];
         * ```
         */

        var domPrefixes = (ModernizrProto._config.usePrefixes ? omPrefixes.toLowerCase().split(' ') : []);
        ModernizrProto._domPrefixes = domPrefixes;


        /**
         * cssToDOM takes a kebab-case string and converts it to camelCase
         * e.g. box-sizing -> boxSizing
         *
         * @access private
         * @function cssToDOM
         * @param {string} name - String name of kebab-case prop we want to convert
         * @returns {string} The camelCase version of the supplied name
         */

        function cssToDOM(name) {
            return name.replace(/([a-z])-([a-z])/g, function (str, m1, m2) {
                return m1 + m2.toUpperCase();
            }).replace(/^-/, '');
        }

        /**
         * contains checks to see if a string contains another string
         *
         * @access private
         * @function contains
         * @param {string} str - The string we want to check for substrings
         * @param {string} substr - The substring we want to search the first string for
         * @returns {boolean}
         */

        function contains(str, substr) {
            return !!~('' + str).indexOf(substr);
        }

        /**
         * createElement is a convenience wrapper around document.createElement. Since we
         * use createElement all over the place, this allows for (slightly) smaller code
         * as well as abstracting away issues with creating elements in contexts other than
         * HTML documents (e.g. SVG documents).
         *
         * @access private
         * @function createElement
         * @returns {HTMLElement|SVGElement} An HTML or SVG element
         */

        function createElement() {
            if (typeof document.createElement !== 'function') {
                // This is the case in IE7, where the type of createElement is "object".
                // For this reason, we cannot call apply() as Object is not a Function.
                return document.createElement(arguments[0]);
            } else if (isSVG) {
                return document.createElementNS.call(document, 'http://www.w3.org/2000/svg', arguments[0]);
            } else {
                return document.createElement.apply(document, arguments);
            }
        }

        /**
         * fnBind is a super small [bind](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/bind) polyfill.
         *
         * @access private
         * @function fnBind
         * @param {function} fn - a function you want to change `this` reference to
         * @param {object} that - the `this` you want to call the function with
         * @returns {function} The wrapped version of the supplied function
         */

        function fnBind(fn, that) {
            return function () {
                return fn.apply(that, arguments);
            };
        }

        /**
         * testDOMProps is a generic DOM property test; if a browser supports
         *   a certain property, it won't return undefined for it.
         *
         * @access private
         * @function testDOMProps
         * @param {array.<string>} props - An array of properties to test for
         * @param {object} obj - An object or Element you want to use to test the parameters again
         * @param {boolean|object} elem - An Element to bind the property lookup again. Use `false` to prevent the check
         * @returns {false|*} returns false if the prop is unsupported, otherwise the value that is supported
         */
        function testDOMProps(props, obj, elem) {
            var item;

            for (var i in props) {
                if (props[i] in obj) {

                    // return the property name as a string
                    if (elem === false) {
                        return props[i];
                    }

                    item = obj[props[i]];

                    // let's bind a function
                    if (is(item, 'function')) {
                        // bind to obj unless overriden
                        return fnBind(item, elem || obj);
                    }

                    // return the unbound function or obj or value
                    return item;
                }
            }
            return false;
        }

        /**
         * Create our "modernizr" element that we do most feature tests on.
         *
         * @access private
         */

        var modElem = {
            elem: createElement('modernizr')
        };

        // Clean up this element
        Modernizr._q.push(function () {
            delete modElem.elem;
        });


        var mStyle = {
            style: modElem.elem.style
        };

        // kill ref for gc, must happen before mod.elem is removed, so we unshift on to
        // the front of the queue.
        Modernizr._q.unshift(function () {
            delete mStyle.style;
        });


        /**
         * domToCSS takes a camelCase string and converts it to kebab-case
         * e.g. boxSizing -> box-sizing
         *
         * @access private
         * @function domToCSS
         * @param {string} name - String name of camelCase prop we want to convert
         * @returns {string} The kebab-case version of the supplied name
         */

        function domToCSS(name) {
            return name.replace(/([A-Z])/g, function (str, m1) {
                return '-' + m1.toLowerCase();
            }).replace(/^ms-/, '-ms-');
        }

        /**
         * wrapper around getComputedStyle, to fix issues with Firefox returning null when
         * called inside of a hidden iframe
         *
         * @access private
         * @function computedStyle
         * @param {HTMLElement|SVGElement} - The element we want to find the computed styles of
         * @param {string|null} [pseudoSelector]- An optional pseudo element selector (e.g. :before), of null if none
         * @returns {CSSStyleDeclaration}
         */

        function computedStyle(elem, pseudo, prop) {
            var result;

            if ('getComputedStyle' in window) {
                result = getComputedStyle.call(window, elem, pseudo);
                var console = window.console;

                if (result !== null) {
                    if (prop) {
                        result = result.getPropertyValue(prop);
                    }
                } else {
                    if (console) {
                        var method = console.error ? 'error' : 'log';
                        console[method].call(console, 'getComputedStyle returning null, its possible modernizr test results are inaccurate');
                    }
                }
            } else {
                result = !pseudo && elem.currentStyle && elem.currentStyle[prop];
            }

            return result;
        }

        /**
         * getBody returns the body of a document, or an element that can stand in for
         * the body if a real body does not exist
         *
         * @access private
         * @function getBody
         * @returns {HTMLElement|SVGElement} Returns the real body of a document, or an
         * artificially created element that stands in for the body
         */

        function getBody() {
            // After page load injecting a fake body doesn't work so check if body exists
            var body = document.body;

            if (!body) {
                // Can't use the real body create a fake one.
                body = createElement(isSVG ? 'svg' : 'body');
                body.fake = true;
            }

            return body;
        }

        /**
         * injectElementWithStyles injects an element with style element and some CSS rules
         *
         * @access private
         * @function injectElementWithStyles
         * @param {string} rule - String representing a css rule
         * @param {function} callback - A function that is used to test the injected element
         * @param {number} [nodes] - An integer representing the number of additional nodes you want injected
         * @param {string[]} [testnames] - An array of strings that are used as ids for the additional nodes
         * @returns {boolean}
         */

        function injectElementWithStyles(rule, callback, nodes, testnames) {
            var mod = 'modernizr';
            var style;
            var ret;
            var node;
            var docOverflow;
            var div = createElement('div');
            var body = getBody();

            if (parseInt(nodes, 10)) {
                // In order not to give false positives we create a node for each test
                // This also allows the method to scale for unspecified uses
                while (nodes--) {
                    node = createElement('div');
                    node.id = testnames ? testnames[nodes] : mod + (nodes + 1);
                    div.appendChild(node);
                }
            }

            style = createElement('style');
            style.type = 'text/css';
            style.id = 's' + mod;

            // IE6 will false positive on some tests due to the style element inside the test div somehow interfering offsetHeight, so insert it into body or fakebody.
            // Opera will act all quirky when injecting elements in documentElement when page is served as xml, needs fakebody too. #270
            (!body.fake ? div : body).appendChild(style);
            body.appendChild(div);

            if (style.styleSheet) {
                style.styleSheet.cssText = rule;
            } else {
                style.appendChild(document.createTextNode(rule));
            }
            div.id = mod;

            if (body.fake) {
                //avoid crashing IE8, if background image is used
                body.style.background = '';
                //Safari 5.13/5.1.4 OSX stops loading if ::-webkit-scrollbar is used and scrollbars are visible
                body.style.overflow = 'hidden';
                docOverflow = docElement.style.overflow;
                docElement.style.overflow = 'hidden';
                docElement.appendChild(body);
            }

            ret = callback(div, rule);
            // If this is done after page load we don't want to remove the body so check if body exists
            if (body.fake) {
                body.parentNode.removeChild(body);
                docElement.style.overflow = docOverflow;
                // Trigger layout so kinetic scrolling isn't disabled in iOS6+
                // eslint-disable-next-line
                docElement.offsetHeight;
            } else {
                div.parentNode.removeChild(div);
            }

            return !!ret;

        }

        /**
         * nativeTestProps allows for us to use native feature detection functionality if available.
         * some prefixed form, or false, in the case of an unsupported rule
         *
         * @access private
         * @function nativeTestProps
         * @param {array} props - An array of property names
         * @param {string} value - A string representing the value we want to check via @supports
         * @returns {boolean|undefined} A boolean when @supports exists, undefined otherwise
         */

        // Accepts a list of property names and a single value
        // Returns `undefined` if native detection not available
        function nativeTestProps(props, value) {
            var i = props.length;
            // Start with the JS API: http://www.w3.org/TR/css3-conditional/#the-css-interface
            if ('CSS' in window && 'supports' in window.CSS) {
                // Try every prefixed variant of the property
                while (i--) {
                    if (window.CSS.supports(domToCSS(props[i]), value)) {
                        return true;
                    }
                }
                return false;
            }
            // Otherwise fall back to at-rule (for Opera 12.x)
            else if ('CSSSupportsRule' in window) {
                // Build a condition string for every prefixed variant
                var conditionText = [];
                while (i--) {
                    conditionText.push('(' + domToCSS(props[i]) + ':' + value + ')');
                }
                conditionText = conditionText.join(' or ');
                return injectElementWithStyles('@supports (' + conditionText + ') { #modernizr { position: absolute; } }', function (node) {
                    return computedStyle(node, null, 'position') == 'absolute';
                });
            }
            return undefined;
        }

        // testProps is a generic CSS / DOM property test.

        // In testing support for a given CSS property, it's legit to test:
        //    `elem.style[styleName] !== undefined`
        // If the property is supported it will return an empty string,
        // if unsupported it will return undefined.

        // We'll take advantage of this quick test and skip setting a style
        // on our modernizr element, but instead just testing undefined vs
        // empty string.

        // Property names can be provided in either camelCase or kebab-case.

        function testProps(props, prefixed, value, skipValueTest) {
            skipValueTest = is(skipValueTest, 'undefined') ? false : skipValueTest;

            // Try native detect first
            if (!is(value, 'undefined')) {
                var result = nativeTestProps(props, value);
                if (!is(result, 'undefined')) {
                    return result;
                }
            }

            // Otherwise do it properly
            var afterInit, i, propsLength, prop, before;

            // If we don't have a style element, that means we're running async or after
            // the core tests, so we'll need to create our own elements to use

            // inside of an SVG element, in certain browsers, the `style` element is only
            // defined for valid tags. Therefore, if `modernizr` does not have one, we
            // fall back to a less used element and hope for the best.
            // for strict XHTML browsers the hardly used samp element is used
            var elems = ['modernizr', 'tspan', 'samp'];
            while (!mStyle.style && elems.length) {
                afterInit = true;
                mStyle.modElem = createElement(elems.shift());
                mStyle.style = mStyle.modElem.style;
            }

            // Delete the objects if we created them.
            function cleanElems() {
                if (afterInit) {
                    delete mStyle.style;
                    delete mStyle.modElem;
                }
            }

            propsLength = props.length;
            for (i = 0; i < propsLength; i++) {
                prop = props[i];
                before = mStyle.style[prop];

                if (contains(prop, '-')) {
                    prop = cssToDOM(prop);
                }

                if (mStyle.style[prop] !== undefined) {

                    // If value to test has been passed in, do a set-and-check test.
                    // 0 (integer) is a valid property value, so check that `value` isn't
                    // undefined, rather than just checking it's truthy.
                    if (!skipValueTest && !is(value, 'undefined')) {

                        // Needs a try catch block because of old IE. This is slow, but will
                        // be avoided in most cases because `skipValueTest` will be used.
                        try {
                            mStyle.style[prop] = value;
                        } catch (e) {
                        }

                        // If the property value has changed, we assume the value used is
                        // supported. If `value` is empty string, it'll fail here (because
                        // it hasn't changed), which matches how browsers have implemented
                        // CSS.supports()
                        if (mStyle.style[prop] != before) {
                            cleanElems();
                            return prefixed == 'pfx' ? prop : true;
                        }
                    }
                    // Otherwise just return true, or the property name if this is a
                    // `prefixed()` call
                    else {
                        cleanElems();
                        return prefixed == 'pfx' ? prop : true;
                    }
                }
            }
            cleanElems();
            return false;
        }

        /**
         * testPropsAll tests a list of DOM properties we want to check against.
         * We specify literally ALL possible (known and/or likely) properties on
         * the element including the non-vendor prefixed one, for forward-
         * compatibility.
         *
         * @access private
         * @function testPropsAll
         * @param {string} prop - A string of the property to test for
         * @param {string|object} [prefixed] - An object to check the prefixed properties on. Use a string to skip
         * @param {HTMLElement|SVGElement} [elem] - An element used to test the property and value against
         * @param {string} [value] - A string of a css value
         * @param {boolean} [skipValueTest] - An boolean representing if you want to test if value sticks when set
         * @returns {false|string} returns the string version of the property, or false if it is unsupported
         */
        function testPropsAll(prop, prefixed, elem, value, skipValueTest) {

            var ucProp = prop.charAt(0).toUpperCase() + prop.slice(1),
                props = (prop + ' ' + cssomPrefixes.join(ucProp + ' ') + ucProp).split(' ');

            // did they call .prefixed('boxSizing') or are we just testing a prop?
            if (is(prefixed, 'string') || is(prefixed, 'undefined')) {
                return testProps(props, prefixed, value, skipValueTest);

                // otherwise, they called .prefixed('requestAnimationFrame', window[, elem])
            } else {
                props = (prop + ' ' + (domPrefixes).join(ucProp + ' ') + ucProp).split(' ');
                return testDOMProps(props, prefixed, elem);
            }
        }

        // Modernizr.testAllProps() investigates whether a given style property,
        // or any of its vendor-prefixed variants, is recognized
        //
        // Note that the property names must be provided in the camelCase variant.
        // Modernizr.testAllProps('boxSizing')
        ModernizrProto.testAllProps = testPropsAll;


        /**
         * testAllProps determines whether a given CSS property is supported in the browser
         *
         * @memberof Modernizr
         * @name Modernizr.testAllProps
         * @optionName Modernizr.testAllProps()
         * @optionProp testAllProps
         * @access public
         * @function testAllProps
         * @param {string} prop - String naming the property to test (either camelCase or kebab-case)
         * @param {string} [value] - String of the value to test
         * @param {boolean} [skipValueTest=false] - Whether to skip testing that the value is supported when using non-native detection
         * @example
         *
         * testAllProps determines whether a given CSS property, in some prefixed form,
         * is supported by the browser.
         *
         * ```js
         * testAllProps('boxSizing')  // true
         * ```
         *
         * It can optionally be given a CSS value in string form to test if a property
         * value is valid
         *
         * ```js
         * testAllProps('display', 'block') // true
         * testAllProps('display', 'penguin') // false
         * ```
         *
         * A boolean can be passed as a third parameter to skip the value check when
         * native detection (@supports) isn't available.
         *
         * ```js
         * testAllProps('shapeOutside', 'content-box', true);
         * ```
         */

        function testAllProps(prop, value, skipValueTest) {
            return testPropsAll(prop, undefined, undefined, value, skipValueTest);
        }

        ModernizrProto.testAllProps = testAllProps;

        /*!
        {
          "name": "CSS Transitions",
          "property": "csstransitions",
          "caniuse": "css-transitions",
          "tags": ["css"]
        }
        !*/

        Modernizr.addTest('csstransitions', testAllProps('transition', 'all', true));

        /*!
        {
          "name": "CSS Animations",
          "property": "cssanimations",
          "caniuse": "css-animation",
          "polyfills": ["transformie", "csssandpaper"],
          "tags": ["css"],
          "warnings": ["Android < 4 will pass this test, but can only animate a single property at a time"],
          "notes": [{
            "name" : "Article: 'Dispelling the Android CSS animation myths'",
            "href": "https://goo.gl/OGw5Gm"
          }]
        }
        !*/
        /* DOC
        Detects whether or not elements can be animated using CSS
        */

        Modernizr.addTest('cssanimations', testAllProps('animationName', 'a', true));


        // Run each test
        testRunner();

        // Remove the "no-js" class if it exists
        setClasses(classes);

        delete ModernizrProto.addTest;
        delete ModernizrProto.addAsyncTest;

        // Run the things that are supposed to run after the tests
        for (var i = 0; i < Modernizr._q.length; i++) {
            Modernizr._q[i]();
        }

        // Leak Modernizr namespace
        window.Modernizr = Modernizr;


    })(window, document);

    // Define Parallax For Theme
    jQuery(function ($) {
        $('#da-slider').cslider(
            {
                autoplay: true,
                bgincrement: 450,
                interval: evolve_js_local_vars.parallax_speed
            }
        )
    });
}

/*
   Infinite Scroll
   ======================================= */

if (evolve_js_local_vars.infinite_scroll_enabled === '1') {

    /*!
 * Infinite Ajax Scroll v2.3.1
 * A jQuery plugin for infinite scrolling
 * https://infiniteajaxscroll.com
 *
 * Commercial use requires one-time purchase of a commercial license
 * https://infiniteajaxscroll.com/docs/license.html
 *
 * Non-commercial use is licensed under the MIT License
 *
 * Copyright (c) 2018 Webcreate (Jeroen Fiege)
 */
    var IASCallbacks = function (a) {
        return this.list = [], this.fireStack = [], this.isFiring = !1, this.isDisabled = !1, this.Deferred = a.Deferred, this.fire = function (a) {
            var b = a[0], c = a[1], d = a[2];
            this.isFiring = !0;
            for (var e = 0, f = this.list.length; f > e; e++) if (void 0 != this.list[e] && !1 === this.list[e].fn.apply(b, d)) {
                c.reject();
                break
            }
            this.isFiring = !1, c.resolve(), this.fireStack.length && this.fire(this.fireStack.shift())
        }, this.inList = function (a, b) {
            b = b || 0;
            for (var c = b, d = this.list.length; d > c; c++) if (this.list[c].fn === a || a.guid && this.list[c].fn.guid && a.guid === this.list[c].fn.guid) return c;
            return -1
        }, this
    };
    IASCallbacks.prototype = {
        add: function (a, b) {
            var c = {fn: a, priority: b};
            b = b || 0;
            for (var d = 0, e = this.list.length; e > d; d++) if (b > this.list[d].priority) return this.list.splice(d, 0, c), this;
            return this.list.push(c), this
        }, remove: function (a) {
            for (var b = 0; (b = this.inList(a, b)) > -1;) this.list.splice(b, 1);
            return this
        }, has: function (a) {
            return this.inList(a) > -1
        }, fireWith: function (a, b) {
            var c = this.Deferred();
            return this.isDisabled ? c.reject() : (b = b || [], b = [a, c, b.slice ? b.slice() : b], this.isFiring ? this.fireStack.push(b) : this.fire(b), c)
        }, disable: function () {
            this.isDisabled = !0
        }, enable: function () {
            this.isDisabled = !1
        }
    }, function (a) {
        "use strict";
        var b = -1, c = function (c, d) {
            return this.itemsContainerSelector = d.container, this.itemSelector = d.item, this.nextSelector = d.next, this.paginationSelector = d.pagination, this.$scrollContainer = c, this.$container = window === c.get(0) ? a(document) : c, this.defaultDelay = d.delay, this.negativeMargin = d.negativeMargin, this.nextUrl = null, this.isBound = !1, this.isPaused = !1, this.isInitialized = !1, this.jsXhr = !1, this.listeners = {
                next: new IASCallbacks(a),
                load: new IASCallbacks(a),
                loaded: new IASCallbacks(a),
                render: new IASCallbacks(a),
                rendered: new IASCallbacks(a),
                scroll: new IASCallbacks(a),
                noneLeft: new IASCallbacks(a),
                ready: new IASCallbacks(a)
            }, this.extensions = [], this.scrollHandler = function () {
                if (this.isBound && !this.isPaused) {
                    var a = this.getCurrentScrollOffset(this.$scrollContainer), c = this.getScrollThreshold();
                    b != c && (this.fire("scroll", [a, c]), a >= c && this.next())
                }
            }, this.getItemsContainer = function () {
                return a(this.itemsContainerSelector, this.$container)
            }, this.getLastItem = function () {
                return a(this.itemSelector, this.getItemsContainer().get(0)).last()
            }, this.getFirstItem = function () {
                return a(this.itemSelector, this.getItemsContainer().get(0)).first()
            }, this.getScrollThreshold = function (a) {
                var c;
                return a = a || this.negativeMargin, a = a >= 0 ? -1 * a : a, c = this.getLastItem(), 0 === c.length ? b : c.offset().top + c.height() + a
            }, this.getCurrentScrollOffset = function (a) {
                var b = 0, c = a.height();
                return b = window === a.get(0) ? a.scrollTop() : a.offset().top, (-1 != navigator.platform.indexOf("iPhone") || -1 != navigator.platform.indexOf("iPod")) && (c += 80), b + c
            }, this.getNextUrl = function (b) {
                return b = b || this.$container, a(this.nextSelector, b).last().attr("href")
            }, this.load = function (b, c, d) {
                function e(b) {
                    f = a(this.itemsContainerSelector, b).eq(0), 0 === f.length && (f = a(b).filter(this.itemsContainerSelector).eq(0)), f && f.find(this.itemSelector).each(function () {
                        i.push(this)
                    }), h.fire("loaded", [b, i]), c && (g = +new Date - j, d > g ? setTimeout(function () {
                        c.call(h, b, i)
                    }, d - g) : c.call(h, b, i))
                }

                var f, g, h = this, i = [], j = +new Date;
                d = d || this.defaultDelay;
                var k = {url: b, ajaxOptions: {dataType: "html"}};
                return h.fire("load", [k]), this.jsXhr = a.ajax(k.url, k.ajaxOptions).done(a.proxy(e, h)), this.jsXhr
            }, this.render = function (b, c) {
                var d = this, e = this.getLastItem(), f = 0, g = this.fire("render", [b]);
                g.done(function () {
                    a(b).hide(), e.after(b), a(b).fadeIn(400, function () {
                        ++f < b.length || (d.fire("rendered", [b]), c && c())
                    })
                }), g.fail(function () {
                    c && c()
                })
            }, this.hidePagination = function () {
                this.paginationSelector && a(this.paginationSelector, this.$container).hide()
            }, this.restorePagination = function () {
                this.paginationSelector && a(this.paginationSelector, this.$container).show()
            }, this.throttle = function (b, c) {
                var d, e, f = 0;
                return d = function () {
                    function a() {
                        f = +new Date, b.apply(d, g)
                    }

                    var d = this, g = arguments, h = +new Date - f;
                    e ? clearTimeout(e) : a(), h > c ? a() : e = setTimeout(a, c)
                }, a.guid && (d.guid = b.guid = b.guid || a.guid++), d
            }, this.fire = function (a, b) {
                return this.listeners[a].fireWith(this, b)
            }, this.pause = function () {
                this.isPaused = !0
            }, this.resume = function () {
                this.isPaused = !1
            }, this
        };
        c.prototype.initialize = function () {
            if (this.isInitialized) return !1;
            var a = !!("onscroll" in this.$scrollContainer.get(0)),
                b = this.getCurrentScrollOffset(this.$scrollContainer),
                c = this.getScrollThreshold();
            return a ? (this.hidePagination(), this.bind(), this.nextUrl = this.getNextUrl(), this.nextUrl || this.fire("noneLeft", [this.getLastItem()]), this.nextUrl && b >= c ? (this.next(), this.one("rendered", function () {
                this.isInitialized = !0, this.fire("ready")
            })) : (this.isInitialized = !0, this.fire("ready")), this) : !1
        }, c.prototype.reinitialize = function () {
            this.isInitialized = !1, this.unbind(), this.initialize()
        }, c.prototype.bind = function () {
            if (!this.isBound) {
                this.$scrollContainer.on("scroll", a.proxy(this.throttle(this.scrollHandler, 150), this));
                for (var b = 0, c = this.extensions.length; c > b; b++) this.extensions[b].bind(this);
                this.isBound = !0, this.resume()
            }
        }, c.prototype.unbind = function () {
            if (this.isBound) {
                this.$scrollContainer.off("scroll", this.scrollHandler);
                for (var a = 0, b = this.extensions.length; b > a; a++) "undefined" != typeof this.extensions[a].unbind && this.extensions[a].unbind(this);
                this.isBound = !1
            }
        }, c.prototype.destroy = function () {
            try {
                this.jsXhr.abort()
            } catch (a) {
            }
            this.unbind(), this.$scrollContainer.data("ias", null)
        }, c.prototype.on = function (b, c, d) {
            if ("undefined" == typeof this.listeners[b]) throw new Error('There is no event called "' + b + '"');
            return d = d || 0, this.listeners[b].add(a.proxy(c, this), d), this.isInitialized && ("ready" === b ? a.proxy(c, this)() : "noneLeft" !== b || this.nextUrl || a.proxy(c, this)()), this
        }, c.prototype.one = function (a, b) {
            var c = this, d = function () {
                c.off(a, b), c.off(a, d)
            };
            return this.on(a, b), this.on(a, d), this
        }, c.prototype.off = function (a, b) {
            if ("undefined" == typeof this.listeners[a]) throw new Error('There is no event called "' + a + '"');
            return this.listeners[a].remove(b), this
        }, c.prototype.next = function () {
            var a = this.nextUrl, b = this;
            if (!a) return !1;
            this.pause();
            var c = this.fire("next", [a]);
            return c.done(function () {
                b.load(a, function (a, c) {
                    b.render(c, function () {
                        b.nextUrl = b.getNextUrl(a), b.nextUrl || b.fire("noneLeft", [b.getLastItem()]), b.resume()
                    })
                })
            }), c.fail(function () {
                b.resume()
            }), !0
        }, c.prototype.extension = function (a) {
            if ("undefined" == typeof a.bind) throw new Error('Extension doesn\'t have required method "bind"');
            return "undefined" != typeof a.initialize && a.initialize(this), this.extensions.push(a), this.isBound && this.reinitialize(), this
        }, a.ias = function (b) {
            var c = a(window);
            return c.ias.apply(c, arguments)
        }, a.fn.ias = function (b) {
            var d = Array.prototype.slice.call(arguments), e = this;
            return this.each(function () {
                var f = a(this), g = f.data("ias"),
                    h = a.extend({}, a.fn.ias.defaults, f.data(), "object" == typeof b && b);
                if (g || (f.data("ias", g = new c(f, h)), h.initialize && a(document).ready(a.proxy(g.initialize, g))), "string" == typeof b) {
                    if ("function" != typeof g[b]) throw new Error('There is no method called "' + b + '"');
                    d.shift(), g[b].apply(g, d)
                }
                e = g
            }), e
        }, a.fn.ias.defaults = {
            item: ".item",
            container: ".listing",
            next: ".next",
            pagination: !1,
            delay: 600,
            negativeMargin: 10,
            initialize: !0
        }
    }(jQuery);
    var IASHistoryExtension = function (a) {
        return a = jQuery.extend({}, this.defaults, a), this.ias = null, this.prevSelector = a.prev, this.prevUrl = null, this.listeners = {prev: new IASCallbacks(jQuery)}, this.onPageChange = function (a, b, c) {
            if (window.history && window.history.replaceState) {
                var d = history.state;
                history.replaceState(d, document.title, c)
            }
        }, this.onScroll = function (a, b) {
            var c = this.getScrollThresholdFirstItem();
            this.prevUrl && (a -= this.ias.$scrollContainer.height(), c >= a && this.prev())
        }, this.onReady = function () {
            var a = this.ias.getCurrentScrollOffset(this.ias.$scrollContainer), b = this.getScrollThresholdFirstItem();
            a -= this.ias.$scrollContainer.height(), b >= a && this.prev()
        }, this.getPrevUrl = function (a) {
            return a || (a = this.ias.$container), jQuery(this.prevSelector, a).last().attr("href")
        }, this.getScrollThresholdFirstItem = function () {
            var a;
            return a = this.ias.getFirstItem(), 0 === a.length ? -1 : a.offset().top
        }, this.renderBefore = function (a, b) {
            var c = this.ias, d = c.getFirstItem(), e = 0;
            c.fire("render", [a]), jQuery(a).hide(), d.before(a), jQuery(a).fadeIn(400, function () {
                ++e < a.length || (c.fire("rendered", [a]), b && b())
            })
        }, this
    };
    IASHistoryExtension.prototype.initialize = function (a) {
        var b = this;
        this.ias = a, jQuery.extend(a.listeners, this.listeners), a.prev = function () {
            return b.prev()
        }, this.prevUrl = this.getPrevUrl()
    }, IASHistoryExtension.prototype.bind = function (a) {
        a.on("pageChange", jQuery.proxy(this.onPageChange, this)), a.on("scroll", jQuery.proxy(this.onScroll, this)), a.on("ready", jQuery.proxy(this.onReady, this))
    }, IASHistoryExtension.prototype.unbind = function (a) {
        a.off("pageChange", this.onPageChange), a.off("scroll", this.onScroll), a.off("ready", this.onReady)
    }, IASHistoryExtension.prototype.prev = function () {
        var a = this.prevUrl, b = this, c = this.ias;
        if (!a) return !1;
        c.pause();
        var d = c.fire("prev", [a]);
        return d.done(function () {
            c.load(a, function (a, d) {
                b.renderBefore(d, function () {
                    b.prevUrl = b.getPrevUrl(a), c.resume(), b.prevUrl && b.prev()
                })
            })
        }), d.fail(function () {
            c.resume()
        }), !0
    }, IASHistoryExtension.prototype.defaults = {prev: ".prev"};
    var IASNoneLeftExtension = function (a) {
        return a = jQuery.extend({}, this.defaults, a), this.ias = null, this.uid = (new Date).getTime(), this.html = a.html.replace("{text}", a.text), this.showNoneLeft = function () {
            var a = jQuery(this.html).attr("id", "ias_noneleft_" + this.uid), b = this.ias.getLastItem();
            b.after(a), a.fadeIn()
        }, this
    };
    IASNoneLeftExtension.prototype.bind = function (a) {
        this.ias = a, a.on("noneLeft", jQuery.proxy(this.showNoneLeft, this))
    }, IASNoneLeftExtension.prototype.unbind = function (a) {
        a.off("noneLeft", this.showNoneLeft)
    }, IASNoneLeftExtension.prototype.defaults = {
        text: "You reached the end.",
        html: '<div class="ias-noneleft" style="text-align: center;">{text}</div>'
    };
    var IASPagingExtension = function () {
        return this.ias = null, this.pagebreaks = [[0, document.location.toString()]], this.lastPageNum = 1, this.enabled = !0, this.listeners = {pageChange: new IASCallbacks(jQuery)}, this.onScroll = function (a, b) {
            if (this.enabled) {
                var c, d = this.ias, e = this.getCurrentPageNum(a), f = this.getCurrentPagebreak(a);
                this.lastPageNum !== e && (c = f[1], d.fire("pageChange", [e, a, c])), this.lastPageNum = e
            }
        }, this.onNext = function (a) {
            var b = this.ias.getCurrentScrollOffset(this.ias.$scrollContainer);
            this.pagebreaks.push([b, a]);
            var c = this.getCurrentPageNum(b) + 1;
            this.ias.fire("pageChange", [c, b, a]), this.lastPageNum = c
        }, this.onPrev = function (a) {
            var b = this, c = b.ias, d = c.getCurrentScrollOffset(c.$scrollContainer),
                e = d - c.$scrollContainer.height(),
                f = c.getFirstItem();
            this.enabled = !1, this.pagebreaks.unshift([0, a]), c.one("rendered", function () {
                for (var d = 1, g = b.pagebreaks.length; g > d; d++) b.pagebreaks[d][0] = b.pagebreaks[d][0] + f.offset().top;
                var h = b.getCurrentPageNum(e) + 1;
                c.fire("pageChange", [h, e, a]), b.lastPageNum = h, b.enabled = !0
            })
        }, this
    };
    IASPagingExtension.prototype.initialize = function (a) {
        this.ias = a, jQuery.extend(a.listeners, this.listeners)
    }, IASPagingExtension.prototype.bind = function (a) {
        try {
            a.on("prev", jQuery.proxy(this.onPrev, this), this.priority)
        } catch (b) {
        }
        a.on("next", jQuery.proxy(this.onNext, this), this.priority), a.on("scroll", jQuery.proxy(this.onScroll, this), this.priority)
    }, IASPagingExtension.prototype.unbind = function (a) {
        try {
            a.off("prev", this.onPrev)
        } catch (b) {
        }
        a.off("next", this.onNext), a.off("scroll", this.onScroll)
    }, IASPagingExtension.prototype.getCurrentPageNum = function (a) {
        for (var b = this.pagebreaks.length - 1; b > 0; b--) if (a > this.pagebreaks[b][0]) return b + 1;
        return 1
    }, IASPagingExtension.prototype.getCurrentPagebreak = function (a) {
        for (var b = this.pagebreaks.length - 1; b >= 0; b--) if (a > this.pagebreaks[b][0]) return this.pagebreaks[b];
        return null
    }, IASPagingExtension.prototype.priority = 500;
    var IASSpinnerExtension = function (a) {
        return a = jQuery.extend({}, this.defaults, a), this.ias = null, this.uid = (new Date).getTime(), this.src = a.src, this.html = a.html.replace("{src}", this.src), this.showSpinner = function () {
            var a = this.getSpinner() || this.createSpinner(), b = this.ias.getLastItem();
            b.after(a), a.fadeIn()
        }, this.showSpinnerBefore = function () {
            var a = this.getSpinner() || this.createSpinner(), b = this.ias.getFirstItem();
            b.before(a), a.fadeIn()
        }, this.removeSpinner = function () {
            this.hasSpinner() && this.getSpinner().remove()
        }, this.getSpinner = function () {
            var a = jQuery("#ias_spinner_" + this.uid);
            return a.length > 0 ? a : !1
        }, this.hasSpinner = function () {
            var a = jQuery("#ias_spinner_" + this.uid);
            return a.length > 0
        }, this.createSpinner = function () {
            var a = jQuery(this.html).attr("id", "ias_spinner_" + this.uid);
            return a.hide(), a
        }, this
    };
    IASSpinnerExtension.prototype.bind = function (a) {
        this.ias = a, a.on("next", jQuery.proxy(this.showSpinner, this)), a.on("render", jQuery.proxy(this.removeSpinner, this));
        try {
            a.on("prev", jQuery.proxy(this.showSpinnerBefore, this))
        } catch (b) {
        }
    }, IASSpinnerExtension.prototype.unbind = function (a) {
        a.off("next", this.showSpinner), a.off("render", this.removeSpinner);
        try {
            a.off("prev", this.showSpinnerBefore)
        } catch (b) {
        }
    }, IASSpinnerExtension.prototype.defaults = {
        src: "data:image/gif;base64,R0lGODlhEAAQAPQAAP///wAAAPDw8IqKiuDg4EZGRnp6egAAAFhYWCQkJKysrL6+vhQUFJycnAQEBDY2NmhoaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAAFdyAgAgIJIeWoAkRCCMdBkKtIHIngyMKsErPBYbADpkSCwhDmQCBethRB6Vj4kFCkQPG4IlWDgrNRIwnO4UKBXDufzQvDMaoSDBgFb886MiQadgNABAokfCwzBA8LCg0Egl8jAggGAA1kBIA1BAYzlyILczULC2UhACH5BAkKAAAALAAAAAAQABAAAAV2ICACAmlAZTmOREEIyUEQjLKKxPHADhEvqxlgcGgkGI1DYSVAIAWMx+lwSKkICJ0QsHi9RgKBwnVTiRQQgwF4I4UFDQQEwi6/3YSGWRRmjhEETAJfIgMFCnAKM0KDV4EEEAQLiF18TAYNXDaSe3x6mjidN1s3IQAh+QQJCgAAACwAAAAAEAAQAAAFeCAgAgLZDGU5jgRECEUiCI+yioSDwDJyLKsXoHFQxBSHAoAAFBhqtMJg8DgQBgfrEsJAEAg4YhZIEiwgKtHiMBgtpg3wbUZXGO7kOb1MUKRFMysCChAoggJCIg0GC2aNe4gqQldfL4l/Ag1AXySJgn5LcoE3QXI3IQAh+QQJCgAAACwAAAAAEAAQAAAFdiAgAgLZNGU5joQhCEjxIssqEo8bC9BRjy9Ag7GILQ4QEoE0gBAEBcOpcBA0DoxSK/e8LRIHn+i1cK0IyKdg0VAoljYIg+GgnRrwVS/8IAkICyosBIQpBAMoKy9dImxPhS+GKkFrkX+TigtLlIyKXUF+NjagNiEAIfkECQoAAAAsAAAAABAAEAAABWwgIAICaRhlOY4EIgjH8R7LKhKHGwsMvb4AAy3WODBIBBKCsYA9TjuhDNDKEVSERezQEL0WrhXucRUQGuik7bFlngzqVW9LMl9XWvLdjFaJtDFqZ1cEZUB0dUgvL3dgP4WJZn4jkomWNpSTIyEAIfkECQoAAAAsAAAAABAAEAAABX4gIAICuSxlOY6CIgiD8RrEKgqGOwxwUrMlAoSwIzAGpJpgoSDAGifDY5kopBYDlEpAQBwevxfBtRIUGi8xwWkDNBCIwmC9Vq0aiQQDQuK+VgQPDXV9hCJjBwcFYU5pLwwHXQcMKSmNLQcIAExlbH8JBwttaX0ABAcNbWVbKyEAIfkECQoAAAAsAAAAABAAEAAABXkgIAICSRBlOY7CIghN8zbEKsKoIjdFzZaEgUBHKChMJtRwcWpAWoWnifm6ESAMhO8lQK0EEAV3rFopIBCEcGwDKAqPh4HUrY4ICHH1dSoTFgcHUiZjBhAJB2AHDykpKAwHAwdzf19KkASIPl9cDgcnDkdtNwiMJCshACH5BAkKAAAALAAAAAAQABAAAAV3ICACAkkQZTmOAiosiyAoxCq+KPxCNVsSMRgBsiClWrLTSWFoIQZHl6pleBh6suxKMIhlvzbAwkBWfFWrBQTxNLq2RG2yhSUkDs2b63AYDAoJXAcFRwADeAkJDX0AQCsEfAQMDAIPBz0rCgcxky0JRWE1AmwpKyEAIfkECQoAAAAsAAAAABAAEAAABXkgIAICKZzkqJ4nQZxLqZKv4NqNLKK2/Q4Ek4lFXChsg5ypJjs1II3gEDUSRInEGYAw6B6zM4JhrDAtEosVkLUtHA7RHaHAGJQEjsODcEg0FBAFVgkQJQ1pAwcDDw8KcFtSInwJAowCCA6RIwqZAgkPNgVpWndjdyohACH5BAkKAAAALAAAAAAQABAAAAV5ICACAimc5KieLEuUKvm2xAKLqDCfC2GaO9eL0LABWTiBYmA06W6kHgvCqEJiAIJiu3gcvgUsscHUERm+kaCxyxa+zRPk0SgJEgfIvbAdIAQLCAYlCj4DBw0IBQsMCjIqBAcPAooCBg9pKgsJLwUFOhCZKyQDA3YqIQAh+QQJCgAAACwAAAAAEAAQAAAFdSAgAgIpnOSonmxbqiThCrJKEHFbo8JxDDOZYFFb+A41E4H4OhkOipXwBElYITDAckFEOBgMQ3arkMkUBdxIUGZpEb7kaQBRlASPg0FQQHAbEEMGDSVEAA1QBhAED1E0NgwFAooCDWljaQIQCE5qMHcNhCkjIQAh+QQJCgAAACwAAAAAEAAQAAAFeSAgAgIpnOSoLgxxvqgKLEcCC65KEAByKK8cSpA4DAiHQ/DkKhGKh4ZCtCyZGo6F6iYYPAqFgYy02xkSaLEMV34tELyRYNEsCQyHlvWkGCzsPgMCEAY7Cg04Uk48LAsDhRA8MVQPEF0GAgqYYwSRlycNcWskCkApIyEAOwAAAAAAAAAAAA==",
        html: '<div class="infinite-scroll"><div class="loader"></div></div>'
    };
    var IASTriggerExtension = function (a) {
        return a = jQuery.extend({}, this.defaults, a), this.ias = null, this.html = a.html.replace("{text}", a.text), this.htmlPrev = a.htmlPrev.replace("{text}", a.textPrev), this.enabled = !0, this.count = 0, this.offset = a.offset, this.$triggerNext = null, this.$triggerPrev = null, this.showTriggerNext = function () {
            if (!this.enabled) return !0;
            if (!1 === this.offset || ++this.count < this.offset) return !0;
            var a = this.$triggerNext || (this.$triggerNext = this.createTrigger(this.next, this.html)),
                b = this.ias.getLastItem();
            return b.after(a), a.fadeIn(), !1
        }, this.showTriggerPrev = function () {
            if (!this.enabled) return !0;
            var a = this.$triggerPrev || (this.$triggerPrev = this.createTrigger(this.prev, this.htmlPrev)),
                b = this.ias.getFirstItem();
            return b.before(a), a.fadeIn(), !1
        }, this.onRendered = function () {
            this.enabled = !0
        }, this.createTrigger = function (a, b) {
            var c, d = (new Date).getTime();
            return b = b || this.html, c = jQuery(b).attr("id", "ias_trigger_" + d), c.hide(), c.on("click", jQuery.proxy(a, this)), c
        }, this
    };
    IASTriggerExtension.prototype.bind = function (a) {
        this.ias = a, a.on("next", jQuery.proxy(this.showTriggerNext, this), this.priority), a.on("rendered", jQuery.proxy(this.onRendered, this), this.priority);
        try {
            a.on("prev", jQuery.proxy(this.showTriggerPrev, this), this.priority)
        } catch (b) {
        }
    }, IASTriggerExtension.prototype.unbind = function (a) {
        a.off("next", this.showTriggerNext), a.off("rendered", this.onRendered);
        try {
            a.off("prev", this.showTriggerPrev)
        } catch (b) {
        }
    }, IASTriggerExtension.prototype.next = function () {
        this.enabled = !1, this.ias.pause(), this.$triggerNext && (this.$triggerNext.remove(), this.$triggerNext = null), this.ias.next()
    }, IASTriggerExtension.prototype.prev = function () {
        this.enabled = !1, this.ias.pause(), this.$triggerPrev && (this.$triggerPrev.remove(), this.$triggerPrev = null), this.ias.prev()
    }, IASTriggerExtension.prototype.defaults = {
        text: "Load more items",
        html: '<div id="infinite-trigger" class="ias-trigger ias-trigger-next" style="text-align: center; cursor: pointer;"><a class="btn" href="#infinite-trigger">{text}</a></div>',
        textPrev: "Load previous items",
        htmlPrev: '<div id="infinite-trigger" class="ias-trigger ias-trigger-prev" style="text-align: center; cursor: pointer;"><a class="btn" href="#infinite-trigger">{text}</a></div>',
        offset: 0
    }, IASTriggerExtension.prototype.priority = 1e3;

    // Define Infinite Scroll For Theme

    var ias = jQuery.ias({
        container: "#primary",
        item: "article",
        pagination: ".navigation",
        next: ".nav-previous a",
    });
    ias.extension(new IASSpinnerExtension({}));
    ias.extension(new IASTriggerExtension({
        text: evolve_js_local_vars.infinite_scroll_text,
        offset: 3
    }));
    ias.extension(new IASNoneLeftExtension({text: evolve_js_local_vars.infinite_scroll_text_finished,}));
}

