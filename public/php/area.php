<?php

session_start();

// CONNEXION MYSQL
try{
  $database = new PDO('mysql:host=localhost;dbname=survey', $_SESSION['nom'], $_SESSION['pass']);
  }
  catch(Exception $e){
    die('ERROR: '.$e->getMessage());
  }

// ACTION AU 'GET' DE L'EXAM
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $tempo = $database->query('SELECT nomRegion, nom FROM regions ORDER BY nomRegion');
  $i=0;
  $retour = array();

  while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
    $retour[$i] = $row;
    $i+=1;
  }

  echo json_encode($retour); 
}
?>