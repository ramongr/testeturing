$(document).ready(function() {
  $('.snd-step').hide()

  $('#new-game').click(function(){

    $.ajax({
      url: './php/index.php',
      type: 'POST'
    })
    .done(function(result) {
     
    })
    
    $('.fst-step').hide(600)
    $('.snd-step').show(600)
  })
})