/*
** module.js v1.1.2
** (c) 2017 Jun Takahashi with OS. CO., LTD.
*/

/*--------------------------------------------------*/
/* plugin-related */
/*--------------------------------------------------*/

/* jquery.kerning.js --------------------------------------*/

/* 使用方法 → タグに data-kerning 属性を付加する */

/*
** kerning - v0.3.1 - 2014-12-13
** http://karappoinc.github.io/jquery.kerning.js/
** Copyright (c) 2014 Karappo Inc.; Licensed MIT
**
** Arranged by Jun Takahashi with OS. CO., LTD.
*/
!function($){return function(){return $(document).find("[data-kerning]").each(function(){var a,b;return b=$(this).data("kerning"),a=null,b?(a=0<=b.indexOf("{")?$.kerning.parseJSON(b):b,$(this).kerning(a,$(this).data("kerning-extend"))):$(this).kerning()})},$.kerning={},$.kerning.defaults={removeTags:!1,removeAnchorTags:!1,data:{kerning:{"、":[0,-.4],"。":[0,-.4],"（":[-.4,0],"）":[0,-.4],"〔":[-.4,0],"〕":[0,-.4],"［":[-.4,0],"］":[0,-.4],"｛":[-.4,0],"｝":[0,-.4],"〈":[-.4,0],"〉":[0,-.4],"《":[-.4,0],"》":[0,-.4],"「":[-.4,0],"」":[0,-.4],"『":[-.4,0],"』":[0,-.4],"【":[-.4,0],"】":[0,-.4],"・":[-.22,-.22],"：":[-.22,-.22],"；":[-.22,-.22],"｜":[-.22,-.22]}}},$.kerning.parseJSON=function(text){var O_o,o_O,obj;obj=null;try{return obj=JSON.parse(text)}catch(_error){O_o=_error,console.log("jquery.kerning : [WARN] As a result of JSON.parse, a trivial problem has occurred")}try{obj=eval("("+text+")")}catch(_error){return o_O=_error,console.error("jquery.kerning : [ERROR] JSON.parse failed"),null}return obj},$.fn.kerning=function(a,b){return null==b&&(b=!1),this.each(function(){var c,d,e,f,g,h,i,j;return h=$(this),c=h,j=h.html(),d="",i=f=null,e=function(){var a;for(a=[];h.find("[data-kerned]").length;)h.find("[data-kerned]").replaceWith(function(){return this.innerHTML}),a.push(j=h.html());return a},g=function(a){var g,k,l,m,n,o,p,q;for(h.find("[data-kerned]").length&&e(),i=b?$.extend(!0,{},$.kerning.defaults,a):$.extend({},$.kerning.defaults,a),f=i.data.kerning,i.removeAnchorTags?h.children("a").length?(c=h.children("a"),j=c.html().replace(/(<([^>]+)>)/gi,"").split("")):(c=h,j=h.html().replace(/(<([^>]+)>)/gi,"").split("")):i.removeTags?j=h.html().replace(/(<([^>]+)>)/gi,"").split(""):h.find("[data-kerned]").empty(),l=h.data("delimiter"),n=h.data("linebreak"),void 0!==l&&(j=(l+j.join(l)+l).split("")),m=p=0,q=j.length;q>=0?q>p:p>q;m=q>=0?++p:--p)o=j[m],g=0,k=0,f[o]?(g=f[o][0],k=f[o][1],void 0!==n&&(d+='<span style="display:inline-block;">'+n+"</span>"),d+=0!==g||0!==k?'<span data-kerned style="display:inline-block;margin-left:'+g+"em;margin-right:"+k+'em;">'+o+"</span>":o,void 0!==n&&(d+='<span style="display:inline-block;">'+n+"</span><br>")):d+=o;return c.html(d),c.find("[data-kerned]").each(function(){var a;return a=$(this),0!==parseInt(a.css("text-indent"),10)?a.css("text-indent",0):void 0}),h},"string"==typeof a?"destroy"===a?(e(),h):0<=a.indexOf(".json")?$.getJSON(a,function(a){return g({data:a})}):(console.error("jquery.kerning : [ERROR] Invalid configure"),h):g(a)})}}(jQuery);

jQuery('[data-kerning]').kerning();

