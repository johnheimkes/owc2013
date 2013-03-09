/* ---------------------------------------------------------------------
ExternalLinks
Author: CMRSery Boilerplate

Launches links with a rel="external" in a new window
------------------------------------------------------------------------ */
CMRS.ExternalLinks = function($) {
    ExternalLinks = {
        init: function() {
            $('a[rel=external]').attr('target', '_blank');
        }
    };

    return ExternalLinks;
}(jQuery);