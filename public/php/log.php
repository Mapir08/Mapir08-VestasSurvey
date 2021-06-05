<?php

session_start();

$_SESSION['nom'] = strtolower($_POST['accountForm_log']);
$_SESSION['pass'] = $_POST['accountForm_pass'];
$_SESSION['table'] = 'savestest';                     // A CHANGER UNE FOIS SUR SERVEUR
switch (strtolower($_POST['accountForm_log'])){       // A CHANGER UNE FOIS SUR SERVEUR
  case 'vestas':
    $_SESSION['bdd'] = 'survey';
    break;
  default:
    $_SESSION['bdd'] = 'survey';
    break;
}

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