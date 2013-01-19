require ['jquery', 'parallax', 'handlers', 'customDropDown', 'contactForm', 'detection'], ($, parallax, handlers, customDropDown, contactForm, detection) ->
  $(document).ready ->
    if (!$.browser.chrome)
      new parallax (scroll)->
        $('body').css('background-position', -.1 * scroll + 'px ' + 0  + 'px')
#      new parallax (scroll)->
#        $('#left-panel').css('padding-top', .5 * scroll)

    new handlers.browserClasses()
    new handlers.interactionPill()
    new handlers.replyLinkBlocker()
    new handlers.commentShowHide()
    new handlers.floatTop $('#page-wrap')

    new customDropDown '.widget_categories', '.widget_categories h2', 'category-drop-down', (value) ->
      return '/?cat=' + value
    new customDropDown '.widget_archive', '.widget_archive h2', 'archive-drop-down', (value) ->
      return value
#     commentBoxes = $('.comment-list-wrapper')
#      i = commentBoxes.length
#      commentBox = null;
#      Disable Sliders
#      while i--
#        commentBox = $(commentBoxes[i])
#        new slider 'y', commentBox.find('.slider-bar'), commentBox.find('.slider'), commentBox, commentBox.find('.commentlist')

    new contactForm 'isly-contact'
##    Testing
#
#    new notification
#      type: 'success'
#      notifications: [
#        notification: 'this is sad'
#      ,
#        notification: 'this is sadder'
#      ]
    new detection(480, 480, 'http://m.melissaesplin.com');