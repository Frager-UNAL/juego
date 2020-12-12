<?php


function insertarPartida($document){
		  //Mostrar lista de post

		  try {
			$document['puntuaciones']=array();
			$client = new MongoDB\Driver\Manager('mongodb+srv://admin:colombia@cluster0.6nunx.mongodb.net');
			$bulk = new MongoDB\Driver\BulkWrite;
			$_id1 = $bulk->insert($document);
			$result = $client->executeBulkWrite('partidas.Partidas', $bulk);

		  } catch (MongoDB\Driver\Exception\AuthenticationException $e) {
		  
			  echo "Exception:", $e->getMessage(), "\n";
		  } catch (MongoDB\Driver\Exception\ConnectionException $e) {
		  
			  echo "Exception:", $e->getMessage(), "\n";
		  } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
		  
			  echo "Exception:", $e->getMessage(), "\n";
		  }

		  return $_id1;
		}
function actualizarPartida($input){
	$user=$input['user'];$data=$input['data'];
	$id['id'] = new \MongoDB\BSON\ObjectId($input['id']);
	$client = new MongoDB\Driver\Manager('mongodb+srv://admin:colombia@cluster0.6nunx.mongodb.net');
	$rows= buscarPartida($id);
	$final=$rows['0'];
	$old=$final->puntuaciones;
	try{
		if(!in_array($user,$final['usuarios'])){
			array_push($final['usuarios'],$user);}
	}
	catch(Error $e){
		if(!in_array($user,$final->usuarios)){
			array_push($final->usuarios,$user);
		}
	}
	try{
	$old[$user]=$data;
	}
	catch(Error $e){
		$old->$user=$data;
	}
	$final->puntuaciones=$old;
	//var_dump($final);
	echo json_encode($final);
	
	$bulk = new MongoDB\Driver\BulkWrite;
	$bulk->update(['_id' => $id['id']],$final);
	$result = $client->executeBulkWrite('partidas.Partidas', $bulk);
}
function buscarPartida($input){
	
	$client = new MongoDB\Driver\Manager('mongodb+srv://admin:colombia@cluster0.6nunx.mongodb.net');
	$filter=[];
	//var_dump($input);
	if(isset($input['id']) and $input['id']!='' and $input['id']!='""'){
	$idf= new \MongoDB\BSON\ObjectId($input['id']);
	$filter['_id'] = $idf;
	}
	if(isset($input['nivel']) and $input['nivel']!="-1"){
		$filter['nivel']=intval($input['nivel']);
	}
	if(isset($input['categorias']) and $input['categorias']!='' and $input['categorias']!='""'){
		$filter['categorias']=explode(",",$input['categorias']);
		//json_encode($input['categorias']);

	}
	if(isset($input['usuarios']) and $input['usuarios']!='' and $input['usuarios']!='""'){
		$filter['usuarios']=explode(",",$input['usuarios']);
	}
	//var_dump($filter);
	$options = [];
	$query = new \MongoDB\Driver\Query($filter, $options);
	$cursor   = $client->executeQuery('partidas.Partidas', $query);
	return $cursor->toArray();

}
function buscarPartidas(){
	$client = new MongoDB\Driver\Manager('mongodb+srv://admin:colombia@cluster0.6nunx.mongodb.net');
	$filter = [];
	$options = [];

	$query = new \MongoDB\Driver\Query($filter, $options);
	$rows   = $client->executeQuery('partidas.Partidas', $query);
	return $rows;
}

function obtenerPreguntas($nivel,$categorias){
	$enlace = mysqli_connect("sarchmysqlinstance.cjuj36p5w1gf.us-east-1.rds.amazonaws.com", "SArchMaster", "S4rch3a5te++", "frager_db");
	if (!$enlace) {
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	if ($resultado=mysqli_query($enlace,"SELECT * FROM TABLES ")) {
		var_dump($resultado);
		mysqli_free_result($resultado);
	}
	
	mysqli_close($enlace);	
}
function obtenerUsuario($id) {
	$enlace = mysqli_connect("sarchmysqlinstance.cjuj36p5w1gf.us-east-1.rds.amazonaws.com", "SArchMaster", "S4rch3a5te++", "frager_db");
	if (!$enlace) {
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	
	if ($resultado=mysqli_query($enlace,"SELECT * FROM TABLES ")) {
		var_dump($resultado);
		mysqli_free_result($resultado);
	}
	
	mysqli_close($enlace);
}

?>
