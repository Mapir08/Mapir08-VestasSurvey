<?php

session_start();

$_SESSION['nom'] = $_POST['account-form_log'];
$_SESSION['pass'] = $_POST['account-form_pass'];
$_SESSION['table'] = 'savestest'; // A CHANGER UNE FOIS SUR SERVEUR
$_SESSION['bdd'] = 'survey';      // A CHANGER UNE FOIS SUR SERVEUR

// CONNEXION MYSQL
try{
  $database = new PDO('mysql:host=localhost;dbname='.$_SESSION['bdd'], $_SESSION['nom'], $_SESSION['pass']);
  }
  catch(Exception $e){
    die('ERROR: '.$e->getMessage());
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  }

?>