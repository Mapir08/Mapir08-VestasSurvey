<?php

session_start();

// CONNEXION MYSQL
try{
  $database = new PDO('mysql:host=localhost;dbname='.$_SESSION['bdd'], $_SESSION['nom'], $_SESSION['pass']);
  }
  catch(Exception $e){
    die('ERROR: '.$e->getMessage());
  }

// ACTION AU 'POST' DE L'EXAM
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
}

?>