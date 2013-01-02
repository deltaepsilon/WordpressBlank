$ = jQuery


class contactForm
  constructor: (formID) ->
    @form = $('#' + formID)
    @contactButton = $('#menu-header-links').find('[title="contact"]')
    @submitButton = @form.find('button')
    @build()
    @register()
  build: ->
    console.log 'form', @form
  register: ->
    @contactButton.on 'click', (e) =>
      @form.slideToggle()
    @form.on 'submit', (e) ->
      form = $(this)
      $.post form.attr('action'), form.serialize(), (result) ->
        console.log 'here is the result', result
      return false


jQuery(document).ready ->
  new contactForm 'isly-contact'
  console.log 'here we are folks'