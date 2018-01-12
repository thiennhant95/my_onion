$(function(){

  // open navi
  $('.nav0001sp-trigger').on('click', function(event) {
    $(this).toggleClass('active');
    $('.nav0001sp-main').toggleClass('active');
  });
  // open submenu
  var clickObj = $('.nav0001sp-list > li > a');
  $(clickObj).on('click', function(event) {
    $(this).parent('li').children('ul._sub').toggle('fast', function(){
    });
  });

});




/* pagetop170 */
/*--------------------------------------------------*/

$(function(){


  // var htmlorbody = (function($) {
  //   var $html = $('html')
  //   var htmlInitialT = $html.scrollTop();
  //   var $empty = $('<div>').height(10000).appendTo('body');
  //   $html.scrollTop(10000);
  //   var which = $html.scrollTop() ? 'html' : 'body';
  //   $html.scrollTop(htmlInitialT);
  //   $empty.remove();
  //   return which;
  // })(jQuery);


  var $pagetop170 = $('.pagetop170');

  $(window).on('load scroll', function() {

    var scrT = $(this).scrollTop();

    if (scrT <= 200) {
      $pagetop170.stop().fadeOut();
    } else if (200 < scrT) {
      $pagetop170.stop().fadeIn();
    }

    // テーブルでTD要素にあるDIVで高さが100%にならない問題を解消
    // var tableDiv = $('.content05-tablebg-1');
    // tableDiv.height(tableDiv.parent('td').innerHeight());

  });

  // テーブルでTD要素にあるDIVで高さが100%にならない問題を解消
  var tableDiv = $('.content05-tablebg-1');
  tableDiv.height(tableDiv.parent('td').innerHeight());

  $pagetop170.on('click', function() {
    $('html').animate({
      scrollTop: 0
    }, {
      duration: 500,
      easing: 'easeOutQuart'
    });
  });

});
