$(document).ready(function(){

  var n_quest = 0
  
  $('#perg-text').keyup(function(event) {
    if(event.which == 13){
      $('#perg-button').trigger('click')
    }
  })

  $('#perg-button').click(function(){
    /*Lista de coisas a fazer: TO DO
      1 - Fazer disable ao botão perguntar para não deixar fazer perguntas
      2 - Enviar a pergunta por AJAX para a BD
      3 - Manter o event listener a ouvir por uma resposta
      4 - Calcular resposta do BOT
      5 - Pegar na(s) resposta(s) e gerar tabela
      6 - Ao fim da terceira questão criar botão decidir/terminar e botão continuar
    */

    //Verifica se as opções estão todas selecionadas
    if($('.perg-list').val()>-1 && $("input[type='radio']:checked").val() != undefined){
      $('#perg-button').prop('disabled', 'true')

      //Envia os dados assícronamente para a base de dados
      $.ajax({
        url: './php/perg.php',
        type: 'POST',
        data: {perg: $('.perg-list option:selected').text(), sala: $("input[type='radio']:checked").val()}
      })
      .done(function(data){
        console.log(data)
      })   
    }
    
  })

  $.ajax({
    url: './php/perg_list.php',
    type: 'POST',
  })
  .done(function(data) {
    $('.perg-list').append(data)
  })
  
})