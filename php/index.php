<?php
  
  //Este ficheiro propõe a criar uma nova entrada na BD

  include 'config.php';

  $db = new Database;

  $db->query("insert into jogo (n_resp,ganhou) values (:resp,:win)");
  $db->bind(':resp',NULL);
  $db->bind(':win',NULL);
  $db->execute();

?>