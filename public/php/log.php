<?php

session_start();

$_SESSION['nom'] = strtolower($_POST['accountForm_log']);
$_SESSION['pass'] = $_POST['accountForm_pass'];
$_SESSION['table'] = 'savestest'; // A CHANGER UNE FOIS SUR SERVEUR
$_SESSION['bdd'] = 'survey';      // A CHANGER UNE FOIS SUR SERVEUR
$_SESSION['host'] = 'localhost';

// CONNEXION MYSQL
try{
  $database = new PDO('mysql:host='.$_SESSION['host'].';dbname='.$_SESSION['bdd'], $_SESSION['nom'], $_SESSION['pass']);
  }
  catch(Exception $e){
    die('ERROR: '.$e->getMessage());
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  }

?>