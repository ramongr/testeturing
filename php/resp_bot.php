<?php
  
  function getName($gen)
  {
    if($gen == 0)
    {
      $file = fopen("nm_masc.txt", "r") or exit("Unable to open file!");
    }
    else
    {
      $file = fopen("nm_fem.txt", "r") or exit("Unable to open file!");
    }
    
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
    $no_par = str_replace(array('(', ')'), ' ', $perg);
    $no_vir = str_replace(',', '.', $no_par);
    $no_spaces = preg_replace('/\s+/', '', $no_vir);
    
    $num = null;
    $op = null;
    $aux = null;

    $j = 0;
    $h = 0;

    //Separar o input em 2 array's. Um com os números e outro com os operadores

    for($i = 0; $i < strlen($no_spaces); $i++)
    {
      if($no_spaces[$i] == '+' || $no_spaces[$i] == '-' || $no_spaces[$i] == '*' || $no_spaces[$i] == '/')
      {
        $op[$j] = $no_spaces[$i];

        $j++;
      }
      else
      {
        while($i < strlen($no_spaces) && (is_numeric($no_spaces[$i]) || $no_spaces[$i] == '.'))
        {
          $aux = $aux . $no_spaces[$i];

          $i++;
        }

        $i--;

        $num[$h] = $aux;

        $aux = null;

        $h++;
      }
    }

    //Fazer as contas

    $i = 0;
    $j = 0;

    $res = $num[$j];
    $j++;

    while($i < count($op))
    {
      switch($op[$i])
      {
        case '+': $res = $res + $num[$j]; break;

        case '-': $res = $res - $num[$j]; break;

        case '*': $res = $res * $num[$j]; break;  

        case '/': $res = $res / $num[$j]; break;
      }

      $i++;
      $j++;
    }

    return $res;
  }

  function checkPerg($perg)
  {
    $no_par = str_replace(array('(', ')'), ' ', $perg);
    $no_vir = str_replace(',', '.', $no_par);
    $no_spaces = preg_replace('/\s+/', '', $no_vir);

    $res = 0;
    $flag = 0;

    for($i = 0; $i < strlen($no_spaces) && $flag == 0; $i++)
    {
      if(is_numeric($no_spaces[$i]) == false && $no_spaces[$i] != '.' && $no_spaces[$i] != '+' && $no_spaces[$i] != '-' && $no_spaces[$i] != '*' && $no_spaces[$i] != '/')
      {
        $res = 1;

        $flag = 1;
      } 
    }

    return $res;
  }

  function getResponse($id_perg, $perg, $estudo, $genero)
  {
    $resp_1 = array('1' => "O meu nome é ", '2' => "Chamo-me ", '3' => "");
    $resp_2 = array('1' => "Tenho ", '2' => "");
    $resp_3 = array('1' => "Vivo em ", '2' => "Moro em ", '3' => "Em ", '4' => 'Eu vivo em ', '5' => "Eu moro em ", '6' => '');
    $resp_4 = array('1' => "Castanho", '2' => "Preto", '3' => "Loiro");
    $resp_5 = array('1' => "Estou a estudar", '2' => "Estudo", '3' => "Estou a trabalhar", '4' => "Trabalho", '5' => "Não trabalho nem estudo");
    $resp_6 = array('1' => "", '2' => "Estou no 1º ano de ", '3' => "Estou no 2º ano de ", '4' => "Sou finalista em ");
    $resp_7 = array('1' => "Homem", '2' => "Sou homem", '3' => "Mulher", '4' => "Sou mulher");
    $resp_8 = array('1' => "", '2' => "Isso é muito complicado para mim", '3' => "Dá ");

    $resp_bot = null;
 
    switch($id_perg)
    {
      case 1: $num = rand(1, 3); if($genero == -1) { $gen = rand(0, 1); $nome =  getName($gen); $genero = $gen; } else { if($genero == 0) { $nome = getName(0); } else { $nome = getName(1); }; }; $resp_bot = $resp_1[$num] . $nome; break;

      case 2: $num = rand (1, 2); $idade = rand(16, 60); $resp_bot = $resp_2[$num] . $idade . " anos"; break;

      case 3: $num = rand (1, 6); $cidade = getCidade(); $resp_bot = $resp_3[$num] . $cidade; break;

      case 4: $num = rand(1, 3); $resp_bot = $resp_4[$num]; break;

      case 5: if($estudo == 1) { $num = rand(1, 2); } else { $num = rand(1, 5); }; $resp_bot = $resp_5[$num]; if($num == 1 || $num == 2) { $estudo = 1; } else { $estudo = 0; }; break;

      case 6: if($estudo == 0) { $resp_bot = "Já disse que não estudo"; } else { $num = rand(1, 4); $curso = getCurso(); $resp_bot = $resp_6[$num] . $curso; $estudo = 1; }; break;

      case 7: if($genero == -1) { $num = rand(1, 4); if($num == 1 || $num == 2) { $genero = 0; } else { $genero = 1; }; } else { if($genero == 0) { $num = rand(1, 2); } else { $num = rand(3, 4); }; }; $resp_bot = $resp_7[$num]; break;

      case 8: $aux = checkPerg($perg); $num = rand(1, 3); if($aux == 1) { $resp_bot = $resp_8['2']; } else { if($num == 2) { $resp_bot = $resp_8[$num]; } else { $res = getRes($perg); $resp_bot = $resp_8[$num] . $res; }}; break;
    }

    $arr = array('0' => $resp_bot, '1' => $estudo, '2' => $genero);

    return $arr;
  }
  
?>