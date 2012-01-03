window.frugal =
  linksWidth: 0
  linksItemsWidth: 0
  # linksPadding: 0
  # pageWidth: 0
  # pagePadding: 0
  layout: ->    
    navLinks = $('#frugal-nav')
    ul = navLinks.children('ul')
    navLinksItems = $('#frugal-nav li')
    pageWrap = $('#page-wrap')
    window.frugal.linksWidth = navLinks.width()
    try
      linksItemsMargin = parseInt($('#frugal-nav li').css('margin-left'))
      linksItemsPadding = parseInt($('#frugal-nav li').css('padding-left'))
      navLinksItems.each ->
        window.frugal.linksItemsWidth += $(this).width() + 2 * ( linksItemsMargin + linksItemsPadding )
    finally
      ul.css 'margin-left', ( window.frugal.linksWidth - window.frugal.linksItemsWidth ) / 2
  shareButtons: ->
    iframes = $('iframe')
    facebook = $('.facebook_like')
    twitter = $('.twitter_tweet')
    iframes.css 'padding', 0
    twitter.css 
      marginTop: -2
    facebook.css 
      width: 80
  contactLink: ->
    link = $('.contact-link')
    form = $('#contact-form')
    wrapper = $('#post-wrapper')
    wrapper.addClass 'closed'
    $('#form-message textarea').attr 'cols', 125
    link.click (e) ->
      height = form.height() + (2 * parseInt(form.css('padding-top'))) + 47
      e.preventDefault()
      if $('.open').length >= 1
        return
      link.addClass 'closer'
      wrapper.addClass 'open'
      wrapper.animate
        marginTop: '+=' + height
      ,->
        form.css 'z-index', 1
        $('.closer').one 'click', ->
          $('.closer').removeClass 'closer'
          if $('.open').length < 1
            return
          wrapper.animate
            marginTop: 0
          form.css 'z-index', -1
          wrapper.removeClass('open').addClass('closed')
    clickCloser = ->
        $('.closer').trigger 'click'
    $('#form-close').click ->
      setTimeout clickCloser, 200
    $('#form-submit input').click ->
      if $('.wpcf7-mail-sent-ok').length >= 1
        setTimeout clickCloser, 2000
$(document).ready ->
  window.frugal.layout()
  window.frugal.shareButtons()
  window.frugal.contactLink()