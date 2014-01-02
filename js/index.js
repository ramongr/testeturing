$(document).ready(function() {
	$('.snd-step').hide()

	$('#new-game').click(function(){
		$('.fst-step').hide(600)
		$('.snd-step').show(600)
	})	
})