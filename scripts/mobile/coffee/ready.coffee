require ['jquery', 'contactForm', 'handlers', 'mobileHandlers'], ($, contactForm, handlers, mobileHandlers) ->
  $(document).ready ->
    new contactForm 'isly-contact'
    new handlers.replyLinkBlocker()
    new mobileHandlers.sidebarHandler()