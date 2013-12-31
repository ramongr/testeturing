$(document).ready(function(){
  
  $('#rest-text').keyup(function(event) {
    if(event.which == 13){
      $('#resp-button').trigger('click')
    }
  })

  $('#resp-button').click(function(){
    /*Lista de coisas a fazer: TO DO
      1 - Fazer disable ao texto para não deixar responder em branco
      2 - Enviar a pergunta por AJAX para a BD
      3 - Manter o event listener a ouvir por uma pergunta
      4 - Esperar nova pergunta
      5 - Registar resposta na tabela
    */
    //$('#resp-text').prop('disabled', 'true')
  })
})