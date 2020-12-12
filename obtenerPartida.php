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
        $results=buscarPartida($_GET['id'])[0];
        echo json_encode($results);
    }

}