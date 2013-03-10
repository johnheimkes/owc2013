/**
 * @fileOverview DropDown View Module File
 *
 * @author 
 * @version 1.0
 */
CMRS.DropDown = function($) {
    'use strict';

    /**
     * Description
     *
     * @name DropDown
     * @class DropDown short description
     * @constructor
     *
     * @since 1.0
     */
    var DropDown = function(options) {
        this.options = options;

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
    DropDown.prototype.checkOptions = function() {
        var requiredOptions = [
            'wrapperSelector',
            'buttonSelector',
            'listSelector'
        ];

        var requiredDomElements = [
            'wrapperSelector',
            'buttonSelector',
            'listSelector'
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
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.init = function() {
        if (!this.checkOptions()) {
            return;
        }

        this.isOpened = false;
        this.isEnabled = false;
        this.isTouch = (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) ? true : false;

        return this
            .setupHandlers()
            .createChildren()
            .render()
            .enable();
    };

    /**
     * Binds the scope of any handler functions
     * Should only be run on initialization of the view
     *
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.setupHandlers = function() {
        this.onClickHandler = $.proxy(this.onClick, this);
        this.onTouchStartHandler = $.proxy(this.onTouchStart, this);
        this.onTouchMoveHandler = $.proxy(this.onTouchMove, this);
        this.onTouchEndHandler = $.proxy(this.onTouchEnd, this);

        return this;
    };

    /**
     * Create any child objects or references to DOM elements
     * Should only be run on initialization of the view
     *
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.createChildren = function() {
        this.$wrapper = $(this.options.wrapperSelector);
        this.$button = this.$wrapper.find(this.options.buttonSelector);
        this.$list = this.$wrapper.find(this.options.listSelector);

        return this;
    };

    /**
     * Appends new elements to the dom and updates their references
     *
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.render = function() {
        this.$list.css('display', 'none');

        return this;
    };

    /**
     * Enables the view
     * Performs any event binding to handlers
     * Exits early if it is already enabled
     *
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.enable = function() {
        if (this.isEnabled) {
            return this;
        }

        this.isEnabled = true;

        if (this.isTouch) {
            this.$button.on('touchstart', this.onTouchStartHandler);
            this.$button.on('touchmove', this.onTouchMoveHandler);
            this.$button.on('touchend', this.onTouchEndHandler);
        } else {
            this.$button.on('click', this.onClickHandler);
        }

        return this;
    };

    /**
     * Disables the view
     * Tears down any event binding to handlers
     * Exits early if it is already disabled
     *
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.disable = function() {
        if (!this.isEnabled) {
            return this;
        }

        this.isEnabled = false;

        if (this.isTouch) {
            this.$button.off('touchstart', this.onTouchStartHandler);
            this.$button.off('touchmove', this.onTouchMoveHandler);
            this.$button.off('touchend', this.onTouchEndHandler);
        } else {
            this.$button.off('click', this.onClickHandler);
        }

        return this;
    };

    /**
     * Destroys the view
     * Tears down any events, handlers, elements
     * Should be called when the object should be left unused
     *
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.destroy = function() {
        this.disable();

        return this;
    };

    /**
     * Toggles the dropdown opened or closed
     *
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.toggle = function() {
        if (this.isOpened) {
            this.close();
        } else {
            this.open();
        }

        return this;
    };

    /**
     * Opens the dropdown
     *
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.open = function() {
        this.isOpened = true;

        this.$list.css('display', 'block');

        return this;
    };

    /**
     * Closes the dropdown
     *
     * @returns {DropDown}
     * @since 1.0
     */
    DropDown.prototype.close = function() {
        this.isOpened = false;

        this.$list.css('display', 'none');

        return this;
    };

    /**
     * onClick Handler
     * Performs this action on click
     *
     * @param {MouseEvent} event Click event
     * @since 1.0
     */
    DropDown.prototype.onClick = function(e) {
        if (this.isTouch) {
            return false;
        }

        this.toggle();

        return false;
    };

    /**
     * onTouchStart Handler
     * Performs this action on touchstart
     *
     * @param {TouchEvent} event touchstart event
     * @since 1.0
     */
    DropDown.prototype.onTouchStart = function(e) {
        this.hasMoved = false;
    };

    /**
     * onTouchMove Handler
     * Performs this action on touchmove
     *
     * @param {TouchEvent} event touchmove event
     * @since 1.0
     */
    DropDown.prototype.onTouchMove = function(e) {
        this.hasMoved = true;
    };

    /**
     * onTouchEnd Handler
     * Performs this action on touchend
     *
     * @param {TouchEvent} event touchend event
     * @since 1.0
     */
    DropDown.prototype.onTouchEnd = function(e) {
        if (this.hasMoved) {
            return false;
        }

        this.toggle();

        return false;
    };

    return DropDown;
}(jQuery);