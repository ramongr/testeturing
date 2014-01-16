<?php
  //Este ficheiro propõe a criar uma nova entrada na BD

  /*
  Versão 1:
    -Blind insert (insere mesmo havendo jogos sem perguntas na BD)
  Versão 2:
    - Smart insert verifica antes de inserir uma nova entrada vazia
  */
  include 'config.php';

  $db = new Database;

  $db->query("insert into jogo (n_resp,ganhou) values (:resp,:win)");
  $db->bind(':resp',NULL);
  $db->bind(':win',NULL);
  $db->execute();

?>