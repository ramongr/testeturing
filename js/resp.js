$(document).ready(function(){
  
  $('#copy-table').hide();

  $('#resp-button').prop('disabled',true);
  $('#resp-text').prop('disabled', true);

  var n_resp = 1;

  //Verifica a cada 5 segundos por uma pergunta nova
  window.setInterval(function(){

    $.ajax({
      url: './php/get_perg.php',
      type: 'POST'
    })
    .done(function(result) {

      if(result)
      {
          switch(result)
          {
            case '0':
              $('.perg').text('Por favor aguarde');
              break
            case '1':
              $('.perg').text('Fim do jogo!');
              var Parent = document.getElementById('copy-table');
              while(Parent.hasChildNodes())
              {
                 Parent.removeChild(Parent.firstChild);
              }
              n_resp = 1;
              break
            default :
              $('.perg').text(result);
              $('#resp-button').prop('disabled',false);
              $('#resp-text').prop('disabled',false);
          }
      }
      
    })
  }, 5000)


  $('#resp-button').click(function(){

    $('#resp-button').prop('disabled',true);
    $('#resp-text').prop('disabled', true);

    $('table#copy-table').append("<tr><th class='perg-header'>" + n_resp + ". " + $('.perg').text() + "</th></tr>");
    $('table#copy-table').append("<tr><td class='my-resp'>" + $('#resp-text').val() + "</td></tr>");

    n_resp++;

    $('#copy-table').show();

    $('.perg').text('À espera de outra pergunta');

    $.ajax({
      url: './php/resp.php',
      type: 'POST',
      data: {resp: $('#resp-text').val()}
    })
    .done(function(result) {

      $("#resp-text").val('');
      
    })
    
  })
})