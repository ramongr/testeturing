<?php
  include 'config.php';

  $db = new Database;
  
  $db->query('select id_fix_perg, fix_perg from fix_perg');

  $perg_list = $db->resultset();

  $arr = array();

  foreach ($perg_list as $perg) 
  {
    echo "<option value=".$perg['id_fix_perg'].">".$perg['fix_perg']."</option>";
  }
?>