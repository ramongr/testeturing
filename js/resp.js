$(document).ready(function(){
  var perg = $.cookie('pergunta')
  $('#copy-table').hide();
  $('#resp-button').prop('disabled',true)
  $('#resp-text').prop('disabled', true)

  //Verifica a cada 5 segundos por uma pergunta nova
  window.setInterval(function(){ 
    if(perg < $.cookie('pergunta')){
      $.ajax({
        url: './php/src_resp.php',
        type: 'POST',
        data: {perg: perg}
      })
      .done(function(result) {
        console.log(result)
        switch(result){
          case 0:
            $('.perg').text('À espera de outra pergunta')
            break
          case -1:
            $('.perg').text('Fim do jogo!')
            break
          default :
            $('.perg').text(result)
            $('#resp-button').prop('disabled',false)
            $('#resp-text').prop('disabled',false)
        }
    }
  }, 5000);

  })

  $('#rest-text').keyup(function(event) {
    if(event.which == 13){
      $('#resp-button').trigger('click')
    }
  })

  $('#resp-button').click(function(){
    /*Lista de coisas a fazer: TO DO
      1 - Fazer disable ao texto para não deixar responder em branco -> DONE
      2 - Enviar a pergunta por AJAX para a BD
      3 - Manter o event listener a ouvir por uma pergunta
      4 - Esperar nova pergunta
      5 - Registar resposta na tabela
    */
    $('#resp-button').prop('disabled',true)
    $('#resp-text').prop('disabled', true)
    
    $('#copy-table').clone(true).appendTo('.col-md-8')

    $('.perg-header').text($('.perg').text())
    $('.my-resp').text($('#resp-text').val())
    $('#copy-table').show();
    $('.perg').text('À espera de outra pergunta')
  })
})