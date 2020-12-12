<?php
include "config.php";
include "utils.php";
include "clase.php";
include "db.php";

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
      //Mostrar un post

      header("HTTP/1.1 200 OK");
      echo "soy un get con id";
      exit();
	  }
    else {
      //Mostrar lista de post

      header("HTTP/1.1 200 OK");
      echo "soy un get sin id";
      exit();
	}
}

// Crear un nuevo post
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
  var_dump($input);
  $arr=json_decode($input,true);
  var_dump( $arr);
  //$user1= new Partida("2","holis","juan");  //Object with contructor
  $user1=new Partida($arr);
  echo $user1->getUsusarios();
  echo $user1->getCategorias();
  echo $user1->getUsusarios();
  insertarPartida($arr);
  //header("HTTP/1.1 200 OK");
  exit();
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id'];
  $statement = $dbConn->prepare("DELETE FROM posts where id=:id");
  $statement->bindValue(':id', $id);
  $statement->execute();
	header("HTTP/1.1 200 OK");
	exit();
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id'];
    $fields = getParams($input);
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
    
    header("HTTP/1.1 200 OK");
    exit();
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>