<?php
include "config.php";
include "utils.php";
include "clase.php";
include "db.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = json_encode($_POST);
    /*
    $sql = "INSERT INTO posts
          (title, status, content, user_id)
          VALUES
          (:title, :status, :content, :user_id)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
      $input['id'] = $postId;

   }*/

  $arr=json_decode($input,true);

  $arr['id']=insertarPartida($arr);
  //$arr['preguntas']=obtenerPreguntas($arr['nivel'],$arr['categorias']);
  echo json_encode($arr);
  $user1=new Partida($arr);

  exit();
}
?>