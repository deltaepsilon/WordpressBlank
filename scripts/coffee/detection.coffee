define('detection', ['jquery', 'cookies'], ($, Cookies) ->
  class detection
    constructor: (height, width, subdomain) ->
      if (screen.height <= height || screen.width <= width) && Cookies.get('mobileNotification') != 'notified'
        Cookies.set('mobileNotification', 'notified',
          expires: 2419200 #four weeks expiration
        )
        window.location = location.protocol + '//' + subdomain + location.host + location.pathname
  return detection
)