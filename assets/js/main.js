/**
  // eslint-disable-next-line prettier/prettier
 * Main JavaScript file.
 *
 * @version 1.0.0
 */

"use strict";

import RbbThemeNavigation from "./component/navigation";
import RbbThemeSkipLinkFocus from "./component/skip-link-focus-fix";
import "./component/sticky-header";
import RbbThemeSearch from "./component/search";
import RbbThemeOverlayScrollBar from "./component/overlay-scroll-bar";
import RbbThemeSlickJs from "./component/slick";
import RbbThemePromotionPopup from "./component/promotion-popup";
import RbbThemeLightBox from "./component/lightbox";
import Wow from "wow.js";
import RbbMobileNavigation from "./component/mobile-navigation";
import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";
import "tippy.js/animations/scale.css";

document.addEventListener("DOMContentLoaded", () => {
  const navigation = new RbbThemeNavigation();
  RbbThemeSkipLinkFocus();
  navigation.setupNavigation();
  navigation.enableTouchFocus();
});
const RisingBamboo = {
  config: {},

  adminBarHeight: 0,

  scrollPosition: 0,

  init() {
    const $this = this;
    $this.setConfig();
    $this.setScrollPosition();
    $this.setAdminBarHeight();
    $this.initStickyElements();
    $this.initScrollToTop();
    $this.toggleTextHome();
    $this.searchActive();
    $this.footerMobile();
    $this.menuNavigation();
    $this.menuCanvas();
    $this.OverlayBlur();
    $this.closeCanvasMenu();
    $this.copy();
    $this.speedSlider();
    $this.custom_dotsnumber();
    $this.custom_playslick();
    $this.slideToggle_text();
    $this.headerMobile();
    $this.verticalToggle();
    $this.menuMobileBottom();
    $this.closeSearch();
    $this.productItemHover();
    $this.observeDOMChanges();
    $this.backgroundGradient();
    $this.ToolTip();
    $this.toggleElement(".toggle-login", ".toggle-login ");
    $this.toggleElement(
      ".click-search-mobile",
      ".rbb-product-search-content2 ",
    );
    if (jQuery(window).width() < 768) {
      $this.toggleStyles("_desktop_", "_mobile_");
    }
    if (jQuery(window).width() < 1024) {
      $this.toggleStyles("desktop_", "mobile_");
    }

    RbbThemeSearch.ajaxSearch();
    let currentWidth = jQuery(window).width();
    const minWidth = 768;
    const minWidth2 = 1024;
    if (jQuery(window).width() < 768) {
      $this.headingToggle();
    }

    jQuery(window).on("resize", function () {
      const _cw = currentWidth;
      const _mw = minWidth;
      const _w = jQuery(window).width();
      const _toggle = (_cw >= _mw && _w < _mw) || (_cw < _mw && _w >= _mw);
      currentWidth = _w;
      if (_toggle) {
        $this.toggleStyles("_desktop_", "_mobile_");
      }
      const _mw2 = minWidth2;
      const _toggle2 = (_cw >= _mw2 && _w < _mw2) || (_cw < _mw2 && _w >= _mw2);
      currentWidth = _w;
      if (_toggle2) {
        $this.toggleStyles("desktop_", "mobile_");
      }
      $this.onWindowResize();
      if (jQuery(window).width() < 768) {
        $this.headingToggle();
      }
    });
    new RbbThemeSlickJs(".rbb-slick-el");
    new RbbThemeOverlayScrollBar();
    new RbbThemePromotionPopup();
    new RbbThemeLightBox("#rbb-gallery-lightbox");
    jQuery(window).on("scroll", function () {
      $this.onWindowScroll();
    });
    window.addEventListener("click", () => {
      $this.loginSwitch();
    });
    new Wow().init();
  },
  setConfig() {
    if (typeof window.rbb_config === "object") {
      this.config = window.rbb_config;
    }
  },
  setScrollPosition() {
    this.scrollPosition = jQuery("window").scrollTop();
  },

  setAdminBarHeight() {
    const adminBar = document.querySelector("#wpadminbar");

    if (adminBar && window.outerWidth > 600) {
      this.adminBarHeight = adminBar.offsetHeight;
    }
  },
  initStickyElements() {
    jQuery(".rbb-header-sticky").RbbStickyHeader(this.config.header_sticky);
    new RbbMobileNavigation(
      "#rbb-mobile-navigation",
      this.config.mobile_navigation,
    );
  },
  headingToggle() {
    const contentToggle = document.querySelectorAll(".rbb_heading_toggle");
    contentToggle.forEach((container) => {
      const headers = container.querySelectorAll(".elementor-heading-title");
      headers.forEach((header) => {
        header.addEventListener("click", function () {
          header.classList.toggle("active");
          let sibling = header.parentElement.parentElement.nextElementSibling;
          while (
            sibling &&
            !sibling.querySelector(".elementor-icon-list-items")
          ) {
            sibling = sibling.nextElementSibling;
          }
          const list = sibling
            ? sibling.querySelector(".elementor-icon-list-items")
            : null;
          if (list) {
            list.classList.toggle("show");
          }
        });
      });
    });
  },
  toggleTextHome() {
    const text = jQuery(".rbb-toggle-text");
    const originalHeight = text.outerHeight();
    const halfHeight = originalHeight / 2 + 20;
    text.height(halfHeight).show();
    text.addClass("active");
    const viewMoreButton = jQuery(".rbb-text-view-more");
    const viewLessButton = jQuery(".rbb-text-view-less");

    viewMoreButton.on("click", function () {
      text.stop().animate({ height: originalHeight }, "slow", function () {
        viewMoreButton.hide();
        viewLessButton.show();
      });
      text.toggleClass("active");
    });

    viewLessButton.on("click", function () {
      text.stop().animate({ height: halfHeight }, "slow", function () {
        viewMoreButton.show();
        viewLessButton.hide();
      });
      text.toggleClass("active");
    });
  },
  initScrollToTop() {
    const $button = jQuery(".scroll-to-top");
    jQuery(window).scroll(function () {
      const offset = 50;
      if (window.scrollY > offset) {
        $button.removeClass("scale-0 opacity-0 pointer-events-none");
      } else {
        $button.addClass("scale-0 opacity-0 pointer-events-none");
      }
    });
    $button.on("click", function (e) {
      jQuery("body, html").animate(
        {
          scrollTop: 0,
        },
        400,
      );

      e.preventDefault();
    });
    const progressPath = document.querySelector(".scroll-to-top path");
    if (!progressPath) {
      return;
    }
    const pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "none";
    progressPath.style.strokeDasharray = pathLength + " " + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "stroke-dashoffset 10ms linear";
    const updateProgress = function () {
      const scroll = jQuery(window).scrollTop();
      const height = jQuery(document).height() - jQuery(window).height();
      const progress = pathLength - (scroll * pathLength) / height;
      progressPath.style.strokeDashoffset = progress;
    };
    updateProgress();
    jQuery(window).scroll(updateProgress);
  },

  onWindowResize() {
    this.setAdminBarHeight();
  },

  onWindowScroll() {
    const isScrollUp = jQuery(window).scrollTop() < this.scrollPosition;

    if (isScrollUp) {
      jQuery(window).triggerHandler("scroll:up");
    } else {
      jQuery(window).triggerHandler("scroll:down");
    }

    this.scrollPosition = jQuery(window).scrollTop();
  },

  toggleElement($clickAble, content) {
    jQuery($clickAble).on("click", function () {
      if (jQuery(content).hasClass("active")) {
        jQuery(content).removeClass("active");
      } else {
        jQuery(content).addClass("active");
      }
    });
    jQuery(content)
      .find(".close")
      .on("click", function () {
        if (jQuery(content).hasClass("active")) {
          jQuery(content).removeClass("active");
        }
      });
    jQuery(document).mouseup(function (e) {
      if (jQuery(e.target).closest(content).length === 0) {
        jQuery(content).removeClass("active");
      }
    });
  },
  menuMobile(menuLevel) {
    const $document = jQuery(document);
    $document.on("click", menuLevel, function () {
      const $this = jQuery(this);
      const $parent = $this.parent();
      const $closestUl = $this.closest("ul");
      if ($parent.hasClass("menu-active")) {
        $parent
          .removeClass("menu-active")
          .css({ "z-index": "1", position: "relative" });
        $closestUl
          .removeClass("active")
          .css({ top: "50px", transform: "translateX(0%)" });
      } else {
        $parent
          .addClass("menu-active")
          .css({ "z-index": "9", position: "static" });
        const translateValue = jQuery("body").hasClass("rtl")
          ? "100%"
          : "-100%";
        $closestUl.addClass("active").css({
          top: "0px",
          transform: `translateX(${translateValue})`,
        });
      }
      jQuery(".mega-menu .rbb-slick-carousel").slick("refresh");
    });
  },
  menuNavigation() {
    const desktopSocial = document.getElementById("desktop-social");
    const desktopSearch = document.getElementById("_desktop_search");
    const mobileTop = document.querySelector(".search_desktop");
    const mobileBottom = document.querySelector(
      ".mobile_bottom .social_content",
    );
    if (desktopSocial && mobileBottom) {
      mobileBottom.innerHTML = desktopSocial.innerHTML;
    }
    if (desktopSearch && mobileTop) {
      mobileTop.innerHTML = desktopSearch.innerHTML;
    }
    const checkAndAddBlocks = () => {
      if (jQuery(".rbb-main-navigation").hasClass("screen")) {
        if (jQuery(window).width() < 1024) {
          this.menuMobile("#mobile_menu .opener");
          this.menuMobile("#mobile_menu .opener2");
          jQuery(document).on(
            "click",
            ".toggle-megamenu, .canvas-overlay",
            function () {
              if (jQuery(".search_desktop").hasClass("fadeInLeft")) {
                jQuery(".search_desktop").removeClass("fadeInLeft");
                jQuery(".mobile_bottom > div").removeClass("fadeInLeft");
                jQuery("#mobile_menu .menu-container > li").removeClass(
                  "fadeInLeft",
                );
              } else {
                jQuery(".search_desktop").addClass("fadeInLeft");
                jQuery(".mobile_bottom > div").addClass("fadeInLeft");
                jQuery("#mobile_menu .menu-container > li").addClass(
                  "fadeInLeft",
                );
              }
            },
          );
          const ul = document.getElementById("menu-main");
          const liElements = ul.querySelectorAll(".menu-container > li");
          let $y = 800;
          for (let i = 0; i < liElements.length; i++) {
            const li = liElements[i];
            jQuery(li).css("animation-duration", $y + "ms");
            $y = $y + 150;
          }
        }
      }
    };
    checkAndAddBlocks();
    window.addEventListener("resize", checkAndAddBlocks);
  },
  menuCanvas() {
    this.menuMobile(".rbb-menu-canvas .opener");
    this.menuMobile(".rbb-menu-canvas .opener2");
    jQuery(document).on("click", ".menu_close", function () {
      const $menuCanvas = jQuery(".rbb-menu-canvas");
      const $menuClose = jQuery(".menu_close");
      const $body = jQuery("body");
      if ($menuCanvas.hasClass("show")) {
        $menuCanvas.removeClass("show");
        $menuClose.removeClass("active");
        $body.removeClass("active");
        if (jQuery(window).width() < 767) {
          $body.css("overflow", "initial");
        }
      } else {
        RisingBambooModal.modal(".rbb-menu-canvas");
        $menuCanvas.addClass("show");
        $menuClose.addClass("active");
        $body.addClass("active");
        if (jQuery(window).width() < 767) {
          $body.css("overflow", "hidden");
        }
      }
    });
    jQuery(document).on("click", ".rbb-modal-backdrop", function () {
      const $body = jQuery("body");
      jQuery(".menu_close").removeClass("active");
      if (jQuery(window).width() < 767) {
        $body.css("overflow", "initial");
      }
    });
    if (jQuery(".rbb-menu-canvas").hasClass("rbb-modal")) {
      const ul = document.getElementById("menu-main");
      const liElements = ul.querySelectorAll(".menu-container > li");
      let $y = 800;
      for (let i = 0; i < liElements.length; i++) {
        const li = liElements[i];
        jQuery(li)
          .addClass("fadeInLeft")
          .css("animation-duration", $y + "ms");
        $y = $y + 150;
      }
    }
  },
  OverlayBlur() {
    const overlayBlurs = document.getElementsByClassName(
      "rissing_overlay_blur",
    );

    Array.from(overlayBlurs).forEach((overlayBlur) => {
      let parent = overlayBlur.parentElement;
      let shouldSkip = false;

      while (parent) {
        if (
          parent.classList &&
          parent.classList.contains("rissing_overlay_blur")
        ) {
          shouldSkip = true;
          break;
        }
        parent = parent.parentElement;
      }

      if (shouldSkip) {
        return;
      }
      const respon = overlayBlur.getAttribute("data-respon") || 1;
      let backdrop = overlayBlur.getAttribute("data-backdrop");
      const currentWidth = window.innerWidth;

      if (currentWidth >= respon) {
        let hoverTimer;

        overlayBlur.addEventListener("mouseenter", function () {
          hoverTimer = setTimeout(function () {
            const overlayDiv = document.createElement("div");
            overlayDiv.classList.add("overlay-blur", backdrop);
            document.body.appendChild(overlayDiv);

            const megaMenu = document.querySelector(".mega-menu");
            if (!megaMenu) {
              return;
            }
            const megaMenuRect = megaMenu.getBoundingClientRect();
            const offsetTop = megaMenuRect.top + window.scrollY + 100;
            overlayDiv.style.position = "fixed";
            overlayDiv.style.top = `${offsetTop}px`;
            overlayDiv.style.zIndex = "25";

            const overlayHeight = window.innerHeight;

            overlayDiv.style.height = overlayHeight + 300 + "px";
          }, 150);
        });

        overlayBlur.addEventListener("mouseleave", function () {
          clearTimeout(hoverTimer);
          jQuery("body")
            .find(".overlay-blur")
            .fadeOut(300, function () {
              jQuery(this).remove();
            });
        });
      }
    });
  },
  clickCanvasMenu(selector, content, overlaySelector, ...closeElements) {
    jQuery(document).on("click", selector, function () {
      const isActive = jQuery(this).toggleClass("active").hasClass("active");
      jQuery("body").css("overflow", isActive ? "hidden" : "auto");
      jQuery([overlaySelector, content].join(", ")).toggleClass(
        "active",
        isActive,
      );
      jQuery(closeElements.join(", ")).removeClass("active");
    });
  },
  closeCanvasMenu() {
    jQuery(".rbb-close-canvas-menu").on("click", function () {
      jQuery("#mobile_menu, .canvas-overlay").removeClass("active");
      jQuery(".menu-mobile, .toggle-megamenu").removeClass("active");
      jQuery("body").css("overflow", "auto");
    });
  },
  handleOverlayClick(overlaySelector, content, closeElements) {
    jQuery(document).on("click", overlaySelector, function () {
      if (jQuery(this).hasClass("active")) {
        jQuery(this).removeClass("active");
        jQuery("body").css("overflow", "auto");
        jQuery(
          [overlaySelector, content, closeElements].join(", "),
        ).removeClass("active");
      } else {
        jQuery(this).addClass("active");
        jQuery("body").css("overflow", "hidden");
        jQuery([overlaySelector, content, closeElements].join(", ")).addClass(
          "active",
        );
      }
    });
  },
  headerMobile() {
    this.clickCanvasMenu(
      ".toggle-megamenu",
      "#mobile_menu",
      ".canvas-overlay",
      ".search-mobile",
      "#_mobile_search",
      ".rbb_results",
    );
    this.handleOverlayClick(
      ".canvas-overlay",
      "#mobile_menu",
      ".toggle-megamenu",
    );
    if (jQuery(window).width() < 1024) {
      this.clickCanvasMenu(
        ".all-categories",
        "#mobile_vertical_menu",
        ".canvas-overlay2",
        ".search-mobile",
        "#_mobile_search",
        ".rbb_results",
        ".toggle-megamenu",
        "#mobile_menu",
        ".canvas-overlay",
      );
      this.handleOverlayClick(
        ".canvas-overlay2",
        "#mobile_vertical_menu",
        ".all-categories",
      );
    }
    jQuery(document).on("click", ".search-mobile", function () {
      if (jQuery(".search-mobile").hasClass("active")) {
        jQuery(
          ".search-mobile, .product-search-mobile, .rbb_results, .canvas-overlay, #mobile_menu",
        ).removeClass("active");
        jQuery("body").css("overflow", "auto");
      } else {
        jQuery(".search-mobile, .product-search-mobile, .rbb_results").addClass(
          "active",
        );
        jQuery("body").css("overflow", "hidden");
      }
      jQuery(".canvas-overlay, .toggle-megamenu, #mobile_menu").removeClass(
        "active",
      );
    });
  },
  searchActive() {
    const resultsTop = jQuery(".rbb-default-header").height();
    jQuery(".rbb_results").css("top", resultsTop + "px");
    if (jQuery(window).width() < 768) {
      jQuery(document).on("keyup", ".input-search", function () {
        const term = jQuery(this).val();
        if (term.length > 0) {
          jQuery(".btn-search_clear-text").show();
        } else {
          jQuery(".btn-search_clear-text").hide();
        }
        jQuery(document).on("click", ".btn-search_clear-text", function () {
          jQuery(".input-search").val("");
          jQuery(".btn-search_clear-text").hide();
          jQuery(".rbb_results").removeClass("active");
          jQuery("body").removeClass("active");
        });
      });
    }
  },

  footerElement($footerTitle, $footerContent) {
    if (jQuery(window).width() < 768) {
      jQuery(document).on("click", $footerTitle, function () {
        jQuery($footerContent).slideToggle("slow");
        const $hasActive = jQuery($footerTitle).hasClass("active");
        if ($hasActive) {
          jQuery($footerTitle).removeClass("active");
        } else {
          jQuery($footerTitle).addClass("active");
        }
      });
    }
  },
  footerMobile() {
    this.footerElement(
      ".footer-title1 .elementor-heading-title",
      ".footer-title1 .elementor-icon-list-items",
    );
    this.footerElement(
      ".footer-title2 .elementor-heading-title",
      ".footer-title2 .elementor-icon-list-items",
    );
    this.footerElement(
      ".footer-title3 .elementor-heading-title",
      ".footer-title3 .elementor-icon-list-items",
    );
    this.footerElement(
      ".footer-title4 .elementor-heading-title",
      ".footer-title4 .elementor-icon-list-items",
    );
    this.footerElement(
      ".footer-title5 .elementor-heading-title",
      ".footer-title5 .elementor-icon-list-items",
    );
    this.footerElement(
      ".footer-title6 .elementor-heading-title",
      ".footer-title6 .elementor-icon-list-items",
    );
  },
  loginSwitch() {
    jQuery(document).on("click", ".login_switch", function () {
      if (jQuery(this).hasClass("login-btn")) {
        jQuery(".login_switch_title").css("transform", "translate(0)");
        jQuery("#rbb_login").slideDown();
        jQuery("#rbb_register").slideUp();
      } else {
        jQuery(".login_switch_title").css("transform", "translate(100%)");
        jQuery("#rbb_login").slideUp();
        jQuery("#rbb_register").slideDown();
      }
    });
  },
  copy() {
    jQuery(document).on("click", ".copy-btn", function () {
      const el = jQuery(this);
      const copyText = el.siblings("input")[0];
      copyText.select();
      const selection = copyText.ownerDocument.defaultView.getSelection();
      document.execCommand("copy");
      selection.removeAllRanges();
      const copy = el.data("copy");
      const copied = el.data("copied");
      el.text(copied);
      setTimeout(() => el.text(copy), 2500);
    });
  },
  verticalToggle() {
    const $menuItems = jQuery(".vertical-menu-content .has-mega-menu .opener");
    $menuItems.off("click").on("click", function () {
      const $subMenu = jQuery(this).siblings(".sub-menu");
      jQuery(".sub-menu").not($subMenu).slideUp("slow");
      $subMenu.slideToggle("slow");
    });
  },

  toggleStyles(prefix1, prefix2) {
    const $elements = jQuery(`*[id^='${prefix1}']`);

    $elements.each(function () {
      const el = jQuery(this);
      const targetId = el.attr("id").replace(prefix1, prefix2);
      const $target = jQuery(`#${targetId}`);

      if ($target.length) {
        const $tempChildren = $target.children().detach();
        $target.empty().append(el.children().detach());
        el.append($tempChildren);
      }
    });
  },
  menuMobileBottom() {
    let thisurl = window.location;
    let urlmenu = "";
    thisurl = String(thisurl);
    thisurl = thisurl
      .replace("https://", "")
      .replace("http://", "")
      .replace("www.", "")
      .replace(/#\w*/, "");
    let thislink = "{/literal}{$current_link}{literal}";
    thislink = thislink
      .replace("https://", "")
      .replace("http://", "")
      .replace("www.", "")
      .replace(/#\w*/, "");
    jQuery("#rbb-mobile-navigation a").each(function () {
      urlmenu = jQuery(this)
        .attr("href")
        .replace("https://", "")
        .replace("http://", "")
        .replace("www.", "")
        .replace(/#\w*/, "");
      if (thisurl === urlmenu || thisurl.replace(thislink, "") === urlmenu) {
        jQuery(this)
          .find("i")
          .addClass("text-[var(--rbb-menu-link-hover-color)]");
        return false;
      }
    });
  },
  speedSlider() {
    const sliders = document.getElementsByClassName("rbb-elementor-slider");
    Array.from(sliders).forEach((slider) => {
      const sliderId = "#" + slider.id;
      const $slider = jQuery(`${sliderId} .rbb-slick-carousel`);

      const dotsElement = jQuery(`${sliderId} .slideshow-dot div`);
      const speed = jQuery($slider).data("speed");
      const speedslick = speed && !isNaN(speed) ? speed / 1000 : 3;
      dotsElement.on("click", function () {
        const index = jQuery(this).data("index");
        if ($slider.slick) {
          $slider.slick("slickGoTo", index);
        }
      });
      function applyTransitionStyles() {
        if (dotsElement.length > 0) {
          jQuery(`${sliderId} .slideshow-dot .svg_visibility circle`).css(
            "transition",
            `all ${speedslick}s cubic-bezier(0.39, 0.58, 0.57, 1)`,
          );
        }
      }
      applyTransitionStyles();
      $slider.on(
        "beforeChange",
        function (event, slick, currentSlide, nextSlide) {
          dotsElement.removeClass("active");
          dotsElement.eq(nextSlide).addClass("active");
        },
      );
    });
  },
  custom_dotsnumber() {
    const sliders = document.getElementsByClassName("rbb-elementor-slider");

    Array.from(sliders).forEach((slider) => {
      const sliderId = "#" + slider.id;
      const $slider = jQuery(sliderId);

      $slider.on(
        "init reInit afterChange",
        function (event, slick, currentSlide) {
          const length = $slider.find(".slick-active").length;
          const page = Math.ceil(((currentSlide || 0) + 1) / length);
          const numPages = Math.ceil(slick.slideCount / length);
          $slider.find(".dots_custom .current_nav").text(page);
          $slider.find(".dots_custom .total_nav").text(numPages);
        },
      );
    });
  },
  custom_playslick() {
    const sliders = document.getElementsByClassName("rbb-elementor-slider");
    Array.from(sliders).forEach((slider) => {
      const sliderId = "#" + slider.id;
      const $slider = jQuery(`${sliderId} .rbb-slick-carousel`);
      const speed = $slider.data("speed");
      const clickPlayElement = jQuery(`${sliderId} .button-action`);
      $slider.on("init", function () {
        const $circle = $slider.parent().find("circle");
        if ($circle.length) {
          $circle.addClass("animating");
          $circle.css("animation-duration", `${speed}ms`);
        }
        $slider.find(".slick-slide").off("focus");
        $slider.find(".slick-slide").off("mouseenter mouseleave");
      });

      $slider.on("beforeChange", function () {
        $slider
          .parent()
          .find("circle")
          .removeClass("animating")
          .removeClass("animating2");
      });

      $slider.on("afterChange", function () {
        $slider.parent().find("circle").addClass("animating");
      });
      clickPlayElement.on("click", function () {
        const $this = jQuery(this);
        const $circle = $this.parent().find("circle");
        if ($this.hasClass("pause")) {
          $slider.slick("slickPause");
          $this.removeClass("pause").addClass("play");
        } else {
          $slider.slick("slickPlay");
          $this.removeClass("play").addClass("pause");
          if ($circle.hasClass("animating2")) {
            $circle.removeClass("animating2").addClass("animating");
          } else {
            $circle.removeClass("animating").addClass("animating2");
          }
        }
      });
    });
  },
  slideToggle_text() {
    const toggleButtons = document.querySelectorAll(".icon_slide_toggle");

    toggleButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const blockContent = button.closest(".block__content");
        const content = blockContent.querySelector(".block_content_toggle");
        const isOpen =
          content.style.maxHeight && content.style.maxHeight !== "0px";

        content.style.maxHeight = isOpen
          ? "0px"
          : `${blockContent.clientHeight - 80}px`;
        button.classList.toggle("icon_active", !isOpen);
      });
    });
  },
  closeSearch() {
    jQuery(document).on("click", ".close-search", function () {
      jQuery("body").css("overflow", "auto").removeClass("active");
      if (jQuery(".rbb_results").hasClass("active")) {
        jQuery(".rbb_results").removeClass("active");
      } else {
        jQuery(".rbb_results").addClass("active");
      }
    });
  },
  productItemHover() {
    const items = document.querySelectorAll(
      ".rbb-product-content .item-product",
    );
    items.forEach((item) => {
      const outermostParent = item.closest(".rbb-product-content");
      const fadeBlock = item.querySelector(".product__bottom");
      const fadeContentBlock = item.querySelector(".product__bottom-fade");
      const elementorSectionParent = item.closest(".elementor-section");
      const elementorSectionParentrReladted = item.closest("#related-product");
      const elementorSectionParentrUpsell = item.closest("#upsell-product");

      if (outermostParent && fadeBlock && fadeContentBlock) {
        const fadeBlockHeight = fadeBlock.scrollHeight;
        outermostParent.style.marginBottom = `-${fadeBlockHeight + 30}px`;
        outermostParent.style.paddingBottom = `${fadeBlockHeight + 30}px`;

        item.addEventListener("mouseenter", () => {
          fadeBlock.style.height = `${fadeBlockHeight}px`;
          const itemProductHeight = item.offsetHeight;
          const newFadeContentBlockHeight =
            itemProductHeight + fadeBlockHeight - 8;
          fadeContentBlock.style.height = `${newFadeContentBlockHeight}px`;

          item.style.zIndex = "11";
          if (elementorSectionParent) {
            elementorSectionParent.style.zIndex = "11";
          }
          if (elementorSectionParentrReladted) {
            elementorSectionParentrReladted.style.zIndex = "11";
          }
          if (elementorSectionParentrUpsell) {
            elementorSectionParentrUpsell.style.zIndex = "11";
          }
        });

        item.addEventListener("mouseleave", () => {
          const itemProductHeight = item.offsetHeight;
          fadeBlock.style.height = "0";
          fadeContentBlock.style.height = `${itemProductHeight}px`;

          item.style.zIndex = "";
          if (elementorSectionParent) {
            elementorSectionParent.style.zIndex = "";
          }
          if (elementorSectionParentrReladted) {
            elementorSectionParentrReladted.style.zIndex = "";
          }
          if (elementorSectionParentrUpsell) {
            elementorSectionParentrUpsell.style.zIndex = "";
          }
        });
      }
    });
  },
  observeDOMChanges() {
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (mutation.target.closest(".rbb-product-content")) {
          this.productItemHover();
        }
      });
    });

    const config = { childList: true, subtree: true };
    const targetNode = document.body;
    observer.observe(targetNode, config);
  },
  backgroundGradient() {
    const elements = document.querySelectorAll(".gradient-animate");
    if (elements.length === 0) {
      return;
    }
    const enableGradient = getComputedStyle(document.documentElement)
      .getPropertyValue("--rbb-gradient-enable")
      .trim();

    elements.forEach((element) => {
      if (enableGradient === "true") {
        element.classList.add("gradient-animation");
      } else {
        element.classList.remove("gradient-animation");
      }
    });
  },
  ToolTip() {
    const tooltipElements = document.querySelectorAll("[data-tooltips]");
    tooltipElements.forEach((element) => {
      tippy(element, {
        content: element.getAttribute("data-tooltips"),
        arrow: true,
        animation: "scale",
      });
    });

    // Run the tooltip function on page load and after AJAX requests
    document.addEventListener("DOMContentLoaded", function () {
      initTooltips();
    });

    function initTooltips() {
      const tooltipElementss = document.querySelectorAll("[data-tooltips]");
      tooltipElementss.forEach((element) => {
        tippy(element, {
          content: element.getAttribute("data-tooltips"),
          arrow: true,
          animation: "scale",
        });
      });
    }

    // Listen for AJAX requests and run the tooltip function after each request
    jQuery(document).ajaxComplete(function () {
      initTooltips();
    });
  },
};
window.RisingBamboo = RisingBamboo;
window.RbbThemeSearch = RbbThemeSearch;
jQuery(function () {
  RisingBamboo.init();
});
