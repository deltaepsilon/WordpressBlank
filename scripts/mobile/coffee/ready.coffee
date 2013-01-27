require ['jquery', 'contactForm', 'handlers', 'mobileHandlers', 'mobileDetection'], ($, contactForm, handlers, mobileHandlers, mobileDetection) ->
  $(document).ready ->
    new contactForm 'isly-contact'
    new handlers.replyLinkBlocker()
    new mobileHandlers.sidebarHandler()
    new mobileDetection('m.')