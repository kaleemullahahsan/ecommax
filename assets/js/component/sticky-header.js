/**
 * Sticker Header.
 *
 * @version 1.0.0
 * @since 1.0.0
 */
"use strict";

class StickyHeader {
  constructor(el, options) {
    this.el = el;

    this._defaults = {
      enable: true,
      height: false,
      behaviour: "down",
    };

    this.options = Object.assign({}, this._defaults, options);
    if (this.options.enable !== true) return;

    this.$el = jQuery(el);
    this.$adminbar = jQuery("#wpadminbar");
    this.$dummy = jQuery('<div class="sticky-dummy"></div>');
    this.stuck = false;
    this.hidden = true;
    this.lastScrollTop = 0;

    this.scrollHandler = this.scrollHandler.bind(this);
    this.resizeHandler = this.resizeHandler.bind(this);

    this.init();
  }

  init() {
    if (!this.initialized && window.innerWidth > 1024) {
      this.cacheElements();
      this.bindEvents();
      this.calculateDimensions();
      this.scrollHandler();
      this.initialized = true;
      this.trigger("onInit");
    }
  }

  cacheElements() {
    this.adminBarHeight =
      this.$adminbar.length > 0 ? this.$adminbar.height() : 0;
    this.adminBarFixed =
      this.$adminbar.length > 0
        ? this.$adminbar.css("position") === "fixed"
        : false;
    this.elHeight = this.$el.outerHeight();
    this.elOffset = this.$el.offset().top;
    this.stuckHeight = this.options.height
      ? this.options.height
      : this.elHeight;
  }

  bindEvents() {
    jQuery(window).on("scroll", this.scrollHandler);
    jQuery(window).on("resize", this.resizeHandler);
    this.calculateDimensions();
    this.scrollHandler();
  }

  scrollHandler() {
    const position = jQuery(window).scrollTop();
    const scrollDirection = position > this.lastScrollTop ? "down" : "up";
    this.lastScrollTop = position <= 0 ? 0 : position;

    if (
      (this.options.behaviour === "down" && scrollDirection === "down") ||
      (this.options.behaviour === "up" && scrollDirection === "up") ||
      this.options.behaviour === "both"
    ) {
      if (position >= this.elOffset) {
        if (!this.stuck) {
          this.stick();
          this.toggleSticky(true);
          this.show();
        }
      } else {
        if (this.stuck) {
          this.unstick();
          this.hide();
          this.toggleSticky(false);
        }
        this.calculateDimensions();
      }
    } else {
      if (this.stuck) {
        this.unstick();
        this.hide();
        this.toggleSticky(false);
      }
      this.calculateDimensions();
    }
  }

  resizeHandler() {
    this.calculateDimensions();
  }

  calculateDimensions() {
    this.elHeight = this.$el.outerHeight();
    this.elOffset = this.$el.offset().top;
    this.stuckHeight = this.options.height
      ? this.options.height
      : this.elHeight;
  }

  stick() {
    if (!this.stuck) {
      this.$dummy.height(this.elHeight).insertAfter(this.$el);
      this.$el.addClass("header-stuck").css({
        position: "fixed",
        top: this.adminBarHeight,
        width: "100%",
        zIndex: 9999,
      });
      this.stuck = true;
    }
  }

  unstick() {
    if (this.stuck) {
      this.$dummy.remove();
      this.$el.removeClass("header-stuck").attr("style", "");
      this.stuck = false;
    }
  }

  show() {
    if (this.hidden) {
      this.$el.addClass("header-visible").css({
        height: this.options.height,
        opacity: 1,
        visibility: "visible",
        transform: "translateY(0)",
        transition: "transform 200ms linear",
      });
      this.hidden = false;
    }
  }

  hide() {
    if (!this.hidden) {
      this.$el.removeClass("header-visible").css({
        opacity: 0,
        visibility: "hidden",
        transform: "translateY(-100%)",
        transition: "transform 200ms linear",
      });
      this.hidden = true;
    }
  }

  destroy() {
    jQuery(window).off("scroll", this.scrollHandler);
    jQuery(window).off("resize", this.resizeHandler);
    this.unstick();
    this.show();
    this.initialized = false;
    this.hidden = false;
  }

  trigger(hook, ...args) {
    if (typeof this.options[hook] === "function") {
      this.options[hook].apply(this, args);
    }
  }

  toggleSticky(action) {
    if (action === true) {
      {
        jQuery("*[class^='contentsticky_']").each((idx, el) => {
          const target = jQuery(
            "." +
              el.classList[0].replace("contentsticky_", "contentstickynew_"),
          );
          if (target.length) {
            StickyHeader.swapChildren(jQuery(el), target);
          }
        });
      }
    } else {
      jQuery("*[class^='contentstickynew_']").each((idx, el) => {
        const target = jQuery(
          "." + el.classList[0].replace("contentstickynew_", "contentsticky_"),
        );
        if (target.length) {
          StickyHeader.swapChildren(jQuery(el), target);
        }
      });
    }
  }

  static swapChildren(obj1, obj2) {
    const temp = obj2.children().detach();
    obj2.empty().append(obj1.children().detach());
    obj1.append(temp);
  }
}

jQuery.fn.RbbStickyHeader = function () {
  const args = [];
  for (let i = 0; i < arguments.length; i++) {
    args.push(arguments[i]);
  }
  return this.each(function () {
    const opts = args[0];
    let data = jQuery.data(this, "RbbStickyHeader");

    if (!data) {
      data = jQuery.data(this, "RbbStickyHeader", new StickyHeader(this, opts));
      return;
    }

    if (
      "string" === typeof opts &&
      "function" === typeof data[opts] &&
      opts.charAt(0) !== "_"
    ) {
      return data[opts].apply(data, args.slice(1));
    }
  });
};

export default StickyHeader;
