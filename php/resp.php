<?php
  //Este ficheiro pretende inserir na DB a resposta do humano
  include 'config.php';

  $db = new Database();

  $db->query('insert into respostas (id_jogo,resp) values (:jogo,:resp)');
  $db->bind(':jogo',$_COOKIE['turing']);
  $db->bind(':resp',$_POST['resp']);
  $db->execute();

  $db->query('update perguntas set id_resp= :resp where id_perg= :perg');
  $db->bind(':resp',$db->lastInsertId());
  $db->bind(':perg',$_COOKIE['pergunta']);
  $db->execute();
?>