/* jquery.matchHeight-min.js --------------------------------------*/

jQuery(function($) {

  $.fn.matchHeight._maintainScroll = true;

  $.fn.matchHeight._beforeUpdate = function(event, groups) {
    $('.matchHeight').css({ height: '100%' });
  }

  $('.matchHeight').each(function() {
    var $origin = $(this);
    var $this = $(this);
    var layer = 0;
    while ($this.parent().prop('tagName').toLowerCase() != 'body') {
      $this = $this.parent();
      layer++;
    }
    $origin.addClass('matchHeight-' + layer);
  });

  for (i = 20; 0 <= i; i--) {
    $('.matchHeight-' + i).matchHeight();
  }

});

/*--------------------------------------------------*/
/* global */
/*--------------------------------------------------*/

/* useragent --------------------------------------*/

var globalUA = window.navigator.userAgent.toLowerCase();
var addClass = function(useragent) {
  jQuery('html').addClass(useragent);
};

/* device */

var ua_touch;
var ua_nontouch;
var ua_retina;
var ua_phone;
var ua_tablet;
var ua_desktop;

ua_touch = window.ontouchstart === null;
ua_nontouch = window.ontouchstart !== null;

ua_retina = (window.devicePixelRatio != 1 && window.devicePixelRatio !== undefined);

ua_phone =
(globalUA.indexOf('windows') >= 0 && globalUA.indexOf('phone') >= 0) ||
globalUA.indexOf('iphone') >= 0 ||
globalUA.indexOf('ipod') >= 0 ||
(globalUA.indexOf('android') >= 0 && globalUA.indexOf('mobile') >= 0) ||
(globalUA.indexOf('firefox') >= 0 && globalUA.indexOf('mobile') >= 0);

ua_tablet =
(globalUA.indexOf('windows') >= 0 && globalUA.indexOf('touch') >= 0 && globalUA.indexOf('tablet pc') == -1) ||
globalUA.indexOf('ipad') >= 0 ||
(globalUA.indexOf('android') >= 0 && globalUA.indexOf('mobile') == -1) ||
(globalUA.indexOf('firefox') >= 0 && globalUA.indexOf('tablet') >= 0);

ua_desktop = !(ua_phone || ua_tablet);

if (ua_touch) {
  addClass('ua-touch');
}
if (ua_nontouch) {
  addClass('ua-nontouch');
}
if (ua_retina) {
  addClass('ua-retina');
}
if (ua_phone) {
  addClass('ua-phone');
}
if (ua_tablet) {
  addClass('ua-tablet');
}
if (ua_desktop) {
  addClass('ua-desktop');
}

/* os */

var ua_windows;
var ua_mac;
var ua_ipad;
var ua_iphone;
var ua_android;
var ua_android_noflex;

if (ua_windows = globalUA.indexOf('windows') >= 0) {
  addClass('ua-windows');
}
if (ua_mac = globalUA.indexOf('mac') >= 0) {
  addClass('ua-mac');
}
if (ua_ipad = globalUA.indexOf('ipad') >= 0) {
  addClass('ua-ipad');
}
if (ua_iphone = globalUA.indexOf('iphone') >= 0) {
  addClass('ua-iphone');
}
if (ua_android = globalUA.indexOf('android') >= 0) {
  addClass('ua-android');
  if (ua_android_noflex = parseFloat(globalUA.slice(globalUA.indexOf('android')) + 8) <= 4.3) {
    addClass('ua-android-noflex');
  }
}

/* browser */

var ua_edge;
var ua_ie;
var ua_ie8;
var ua_ie9;
var ua_ie10;
var ua_ie11;
var ua_chrome;
var ua_firefox;
var ua_safari;

