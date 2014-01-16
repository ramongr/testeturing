<?php
  //Este ficheiro devolve a pergunta atual
  include 'config.php';

  //Ficheiro com as respostas do bot
  include 'resp_bot.php';

  $db = new Database;

  //Guarda o id da sala para sabermos a quem foi feita a pergunta e devolver a sua resposta 

  $sala = $_POST['sala'];

  //Se a pergunta for para efectuar cálculos, temos de enviar essa pergunta para o ficheiro das respostas do bot

  $perg = $_POST['perg'];

  //Controla umas repostas do bot, para dar alguma inteligência ao programa
  $estudo = $_POST['estudo'];
  $genero = $_POST['genero'];

  //Devolve o id do jogo atual

  $db->query("select max(id_jogo) from jogo");
  
  $arr = $db->single();

  $id_jogo = $arr['max(id_jogo)'];

  //Devolve o id da ultima pergunta efetuada do jogo atual

  $db->query("select max(id_perg) from perguntas where id_jogo=:id_j");
  $db->bind(':id_j',$id_jogo);
  
  $arr = $db->single();

  $id_perg = $arr['max(id_perg)'];

  if($sala == 0)
  {
    $db->query("select resp from respostas r, perguntas p where p.id_perg=:id_p and p.id_jogo=r.id_jogo and p.id_resp=r.id_resp and r.id_jogo=:id_j");
    $db->bind(':id_j',$id_jogo);
    $db->bind(':id_p',$id_perg);

    $arr = $db->single();

    $arr2 = array("my_resp" => $arr['resp']);

    echo json_encode($arr2);
  }
  else
  {
    if($sala == 1)
    {
      if($_POST['perg'])
      {
        //Neste caso a pergunta fixa é "Matemática"

        //Chamar a função para obter a resposta do bot

        $arr = getResponse(8, $perg, $estudo, $genero);

        $resp = $arr['0'];
        $estudo = $arr['1'];
        $genero = $arr['2'];
      }
      else
      {
        //Vamos obter o id da pergunta fixa

        $db->query("select id_fix_perg from fix_perg f, perguntas p where p.id_jogo = :id_j and p.id_perg = :id_p and p.perg = f.fix_perg");
        $db->bind(':id_p',$id_perg);
        $db->bind(':id_j',$id_jogo);

        $arr = $db->single();

        //Chamar a função para obter a resposta do bot

        $arr = getResponse($arr['id_fix_perg'], $perg, $estudo, $genero);

        $resp = $arr['0'];
        $estudo = $arr['1'];
        $genero = $arr['2'];
      }

      //Faz as devidas alterações á base de dados

      $db->query('insert into respostas (id_jogo,resp_bot) values (:jogo,:resp)');
      $db->bind(':jogo',$id_jogo);
      $db->bind(':resp',$resp);
      $db->execute();

      $db->query('update perguntas set id_resp= :resp where id_perg= :perg');
      $db->bind(':resp',$db->lastInsertId());
      $db->bind(':perg',$id_perg);
      $db->execute();

      $arr = array("resp_bot" => $resp, "estudo" => $estudo, "genero" => $genero);

      echo json_encode($arr);
    }
    else
    {
      if($sala == 2)
      {
        //Vamos obter a resposta do humano. Se existir, então vamos buscar a resposta do bot. Desta forma, as 2 repsostas serão apresentadas ao mesmo tempo.

        $db->query("select resp from respostas r, perguntas p where p.id_perg=:id_p and p.id_jogo=r.id_jogo and p.id_resp=r.id_resp and r.id_jogo=:id_j");
        $db->bind(':id_j',$id_jogo);
        $db->bind(':id_p',$id_perg);

        $arr = $db->single();

        $my_resp = $arr['resp'];

        if($my_resp)
        {
          if($_POST['perg'])
          {
            //Neste caso a pergunta fixa é "Matemática"

            //Chamar a função para obter a resposta do bot

            $arr = getResponse(8, $perg, $estudo, $genero);

            $resp = $arr['0'];
            $estudo = $arr['1'];
            $genero = $arr['2'];
          }
          else
          {
            //Vamos obter o id da pergunta fixa

            $db->query("select id_fix_perg from fix_perg f, perguntas p where p.id_jogo = :id_j and p.id_perg = :id_p and p.perg = f.fix_perg");
            $db->bind(':id_p',$id_perg);
            $db->bind(':id_j',$id_jogo);

            $arr = $db->single();

            //Chamar a função para obter a resposta do bot

            $arr = getResponse($arr['id_fix_perg'], $perg, $estudo, $genero);

            $resp = $arr['0'];
            $estudo = $arr['1'];
            $genero = $arr['2'];
          }

          //Faz as devidas alterações á base de dados

          $db->query('insert into respostas (id_jogo,resp_bot) values (:jogo,:resp)');
          $db->bind(':jogo',$id_jogo);
          $db->bind(':resp',$resp);
          $db->execute();

          $db->query('update perguntas set id_resp= :resp where id_perg= :perg');
          $db->bind(':resp',$db->lastInsertId());
          $db->bind(':perg',$id_perg);
          $db->execute();

          //Vamos devolver as 2 respostas

          $arr = array("my_resp" => $my_resp, "resp_bot" => $resp, "estudo" => $estudo, "genero" => $genero);

          echo json_encode($arr);
        }
      }
    }
  }
?>