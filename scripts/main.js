var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

window.require(['jquery', 'transparency'], function($, Transparency) {
  var contactForm, notification;
  Transparency.register($);
  contactForm = (function() {

    function contactForm() {
      this.toggle = __bind(this.toggle, this);
      this.window = $(window);
      this.form = $('#isly-contact');
      this.notifications = $('#notifications');
      this.contactButton = $('#menu-header-links').find('[title="contact"]');
      this.contactButtons = $('.open-contact');
      this.submitButton = this.form.find('button');
      this.register();
    }

    contactForm.prototype.register = function() {
      var that;
      that = this;
      this.contactButton.on('click', this.toggle);
      return this.form.on('submit', function(e) {
        var form;
        form = $(this);
        that.notifications.hide();
        $.post(form.attr('action'), form.serialize(), function(result) {
          return new notification(JSON.parse(result));
        });
        return false;
      });
    };

    contactForm.prototype.toggle = function(e) {
      $(document).trigger('contactFormClick');
      this.form.slideToggle();
      return this.contactButton.toggleClass('selected');
    };

    return contactForm;

  })();
  notification = (function() {

    function notification(result) {
      this.target = $('body');
      this.form = $('#isly-contact');
      this.template = $('#notifications');
      this.notify(result.type, result.notifications);
    }

    notification.prototype.notify = function(type, notifications) {
      var directives;
      directives = {
        notification: {
          'class': function() {
            return type;
          }
        }
      };
      this.template.render(notifications, directives);
      this.template.slideToggle();
      if (type === 'success') {
        return this.form.delay(3000).slideUp();
      }
    };

    return notification;

  })();
  return $(document).ready(function() {
    return new contactForm('isly-contact');
  });
});


