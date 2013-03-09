/**
 * @fileOverview carousel View Module File
 *
 * @author 
 * @version 1.0
 */
CMRS.Carousel = function($) {
    'use strict';

    var CONSTANTS = {
        navItemText: 'carousel slide ',
        movementPercentage: 100,
        swipeXThresholdModifier: 0.3,
        swipeYThresholdModifier: 0.3
    };

    var $window = $(window);

    /**
     * Description
     *
     * @name carousel
     * @class carousel short description
     * @constructor
     *
     * @since 1.0
     */
    var Carousel = function(options) {
        this.options = options;

        this.init();
    };

    /**
     * checks to see if options and dom elements exist
     * if options are missing, throws error
     * if dom elements exist, return true, if not return false
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.checkOptions = function() {
        var requiredOptions = [
            'carouselWrapperSelector',
            'slideWrapperSelector',
            'slideListSelector',
            'navWrapperClass',
            'navItemClass',
            'navItemActiveClass',
            'buttonClass',
            'buttonPrevClass',
            'buttonNextClass',
            'animationDuration'
        ];

        var requiredDomElements = [
            'carouselWrapperSelector',
            'slideWrapperSelector',
            'slideListSelector'
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
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.init = function() {
        if (!this.checkOptions()) {
            return;
        }

        this.isClickTouchEnabled = false;
        this.isResizable = false;
        this.isTouch = (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) ? true : false;

        return this
            .setupHandlers()
            .createChildren()
            .renderNav()
            .enableClickTouch()
            .enableWindowResize();
    };

    /**
     * Binds the scope of any handler functions
     * Should only be run on initialization of the view
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.setupHandlers = function() {
        this.onJumpToIndexHandler = $.proxy(this.onJumpToIndex, this);
        this.onPrevHandler = $.proxy(this.onPrev, this);
        this.onNextHandler = $.proxy(this.onNext, this);
        this.onWindowResizeHandler = $.proxy(this.onWindowResize, this);

        if (!this.isTouch) {
            return this;
        }

        this.onTouchStartHandler = $.proxy(this.onTouchStart, this);
        this.onTouchMoveHandler = $.proxy(this.onTouchMove, this);
        this.onTouchEndHandler = $.proxy(this.onTouchEnd, this);

        return this;
    };

    /**
     * Create any child objects or references to DOM elements
     * Should only be run on initialization of the view
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.createChildren = function() {
        this.$wrapper = $(this.options.carouselWrapperSelector);
        this.$slideWrapper = this.$wrapper.find(this.options.slideWrapperSelector);
        this.$slideList = this.$wrapper.find(this.options.slideListSelector);
        this.$slides = this.$slideList.children();
        this.$navWrapper = null;
        this.$navItems = null;
        this.$prevButton = null;
        this.$nextButton = null;
        this.animationDuration = this.options.animationDuration;
        this.totalSlides = 0;
        this.activeIndex = 0;

        if (!this.isTouch) {
            return this;
        }

        this.swipeDirection = null;
        this.swipeXThreshold = Math.ceil($window.outerWidth() * CONSTANTS.swipeXThresholdModifier);
        this.swipeYThreshold = Math.ceil(this.$slideList.outerHeight() * CONSTANTS.swipeYThresholdModifier);
        this.touchStartX = 0;
        this.touchStartY = 0;

        return this;
    };

    /**
     * Appends new nav elements to the dom and updates their references
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.renderNav = function() {
        var visibleSlides = Math.ceil(this.$slideList.outerWidth() / this.$slides.eq(0).outerWidth());
        var i = 0;

        this.totalSlides = Math.ceil(this.$slides.length / visibleSlides);

        this.$wrapper.append(
            '<button class="' + this.options.buttonClass + ' ' + this.options.buttonPrevClass + '">' +
                'previous' +
            '</button>' +
            '<button class="' + this.options.buttonClass + ' ' + this.options.buttonNextClass + '">' +
                'next' +
            '</button>' +
            '<ol class="' + this.options.navWrapperClass + '"></ol>'
        );

        this.$navWrapper = this.$wrapper.find('.' + this.options.navWrapperClass);
        this.$prevButton = this.$wrapper.find('.' + this.options.buttonPrevClass);
        this.$nextButton = this.$wrapper.find('.' + this.options.buttonNextClass);

        for (; i < this.totalSlides; i++) {
            this.$navWrapper.append(
                '<li>' +
                    '<button class="' + this.options.navItemClass + '">' +
                        CONSTANTS.navItemText + i +
                    '</button>' +
                '</li>'
            );
        }

        this.$navItems = this.$navWrapper.find('.' + this.options.navItemClass);

        return this
            .updateNav()
            .updateButtons();
    };

    /**
     * Removes nav elements
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.destroyNav = function() {
        this.$navWrapper.remove();
        this.$prevButton.remove();
        this.$nextButton.remove();
        this.$navItems.remove();

        this.$navWrapper = null;
        this.$prevButton = null;
        this.$nextButton = null;
        this.$navItems = null;

        return this;
    };

    /**
     * Enables the view
     * Performs any event binding to handlers
     * Exits early if it is already enabled
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.enableClickTouch = function() {
        if (this.isEnabled) {
            return this;
        }

        this.isEnabled = true;

        this.$navItems.on('click', this.onJumpToIndexHandler);
        this.$prevButton.on('click', this.onPrevHandler);
        this.$nextButton.on('click', this.onNextHandler);

        if (!this.isTouch) {
            return this;
        }

        this.$slideList.on('touchstart', this.onTouchStartHandler);
        this.$slideList.on('touchmove', this.onTouchMoveHandler);
        this.$slideList.on('touchend', this.onTouchEndHandler);

        return this;
    };

    /**
     * Disables the view
     * Tears down any event binding to handlers
     * Exits early if it is already disabled
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.disableClickTouch = function() {
        if (!this.isEnabled) {
            return this;
        }

        this.isEnabled = false;

        this.$navItems.off('click', this.onJumpToIndexHandler);
        this.$prevButton.off('click', this.onPrevHandler);
        this.$nextButton.off('click', this.onNextHandler);

        if (!this.isTouch) {
            return this;
        }

        this.$slideList.off('touchstart', this.onTouchStartHandler);
        this.$slideList.off('touchmove', this.onTouchMoveHandler);
        this.$slideList.off('touchend', this.onTouchEndHandler);

        return this;
    };

    /**
     * Enables the windwow resize event
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.enableWindowResize = function() {
        if (this.isResizable) {
            return this;
        }

        $window.on('resize', this.onWindowResizeHandler);

        return this;
    };

    /**
     * Disable the windwow resize event
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.disableWindowResize = function() {
        if (!this.isResizable) {
            return this;
        }

        $window.off('resize', this.onWindowResizeHandler);

        return this;
    };

    /**
     * slide
     * Animates the slides based on the active index
     *
     * @since 1.0
     */
    Carousel.prototype.slide = function() {
        var animationDistance;

        if (this.isTouch) {
            animationDistance = -(this.activeIndex * this.$wrapper.outerWidth());

            this.$slideList.css('-webkit-transform', 'translate3d(' + animationDistance + 'px,0,0)');
        } else {
            animationDistance = -(this.activeIndex * CONSTANTS.movementPercentage);

            this.$slides.eq(0).stop().animate({
                'margin-left': (animationDistance + '%')
            }, this.animationDuration);
        }

        this.updateNav();

        return this
            .updateNav()
            .updateButtons();
    };

    /**
     * updateNav
     * Adds active class to nav item of active index
     *
     * @since 1.0
     */
    Carousel.prototype.updateNav = function() {
        if (this.$activeNavItem) {
            this.$activeNavItem.removeClass(this.options.navItemActiveClass);
        }

        this.$activeNavItem = this.$navItems.eq(this.activeIndex);

        this.$activeNavItem.addClass(this.options.navItemActiveClass);

        return this;
    };

    /**
     * updateButtons
     * Hides or show prev and next buttons if you're at the beginning or end of the carousel
     *
     * @since 1.0
     */
    Carousel.prototype.updateButtons = function() {
        if (this.activeIndex === 0) {
            this.$prevButton.css('display', 'none');
            this.$nextButton.css('display', 'block');
        } else if (this.activeIndex === (this.totalSlides - 1)) {
            this.$prevButton.css('display', 'block');
            this.$nextButton.css('display', 'none');
        } else {
            this.$prevButton.css('display', 'block');
            this.$nextButton.css('display', 'block');
        }

        return this;
    };

    /**
     * Destroys the view
     * Tears down any events, handlers, elements
     * Should be called when the object should be left unused
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.destroy = function() {
        this
            .disableClickTouch()
            .disableWindowResize();

        return this;
    };

    /**
     * onJumpToIndex Handler
     * Performs this action on clicking pips
     *
     * @param {MouseEvent} event Click event
     * @since 1.0
     */
    Carousel.prototype.onJumpToIndex = function(e) {
        this.activeIndex = this.$navItems.index($(e.currentTarget));

        this.slide();
    };

    /**
     * onPrev Handler
     * Performs this action on clicking prev button or swiping right
     *
     * @param {MouseEvent} event Click event
     * @since 1.0
     */
    Carousel.prototype.onPrev = function(e) {
        if (this.activeIndex === 0) {
            return false;
        }

        this.activeIndex -= 1;

        this.slide();

        return false;
    };

    /**
     * onNext Handler
     * Performs this action on clicking next button or swiping left
     *
     * @param {MouseEvent} event Click event
     * @since 1.0
     */
    Carousel.prototype.onNext = function(e) {
        if (this.activeIndex === (this.totalSlides - 1)) {
            return false;
        }

        this.activeIndex += 1;

        this.slide();

        return false;
    };

    /**
     * onJumpToIndex Handler
     * Performs this action on clicking pips
     *
     * @param {MouseEvent} event Click event
     * @since 1.0
     */
    Carousel.prototype.onJumpToIndex = function(e) {
        this.activeIndex = this.$navItems.index($(e.currentTarget));

        this.slide();
    };

    /**
     * onTouchStart Handler
     * Performs this action on touchstart of the slide wrapper
     *
     * @param {TouchEvent} event touch event
     * @since 1.0
     */
    Carousel.prototype.onTouchStart = function(e) {
        this.touchStartX = e.originalEvent.touches[0].screenX;
        this.touchStartY = e.originalEvent.touches[0].screenY;
        this.swipeDirection = null;
    };

    /**
     * onTouchMove Handler
     * Performs this action on touchmove of the slide wrapper
     *
     * @param {TouchEvent} event touch event
     * @since 1.0
     */
    Carousel.prototype.onTouchMove = function(e) {
        var touchCurrentX = e.originalEvent.touches[0].screenX;
        var touchCurrentY = e.originalEvent.touches[0].screenY;
        var touchXDistance = (this.touchStartX - touchCurrentX);
        var touchYDistance = (this.touchStartY - touchCurrentY);

        if (Math.abs(touchXDistance) < this.swipeXThreshold || Math.abs(touchYDistance) > this.swipeYThreshold) {
            return;
        }

        if (touchXDistance > 0) {
            this.swipeDirection = 'left';
        } else {
            this.swipeDirection = 'right';
        }

        return false;
    };

    /**
     * onTouchEnd Handler
     * Performs this action on touchend of the slide wrapper
     *
     * @param {TouchEvent} event touch event
     * @since 1.0
     */
    Carousel.prototype.onTouchEnd = function(e) {
        if (!this.swipeDirection) {
            return;
        }

        if (this.swipeDirection === 'left') {
            this.onNextHandler();
        } else if (this.swipeDirection === 'right') {
            this.onPrevHandler();
        }
    };

    /**
     * onWindowResize Handler
     * Performs this action on window resize
     *
     * @param {ResizeEvent} event resize event
     * @since 1.0
     */
    Carousel.prototype.onWindowResize = function(e) {
        var indexRatio = (this.activeIndex / (this.totalSlides - 1));

        this
            .disableClickTouch()
            .destroyNav()
            .renderNav()
            .enableClickTouch();

        this.activeIndex = Math.round((this.totalSlides - 1) * indexRatio);

        this.slide();
    };

    return Carousel;
}(jQuery);