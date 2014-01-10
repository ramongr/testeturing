<?php
  
  function getName()
  {
    $file = fopen("nomes.txt", "r") or exit("Unable to open file!");
    
    $i = 0;

    while(!feof($file))
    {
      $arr[$i] = fgets($file);
      
      $i++;
    }
    
    fclose($file);

    $num = rand(0, $i-1);

    $name = $arr[$num];

    return $name;
  }

  function getResponse($id_perg)
  {
    $resp_1 = array('1' => "O meu nome é ", '2' => "Chamo-me ", '3' => "");
    $resp_2 = array('1' => "Tenho ", '2' => "");

    $resp_bot = null;
    
    switch($id_perg)
    {
      case 1: $num = rand(1, 3); $nome =  getName(); $resp_bot = $resp_1[$num] . $nome; break;

      case 2: $num = rand (1, 2); $idade = rand(16, 60); $resp_bot = $resp_2[$num] . $idade . " anos"; break;
    }

    return $resp_bot;
  }
  
?>