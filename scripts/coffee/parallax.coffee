define('parallax', ['jquery'], ($) ->
  class parallax
    constructor: (positioner) ->
      @scrollTarget = $(window)
      console.log 'ready to parallax'

      @positioner = positioner
      @positioner()
      @register()
    register: ->
      that = this
      @scrollTarget.on 'scroll', ->
        that.positioner(that.scrollTarget.scrollTop())
  return parallax
)


