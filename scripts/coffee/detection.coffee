define('detection', ['jquery', 'cookies'], ($, Cookies) ->
  class detection
    constructor: (height, width, subdomain) ->
      @url = location.protocol + '//' + subdomain + '.' + location.host
      @newDomain = subdomain + '.' + location.host
      if (screen.height <= height || screen.width <= width) && Cookies.get('mobileNotification') != 'notified'
        @prompt()
    prompt: ->
      template = $(@getTemplate())
      $('body').append template
      template.slideToggle().delay(10000).slideToggle()
      Cookies.set('mobileNotification', 'notified',
        expires: 604800 #one week expiration
      )
    getTemplate: ->
      return """
             <div id="mobile-prompt" class="notification">
              <a href="#{@url}" class="mobile-prompt-message">
                Return to the full site: #{@newDomain}
              </a>
             </div>
             """
  return detection
)