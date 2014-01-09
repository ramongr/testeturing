<?php
  //Este ficheiro pretende inserir na DB a resposta do humano
  include 'config.php';

  $db = new Database();

  //Devolve o id do jogo atual

  $db->query("select max(id_jogo) from jogo");
  
  $arr = $db->single();

  $id_jogo = $arr['max(id_jogo)'];

  //Devolve o id da ultima pergunta efetuada do jogo atual

  $db->query("select max(id_perg) from perguntas where id_jogo=:id_j");
  $db->bind(':id_j',$id_jogo);
  
  $arr = $db->single();

  $id_perg = $arr['max(id_perg)'];

  //Faz as devidas alterações á base de dados

  $db->query('insert into respostas (id_jogo,resp) values (:jogo,:resp)');
  $db->bind(':jogo',$id_jogo);
  $db->bind(':resp',$_POST['resp']);
  $db->execute();

  $db->query('update perguntas set id_resp= :resp where id_perg= :perg');
  $db->bind(':resp',$db->lastInsertId());
  $db->bind(':perg',$id_perg);
  $db->execute();

?>