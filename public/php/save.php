<?php

session_start();

// CONNEXION MYSQL
try{
  $database = new PDO('mysql:host=localhost;dbname=survey', $_SESSION['nom'], $_SESSION['pass']);
  }
  catch(Exception $e){
    die('ERROR: '.$e->getMessage());
  }

// ACTION AU 'POST' DE L'EXAM
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $database -> query('INSERT INTO `savestest` (`candidat`, `region`, `question`, `img`, `bonneReponse`, `reponseChoisi`) VALUES ("'.$_POST['c'].'", "'.$_POST['a'].'", "'.$_POST['q'].'", "'.$_POST['img'].'", "'.$_POST['br'].'", "'.$_POST['r'].'");');
}
?>