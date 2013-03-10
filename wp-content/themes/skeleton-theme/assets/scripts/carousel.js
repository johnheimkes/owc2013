/**
 * @fileOverview Carousel View Module File
 *
 * @author Zach Walders
 * @version 1.0
 */
CMRS.Carousel = function($) {
    'use strict';

    var CONSTANTS = {
        navItemText: 'slide ',
        movementPercentage: 100
    };

    var $window = $(window);

    /**
     * Determines current wrapper and creates carousels for each related wrapper found
     *
     * @author 
     * @version 1.0
     */
    var CarouselFactory = function(options) {
        this.options = options;

        if (!this.checkOptions) {
            return;
        }

        this.buildCarousels();
    };

    /**
     * checks to see if options and dom elements exist
     * if options are missing, throws error
     * if dom elements exist, return true, if not return false
     *
     * @since 1.0
     */
    CarouselFactory.prototype.checkOptions = function() {
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
            'animationDuration',
            'swipeXThresholdModifier',
            'swipeYThresholdModifier'
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
     * Builds new carousels for each wrapper found
     *
     * @since 1.0
     */
    CarouselFactory.prototype.buildCarousels= function() {
        this.carousels = [];
        var $wrappers = $(this.options.carouselWrapperSelector);
        var length = $wrappers.length;
        var i = 0;

        for (; i < length; i++) {
            this.options.$wrapper = $wrappers.eq(i);
            this.carousels.push(new Carousel(this.options));
        }
    };

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
     * Initializes the UI Component View
     * Runs a single setupHandlers call, followed by createChildren and layout
     *
     * @returns {Carousel}
     * @since 1.0
     */
    Carousel.prototype.init = function() {
        this.isClickTouchEnabled = false;
        this.isResizable = false;
        this.isTouch = (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) ? true : false;
        this.hasTouchMoved = false;

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

        this.onSwipeStartHandler = $.proxy(this.onSwipeStart, this);
        this.onSwipeMoveHandler = $.proxy(this.onSwipeMove, this);
        this.onSwipeEndHandler = $.proxy(this.onSwipeEnd, this);
        this.onTouchButtonStartHandler = $.proxy(this.onTouchButtonStart, this);
        this.onTouchButtonMoveHandler = $.proxy(this.onTouchButtonMove, this);

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
        this.$wrapper = this.options.$wrapper;
        this.$slideWrapper = this.$wrapper.find(this.options.slideWrapperSelector);
        this.$slideList = this.$wrapper.find(this.options.slideListSelector);
        this.$slides = this.$slideList.children();
        this.$navWrapper = null;
        this.$navItems = null;
        this.$prevButton = null;
        this.$nextButton = null;
        this.totalSlides = 0;
        this.activeIndex = 0;

        if (!this.isTouch) {
            return this;
        }

        this.swipeDirection = null;
        this.swipeXThreshold = Math.round($window.outerWidth() * this.options.swipeXThresholdModifier);
        this.swipeYThreshold = Math.round(this.$slideList.outerHeight() * this.options.swipeYThresholdModifier);
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
        var visibleSlides = Math.round(this.$slideList.outerWidth() / this.$slides.eq(0).outerWidth());
        var i = 0;

        this.totalSlides = Math.round(this.$slides.length / visibleSlides);

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

        if (this.isTouch) {
            this.$slideList.on('touchstart', this.onSwipeStartHandler);
            this.$slideList.on('touchmove', this.onSwipeMoveHandler);
            this.$slideList.on('touchend', this.onSwipeEndHandler);
            this.$navItems.on('touchstart', this.onTouchButtonStartHandler);
            this.$prevButton.on('touchstart', this.onTouchButtonStartHandler);
            this.$nextButton.on('touchstart', this.onTouchButtonStartHandler);
            this.$navItems.on('touchmove', this.onTouchButtonMoveHandler);
            this.$prevButton.on('touchmove', this.onTouchButtonMoveHandler);
            this.$nextButton.on('touchmove', this.onTouchButtonMoveHandler);
            this.$navItems.on('touchend', this.onJumpToIndexHandler);
            this.$prevButton.on('touchend', this.onPrevHandler);
            this.$nextButton.on('touchend', this.onNextHandler);
        } else {
            this.$navItems.on('click', this.onJumpToIndexHandler);
            this.$prevButton.on('click', this.onPrevHandler);
            this.$nextButton.on('click', this.onNextHandler);
        }

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

        if (this.isTouch) {
            this.$slideList.off('touchstart', this.onSwipeStartHandler);
            this.$slideList.off('touchmove', this.onSwipeMoveHandler);
            this.$slideList.off('touchend', this.onSwipeEndHandler);
            this.$navItems.off('touchstart', this.onTouchButtonStartHandler);
            this.$prevButton.off('touchstart', this.onTouchButtonStartHandler);
            this.$nextButton.off('touchstart', this.onTouchButtonStartHandler);
            this.$navItems.off('touchmove', this.onTouchButtonMoveHandler);
            this.$prevButton.off('touchmove', this.onTouchButtonMoveHandler);
            this.$nextButton.off('touchmove', this.onTouchButtonMoveHandler);
            this.$navItems.off('touchend', this.onJumpToIndexHandler);
            this.$prevButton.off('touchend', this.onPrevHandler);
            this.$nextButton.off('touchend', this.onNextHandler);
        } else {
            this.$navItems.off('click', this.onJumpToIndexHandler);
            this.$prevButton.off('click', this.onPrevHandler);
            this.$nextButton.off('click', this.onNextHandler);
        }

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
            }, this.options.animationDuration);
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
     * updateLayout
     * Carries out updates necessary after resize
     *
     * @since 1.0
     */
    Carousel.prototype.updateLayout = function(indexRatio) {
        this.activeIndex = Math.round((this.totalSlides - 1) * indexRatio);
        this.swipeXThreshold = Math.round($window.outerWidth() * this.options.swipeXThresholdModifier);
        this.swipeYThreshold = Math.round(this.$slideList.outerHeight() * this.options.swipeYThresholdModifier);

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
        if (this.isTouch && this.hasTouchMoved) {
            return false;
        }

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
        if (this.isTouch && this.hasTouchMoved || this.activeIndex === 0) {
            return false;
        }

        this.activeIndex -= 1;

        this.slide();
    };

    /**
     * onNext Handler
     * Performs this action on clicking next button or swiping left
     *
     * @param {MouseEvent} event Click event
     * @since 1.0
     */
    Carousel.prototype.onNext = function(e) {
        if (this.isTouch && this.hasTouchMoved || this.activeIndex === (this.totalSlides - 1)) {
            return false;
        }

        this.activeIndex += 1;

        this.slide();
    };

    /**
     * onSwipeStart Handler
     * Performs this action on touchstart of the slide wrapper
     *
     * @param {TouchEvent} event touch event
     * @since 1.0
     */
    Carousel.prototype.onSwipeStart = function(e) {
        this.touchStartX = e.originalEvent.touches[0].screenX;
        this.touchStartY = e.originalEvent.touches[0].screenY;
        this.swipeDirection = null;
    };

    /**
     * onSwipeMove Handler
     * Performs this action on touchmove of the slide wrapper
     *
     * @param {TouchEvent} event touch event
     * @since 1.0
     */
    Carousel.prototype.onSwipeMove = function(e) {
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
     * onSwipeEnd Handler
     * Performs this action on touchend of the slide wrapper
     *
     * @param {TouchEvent} event touch event
     * @since 1.0
     */
    Carousel.prototype.onSwipeEnd = function(e) {
        if (!this.swipeDirection) {
            return false;
        }

        if (this.swipeDirection === 'left') {
            this.onNextHandler();
        } else if (this.swipeDirection === 'right') {
            this.onPrevHandler();
        }
    };

    /**
     * onTouchButtonStart Handler
     * Performs this action on touchstart of a carousel buton
     *
     * @param {TouchEvent} event touch event
     * @since 1.0
     */
    Carousel.prototype.onTouchButtonStart = function(e) {
        this.hasTouchMoved = false;
    };

    /**
     * onTouchButtonMove Handler
     * Performs this action on touchmove of a carousel buton
     *
     * @param {TouchEvent} event touch event
     * @since 1.0
     */
    Carousel.prototype.onTouchButtonMove = function(e) {
        this.hasTouchMoved = true;
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
            .enableClickTouch()
            .updateLayout(indexRatio)
            .slide();
    };

    return CarouselFactory;
}(jQuery);