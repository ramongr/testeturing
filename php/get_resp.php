<?php
  //Este ficheiro devolve a pergunta atual
  include 'config.php';

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

    }
    else
    {
      if($sala == 2)
      {

      }
    }
  }
?>