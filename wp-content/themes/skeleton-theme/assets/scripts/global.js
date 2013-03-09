/* ---------------------------------------------------------------------
Global JavaScript & jQuery

Target Browsers: All
Authors: Zach Walders, Scott Garrison

JS Devs beware! WordPress loads jQuery in noConflict mode.
------------------------------------------------------------------------ */
jQuery(function($) {
    // Initialize!
    CMRSThemeJS($);
});

var CMRSThemeJS = function($){

    var CMRS = CMRS || {};

    /* ---------------------------------------------------------------------
    ExternalLinks
    Author: CMRSery Boilerplate

    Launches links with a rel="external" in a new window
    ------------------------------------------------------------------------ */

    CMRS.ExternalLinks = {
        init: function() {
            $('a[rel=external]').attr('target', '_blank');
        }
    };

    /* ---------------------------------------------------------------------
    AutoReplace
    Author: CMRSery Boilerplate

    Mimics HTML5 placeholder behavior

    Additionally, adds and removes 'placeholder-text' class, used as a styling
    hook for when placeholder text is visible or not visible

    Additionally, prevents forms from being
    submitted if the default text remains in input field - which we may
    or may not want to leave in place, depending on usage in site
    ------------------------------------------------------------------------ */
    CMRS.AutoReplace = {
        $fields: undefined,

        init: function() {
            var $fields = $('[placeholder]');

            if ($fields.length !== 0) {
                var self = this;
                self.$fields = $fields.addClass('placeholder-text');
                self.bind();
            }
        },

        bind: function() {
            var self = this;

            self.$fields.each(
                function() {
                    var me = $(this);
                    var defaultText = me.attr('placeholder');
                    me.attr('placeholder', '').val(defaultText);

                    me.focus(
                        function() {
                            if (me.val() === defaultText) {
                                me.val('').removeClass('placeholder-text');
                            }
                        }
                    );

                    me.blur(
                        function() {
                            if (me.val() === '') {
                                me.val(defaultText).addClass('placeholder-text');
                            }
                        }
                    );

                    me.parents('form').submit(
                        function() {
                            if (me.is('.required') && (me.val() === defaultText || me.val() === "")) {
                                return false;
                            }
                        }
                    );
                }
            );
        }
    };


    CMRS.ExternalLinks.init();
    CMRS.AutoReplace.init();

    var carousel = new APP.Carousel({
        carouselWrapperSelector: '.js-carousel',
        slideWrapperSelector: '.js-carousel-slide-wrapper',
        slideListSelector: '.js-carousel-slide-list',
        navWrapperClass: 'carousel-nav',
        navItemClass: 'carousel-nav-item',
        navItemActiveClass: 'carousel-nav-item-is-active',
        buttonClass: 'carousel-btn',
        buttonPrevClass: 'carousel-btn-prev',
        buttonNextClass: 'carousel-btn-next',
        animationDuration: 300
    });
}; // end CMRSThemeJS