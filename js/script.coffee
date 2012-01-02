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
        console.log $(this).width() + 2 * ( linksItemsMargin + linksItemsPadding )
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
$(document).ready ->
  console.log "We're ready snitches."
  window.frugal.layout()
  window.frugal.shareButtons()
  console.log window.frugal