window.require(['jquery', 'transparency'], function($, Transparency) {
  var customDropDown, slider;
  Transparency.register($);
  customDropDown = (function() {

    function customDropDown(target, toggle, id, translator) {
      this.target = $(target);
      this.toggle = $(toggle);
      this.select = this.target.find('select');
      this.id = id;
      this.translator = translator;
      this.options = this.getOptions();
      this.instantiated = false;
      this.register();
    }

    customDropDown.prototype.register = function() {
      var that,
        _this = this;
      that = this;
      return this.toggle.on('click', function() {
        console.log('clicked');
        _this.target.toggleClass('open');
        if (!_this.instantiated) {
          _this.instantiated = true;
          _this.template = _this.insertTemplate();
          _this.renderTemplate(_this.template);
          return new slider('y', _this.target.find('.drop-down-slider-bar'), _this.target.find('.drop-down-slider'), _this.target.find('#' + _this.id), _this.target.find('.drop-down-list'));
        }
      });
    };

    customDropDown.prototype.getOptions = function() {
      var i, option, options, result, value;
      options = this.select.find('option');
      i = options.length;
      option = null;
      value = null;
      result = [];
      while (i--) {
        option = $(options[i]);
        value = option.attr('value');
        if (value.length && value !== '-1') {
          result.unshift({
            'dropDownItem': {
              'dropDownItemLink': {
                link: this.translator(option.attr('value')),
                linkText: option.text()
              }
            }
          });
        }
      }
      return result;
    };

    customDropDown.prototype.insertTemplate = function() {
      var template;
      template = this.getTemplate();
      this.target.append(template);
      return this.target.find('.drop-down-list');
    };

    customDropDown.prototype.getTemplate = function() {
      return "<div id=\"" + this.id + "\" class=\"drop-down\">\n<ul class=\"drop-down-list\">\n<li class=\"dropDownItem\">\n<a class=\"dropDownItemLink\"></a>\n</li>\n</ul>\n<div class=\"drop-down-slider slider\">\n<div class=\"drop-down-slider-bar slider-bar\"></div>\n</div>\n</div>";
    };

    customDropDown.prototype.renderTemplate = function(template) {
      var directive;
      directive = {
        'dropDownItemLink': {
          href: function() {
            return this.dropDownItem.dropDownItemLink.link;
          },
          text: function() {
            return this.dropDownItem.dropDownItemLink.linkText;
          }
        }
      };
      return template.render(this.options, directive);
    };

    return customDropDown;

  })();
  slider = (function() {

    function slider(axis, slider, sliderBox, box, target) {
      if (axis == null) {
        axis = "y";
      }
      console.log(arguments);
      this.axis = axis;
      this.slider = $(slider);
      this.sliderBox = sliderBox;
      this.box = $(box);
      this.target = $(target);
      this.build();
      this.register();
    }

    slider.prototype.build = function() {
      this.targetHeight = this.target.height();
      this.boxHeight = this.box.height();
      this.minOffset = -1 * (this.targetHeight - this.boxHeight);
      this.sliderHeight = this.boxHeight * (this.boxHeight / this.targetHeight);
      this.scrollThreshhold = 100;
      this.scrollRatio = (-1 * this.minOffset) / (this.boxHeight - this.sliderHeight);
      console.log(this.targetHeight, this.boxHeight, this.sliderHeight);
      if (this.targetHeight > this.boxHeight) {
        return this.slider.height(this.sliderHeight);
      }
    };

    slider.prototype.register = function() {
      var mousemoveHandler, that;
      that = this;
      this.box.on('rebuildSlider', function() {
        return that.build();
      });
      this.box.on('mousewheel', function(e) {
        var delta;
        e.preventDefault();
        if (that.axis === 'y') {
          delta = e.originalEvent.wheelDeltaY;
        } else if (that.axis === 'x') {
          delta = e.originalEvent.wheelDeltaX;
        }
        return that.scroll(delta);
      });
      mousemoveHandler = function(e) {
        return that.mouseHandler(e);
      };
      this.slider.on('mousedown', function(e) {
        that.target.addClass('sliding');
        that.sliderBox.on('mousemove', mousemoveHandler);
        return false;
      });
      this.box.on('mouseup mouseleave', function() {
        that.target.removeClass('sliding');
        return that.sliderBox.off('mousemove', mousemoveHandler);
      });
      return this.sliderBox.on('click', function(e) {
        var offset, px, sliderOffset;
        if (that.axis === 'y') {
          sliderOffset = that.slider.position().top;
          offset = e.pageY - that.sliderBox.offset().top;
        } else {
          sliderOffset = that.slider.position().left;
          offset = e.pageX - that.sliderBox.offset().left;
        }
        px = -1 * that.scrollRatio * (offset - sliderOffset);
        return that.scroll(px, true);
      });
    };

    slider.prototype.scroll = function(px, skipThreshhold) {
      var offset, percentage, sliderOffset, style;
      if (skipThreshhold == null) {
        skipThreshhold = false;
      }
      if (this.axis === 'y') {
        style = 'top';
      } else {
        style = 'left';
      }
      if (!skipThreshhold && Math.abs(px) > this.scrollThreshhold) {
        px = this.scrollThreshhold;
        if (px > 0) {
          px = -1 * this.scrollThreshhold;
        }
      }
      offset = Math.max(this.minOffset, Math.min(0, this.target.position().top + px));
      if (offset > this.minOffset) {
        percentage = offset / this.minOffset;
        sliderOffset = Math.min(this.boxHeight - this.sliderHeight, percentage * this.boxHeight);
        this.target.css(style, offset);
        return this.slider.css(style, sliderOffset);
      }
    };

    slider.prototype.mouseHandler = function(e) {
      var mouseOffset, movement, px, sliderOffset;
      if (this.axis === 'y') {
        sliderOffset = this.slider.position().top;
        mouseOffset = e.pageY - this.sliderBox.offset().top;
      } else {
        sliderOffset = this.slider.position().left;
        mouseOffset = e.pageX - this.sliderBox.offset().left;
      }
      movement = sliderOffset - mouseOffset;
      px = movement * this.scrollRatio;
      return this.scroll(px);
    };

    return slider;

  })();
  return $(document).ready(function() {
    var commentBox, commentBoxes, i, _results;
    new customDropDown('.widget_categories', '.widget_categories h2', 'category-drop-down', function(value) {
      return '/?cat=' + value;
    });
    new customDropDown('.widget_archive', '.widget_archive h2', 'archive-drop-down', function(value) {
      return value;
    });
    commentBoxes = $('.comment-list-wrapper');
    i = commentBoxes.length;
    commentBox = null;
    _results = [];
    while (i--) {
      commentBox = $(commentBoxes[i]);
      _results.push(new slider('y', commentBox.find('.slider-bar'), commentBox.find('.slider'), commentBox, commentBox.find('.commentlist')));
    }
    return _results;
  });
});


