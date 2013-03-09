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
CMRS.AutoReplace = function($) {
    AutoReplace = {
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

    return AutoReplace;
}(jQuery);