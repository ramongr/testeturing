<?php

  //Este ficheiro pretende determinar o estado actual do jogo
  include 'config.php';

  $db = new Database();

  $db->query('select id_resp,perg from perguntas where id_perg = :perg');
  $db->bind(':perg',$_POST['perg']);

  $arr = $db->single();

  //Verifica se existem novas perguntas para o humano
  if($arr['id_resp']==NULL){
    echo $arr['perg'];
  }
  //Se não existem vamos verificar se o jogo acabou
  else{
    $db->query('select ganhou from jogo where id_jogo = :jogo');
    $db->bind(':jogo',$_COOKIE['jogo']);

    $arr = $db->single();

    //Se o jogo não acabou temos que continuar à espera
    if($arr['ganhou'] == NULL){
      echo 0;
    }
    //Se o jogo acabou avisa-se o humano
    else{
      echo -1;
    }
  }
?>