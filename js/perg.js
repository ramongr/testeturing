$(document).ready(function(){

  $('#perg-button').click(function(){
    /*Lista de coisas a fazer: TO DO
      1 - Fazer disable ao botão perguntar para não deixar fazer perguntas
      2 - Enviar a pergunta por AJAX para a BD
      3 - Manter o event listener a ouvir por uma resposta
      4 - Calcular resposta do BOT
      5 - Pegar na(s) resposta(s) e gerar tabela
      6 - Ao fim da terceira questão criar botão decidir/terminar e botão continuar
    */

    //Verifica se existe uma pergunta seleccionada e se a pergunta foi feita para a Sala A

    if($('.perg-list').val()>-1 && $("input[name='sala']:checked").val() == 0)
    {
      $('#perg-button').prop('disabled', true)
      $('.perg-list').prop('disabled', true)

      //Envia os dados assícronamente para a base de dados
      $.ajax({
        url: './php/perg.php',
        type: 'POST',
        data: {perg: $('.perg-list option:selected').text(), sala: $('input[name="sala"]:checked').val()}
      })
      .done(function(data){
        
        //Verifica a cada 5 segundos por uma resposta nova

        var interval = window.setInterval(function(){

          $.ajax({
            url: './php/get_resp.php',
            type: 'POST',
            dataType:"json",
            data: {sala: $('input[name="sala"]:checked').val()}
          })
          .done(function(result) {

            if(result.my_resp)
            {
              $('table#copy-table').append("<tr><th class='text-center perg-header'>"+$('.perg-list option:selected').text()+"</th></tr>");
              $('table#copy-table').append("<tr><td>"+result.my_resp+"</td></tr>");
              //$('.perg-header').text($('.perg-list option:selected').text());
              //$('.my-resp').text(result.my_resp);
              $('#perg-button').prop('disabled', false);
              $('.perg-list').prop('disabled', false);

              clearInterval(interval);
            }
          })
        })   
      })
    }

    //Verifica se existe uma pergunta seleccionada e se a pergunta foi feita para a Sala B

    if($('.perg-list').val()>-1 && $("input[name='sala']:checked").val() == 1)
    {
      $('#perg-button').prop('disabled', true)
      $('.perg-list').prop('disabled', true)

      //Envia os dados assícronamente para a base de dados
      
    }
  })

  //Pesquisa na table "fixed questions", e devolve todas as perguntas existentes

  $.ajax({
    url: './php/perg_list.php',
    type: 'POST',
  })
  .done(function(data) {
    $('.perg-list').append(data)
  })


  //Verifica a cada 5 segundos por uma resposta nova

  /*var interval = window.setInterval(function(){

    $.ajax({
      url: './php/get_resp.php',
      type: 'POST',
      dataType:"json",
      data: {sala: $('input[name="sala"]:checked').val()}
    })
    .done(function(result) {

      if(result)
      {
        if($('input[name="sala"]:checked').val() == 0)
        {
          document.getElementById('my-resp-perg').innerHTML = $('.perg-list option:selected').text().bold();
          $('.my-resp').text(result.my_resp);
          $('#perg-button').prop('disabled', false);
          $('.perg-list').prop('disabled', false);
        }

        if($('input[name="sala"]:checked').val() == 1)
        {
          document.getElementById('bot-resp-perg').innerHTML = $('.perg-list option:selected').text().bold();
          $('.bot-resp').text(result.resp_bot);
          $('#perg-button').prop('disabled', false);
          $('.perg-list').prop('disabled', false);
        }

        if($('input[name="sala"]:checked').val() == 2)
        {
          console.log("My: " + result.my_resp);
          console.log("Bot: " + result.resp_bot);
          document.getElementById('my-resp-perg').innerHTML = $('.perg-list option:selected').text().bold();
          document.getElementById('bot-resp-perg').innerHTML = $('.perg-list option:selected').text().bold();
          $('.my-resp').text(result.my_resp);
          $('.bot-resp').text(result.resp_bot);
          $('#perg-button').prop('disabled', false);
          $('.perg-list').prop('disabled', false);
        }

        clearInterval(interval);
      }
    })
  }, 5000)*/
  
  
})