if (ua_edge = globalUA.indexOf('edge') >= 0) { /* Edge */
  addClass('ua-edge');
} else if (ua_ie = globalUA.indexOf('trident') >= 0) { /* IE8〜11 */
  addClass('ua-ie');
  if (ua_ie8 = globalUA.indexOf('msie 8') >= 0) { /* IE8 */
    addClass('ua-ie8');
  } else if (ua_ie9 = globalUA.indexOf('msie 9') >= 0) { /* IE9 */
    addClass('ua-ie9');
  } else if (ua_ie10 = globalUA.indexOf('msie 10') >= 0) { /* IE10 */
    addClass('ua-ie10');
  } else if (ua_ie11 = globalUA.indexOf('trident/7') >= 0) { /* IE11 */
    addClass('ua-ie11');
  }
} else if (ua_chrome = globalUA.indexOf('chrome') >= 0) {
  addClass('ua-chrome');
} else if (ua_firefox = globalUA.indexOf('firefox') >= 0) {
  addClass('ua-firefox');
} else if (ua_safari = globalUA.indexOf('safari') >= 0) {
  addClass('ua-safari');
}

/* get window width --------------------------------------*/

function get_winW() {
  var ua = window.navigator.userAgent.toLowerCase();
  if (globalUA.indexOf('safari') >= 0 && globalUA.indexOf('chrome') == -1) {
    return jQuery(window).width();
  } else {
    return window.innerWidth;
  }
}

var winW = get_winW();

jQuery(window).on('load resize', function() {
  winW = get_winW();
});

/* which is scrollable --------------------------------------*/

var htmlorbody = (function($) {
  var $html = $('html')
  var htmlInitialT = $html.scrollTop();
  var $empty = $('<div>').height(10000).appendTo('body');
  $html.scrollTop(10000);
  var which = $html.scrollTop() ? 'html' : 'body';
  $html.scrollTop(htmlInitialT);
  $empty.remove();
  return which;
})(jQuery);

/* mousewheel event --------------------------------------*/

var mousewheelevent = 'onwheel' in document ? 'wheel' : 'onmousewheel' in document ? 'mousewheel' : 'DOMMouseScroll';

function get_delta(e) {
  return e.originalEvent.deltaY ? -(e.originalEvent.deltaY) : e.originalEvent.wheelDelta ? e.originalEvent.wheelDelta : -(e.originalEvent.detail);
}

(function($) {

  $(document).on(mousewheelevent, function(e) {

    /* スクリプトによるスクロール中にマウスホイール → スクロールを停止 */
    $(htmlorbody).stop();

    // var delta = get_delta(e);

    // if (delta < 0) {
      /* mouse down */
    // } else {
      /* mouse up */
    // }

  });

})(jQuery);

/* tap event */

(function($, window) {

  var RANGE = 5;
  var events = ['click', 'touchstart', 'touchmove', 'touchend'];
  var handlers = {

    click: function(e) {

      if (e.target === e.currentTarget)
        e.preventDefault();

    },

    touchstart: function(e) {

      this.jQueryTap.touched = true;
      this.jQueryTap.startX = e.touches[0].pageX;
      this.jQueryTap.startY = e.touches[0].pageY;

    },

    touchmove: function(e) {

      if (!this.jQueryTap.touched) {
        return;
      }

      if (Math.abs(e.touches[0].pageX - this.jQueryTap.startX) > RANGE ||
        Math.abs(e.touches[0].pageY - this.jQueryTap.startY) > RANGE)
      {
        this.jQueryTap.touched = false;
      }

    },

    touchend: function(e) {

      if (!this.jQueryTap.touched) {
        return;
      }

      this.jQueryTap.touched = false;
      $.event.dispatch.call(this, $.Event('tap', {
        originalEvent: e,
        target: e.target,
        pageX: e.changedTouches[0].pageX,
        pageY: e.changedTouches[0].pageY
      }));

    }

  };

  $.event.special.tap = 'ontouchend' in window ? {

    setup: function() {

      var thisObj = this;

      if (!this.jQueryTap) {
        Object.defineProperty(this, 'jQueryTap', {
          value: {}
        });
      }

      $.each(events, function(i, ev) {
        thisObj.addEventListener(ev, handlers[ev], false);
      });

    },

    teardown: function() {

      var thisObj = this;

      $.each(events, function(i, ev) {
        thisObj.removeEventListener(ev, handlers[ev], false);
      });

    }

  } : {

    bindType: 'click',
    delegateType: 'click'

  };

  $.fn.tap = function(data, fn) {
    return arguments.length > 0 ? this.on('tap', null, data, fn) : this.trigger('tap');
  };

})(jQuery, this);

/* zero padding --------------------------------------*/

