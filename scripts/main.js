var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

window.require(['jquery', 'transparency'], function($, Transparency) {
  var contactForm, customDropDown, notification, slider;
  Transparency.register($);
  contactForm = (function() {

    function contactForm() {
      this.toggle = __bind(this.toggle, this);
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
      this.contactButtons.on('click', this.toggle);
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
  customDropDown = (function() {

    function customDropDown(target, id, translator) {
      this.target = target;
      this.select = this.target.find('select');
      this.id = id;
      this.translator = translator;
      this.options = this.getOptions();
      this.template = this.insertTemplate();
      this.renderTemplate(this.template);
      new slider('y', this.target.find('.drop-down-slider-bar'), this.target.find('.drop-down-slider'), this.target.find('#' + this.id), this.target.find('.drop-down-list'));
    }

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
      return "<div id=\"" + this.id + "\" class=\"drop-down\">\n  <ul class=\"drop-down-list\">\n    <li class=\"dropDownItem\">\n     <a class=\"dropDownItemLink\"></a>\n    </li>\n  </ul>\n  <div class=\"drop-down-slider\">\n   <div class=\"drop-down-slider-bar\"></div>\n  </div>\n</div>";
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
      this.axis = axis;
      this.slider = $(slider);
      this.sliderBox = sliderBox;
      this.box = $(box);
      this.target = $(target);
      this.build();
      if (this.slider.height() > 0) {
        this.register();
      }
    }

    slider.prototype.build = function() {
      this.targetHeight = this.target.height();
      this.boxHeight = this.box.height();
      this.minOffset = -1 * (this.targetHeight - this.boxHeight);
      this.sliderHeight = this.boxHeight * (this.boxHeight / this.targetHeight);
      this.scrollThreshhold = 75;
      this.scrollRatio = (-1 * this.minOffset) / this.boxHeight;
      if (this.targetHeight > this.boxHeight) {
        return this.slider.height(this.sliderHeight);
      }
    };

    slider.prototype.register = function() {
      var mousemoveHandler, that;
      that = this;
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
        px = -1 * that.scrollRatio * (offset - that.slider.position().top);
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
      console.log(this.slider.position());
      if (this.axis === 'y') {
        sliderOffset = this.slider.position().top;
        mouseOffset = e.offsetY;
      } else {
        sliderOffset = this.slider.position().left;
        mouseOffset = e.offsetX;
      }
      movement = sliderOffset - mouseOffset;
      px = movement * this.scrollRatio;
      console.log('sliderOffset', 'mouseOffset', mouseOffset, 'movement', movement, 'px', px, e);
      return this.scroll(px);
    };

    return slider;

  })();
  return $(document).ready(function() {
    new contactForm('isly-contact');
    new customDropDown($('.widget_categories'), 'category-drop-down', function(value) {
      return '/?cat=' + value;
    });
    return new customDropDown($('.widget_archive'), 'archive-drop-down', function(value) {
      return value;
    });
  });
});
