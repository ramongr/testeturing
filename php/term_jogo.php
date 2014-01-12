<?php
  
  include 'config.php';

  $db = new Database();

  //Devolve o id do jogo atual

  $db->query("select max(id_jogo) from jogo");
  
  $arr = $db->single();

  $id_jogo = $arr['max(id_jogo)'];


  //Faz as devidas alterações á base de dados

  $db->query('update jogo set ganhou = :ganhou where id_jogo = :id_j');
  $db->bind(':id_j',$id_jogo);
  $db->bind(':ganhou',$_POST['ganhou']);
  $db->execute();

?>