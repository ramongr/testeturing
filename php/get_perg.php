<?php
  //Este ficheiro devolve a pergunta atual
  include 'config.php';

  $db = new Database;

  //Devolve o id do jogo atual

  $db->query("select max(id_jogo) from jogo");
  
  $arr = $db->single();

  $id_jogo = $arr['max(id_jogo)'];

  //Devolve o id da ultima pergunta efetuada do jogo atual

  $db->query("select max(id_perg) from perguntas where id_jogo=:id_j");
  $db->bind(':id_j',$id_jogo);
  
  $arr = $db->single();

  $id_perg = $arr['max(id_perg)'];

  //Devolve a pergunta atual à espera de resposta

  $db->query("select perg from perguntas where id_jogo=:id_j and id_perg=:id_p and id_resp is NULL and sala_a = 1");
  $db->bind(':id_j',$id_jogo);
  $db->bind(':id_p',$id_perg);

  $arr = $db->single();

  $perg = $arr['perg'];


  //Verifica se existem novas perguntas para o humano

  if($perg != NULL)
  {
    echo $perg;
  }
  //Se não existem vamos verificar se o jogo acabou
  else
  {
    $db->query('select ganhou from jogo where id_jogo = :jogo');
    $db->bind(':jogo',$id_jogo);

    $arr = $db->single();

    //Se o jogo não acabou temos que continuar à espera
    if($arr['ganhou'] == NULL)
    {
      echo '0';
    }
    //Se o jogo acabou avisa-se o humano
    else
    {
      echo -1;
    }
  }
?>