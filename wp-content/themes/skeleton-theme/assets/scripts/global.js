/* ---------------------------------------------------------------------
Global JavaScript & jQuery

Target Browsers: All
Authors: Zach Walders, Scott Garrison

JS Devs beware! WordPress loads jQuery in noConflict mode.
------------------------------------------------------------------------ */
// Namespace Object
var CMRS = CMRS || {};

// Pass reference to jQuery and Namespace
(function($, APP) {
    // DOM Ready Function
    $(function() {
        //Initialize!
        APP.ExternalLinks.init();

        APP.AutoReplace.init();

        var slideoutmenu = new APP.SlideoutMenu(
            $('#btn-menu'), /* button clicked to bring menu visible */
            $('#nav'), /*  */
            $('.wrapper-header'),
            $('.page-content'),
            'left-active'
        );


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
            animationDuration: 300,
            swipeXThresholdModifier: 0.3,
            swipeYThresholdModifier: 0.5
        });

        var dropdown = new APP.DropDown({
            wrapperSelector: '.js-dropdown',
            buttonSelector: '.js-dropdown-button',
            listSelector: '.js-dropdown-list'
        });

        var scrollNav = new APP.ScrollNav({
            'animationDuration': 300,
            'jumpLinkSelector': '.js-jump-link',
            'jumpLinkActiveClass': 'secondary-nav-item_isActive',
            'jumpLinkTargetSelector': '.js-jump-link-target'
        });
    });
}(jQuery, CMRS));