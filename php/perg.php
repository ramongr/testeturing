<?php
  //Este ficheiro regista as questões inseridas
  include 'config.php';

  $db = new Database;

  $db->query("select max(id_jogo) from jogo");
  
  $arr = $db->single();

  $id_jogo = $arr['max(id_jogo)'];

  $db->query("insert into perguntas (id_jogo,perg,sala_a,sala_b) values (:jogo,:perg,:sa,:sb)");
  $db->bind(':jogo',$id_jogo);
  $db->bind(':perg',$_POST['perg']);

  switch($_POST['sala']){
    case '0':
      $db->bind(':sa',1);
      $db->bind(':sb',0);
      break;

    case '1':
      $db->bind(':sa',0);
      $db->bind(':sb',1);
      break;

    default :
      $db->bind(':sa',1);
      $db->bind(':sb',1);
  }

  $db->execute();

?>