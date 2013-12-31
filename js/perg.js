$(document).ready(function(){
  
  $('#perg-text').keyup(function(event) {
    if(event.which == 13){
      $('#perg-button').trigger('click')
    }
  })

  $('#perg-button').click(function(){
    /*Lista de coisas a fazer: TO DO
      1 - Fazer disable ao texto para não deixar fazer perguntas
      2 - Enviar a pergunta por AJAX para a BD
      3 - Manter o event listener a ouvir por uma resposta
      4 - Calcular resposta do BOT
      5 - Pegar nas duas respostas e gerar tabela
      6 - Ao fim da terceira questão criar botão decidir/terminar e botão continuar
    */
    //$('#perg-text').prop('disabled', 'true')
  })
})