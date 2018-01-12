(function ($) {

  'use strict';

  var $window = $(window);
  var $document = $(document);
  var Common = {};

  /**
   * esing: easeOutExpo
   */
  $.extend($.easing, {
    easeOutExpo: function (x, t, b, c, d) {
      return (t === d) ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b;
    }
  });

  /**
   *  remove focus blur
   */
  Common.onFocusBlur = $(function () {
    $document.on('click', 'a, button', function (e) {
      $(this).blur();
    });
  });

  /**
   *  menu toggle
   */
  Common.navMenuToggle = $(function () {
    var NAV = '.nav-sp';
    var TOGGLE = '.menu-toggler';
    var ACTIVE = 'js-active';
    var Menu = {};

    Menu.removeClass = function () {
      $(document.body).removeClass(ACTIVE);
      $(NAV).removeClass(ACTIVE);
      $(TOGGLE).removeClass(ACTIVE);
    };
    Menu.addClass = function () {
      $(document.body).addClass(ACTIVE);
      $(NAV).addClass(ACTIVE);
      $(TOGGLE).addClass(ACTIVE);
    };
    Menu.toggle = function (e) {
      var isActive = $(NAV).hasClass(ACTIVE);
      var isToggleClick = ($(e.target).closest(TOGGLE).length === 1);
      var isNavOuterClick = ($(e.target).closest(NAV).length === 0);

      if (isNavOuterClick || isToggleClick && isActive) {
        Menu.removeClass();
      }
      if (isToggleClick && !isActive) {
        Menu.addClass();
      }
    };
    $document.on('click touchend', Menu.toggle);
  });

  /**
   *  smooth scroll
   */
  Common.smoothScroll = $(function () {
    var Scroll = {};
    var ignoreElement = [
      '.no-scroll',
      '[data-toggle]',
      '[href="#"]',
      '[href="#0"]',
      '[target*="_"]',
    ].join(', ')

    Scroll.animate = function (position) {
      $('html, body').animate({
        scrollTop: position
      }, 1200, 'easeOutExpo');
      return false;
    };
    Scroll.hashCheck = function () {
      if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
        var $target = $(this.hash) || $('[name=' + this.hash.slice(1) + ']');
        if ($target.length && $target.offset().top) {
          Scroll.animate($target.offset().top);
        }
      }
      return false;
    };
    Scroll.pageTop = function () {
      Scroll.animate(0);
    };
    Scroll.cancel = function (e) {
      $('html, body').stop();
    };

    $document
      .on('click touchend', 'a[href^="#"]:not(' + ignoreElement + ')', Scroll.hashCheck)
      .on('click touchend', '.page-top', Scroll.pageTop)
      .on('mousewheel DOMMouseScroll', Scroll.cancel);
  });

  /**
   *  fade page top btn
   */
  Common.pageTopBtnFade = $(function () {
    var $topBtn = $('.page-top');
    var fadeTo = function () {
      if ($(this).scrollTop() > 160) {
        $topBtn.fadeIn();
      } else {
        $topBtn.fadeOut();
      }
    };
    $topBtn.hide();
    $window.on('scroll', fadeTo);
  });

  /**
   *  date-table selected
   */
  Common.dateTableSelected = $(function () {
    var TABLE = 'table.date-selector';
    var SELECTED_CLASS = 'selected';
    var DISABLED_CLASS = 'disabled';
    var CLICKED_CELL = 'tbody td:not(.' + DISABLED_CLASS + '):not(.' + SELECTED_CLASS + ')';

    var countCell = function ($table) {
      var counterID = $table.attr('data-counter');
      if (counterID && $(counterID).length) {
        $(counterID).text($table.find(CLICKED_CELL).length);
      }
    };
    var toggleSelected = function (e) {
      if ($(e.target).hasClass(SELECTED_CLASS)) {
        $(e.target).removeClass(SELECTED_CLASS);
      } else {
        $(e.target).addClass(SELECTED_CLASS);
      }
      countCell($(e.target).closest(TABLE));
    };

    $(TABLE).each(function () {
      $(this).find(CLICKED_CELL).on('click', toggleSelected);
      countCell($(this));
    });
  });


  /**
   * check all
   */
  Common.checkAllToggle = $(function () {
    var $checkBtn = $('[data-check-name]');
    var checkAll = function (target, isCheck) {
      if (target && isCheck != undefined) {
        $(target).prop('checked', isCheck);
      }
    };
    var getDataAttr = function (e) {
      e.preventDefault();
      var groupName = $(e.target).attr('data-check-name');
      var mode = $(e.target).attr('data-check');
      mode = !!(mode === 'true');
      if (groupName && groupName != undefined) {
        checkAll($('input[type="checkbox"][name="' + groupName + '"]'), mode);
      }
    };
    $checkBtn.on('click', getDataAttr);
  });

})(jQuery);
