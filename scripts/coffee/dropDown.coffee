window.require ['jquery', 'transparency'], ($, Transparency) ->

  Transparency.register $

  class customDropDown
    constructor: (target, toggle, id, translator) ->
      @target = $(target)
      @toggle = $(toggle)
      @select = @target.find 'select'
      @id = id
      @translator = translator
      @options = @getOptions()

      @instantiated = false
      @register()


    register: ->
      that = this

      @toggle.on 'click', =>
        @target.toggleClass('open')
        if !@instantiated
          @instantiated = true
          @template = @insertTemplate()
          @renderTemplate(@template)
#         Disable Sliders
#          new slider 'y', @target.find('.drop-down-slider-bar'), @target.find('.drop-down-slider'), @target.find('#' + @id), @target.find('.drop-down-list')

    getOptions: ->
      options = @select.find 'option'
      i = options.length
      option = null
      value = null
      result = []
      while i--
        option = $(options[i])
        value = option.attr 'value'
        if value.length && value != '-1'
          result.unshift
            'dropDownItem':
              'dropDownItemLink':
                link: @translator(option.attr 'value')
                linkText: option.text()
      return result

    insertTemplate: ->
      template = @getTemplate()
      @target.append template
      return @target.find('.drop-down-list')

    getTemplate: ->
      return """
             <div id="#{@id}" class="drop-down">
             <ul class="drop-down-list">
             <li class="dropDownItem">
             <a class="dropDownItemLink"></a>
             </li>
             </ul>
             <div class="drop-down-slider slider">
             <div class="drop-down-slider-bar slider-bar"></div>
             </div>
             </div>
             """

    renderTemplate: (template) ->
      directive =
        'dropDownItemLink':
          href: ->
            return this.dropDownItem.dropDownItemLink.link
          text: ->
            return this.dropDownItem.dropDownItemLink.linkText
      template.render @options, directive

  class slider
    constructor: (axis = "y", slider, sliderBox, box, target) ->
      @axis = axis
      @slider = $(slider)
      @sliderBox = sliderBox
      @box = $(box)
      @target = $(target)
      @build()
      @register()
#      if @slider.height() > 0
#        @register()

    build: ->
      @targetHeight = @target.height()
      @boxHeight = @box.height()
      @minOffset = -1 * (@targetHeight - @boxHeight)
      @sliderHeight = @boxHeight * (@boxHeight/@targetHeight)
      @scrollThreshhold = 100
      @scrollRatio = (-1 * @minOffset) / (@boxHeight - @sliderHeight)
      if @targetHeight > @boxHeight
        @slider.height(@sliderHeight)

    register: ->
      that = this

      @box.on 'rebuildSlider', ->
        that.build()

      @box.on 'mousewheel', (e) ->
        e.preventDefault()
        if that.axis == 'y'
          delta = e.originalEvent.wheelDeltaY
        else if that.axis == 'x'
          delta = e.originalEvent.wheelDeltaX
        that.scroll delta

      mousemoveHandler = (e) ->
        that.mouseHandler(e)
      @slider.on 'mousedown', (e) ->
        that.target.addClass 'sliding'
        that.sliderBox.on 'mousemove', mousemoveHandler
        return false

      @box.on 'mouseup mouseleave', ->
        that.target.removeClass 'sliding'
        that.sliderBox.off 'mousemove', mousemoveHandler

      @sliderBox.on 'click', (e) ->
        if that.axis == 'y'
          sliderOffset = that.slider.position().top
          offset = e.pageY - that.sliderBox.offset().top
        else
          sliderOffset = that.slider.position().left
          offset = e.pageX - that.sliderBox.offset().left
        px = -1 * that.scrollRatio * (offset - sliderOffset)
        that.scroll(px, true)

    scroll: (px, skipThreshhold = false) ->
      if @axis == 'y'
        style = 'top'
      else
        style = 'left'

      if !skipThreshhold && Math.abs(px) > @scrollThreshhold
        px = @scrollThreshhold
        if px > 0
          px = -1 * @scrollThreshhold

      offset = Math.max(@minOffset, Math.min(0, @target.position().top + px))

      if offset > @minOffset
        percentage = offset / @minOffset
        sliderOffset = Math.min(@boxHeight - @sliderHeight, percentage * @boxHeight)

        @target.css(style, offset)
        @slider.css(style, sliderOffset)


    mouseHandler: (e) ->
      if @axis == 'y'
        sliderOffset = @slider.position().top
        mouseOffset = e.pageY - @sliderBox.offset().top
      else
        sliderOffset = @slider.position().left
        mouseOffset = e.pageX - @sliderBox.offset().left

      movement = sliderOffset - mouseOffset

      px = movement * @scrollRatio

      @scroll px


  $(document).ready ->
    new customDropDown '.widget_categories', '.widget_categories h2', 'category-drop-down', (value) ->
      return '/?cat=' + value
    new customDropDown '.widget_archive', '.widget_archive h2', 'archive-drop-down', (value) ->
      return value

    commentBoxes = $('.comment-list-wrapper')
    i = commentBoxes.length
    commentBox = null;
#    Disable Sliders
#    while i--
#      commentBox = $(commentBoxes[i])
#      new slider 'y', commentBox.find('.slider-bar'), commentBox.find('.slider'), commentBox, commentBox.find('.commentlist')