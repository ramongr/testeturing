<?php
  //Este ficheiro pretende inserir na DB a resposta do humano
  include 'config.php';

  $db = new Database();

  $db->query('insert into respostas (id_jogo,resp) values (:jogo,:resp)');
  $db->bind(':jogo',$_COOKIE['turing']);
  $db->bind(':resp',$_POST['resp']);
  $db->execute();

  setcookie('resposta',$db->lastInsertId(),time()+3600*24,"/");
?>