var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

window.require(['jquery', 'transparency'], function($, Transparency) {
  var contactForm, notification;
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
  return $(document).ready(function() {
    return new contactForm('isly-contact');
  });
});
