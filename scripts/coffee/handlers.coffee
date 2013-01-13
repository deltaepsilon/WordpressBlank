window.require ['jquery', 'js/comment-reply'], ($, commentReply) ->

  class floatTop
    constructor: (element) ->
      @element = $(element)
      @fixed = false;
      @scrollWrapper = $(window)
      @test()
      @register()
    register: ->
      that = this


      @scrollWrapper.on 'scroll resize contactFormClick', ->
        that.test()

      @scrollWrapper.ownerDocument = document
      @scrollWrapper.on 'contactFormClick', ->
        that.element.removeClass('fixed')

    test: ->
      isFixed = @element.hasClass('fixed')
      offsetTop = @element.offset().top - @scrollWrapper.scrollTop()

      if isFixed && offsetTop > 0
        @element.removeClass('fixed')
      else if !isFixed && offsetTop <= 0
        @element.addClass('fixed')

  class browserClasses
    constructor: ->
      browser = $.browser

      body = $('body')
      test = ['opera', 'webkit', 'msie', 'mozilla']
      i = test.length
      while i--
        if browser[test[i]]
          body.addClass test[i]

  class interactionPill
    constructor: ->
      @interactionPills = $('.post-interaction-pill')
      @register()

    register: ->
      @interactionPills.on 'click', '.pill-toggle', (e) ->
        $(e.target).parents('.post-interaction-pill').toggleClass('pill-open')

  class replyLinkBlocker
    constructor: ->
      @commentLists = $('.commentlist')
      @register()

    register: ->
      @commentLists.on 'click', '.comment-reply-link', (e) ->
        e.preventDefault()
        e.stopPropagation()
        target = $(e.target)
        post = target.parents('.post').first()
        postID = post.attr 'data-id'
        commentParent = post.find('#comment_parent')
        comment = target.parents('.comment-body')
        commentIDString = comment.attr('id');
        commentID = commentIDString.match(/\d+/)[0]

        cancel = post.find('#cancel-comment-reply-link')
        respondID = 'respond-' + postID;

        window.addComment.moveForm target.parents('.comment-body').attr('id'), commentID, respondID, postID, post[0], cancel[0], commentParent[0]
        location.hash = comment.attr 'id'
        target.trigger 'rebuildSlider';

#      Disable Sliders
#      @commentLists.on 'click', (e) ->
#        target = $(e.target)
#        if target.attr('id') == 'cancel-comment-reply-link' # Had to do this because jQuery can't filter on IDs, and I have no control over the link that gets read out... or at least I don't want to mess with it.
#          target.trigger 'rebuildSlider';


  class commentShowHide
    constructor: ->
      @posts = $('.post')
      @buttons = $('.home .comment-view-button')
      @register()
    register: ->
      @posts.on 'click', '.comment-view-button', (e) ->
        if $('body').hasClass('home')
          post = $(e.target).parents('.post')
          post.find('.comment-list-wrapper').slideToggle()
          post.find('.respond').slideToggle()
      @posts.on 'click', '.pill-link-overlay', (e) ->
        post = $(e.target).parents('.post')
        if !post.find('.comment-list-wrapper:visible').length
          post.find('.comment-list-wrapper').slideToggle()
        if !post.find('.respond:visible').length
          post.find('.respond').slideToggle()


  $(document).ready ->
    new browserClasses()
    new interactionPill()
    new replyLinkBlocker()
    new commentShowHide()
    new floatTop $('#page-wrap')