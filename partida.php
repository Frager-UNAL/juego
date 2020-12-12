<?php
include "config.php";
include "utils.php";
include "clase.php";
include "db.php";


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET))
    {
        $results=buscarPartida($_GET);
        echo json_encode($results);
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    
    $input=json_decode(file_get_contents('php://input'),true);
    $input['id'] = $_GET['id'];
    //$input['user']=PUT('user');
   // $input['data']=PUT('data');


    //var_dump($input);
    $arr=actualizarPartida($input);
  /*
    $sql = "
          UPDATE posts
          SET $fields
          WHERE id='$postId'
           ";

    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    */
    
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //$input = json_encode($_POST);
    $arr=json_decode(file_get_contents('php://input'),true);
    //var_dump($input);
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

  //$arr=json_decode($input,true);

  $arr['_id']=insertarPartida($arr);
  //$arr['preguntas']=obtenerPreguntas($arr['nivel'],$arr['categorias']);
  echo json_encode($arr);
  $user1=new Partida($arr);

  exit();
}
?>