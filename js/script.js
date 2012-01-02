(function() {
  window.frugal = {
    linksWidth: 0,
    linksItemsWidth: 0,
    layout: function() {
      var linksItemsMargin, linksItemsPadding, navLinks, navLinksItems, pageWrap, ul;
      navLinks = $('#frugal-nav');
      ul = navLinks.children('ul');
      navLinksItems = $('#frugal-nav li');
      pageWrap = $('#page-wrap');
      window.frugal.linksWidth = navLinks.width();
      try {
        linksItemsMargin = parseInt($('#frugal-nav li').css('margin-left'));
        linksItemsPadding = parseInt($('#frugal-nav li').css('padding-left'));
        return navLinksItems.each(function() {
          console.log($(this).width() + 2 * (linksItemsMargin + linksItemsPadding));
          return window.frugal.linksItemsWidth += $(this).width() + 2 * (linksItemsMargin + linksItemsPadding);
        });
      } finally {
        ul.css('margin-left', (window.frugal.linksWidth - window.frugal.linksItemsWidth) / 2);
      }
    },
    shareButtons: function() {
      var facebook, iframes, twitter;
      iframes = $('iframe');
      facebook = $('.facebook_like');
      twitter = $('.twitter_tweet');
      iframes.css('padding', 0);
      twitter.css({
        marginTop: -2
      });
      return facebook.css({
        width: 80
      });
    }
  };
  $(document).ready(function() {
    console.log("We're ready snitches.");
    window.frugal.layout();
    window.frugal.shareButtons();
    return console.log(window.frugal);
  });
}).call(this);
