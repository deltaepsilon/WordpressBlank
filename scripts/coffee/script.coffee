window.require ['jquery', 'transparency'], ($, Transparency) ->

  Transparency.register $

  class contactForm
    constructor: () ->
      @form = $('#isly-contact')
      @notifications = $('#notifications')
      @contactButton = $('#menu-header-links').find('[title="contact"]')
      @contactButtons = $('.open-contact')
      @submitButton = @form.find('button')
      @register()
    register: ->
      that = this
      @contactButton.on 'click', @toggle

      @contactButtons.on 'click', @toggle

      @form.on 'submit', (e) ->
        form = $(this)
        that.notifications.hide()
        $.post form.attr('action'), form.serialize(), (result) ->
          new notification(JSON.parse result)
        return false
    toggle: (e) =>
      @form.slideToggle()
      @contactButton.toggleClass('selected')

  class notification
    constructor: (result) ->
      @target = $('body')
      @form = $('#isly-contact')
      @template = $('#notifications')
      @notify result.type, result.notifications
    notify: (type, notifications) ->
      directives =
        notification:
          'class': ->
            return type
      @template.render notifications, directives
      @template.slideToggle()
      if type == 'success'
        @form.delay(3000).slideUp()

  class customDropDown
    constructor: (target, id, translator) ->
      @target = target
      @select = @target.find 'select'
      @id = id
      @translator = translator
      @options = @getOptions()
      @template = @insertTemplate()
      @renderTemplate(@template)
      new slider 'y', @target.find('.drop-down-slider-bar'), @target.find('.drop-down-slider'), @target.find('#' + @id), @target.find('.drop-down-list')

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
               <div class="drop-down-slider">
                <div class="drop-down-slider-bar"></div>
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
      if @slider.height() > 0
        @register()

    build: ->
      @targetHeight = @target.height()
      @boxHeight = @box.height()
      @minOffset = -1 * (@targetHeight - @boxHeight)
      @sliderHeight = @boxHeight * (@boxHeight/@targetHeight)
      @scrollThreshhold = 75
      @scrollRatio = (-1 * @minOffset) / @boxHeight
      if @targetHeight > @boxHeight
        @slider.height(@sliderHeight)

    register: ->
      that = this

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
        px = -1 * that.scrollRatio * (offset - that.slider.position().top)
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
      console.log @slider.position()
      if @axis == 'y'
        sliderOffset = @slider.position().top
        mouseOffset = e.offsetY
      else
        sliderOffset = @slider.position().left
        mouseOffset = e.offsetX

      movement = sliderOffset - mouseOffset

      px = movement * @scrollRatio

      console.log 'sliderOffset', 'mouseOffset', mouseOffset, 'movement', movement, 'px', px, e
      @scroll px



  $(document).ready ->
    new contactForm 'isly-contact'
    new customDropDown $('.widget_categories'), 'category-drop-down', (value) ->
      return '/?cat=' + value
    new customDropDown $('.widget_archive'), 'archive-drop-down', (value) ->
      return value

#    Testing

#    new notification
#      type: 'success'
#      notifications: [
#        notification: 'this is sad'
#      ,
#        notification: 'this is sadder'
#      ]