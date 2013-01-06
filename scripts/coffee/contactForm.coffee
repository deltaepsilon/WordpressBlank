window.require ['jquery', 'transparency'], ($, Transparency) ->

  Transparency.register $

  class contactForm
    constructor: () ->
      @window = $(window)
      @form = $('#isly-contact')
      @notifications = $('#notifications')
      @contactButton = $('#menu-header-links').find('[title="contact"]')
      @contactButtons = $('.open-contact')
      @submitButton = @form.find('button')
      @register()
    register: ->
      that = this
      @contactButton.on 'click', @toggle

      @form.on 'submit', (e) ->
        form = $(this)
        that.notifications.hide()
        $.post form.attr('action'), form.serialize(), (result) ->
          new notification(JSON.parse result)
        return false
    toggle: (e) =>
      $(document).trigger 'contactFormClick'
      @form.slideToggle()
      @contactButton.toggleClass('selected')

  class notification
    constructor: (result) ->
      @target = $('body')
      @form = $('#isly-contact')
      @template = $('#notifications')
      @notify result.type, result.notifications
    notify: (type, notifications) ->
      directives =
        notification:
          'class': ->
            return type
      @template.render notifications, directives
      @template.slideToggle()
      if type == 'success'
        @form.delay(3000).slideUp()


  $(document).ready ->
    new contactForm 'isly-contact'
#    Testing

#    new notification
#      type: 'success'
#      notifications: [
#        notification: 'this is sad'
#      ,
#        notification: 'this is sadder'
#      ]