define('mobileHandlers', ['jquery'], ($) ->
  class sidebarHandler
    constructor: ->
      @tab = $('#left-panel-tab')
      @body = $('body')
      @register()
    register: ->
      that = this
      @tab.on 'click touchstart', (e) ->
        e.preventDefault();
        console.log('clicked')
        that.body.toggleClass 'sidebar-open'
  mobileHandlers =
    sidebarHandler: sidebarHandler
  return mobileHandlers
)