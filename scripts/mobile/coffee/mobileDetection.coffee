define('mobileDetection', ['jquery', 'cookies'], ($, Cookies) ->
  class detection
    constructor: (subdomain) ->
      regex = new RegExp(subdomain)
      @newDomain = location.host.replace(regex,'')
      @url = location.protocol + '//' + @newDomain
      if Cookies.get('mobileNotification') != 'notified'
        @prompt()
    prompt: ->
      template = $(@getTemplate())
      $('body').append template
      template.slideToggle().delay(10000).slideToggle()
      Cookies.set('mobileNotification', 'notified',
        expires: 2419200 #one month expiration
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