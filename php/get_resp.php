<?php
  //Este ficheiro devolve a pergunta atual
  include 'config.php';

  //Ficheiro com as respostas do bot
  include 'resp_bot.php';

  $db = new Database;

  //Guarda o id da sala para sabermos a quem foi feita a pergunta e devolver a sua resposta 
  
  $sala = $_POST['sala'];

  //Devolve o id do jogo atual

  $db->query("select max(id_jogo) from jogo");
  
  $arr = $db->single();

  $id_jogo = $arr['max(id_jogo)'];

  //Devolve o id da ultima pergunta efetuada do jogo atual

  $db->query("select max(id_perg) from perguntas where id_jogo=:id_j");
  $db->bind(':id_j',$id_jogo);
  
  $arr = $db->single();

  $id_perg = $arr['max(id_perg)'];

  if($sala == 0)
  {
    $db->query("select resp from respostas r, perguntas p where p.id_perg=:id_p and p.id_jogo=r.id_jogo and r.id_jogo=:id_j");
    $db->bind(':id_j',$id_jogo);
    $db->bind(':id_p',$id_perg);

    $arr = $db->single();

    echo $arr['resp'];
  }
  else
  {
    if($sala == 1)
    {
      //Vamos obter o id da pergunta fixa

      $db->query("select id_fix_perg from fix_perg f, perguntas p where p.id_jogo = :id_j and p.id_perg = :id_p and p.perg = f.fix_perg");
      $db->bind(':id_p',$id_perg);
      $db->bind(':id_j',$id_jogo);

      $arr = $db->single();

      //Chamar a função para obter a resposta do bot

      $resp = getResponse($arr['id_fix_perg']);

      //Faz as devidas alterações á base de dados

      $db->query('insert into respostas (id_jogo,resp_bot) values (:jogo,:resp)');
      $db->bind(':jogo',$id_jogo);
      $db->bind(':resp',$resp);
      $db->execute();

      $db->query('update perguntas set id_resp= :resp where id_perg= :perg');
      $db->bind(':resp',$db->lastInsertId());
      $db->bind(':perg',$id_perg);
      $db->execute();

      echo $resp;
    }
    else
    {
      if($sala == 2)
      {

      }
    }
  }
?>