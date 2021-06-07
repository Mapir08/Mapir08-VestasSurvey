<?php

session_start();

// CONNEXION MYSQL
try{
  $database = new PDO('mysql:host='.$_SESSION['host'].';dbname='.$_SESSION['bdd'], $_SESSION['nom'], $_SESSION['pass']);
  }
  catch(Exception $e){
    die('ERROR: '.$e->getMessage());
  }

  $liste = array();
  $i = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $tempo = $database -> query ('SELECT `candidat`, CONCAT(DAY(`date`),"/",MONTH(`date`),"/",YEAR(`date`)) AS "date", `region` ,`question`,`bonneReponse`,`reponseChoisi`,`img` FROM '.$_SESSION['table']);
  while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
    $liste[$i] = $row;
    $i+=1;
  }

  echo json_encode($liste); 
}

?>