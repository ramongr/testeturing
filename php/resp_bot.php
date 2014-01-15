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

  function getCidade()
  {
    $file = fopen("cidades.txt", "r") or exit("Unable to open file!");
    
    $i = 0;

    while(!feof($file))
    {
      $arr[$i] = fgets($file);
      
      $i++;
    }
    
    fclose($file);

    $num = rand(0, $i-1);

    $cidade = $arr[$num];

    return $cidade;
  }

  function getCurso()
  {
    $file = fopen("cursos.txt", "r") or exit("Unable to open file!");
    
    $i = 0;

    while(!feof($file))
    {
      $arr[$i] = fgets($file);
      
      $i++;
    }
    
    fclose($file);

    $num = rand(0, $i-1);

    $cidade = $arr[$num];

    return $cidade;
  }

  function getRes($perg)
  {
    $no_spaces = preg_replace('/\s+/', '', $perg);

    $num = null;
    $op = null;
    $aux = null;
    $res = null;
    $j = 0;
    $h = 0;

    for($i = 0; $i < strlen($no_spaces); $i++)
    {
      $res = "cheguei";
      if($no_spaces[$i] == '+' || $no_spaces[$i] == '-' || $no_spaces[$i] == '*' || $no_spaces[$i] == '/')
      {
        $op[$j] = $no_spaces[$i];

        $j++;
      }
      else
      {
        while($no_spaces[$i] != '+' && $no_spaces[$i] != '-' && $no_spaces[$i] != '*' && $no_spaces[$i] != '/')
        {
          $aux = $aux . $no_spaces[$i];

          $i++;
        }

        $i--;

        $num[$h] = $aux;

        $h++;
      }
    }

    return $res;
  }

  function getResponse($id_perg, $perg)
  {
    $resp_1 = array('1' => "O meu nome é ", '2' => "Chamo-me ", '3' => "");
    $resp_2 = array('1' => "Tenho ", '2' => "");
    $resp_3 = array('1' => "Vivo em ", '2' => "Moro em ", '3' => "Em ", '4' => 'Eu vivo em ', '5' => "Eu moro em ", '6' => '');
    $resp_4 = array('1' => "Castanho", '2' => "Preto", '3' => "Loiro");
    $resp_5 = array('1' => "Estou a estudar", '2' => "Estudo", '3' => "Estou a trabalhar", '4' => "Trabalho", '5' => "Estou desempregado", '6' => "Não trabalho nem estudo");
    $resp_6 = array('1' => "", '2' => "Estou no 1º ano de ", '3' => "Estou no 2º ano de ", '4' => "Sou finalista em ");
    $resp_7 = array('1' => "Homem", '2' => "Mulher", '3' => "Sou homem", '4' => "Sou mulher");
    $resp_8 = array('1' => "", '2' => "Isso é muito complicado para mim", '3' => "Dá ");

    $resp_bot = null;
    $estudo = -1;
 
    switch($id_perg)
    {
      case 1: $num = rand(1, 3); $nome =  getName(); $resp_bot = $resp_1[$num] . $nome; break;

      case 2: $num = rand (1, 2); $idade = rand(16, 60); $resp_bot = $resp_2[$num] . $idade . " anos"; break;

      case 3: $num = rand (1, 6); $cidade = getCidade(); $resp_bot = $resp_3[$num] . $cidade; break;

      case 4: $num = rand(1, 3); $resp_bot = $resp_4[$num]; break;

      case 5: if($estudo == 1) { $num = rand(1, 2); } else { $num = rand(1, 6); }; $resp_bot = $resp_5[$num]; if($num == 1 || $num == 2) { $estudo = 1; } else { $estudo = 0; }; break;

      case 6: $num = rand(1, 4); $curso = getCurso(); if($estudo == 0) { $resp_bot = "Já te disse que não estudo..."; } else { $resp_bot = $resp_6[$num] . $curso; $estudo = 1; }; break;

      case 7: $num = rand(1, 4); $resp_bot = $resp_7[$num]; break;

      case 8: $num = 1; if($num == 2) { $resp_bot = $resp_8[$num]; } else { $res = getRes($perg); $resp_bot = $resp_8[$num] + $res; }; break;
    }

    return $res;
  }
  
?>