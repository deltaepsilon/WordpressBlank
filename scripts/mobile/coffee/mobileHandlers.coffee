define('mobileHandlers', ['jquery', 'jquery.move', 'jquery.swipe'], ($, move, swipe) ->
  class sidebarHandler
    constructor: ->
      @tab = $('#left-panel-tab')
      @leftPanel = $('#left-panel')
      @body = $('body')
      @register()
    register: ->
      that = this
      @tab.on 'click touchstart mousedown', (e) ->
        e.preventDefault();
        e.stopPropagation();
        that.body.toggleClass 'sidebar-open'
      @leftPanel.on 'click touchstart mousedown', (e) ->
        if $(e.target).attr('id') == 'left-panel'
          that.body.toggleClass 'sidebar-open'
      @body.on 'swipeleft', (e) ->
        that.body.removeClass 'sidebar-open'
      @body.on 'swiperight', (e) ->
        that.body.addClass 'sidebar-open'
      @body.on 'movestart', (e) ->
        if (e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)
          e.preventDefault()


  mobileHandlers =
    sidebarHandler: sidebarHandler
  return mobileHandlers
)
