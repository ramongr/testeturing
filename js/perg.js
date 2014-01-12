$(document).ready(function(){

  $('#my-resp-table').hide();
  $('#resp-bot-table').hide();

  $('#termina-jogo').hide();

  $('#resultado').hide();

  //Controla o nº de perguntas feitas às duas salas simultaneamente
  var n_perg = 0;

  //CControla o nº de perguntas feitas à sala A
  var a_perg = 0;

  //Controla o nº de perguntas feitas à sala B
  var b_perg = 0;

  var troca = 0;

  var flag = 0;


  //Logo no inicio, usando um random, determinamos em que sala fica o humano e o bot. Se sair 0, humano -> sala A e bot -> sala B. Se sair 1, humano -> sala B e bot -> sala A

  if(flag == 0)
  {
    var num = Math.floor(Math.random() * 2);

    if(num == 1)
    {
      //Troca os id's das tabelas de respostas

      document.getElementsByTagName("table")[0].setAttribute("id","resp-bot-table");

      document.getElementsByTagName("table")[1].setAttribute("id","my-resp-table");

      //Troca os valores dos radio buttons

      $("input[id='0']").val(1);

      $("input[id='1']").val(0);

      //Nesta variável indicamos que houve uma troca de salas

      troca = 1;
    }

    console.log("Troca: " + troca);
    flag = 1;  
  }


  $('#perg-button').click(function(){

    //Verifica se existe uma pergunta seleccionada e se a pergunta foi feita para a Sala A
    console.log($("input[name='sala']:checked").val());
    if($('.perg-list').val()>-1 && $("input[name='sala']:checked").val() == 0)
    {
      $('#perg-button').prop('disabled', true)
      $('.perg-list').prop('disabled', true)

      //Envia os dados assícronamente para a base de dados
      $.ajax({
        url: './php/perg.php',
        type: 'POST',
        data: {perg: $('.perg-list option:selected').text(), sala: $('input[name="sala"]:checked').val()},
      })
      .done(function(data){
        
        //Verifica a cada 5 segundos por uma resposta nova

        var interval = window.setInterval(function(){

          $.ajax({
            url: './php/get_resp.php',
            type: 'POST',
            dataType:"json",
            data: {sala: $('input[name="sala"]:checked').val()},
          })
          .done(function(result) {

            if(result.my_resp)
            {
              $('table#my-resp-table').append("<tr><th class='perg-header'>"+$('.perg-list option:selected').text()+"</th></tr>");
              $('table#my-resp-table').append("<tr><td class='my-resp'>"+result.my_resp+"</td></tr>");
              
              $('#my-resp-table').show();

              $('#perg-button').prop('disabled', false);
              $('.perg-list').prop('disabled', false);

              a_perg ++;

              clearInterval(interval);
            }
          })
        }, 5000)   
      })
    }

    //Verifica se existe uma pergunta seleccionada e se a pergunta foi feita para a Sala B

    if($('.perg-list').val()>-1 && $("input[name='sala']:checked").val() == 1)
    {
      $('#perg-button').prop('disabled', true)
      $('.perg-list').prop('disabled', true)

      //Envia os dados assícronamente para a base de dados
      $.ajax({
        url: './php/perg.php',
        type: 'POST',
        data: {perg: $('.perg-list option:selected').text(), sala: $('input[name="sala"]:checked').val()},
      })
      .done(function(data){
        
        //Verifica a cada 5 segundos por uma resposta nova

        var interval = window.setInterval(function(){

          $.ajax({
            url: './php/get_resp.php',
            type: 'POST',
            dataType:"json",
            data: {sala: $('input[name="sala"]:checked').val()},
          })
          .done(function(result) {

            if(result.resp_bot)
            {
              $('table#resp-bot-table').append("<tr><th class='perg-header'>"+$('.perg-list option:selected').text()+"</th></tr>");
              $('table#resp-bot-table').append("<tr><td class='bot-resp'>"+result.resp_bot+"</td></tr>");
              
              $('#resp-bot-table').show();

              $('#perg-button').prop('disabled', false);
              $('.perg-list').prop('disabled', false);

              b_perg ++;

              clearInterval(interval);
            }
          })
        }, 5000)   
      })
    }

    //Verifica se existe uma pergunta seleccionada e se a pergunta foi feita para as duas Salas

    if($('.perg-list').val()>-1 && $("input[name='sala']:checked").val() == 2)
    {
      $('#perg-button').prop('disabled', true)
      $('.perg-list').prop('disabled', true)

      //Envia os dados assícronamente para a base de dados
      $.ajax({
        url: './php/perg.php',
        type: 'POST',
        data: {perg: $('.perg-list option:selected').text(), sala: $('input[name="sala"]:checked').val()},
      })
      .done(function(data){
        
        //Verifica a cada 5 segundos por uma resposta nova

        var interval = window.setInterval(function(){

          $.ajax({
            url: './php/get_resp.php',
            type: 'POST',
            dataType:"json",
            data: {sala: $('input[name="sala"]:checked').val()},
          })
          .done(function(result) {

            if(result.resp_bot && result.my_resp)
            {
              $('table#my-resp-table').append("<tr><th class='perg-header'>"+$('.perg-list option:selected').text()+"</th></tr>");
              $('table#my-resp-table').append("<tr><td class='my-resp'>"+result.my_resp+"</td></tr>");
              
              $('#my-resp-table').show();


              $('table#resp-bot-table').append("<tr><th class='perg-header'>"+$('.perg-list option:selected').text()+"</th></tr>");
              $('table#resp-bot-table').append("<tr><td class='bot-resp'>"+result.resp_bot+"</td></tr>");
            
              $('#resp-bot-table').show();

              $('#perg-button').prop('disabled', false);
              $('.perg-list').prop('disabled', false);

              n_perg ++;

              clearInterval(interval);
            }
          })
        }, 5000)   
      })
    }
  })


  //Quando um jogo termina, vamos guardar na base de dados o nº de perguntas feitas e se o utilizador ganhou ou perdeu
  function termina_jogo(ganhou) 
  {
    $.ajax({
      url: './php/term_jogo.php',
      type: 'POST',
      data: {ganhou: ganhou},
    })
    .done(function(result) {

    })
  }


  //Se já tiverem sido efectuadas 3 questões, o jogo acaba e o utilizador tem de escolher qual o computador e qual o humano

  var interval = window.setInterval(function(){

    var ganhou;

    //Se já tiverem sido efectuadas 3 questões às duas salas simultaneamente, o jogo acaba e o utilizador tem de escolher qual o computador e qual o humano
    if(n_perg == 3 || (a_perg == 3 && b_perg == 3))
    {
      $('#perg-button').prop('disabled', true);
      $('.perg-list').prop('disabled', true);

      $('#perguntas').hide();
      $('#titulo').hide();

      $('#termina-jogo').show();

      $('#salaA').on("click", function(result) {

        if(troca == 0)
        {
          $('#resultado').addClass("text-success");
          $('#resultado').text("Ganhou!");

          ganhou = 1;
        }
        else
        {
          $('#resultado').addClass("text-danger");
          $('#resultado').text("Perdeu!");

          ganhou = 0;
        }
        
        termina_jogo(ganhou);

        $('#resultado').show();

        $('#salaA').prop('disabled', true);
        $('#salaB').prop('disabled', true);

      });

      $('#salaB').on("click", function(result) {

        if(troca == 0)
        {
          $('#resultado').addClass("text-danger");
          $('#resultado').text("Perdeu!");

          ganhou = 0;
        }
        else
        {
          $('#resultado').addClass("text-success");
          $('#resultado').text("Ganhou!");

          ganhou = 1;
        }
        
        termina_jogo(ganhou);
        
        $('#resultado').show();

        $('#salaA').prop('disabled', true);
        $('#salaB').prop('disabled', true);

      });

      clearInterval(interval);
    }

    //Se já tiverem sido efectuadas 3 questões à sala A, utilizador agora só pode fazer perguntas à sala B
    if(a_perg == 3)
    {
      if(troca == 0)
      {
        $('#0').prop('disabled', true);
      }
      else
      {
        $('#1').prop('disabled', true);
      }

      $('#2').prop('disabled', true);
    }

    //Se já tiverem sido efectuadas 3 questões à sala B, utilizador agora só pode fazer perguntas à sala A
    if(b_perg == 3)
    {
      if(troca == 0)
      {
        $('#1').prop('disabled', true);
      }
      else
      {
        $('#0').prop('disabled', true);
      }
      
      $('#2').prop('disabled', true);
    }

  }, 500);
  

  //Pesquisa na table "fixed questions", e devolve todas as perguntas existentes

  $.ajax({
    url: './php/perg_list.php',
    type: 'POST',
  })
  .done(function(data) {
    $('.perg-list').append(data)
  })

})