/* ---------------------------------------------------------------------
SlideoutMenu
Author: Scott Garrison, Zach Walders

When on a browser of small width dimensions or on a mobile device, Menus
are hidden and this script allows you to show and hide them.
------------------------------------------------------------------------ */

CMRS.SlideoutMenu = function($) {
    var MenuActiveClass = 'active';
    var TargetResolution = 480;

    var SlideoutMenu = function($btn, $targetMenu, $targetHeader, $targetPage, pageActiveClass) {
        this.$btn = $btn;
        this.$targetMenu = $targetMenu;
        this.$targetPage = $targetPage;
        this.$targetHeader = $targetHeader;
        this.isEnabled = false;
        this.isResizeable = false;
        this.isOpen = false;
        this.hasMoved = false;
        this.pageActiveClass = pageActiveClass;
        this.$window = $(window);

        this.setupHandlers().enableResize();
        if (this.$window.outerWidth() >= TargetResolution) {
            return this;
        }

        this.enable();
    };

    SlideoutMenu.prototype.setupHandlers = function() {
        this.onClickHandler = $.proxy(this.onClick, this);
        this.onResizeHandler = $.proxy(this.onResize, this);
        this.onScrollHandler = $.proxy(this.onScroll, this);
        this.onTouchStartHandler = $.proxy(this.onTouchStart, this);
        this.onTouchMoveHandler = $.proxy(this.onTouchMove, this);
        this.onTouchEndHandler = $.proxy(this.onTouchEnd, this);

        return this;
    };

    SlideoutMenu.prototype.onClick = function(e) {
        e.preventDefault();

        if (!this.isOpen) {
            this.open();
        } else {
            this.close();
        }
    };

    SlideoutMenu.prototype.onResize = function() {
        if (this.$window.outerWidth() >= TargetResolution) {
            this.disable();
        } else {
            this.enable();
        }
    };

    SlideoutMenu.prototype.onTouchStart = function() {
        this.hasMoved = false;
    };

    SlideoutMenu.prototype.onTouchMove = function() {
        this.hasMoved = true;
    };

    SlideoutMenu.prototype.onTouchEnd = function() {
        if (this.hasMoved) {
            return;
        }

        this.close();
    };

    SlideoutMenu.prototype.onScroll = function() {
        if (!this.isOpen) {
            return this;
        }

        this.close();

        return this;
    };

    SlideoutMenu.prototype.open = function() {
        this.$targetMenu.addClass(MenuActiveClass);
        this.$targetHeader.addClass(this.pageActiveClass);
        this.$targetPage.addClass(this.pageActiveClass);
        this.isOpen = true;
    };

    SlideoutMenu.prototype.close = function() {
        this.$targetMenu.removeClass(MenuActiveClass);
        this.$targetHeader.removeClass(this.pageActiveClass);
        this.$targetPage.removeClass(this.pageActiveClass);
        this.isOpen = false;
    };

    SlideoutMenu.prototype.enable = function() {
        if (this.isEnabled) {
            return this;
        }

        this.isEnabled = true;
        this.$btn.on("click", this.onClickHandler);
        this.$window.on('scroll', this.onScrollHandler);
        this.$targetPage.on('touchstart', this.onTouchStartHandler);
        this.$targetPage.on('touchmove', this.onTouchMoveHandler);
        this.$targetPage.on('touchend', this.onTouchEndHandler);

        return this;
    };

    SlideoutMenu.prototype.disable = function() {
        if (!this.isEnabled) {
            return this;
        }

        this.isEnabled = false;
        this.$btn.off("click", this.onClickHandler);
        this.$window.off('scroll', this.onScrollHandler);
        this.$targetPage.off('touchstart', this.onTouchStartHandler);
        this.$targetPage.off('touchmove', this.onTouchMoveHandler);
        this.$targetPage.off('touchend', this.onTouchEndHandler);

        this.close();

        return this;
    };

    SlideoutMenu.prototype.enableResize = function() {
        if (this.isResizeable) {
            return this;
        }

        this.isResizeable = true;
        this.$window.on("resize", this.onResizeHandler);
        return this;
    };

    SlideoutMenu.prototype.disableResize = function() {
        if (!this.isResizeable) {
            return this;
        }

        this.isResizeable = false;
        this.$window.off("resize", this.onResizeHandler);
        return this;
    };

    return SlideoutMenu
}(jQuery);
