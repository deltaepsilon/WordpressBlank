window.require ['jquery'], ($) ->

  class parallax
    constructor: (positioner) ->
      @scrollTarget = $(window)


      @positioner = positioner
      @positioner()
      @register()
    register: ->
      that = this
      @scrollTarget.on 'scroll', ->
        that.positioner(that.scrollTarget.scrollTop())





  $(document).ready ->
    if (!$.browser.chrome)
      new parallax (scroll)->
        $('body').css('background-position', -.1 * scroll + 'px ' + 0  + 'px')
#    new parallax (scroll)->
#      $('#left-panel').css('padding-top', .5 * scroll)

