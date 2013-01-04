window.require ['jquery'], ($) ->

  class floatTop
    constructor: (element) ->
      console.log element



  $(document).ready ->
    new floatTop $('#isly-logo-wrapper')
    new floatTop $('#header')