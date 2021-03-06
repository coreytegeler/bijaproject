jQuery(function($) {
  var $body, $faders, $header, $headerWrap, $intro, $introCont, $left, $leftInner, $logo, $logoSvg, $main, $mainRow, $right, $rightInner, adjustHeader, getSize, getTranslate, init, isSize, logoObj;
  $body = $('body');
  $header = $('header');
  $headerWrap = $('.header-wrap');
  $logo = $('header .col-logo');
  $logoSvg = $('header svg');
  $intro = $('#intro');
  $introCont = $intro.find('.container');
  $main = $('main');
  $mainRow = $main.find('.main-row');
  $faders = $main.find('.inner-content');
  $left = $main.find('.left.col');
  $leftInner = $left.find('.inner-content');
  $right = $main.find('.right.col');
  $rightInner = $right.find('.inner-content');
  init = function() {
    return adjustHeader();
  };
  adjustHeader = function() {
    var headerHeight, headerTop, initX, initY, introBottom, key, leftGap, leftWidth, leftWidthPerc, logoWidth, mainTop, newX, newY, part, ref, resizeFactor, results, rightWidth, scrollY, toAlign, toResize, winSize, windowHeight, windowWidth;
    scrollY = $(window).scrollTop();
    windowWidth = $(window).innerWidth();
    windowHeight = $(window).innerHeight();
    winSize = getSize();
    headerTop = $headerWrap.position().top;
    introBottom = $introCont.offset().top + $introCont.innerHeight();
    mainTop = $main.offset().top;
    toAlign = scrollY / introBottom;
    toResize = scrollY / mainTop;
    resizeFactor = toAlign - 1;
    headerHeight = $header.innerHeight();
    leftWidth = $left.innerWidth();
    rightWidth = $right.innerWidth();
    leftWidthPerc = leftWidth / windowWidth;
    if (toAlign >= 1) {
      $header.addClass('aligned');
      toAlign = 1;
      resizeFactor = (scrollY - introBottom) / (headerTop - introBottom);
      if (resizeFactor < 1) {
        leftGap = rightWidth * resizeFactor;
        logoWidth = ((windowWidth - leftGap) / windowWidth) * 100;
        $faders.css({
          opacity: resizeFactor
        });
      } else {
        toResize = 1;
        logoWidth = (leftWidth / windowWidth) * 100;
        $faders.css({
          opacity: 1
        });
      }
    } else {
      $header.removeClass('aligned');
      logoWidth = 100;
      $faders.css({
        opacity: 0
      });
    }
    if (headerTop > scrollY) {
      $headerWrap.attr('style', '');
      $header.removeClass('fixed');
      $leftInner.css({
        top: 'auto',
        width: 'auto',
        height: 'auto'
      });
      $leftInner.removeClass('fixed');
    } else {
      $headerWrap.css({
        height: headerHeight
      });
      $header.addClass('fixed');
      $leftInner.css({
        top: headerHeight,
        width: leftWidth,
        height: windowHeight - headerHeight
      });
      $leftInner.addClass('fixed');
    }
    if (toResize < 1) {
      $logo.css({
        width: Math.floor(logoWidth) + '%'
      });
    } else {
      $logo.attr('style', '');
    }
    ref = logoObj();
    results = [];
    for (key in ref) {
      part = ref[key];
      initX = part.x;
      initY = part.y;
      newY = toAlign * -part.y + part.y;
      newX = toAlign * -part.x + part.x;
      results.push($(part.elem).attr('transform', 'translate(' + newX + ',' + newY + ')'));
    }
    return results;
  };
  logoObj = function() {
    var height, obj, width;
    height = $(window).innerHeight();
    width = $(window).innerWidth();
    obj = {
      t: {
        elem: $logoSvg.children().filter('g:eq(2)'),
        x: -100,
        y: -100
      },
      b: {
        elem: $logoSvg.children().filter('g:eq(1)'),
        x: 100,
        y: -100
      },
      p: {
        elem: $logoSvg.children().filter('g:eq(0)'),
        x: -100,
        y: 100
      }
    };
    return obj;
  };
  getTranslate = function(svg) {
    var attr, attrs, b, c, i, len;
    attrs = $(svg).attr('transform');
    b = {};
    attrs = attrs.match(/(\w+\((\-?\d+\.?\d*e?\-?\d*,?)+\))+/g);
    for (i = 0, len = attrs.length; i < len; i++) {
      attr = attrs[i];
      c = attr.match(/[\w\.\-]+/g);
      b[c.shift()] = c;
    }
    return b['translate'];
  };
  getSize = function() {
    var bodyBefore, size;
    bodyBefore = window.getComputedStyle($body[0], '');
    size = bodyBefore.getPropertyValue('content');
    return size = size.replace(/"/g, '');
  };
  isSize = function(sizes) {
    var i, len, size, winSize;
    if (!Array.isArray(sizes)) {
      sizes = [sizes];
    }
    winSize = getSize();
    for (i = 0, len = sizes.length; i < len; i++) {
      size = sizes[i];
      if (size === winSize) {
        return true;
      }
    }
    return false;
  };
  $(window).scroll(function(e) {
    return adjustHeader();
  });
  $(window).resize(function(e) {
    return adjustHeader();
  });
  return $(function() {
    init();
    return getSize();
  });
});
