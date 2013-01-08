/* ---------------------------------------------------------------------
Global JavaScript & jQuery

Target Browsers: All
Authors: Jess Green

JS Devs beware! WordPress loads jQuery in noConflict mode.
------------------------------------------------------------------------ */
jQuery(function($) {

    // Initialize!
    NERDThemeJS($);

});

var NERDThemeJS = function($){

    var NERD = NERD || {};

    /* ---------------------------------------------------------------------
    ExternalLinks
    Author: Nerdery Boilerplate

    Launches links with a rel="external" in a new window
    ------------------------------------------------------------------------ */

    NERD.ExternalLinks = {
        init: function() {
            $('a[rel=external]').attr('target', '_blank');
        }
    };

    /* ---------------------------------------------------------------------
    AutoReplace
    Author: Nerdery Boilerplate

    Mimics HTML5 placeholder behavior

    Additionally, adds and removes 'placeholder-text' class, used as a styling
    hook for when placeholder text is visible or not visible

    Additionally, prevents forms from being
    submitted if the default text remains in input field - which we may
    or may not want to leave in place, depending on usage in site
    ------------------------------------------------------------------------ */
    NERD.AutoReplace = {
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


    NERD.ExternalLinks.init();
    NERD.AutoReplace.init();

} // end NERDThemeJS