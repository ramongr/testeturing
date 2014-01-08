<?php
  //Este ficheiro regista as questões inseridas
  include 'config.php';

  $db = new Database;

  $db->query("insert into perguntas (id_jogo,perg,sala_a,sala_b) values (:jogo,:perg,:sa,:sb)");
  $db->bind(':jogo',$_COOKIE['turing']);
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

  if($_POST['sala'] == 0 || $_POST['sala']==2){
    setcookie('pergunta',$db->lastInsertId(),time()+3600*24,'/');
  }
?>