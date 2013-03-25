/**
 * @fileOverview ScrollNav View Module File
 *
 * @author Zach Walders
 * @version 1.0
 */
CMRS.ScrollNav = function($) {
    'use strict';

    var $window = $(window);

    /**
     * Description
     *
     * @name ScrollNav
     * @class ScrollNav short description
     * @constructor
     *
     * @since 1.0
     */
    var ScrollNav = function(options) {
        this.options = options;

        if (!this.checkOptions()) {
            return;
        }

        this.init();
    };

    /**
     * checks to see if options and dom elements exist
     * if options are missing, throws error
     * if dom elements exist, return true, if not return false
     *
     * @returns {DropDown}
     * @since 1.0
     */
    ScrollNav.prototype.checkOptions = function() {
        var requiredOptions = [
            'animationDuration',
            'jumpLinkSelector',
            'jumpLinkTargetSelector',
            'jumpLinkActiveClass'
        ];

        var requiredDomElements = [
            'jumpLinkSelector',
            'jumpLinkTargetSelector'
        ];

        var length = requiredOptions.length;
        var i = 0;

        for (; i < length; i++) {
            if (!this.options[requiredOptions[i]]) {
                throw new Error(requiredOptions[i] + ' not found in options');
            }
        }

        length = requiredDomElements.length;
        i = 0;

        for (; i < length; i++) {
            if (!$(this.options[requiredDomElements[i]]).length) {
                return false;
            }
        }

        return true;
    };

    /**
     * Initializes the UI Component View
     * Runs a single setupHandlers call, followed by createChildren and layout
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.init = function() {
        this.isEnabled = false;

        return this
            .setupHandlers()
            .createChildren()
            .layout()
            .enable();
    };

    /**
     * Binds the scope of any handler functions
     * Should only be run on initialization of the view
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.setupHandlers = function() {
        this.onClickHandler = $.proxy(this.onClick, this);
        this.onJumpCompleteHandler = $.proxy(this.onJumpComplete, this);
        this.onScrollHandler = $.proxy(this.onScroll, this);
        this.onResizeHandler = $.proxy(this.onResize, this);

        return this;
    };

    /**
     * Create any child objects or references to DOM elements
     * Should only be run on initialization of the view
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.createChildren = function() {
        this.$jumpLinks = $(this.options.jumpLinkSelector);
        this.$jumpLinkTargets = $(this.options.jumpLinkTargetSelector);
        this.$jumpLinkActive = null;
        this.$jumpLinkTargetActive = null;
        this.$inViewTargets = [];
        this.inViewIds = [];
        this.activeIndex = 0;
        this.isBeforeFirstHash = true;

        this.windowHeight = null;

        return this;
    };

    /**
     * Enables the view
     * Performs any event binding to handlers
     * Exits early if it is already enabled
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.enable = function() {
        if (this.isEnabled) {
            return this;
        }

        this.isEnabled = true;

        this.$jumpLinks.on('click', this.onClickHandler);
        $window.on('scroll', this.onScrollHandler);
        $window.on('resize', this.onResizeHandler);

        return this;
    };

    /**
     * Disables the view
     * Tears down any event binding to handlers
     * Exits early if it is already disabled
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.disable = function() {
        if (!this.isEnabled) {
            return this;
        }

        this.isEnabled = false;

        this.$jumpLinks.off('click', this.onClickHandler);
        $window.off('scroll', this.onScrollHandler);
        $window.off('resize', this.onResizeHandler);

        return this;
    };

    /**
     * Measurment logic
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.layout = function() {
        this.windowHeight = $window.outerHeight();

        return this;
    };

    /**
     * Destroys the view
     * Tears down any events, handlers, elements
     * Should be called when the object should be left unused
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.destroy = function() {
        this.disable();

        return this;
    };

    /**
     * onClick Handler
     * Performs this action on click
     *
     * @param {MouseEvent} event Click event
     * @since 1.0
     */
    ScrollNav.prototype.onClick = function(e) {
        this.activeIndex = this.$jumpLinks.index($(e.currentTarget));

        this.$jumpLinkTargetActive = this.$jumpLinkTargets.eq(this.activeIndex);

        this.jumpToAnchor();

        return false;
    };

    /**
     * onScroll Handler
     * Performs this action on window scroll
     *
     * @param {ScrollEvent} event scroll event
     * @since 1.0
     */
    ScrollNav.prototype.onScroll = function(e) {
        this
            .checkInView()
            .setActiveHash()
            .toggleActiveClass();
    };

    /**
     * onResize Handler
     * Performs this action on window resize
     *
     * @param {ResizeEvent} event resize event
     * @since 1.0
     */
    ScrollNav.prototype.onResize = function(e) {
        this.layout();
    };

    /**
     * Checks which target containers are in view
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.checkInView = function() {
        this.$inViewTargets = [];
        this.inViewIds = [];

        var $currentTarget;
        var scrollTop = $window.scrollTop();
        var scrollTopLimit = ($(document).outerHeight() - this.windowHeight);
        var firstOffsetTop = this.$jumpLinkTargets.eq(0).offset().top;
        var currentOffsetTop;
        var currentOffsetBottom;

        var length = this.$jumpLinkTargets.length;
        var i = 0;

        if (scrollTop === 0) {
            window.location.hash = '';

            this.isBeforeFirstHash = true;

            return this;
        } else if (scrollTop < firstOffsetTop) {
            this.isBeforeFirstHash = true;

            return this;
        } else if (scrollTop === scrollTopLimit) {
            this.inViewIds.push(this.$jumpLinkTargets.eq(length - 1).attr('id'));
            this.$inViewTargets.push(this.$jumpLinkTargets.eq(length - 1));

            return this;
        }

        this.isBeforeFirstHash = false;

        for (; i < length; i++) {
            $currentTarget = this.$jumpLinkTargets.eq(i);
            currentOffsetTop = $currentTarget.offset().top;
            currentOffsetBottom = (currentOffsetTop + $currentTarget.outerHeight());

            if (currentOffsetTop < (scrollTop + this.windowHeight) && currentOffsetBottom > scrollTop) {
                this.inViewIds.push(this.$jumpLinkTargets.eq(i).attr('id'));
                this.$inViewTargets.push(this.$jumpLinkTargets.eq(i));
            }
        }

        return this;
    };

    /**
     * Sets the hash to the first currently in view target containers id
     * sets the active index to that first in view container's index
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.setActiveHash = function() {
        if (this.$inViewTargets.length === 0) {
            return this;
        }

        this.$inViewTargets[0].attr('id', '');

        window.location.hash = this.inViewIds[0];

        this.$inViewTargets[0].attr('id', this.inViewIds[0]);

        this.activeIndex = this.$jumpLinkTargets.index(this.$inViewTargets[0]);

        return this;
    };

    /**
     * Scrolls the page to the targetted anchor
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.jumpToAnchor = function() {
        $('html, body').stop().animate({
            scrollTop: this.$jumpLinkTargetActive.offset().top
        }, this.options.animationDuration, this.onJumpCompleteHandler);

        return this;
    };

    /**
     * Fires after scroll animation is czomplete
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.onJumpComplete = function() {
        window.location.hash = this.$jumpLinkTargetActive.attr('id');
    };

    /**
     * Removes active class from currently active link and sets it on the new targetted link
     *
     * @returns {ScrollNav}
     * @since 1.0
     */
    ScrollNav.prototype.toggleActiveClass = function() {
        if (this.$jumpLinkActive) {
            this.$jumpLinkActive.removeClass(this.options.jumpLinkActiveClass);
        }

        if (this.isBeforeFirstHash) {
            return this;
        }

        this.$jumpLinkActive = this.$jumpLinks.eq(this.activeIndex);

        this.$jumpLinkActive.addClass(this.options.jumpLinkActiveClass);

        return this;
    };

    return ScrollNav;
}(jQuery);