function pad_zero(number, degit) {
  number = 0 < number ? number : 0;
  var s = number ? Math.log(number) * Math.LOG10E : 0;
  for (i = 1, n = degit - s, str = ''; i < n; i++) str += '0';
    return str + number;
}

/* 下記関数が記述されたJSファイル自身のパスを取得 */

function get_my_path() {
  var scripts = document.getElementsByTagName('script'),
  script = scripts[scripts.length - 1];
  if (script.src) {
    var path = script.src;
    var pathArray = path.split('/');
    pathArray.pop();
    return pathArray.join('/');
  }
}

/*--------------------------------------------------*/
/* method */
/*--------------------------------------------------*/

(function($) {

  /* offset --------------------------------------*/

  $.fn.offsetTop = function() {
    return this.offset().top;
  };

  $.fn.offsetBottom = function() {
    return this.offset().top + this.outerHeight();
  };

  $.fn.offsetLeft = function() {
    return this.offset().left;
  };

  $.fn.offsetRight = function() {
    return this.offset().left + this.outerWidth();
  };

  /* toggleAttr --------------------------------------*/

  $.fn.toggleAttr = function(attr, attr1, attr2) {
    return this.each(function() {
      var self = $(this);
      if (self.attr(attr) == attr1)
        self.attr(attr, attr2);
      else
        self.attr(attr, attr1);
    });
  };

  /* specificImagesLoaded --------------------------------------*/

  /* MIT license. Paul Irish. 2010. */
  /* Arranged by Jun Takahashi with OS. CO., LTD. */

  $.fn.specificImagesLoaded = function(callback) {

    var elems = this.filter('img');
    var len = elems.length;
    var blank = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

    elems.bind('load.specificImagesLoaded', function() {

      if (--len <= 0 && this.src !== blank) {

        elems.unbind('load.specificImagesLoaded');
        setTimeout(function() {
          callback.call(elems, this);
        }, 0);

      }

    }).each(function() {

      if (this.complete || this.complete === undefined) {

        var src = this.src;
        this.src = blank;
        this.src = src;

      }

    });

    return this;

  };

  // $('img:gt(0):lt(4)').specificImagesLoaded(function() {

    /* 例：先頭から5枚分の画像が読み込まれた時点 */

  // });

  /* switchImg / switchBg --------------------------------------*/

  $.fn.switchImgRun = function(maxWidth) {
    if (winW <= maxWidth) {
      this.each(function() {
        var $this = $(this);
        var src = $this.attr('data-switch') ? $this.attr('data-switch') : $this.attr('src');
        if (src.indexOf('-2x.') >= 0) return false;
        src = src.replace(/\.(gif|jpg|jpeg|png)/i, '-2x.$1');
        $this.attr('src', src);
      });
    } else {
      this.each(function() {
        var $this = $(this);
        var src = $this.attr('data-switch') ? $this.attr('data-switch') : $this.attr('src');
        src = src.replace(/-2x\./, '.');
        $this.attr('src', src);
      });
    }
  }

  $.fn.switchBgRun = function(maxWidth) {
    if (winW <= maxWidth) {
      this.each(function() {
        var $this = $(this);
        var src = $this.attr('data-switch') ? 'url("' + $this.attr('data-switch') + '")' : $this.css('background-image');
        if (src.indexOf('-2x.') >= 0) return false;
        src = src.replace(/\.(gif|jpg|jpeg|png)/i, '-2x.$1');
        $this.css('background-image', src);
      });
    } else {
      this.each(function() {
        var $this = $(this);
        var src = $this.attr('data-switch') ? 'url("' + $this.attr('data-switch') + '")' : $this.css('background-image');
        src = src.replace(/-2x\./, '.');
        $this.css('background-image', src);
      });
    }
  }

  $.fn.switchImg = function(option) {
    var $this = this;
    $this.switchImgRun(option.maxWidth);
    $(window).on('load resize', function() {
      $this.switchImgRun(option.maxWidth);
    });
  };

  $.fn.switchBg = function(option) {
    var $this = this;
    $this.switchBgRun(option.maxWidth);
    $(window).on('load resize', function() {
      $this.switchBgRun(option.maxWidth);
    });
  };

  /* 指定したウィンドウサイズ以下になったら画像が切り替わる */
  // $('img').switchImg({maxWidth:767});
  // $('div').switchBg({maxWidth:767});

  /* normalize URL --------------------------------------*/

  String.prototype.normalizeURL = function() {
    return this
    .replace(/(#|\?).*$/, '')
    .replace(/\.[^/]*$/, '')
    .replace(/index$/, '')
    .replace(/\/$/, '');
  };

  /* enable isNaN in IE11 --------------------------------------*/

  Number.isNaN = Number.isNaN || function(any) {
    return typeof any === 'number' && isNaN(any);
  };

})(jQuery);

/*--------------------------------------------------*/
/* common */
/*--------------------------------------------------*/

/* アンカースクロールの際に考慮させたいヘッダー高（コンポーネント側で指定） */

var globalHeaderH;
var globalHeaderH_pc;
var globalHeaderH_sp;
var globalHeaderH_breakpoint;

jQuery(window).on('load resize', function() {
  globalHeaderH = (ua_touch || winW < globalHeaderH_breakpoint) ? globalHeaderH_sp : globalHeaderH_pc;
});

(function($) {

  /* 正方形キープ */
  /*--------------------------------------------------*/

  $('[class*="keepSquare"]').each(function() {

    var $this = $(this);
    var rangeArray = [];
    var classArray = $this.attr('class').split(' ');

    $(window).on('load resize', function() {

      var hasClass = false;

      setTimeout(function() {

        /* ウィンドウ幅ごとの該当クラス配列 */

        if (0 <= winW && winW < 576) {

          rangeArray = [
          'keepSquare',
          'keepSquare-xs',
          'keepSquare-xs-ika',
          'keepSquare-sm-ika',
          'keepSquare-md-ika',
          'keepSquare-lg-ika'
          ];

        } else if (576 <= winW && winW < 768) {

          rangeArray = [
          'keepSquare',
          'keepSquare-sm',
          'keepSquare-sm-ijo',
          'keepSquare-sm-ika',
          'keepSquare-md-ika',
          'keepSquare-lg-ika'
          ];

        } else if (768 <= winW && winW < 992) {

          rangeArray = [
          'keepSquare',
          'keepSquare-md',
          'keepSquare-sm-ijo',
          'keepSquare-md-ijo',
          'keepSquare-md-ika',
          'keepSquare-lg-ika'
          ];

        } else if (992 <= winW && winW < 1200) {

          rangeArray = [
          'keepSquare',
          'keepSquare-lg',
          'keepSquare-sm-ijo',
          'keepSquare-md-ijo',
          'keepSquare-lg-ijo',
          'keepSquare-lg-ika'
          ];

        } else if (1200 <= winW) {

          rangeArray = [
          'keepSquare',
          'keepSquare-xl',
          'keepSquare-sm-ijo',
          'keepSquare-md-ijo',
          'keepSquare-lg-ijo',
          'keepSquare-xl-ijo'
          ];

        }

        /* 該当クラスを持っているか判定 */

        for (i = 0; i < rangeArray.length; i++) {
          if (classArray.indexOf(rangeArray[i]) >= 0) {
            hasClass = true;
            break;
          }
        }

        /* 持っていたら正方形キープ */

        if (hasClass) {
          $this.css({ height: $this.outerWidth() });
        } else {
          $this.css({ height: '' });
        }

      }, 80 /* after matchHeight */ );

    });

  });

  /* ハッシュ付URLにアクセスした場合 */
  /*--------------------------------------------------*/

  var hash = location.hash;
  var $target = $(hash);

  if ($target.length) {

    location.hash = '';

    $(window).on('load', function() {

      $(htmlorbody).queue([]).animate({
        scrollTop: $target.offsetTop() - (globalHeaderH ? globalHeaderH : 0)
      }, 1250, 'easeOutQuart');

      location.hash = hash;

      /* スクリーンリーダーでタブフォーカスを可能にする */
      $target.attr({tabindex: -1}).focus();

    });

  }

  /* ページ内アンカーリンクをクリックした場合 */
  /*--------------------------------------------------*/

  $('[href*="#"]:not([data-nosmooth])').on('click', function(e) {

    /* データ準備 */
    var href = $(this).attr('href');
    var hash = href.slice(href.indexOf('#'));
    var $target = $(hash);

    /* 判定条件 */
    var sharp_start = href[0] == '#';
    var sharp_end = href == '#';
    var page_same = location.href.normalizeURL() == $(this).prop('href').normalizeURL();
    var target_exist = $target.length;

    if (sharp_start) {
      /* #のみの場合 */
      if (sharp_end) return true;
      if (target_exist) {
        /* #で始まりターゲットがある場合 */
        goToTarget(e, $target);
      } else {
        /* #で始まりターゲットがない場合 */
        return true;
      }
    } else {
      if (page_same) {
        if (target_exist) {
          /* #以外で始まる ＆ 同ページ ＆ ターゲットがある場合 */
          goToTarget(e, $target);
        } else {
          /* #以外で始まる ＆ 同ページ ＆ ターゲットがない場合 */
          return true;
        }
      } else {
        /* #以外で始まる ＆ 別ページの場合 */
        return true;
      }
    }
  });

  var goToTarget = function(e, $target) {

    e.preventDefault();

    $(htmlorbody).queue([]).animate({
      scrollTop: $target.offsetTop() - (globalHeaderH ? globalHeaderH : 0)
    }, 1000, 'easeOutQuart');

    location.hash = hash;

    /* スクリーンリーダーでタブフォーカスを可能にする */
    $target.attr({ tabindex: -1 }).focus();

  };

  /* 制作中の href="○○○○○" をクリックした場合 */
  /*--------------------------------------------------*/

  $('[href^="○"]').on('click', function(e) {
    e.preventDefault();
  });

  /* tel disabled @ desktop */
  /*--------------------------------------------------*/

  if (!ua_phone) {
    $('a[href^="tel:"]').click(function(e) {
      e.preventDefault();
    });
  }

  /* history back */
  /*--------------------------------------------------*/

  /* aタグを使う場合 → href 属性は記述しないでおく for Android */

  $('.historyBack').attr('href', ''); /* for iOS */

  $(document).on('click', '.historyBack', function(e) {
      e.preventDefault();
      history.back();
  });

  /* accordion */
  /*--------------------------------------------------*/

  /* aria属性を付与 */

  $('.accordion-toggle').each(function() {
    var id = $(this).data('accordion-id');
    $(this).attr({
      'aria-expanded': 'false',
      'aria-controls': id
    });
  });

  $('.accordion-content').each(function() {
    $(this).attr({
      'aria-hidden': 'true'
    });
  });

  /* toggle */

  $('.accordion-toggle').on('click', function() {
    var id = $(this).data('accordion-id');
    $(this).toggleAttr('aria-expanded', 'true', 'false');
    $('.accordion-content#' + id).slideToggle().toggleAttr('aria-hidden', 'true', 'false');
  });

  /* close */

  $('.accordion-close').on('click', function() {
    var id = $(this).data('accordion-id');
    $('.accordion-toggle[data-accordion-id="' + id + '"]').attr('aria-expanded', 'false');
    $('.accordion-content#' + id).slideUp().attr('aria-hidden', 'true');
  });

  /* close & scroll back to toggle */

  $('.accordion-scrollBack').on('click', function() {

    var $this = $(this);
    var id = $this.data('accordion-id');
    var $tgl = $('.accordion-toggle[data-accordion-id="' + id + '"]');
    var tglT = $tgl.offsetTop();
    var tglB = $tgl.offsetBottom();
    var scrT = $(window).scrollTop();
    var scrBack = tglB < scrT ? tglT : scrT;

    $(htmlorbody).queue([]).animate({
      scrollTop: scrBack
    }, function() {
      $('.accordion-toggle[data-accordion-id="' + id + '"]').attr('aria-expanded', 'false');
      $('.accordion-content#' + id).slideUp().attr('aria-hidden', 'true');
    });

  });

  /* click to select all */
  /*--------------------------------------------------*/

  $('.selectable').click(function() {

    var range;
    var selection;

    range = document.createRange(); /* 該当箇所を含むセルを取得 */
    range.selectNodeContents(this); /* 該当箇所を選択 */

    selection = window.getSelection(); /* カーソルによる選択範囲を取得 */
    selection.removeAllRanges(); /* カーソルによる選択範囲を解除 for IE */

    selection.addRange(range);

  });

})(jQuery);
