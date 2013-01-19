# This function doesn't act as a regular module. Instead, it adds crap to window, because that's what dirty Wordpress does.
addComment =
  moveForm: (commId, parentId, respondId, postId, post, cancel, parent) ->
    t = this
    div = undefined
    comm = t.I(commId)
    respond = t.I(respondId)
    return  if not comm or not respond or not cancel or not parent
    t.respondId = respondId
    postId = postId or false
    unless t.I("wp-temp-form-div")
      div = document.createElement("div")
      div.id = "wp-temp-form-div"
      div.style.display = "none"
      respond.parentNode.insertBefore div, respond
    comm.parentNode.insertBefore respond, comm.nextSibling
    post.value = postId  if post and postId
    parent.value = parentId
    cancel.style.display = ""
    cancel.onclick = ->
      t = addComment
      temp = t.I("wp-temp-form-div")
      respond = t.I(t.respondId)
      return  if not temp or not respond
      t.I("comment_parent").value = "0"
      temp.parentNode.insertBefore respond, temp
      temp.parentNode.removeChild temp
      @style.display = "none"
      @onclick = null
      false

    try
      t.I("comment").focus()
    false

  I: (e) ->
    document.getElementById e