window.require(['jquery', '../../../../wp-includes/js/comment-reply.js'], function($, commentReply) {
  var browserClasses, commentShowHide, floatTop, interactionPill, replyLinkBlocker;
  floatTop = (function() {

    function floatTop(element) {
      this.element = $(element);
      this.fixed = false;
      this.scrollWrapper = $(window);
      this.test();
      this.register();
    }

    floatTop.prototype.register = function() {
      var that;
      that = this;
      this.scrollWrapper.on('scroll resize contactFormClick', function() {
        return that.test();
      });
      this.scrollWrapper.ownerDocument = document;
      return this.scrollWrapper.on('contactFormClick', function() {
        return that.element.removeClass('fixed');
      });
    };

    floatTop.prototype.test = function() {
      var isFixed, offsetTop;
      isFixed = this.element.hasClass('fixed');
      offsetTop = this.element.offset().top - this.scrollWrapper.scrollTop();
      if (isFixed && offsetTop > 0) {
        return this.element.removeClass('fixed');
      } else if (!isFixed && offsetTop <= 0) {
        return this.element.addClass('fixed');
      }
    };

    return floatTop;

  })();
  browserClasses = (function() {

    function browserClasses() {
      var body, browser, i, test;
      browser = $.browser;
      console.log($.browser);
      body = $('body');
      test = ['opera', 'webkit', 'msie', 'mozilla'];
      i = test.length;
      while (i--) {
        if (browser[test[i]]) {
          body.addClass(test[i]);
        }
      }
    }

    return browserClasses;

  })();
  interactionPill = (function() {

    function interactionPill() {
      this.interactionPills = $('.post-interaction-pill');
      this.register();
    }

    interactionPill.prototype.register = function() {
      return this.interactionPills.on('click', '.pill-toggle', function(e) {
        return $(e.target).parents('.post-interaction-pill').toggleClass('pill-open');
      });
    };

    return interactionPill;

  })();
  replyLinkBlocker = (function() {

    function replyLinkBlocker() {
      this.commentLists = $('.commentlist');
      this.register();
    }

    replyLinkBlocker.prototype.register = function() {
      this.commentLists.on('click', '.comment-reply-link', function(e) {
        var commentID, postID, target;
        e.preventDefault();
        e.stopPropagation();
        target = $(e.target);
        postID = target.parents('.post').attr('data-id');
        commentID = target.parents('.comment-body').attr('id').match(/\d+/)[0];
        console.log('adding comment', target.parents('.comment-body').attr('id'), commentID, 'respond-' + postID, postID);
        window.addComment.moveForm(target.parents('.comment-body').attr('id'), commentID, 'respond-' + postID, postID);
        return target.trigger('rebuildSlider');
      });
      return this.commentLists.on('click', function(e) {
        var target;
        target = $(e.target);
        if (target.attr('id') === 'cancel-comment-reply-link') {
          return target.trigger('rebuildSlider');
        }
      });
    };

    return replyLinkBlocker;

  })();
  commentShowHide = (function() {

    function commentShowHide() {
      this.posts = $('.post');
      this.buttons = $('.home .comment-view-button');
      this.register();
    }

    commentShowHide.prototype.register = function() {
      this.posts.on('click', '.comment-view-button', function(e) {
        var post;
        if ($('body').hasClass('home')) {
          post = $(e.target).parents('.post');
          post.find('.comment-list-wrapper').slideToggle();
          return post.find('.respond').slideToggle();
        }
      });
      return this.posts.on('click', '.pill-link-overlay', function(e) {
        var post;
        post = $(e.target).parents('.post');
        if (!post.find('.comment-list-wrapper:visible').length) {
          post.find('.comment-list-wrapper').slideToggle();
        }
        if (!post.find('.respond:visible').length) {
          return post.find('.respond').slideToggle();
        }
      });
    };

    return commentShowHide;

  })();
  return $(document).ready(function() {
    new browserClasses();
    new interactionPill();
    new replyLinkBlocker();
    return new commentShowHide();
  });
});


window.require(['jquery'], function($) {
  var parallax;
  parallax = (function() {

    function parallax(positioner) {
      this.scrollTarget = $(window);
      this.positioner = positioner;
      this.positioner();
      this.register();
    }

    parallax.prototype.register = function() {
      var that;
      that = this;
      return this.scrollTarget.on('scroll', function() {
        return that.positioner(that.scrollTarget.scrollTop());
      });
    };

    return parallax;

  })();
  return $(document).ready(function() {
    console.log('ready to parallax');
    if (!$.browser.webkit) {
      return new parallax(function(scroll) {
        return $('body').css('background-position', -.1 * scroll + 'px ' + 0 + 'px');
      });
    }
  });
});
