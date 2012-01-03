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
    },
    contactLink: function() {
      var clickCloser, form, link, wrapper;
      link = $('.contact-link');
      form = $('#contact-form');
      wrapper = $('#post-wrapper');
      wrapper.addClass('closed');
      $('#form-message textarea').attr('cols', 125);
      link.click(function(e) {
        var height;
        height = form.height() + (2 * parseInt(form.css('padding-top'))) + 47;
        console.log(form.height());
        console.log(2 * parseInt(form.css('padding-top')));
        console.log(height);
        e.preventDefault();
        if ($('.open').length >= 1) {
          return;
        }
        link.addClass('closer');
        wrapper.addClass('open');
        return wrapper.animate({
          marginTop: '+=' + height
        }, function() {
          form.css('z-index', 1);
          return $('.closer').one('click', function() {
            $('.closer').removeClass('closer');
            if ($('.open').length < 1) {
              return;
            }
            wrapper.animate({
              marginTop: 0
            });
            form.css('z-index', -1);
            return wrapper.removeClass('open').addClass('closed');
          });
        });
      });
      clickCloser = function() {
        return $('.closer').trigger('click');
      };
      $('#form-close').click(function() {
        return setTimeout(clickCloser, 200);
      });
      return $('#form-submit input').click(function() {
        if ($('.wpcf7-mail-sent-ok').length >= 1) {
          return setTimeout(clickCloser, 2000);
        }
      });
    }
  };
  $(document).ready(function() {
    console.log("We're ready snitches.");
    window.frugal.layout();
    window.frugal.shareButtons();
    window.frugal.contactLink();
    return console.log(window.frugal);
  });
}).call(this);
