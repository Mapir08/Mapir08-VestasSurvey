<?php

require 'database.php';

// Initialise le tableau de confirmation
$confirmation = array(
  'codeSuccess' => true,
  'nameSuccess' => true,
  'areaSuccess' => true,
  'candidat' => verif($_POST['log_name']),
  'area' => 'vide@vestas.com'
);
$questionnaire = array();

// ACTION AU 'POST' DU LOG
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if ($_POST['log_name'] == ''){
    $confirmation['nameSuccess'] = false;
  }
  if ($_POST['log_area'] == ''){
    $confirmation['areaSuccess'] = false;
  }
  if ($_POST['log_code'] == ''){
    $confirmation['codeSuccess'] = false;
  }else{
    // Création de la liste des question en fonction du CODE envoyé
    switch ($_POST['log_code']){
      case '25J7KM' : // AGENT
        $code['V'] = 1; $code['E'] = 15; $code['H'] = 10; $code['M'] = 5; $code['A'] = 0; $code['S'] = 5;
        break;
      case '8D4KX6' : // TECHNICIEN
        $code['V'] = 1; $code['E'] = 15; $code['H'] = 10; $code['M'] = 5; $code['A'] = 5; $code['S'] = 5;
        break;
      default :
        $code['V'] = 0; $code['E'] = 0; $code['H'] = 0; $code['M'] = 0; $code['A'] = 0; $code['S'] = 0;
        $confirmation['codeSuccess'] = false;
    }
    $db = Database::connect();
    $i = 0;
    $tempo = $db->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="E" ORDER BY rand() LIMIT '.$code['E']);
    while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
      $questionnaire[$i] = $row;
      $i+=1;
    }
    $tempo = $db->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="H"  ORDER BY rand() LIMIT '.$code['H']);
    while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
      $questionnaire[$i] = $row;
      $i+=1;
    }
    $tempo = $db->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="M" ORDER BY rand() LIMIT '.$code['M']);
    while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
      $questionnaire[$i] = $row;
      $i+=1;
    }
    $tempo = $db->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="A"  ORDER BY rand() LIMIT '.$code['A']);
    while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
      $questionnaire[$i] = $row;
      $i+=1;
    }
    $tempo = $db->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="S"  ORDER BY rand() LIMIT '.$code['S']);
    while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
      $questionnaire[$i] = $row;
      $i+=1;
    }
  }
  // Rechercher le contact dans la BDD en fonction de l'area
  $tempo = $db->query('SELECT region, contact FROM regions');
  while ($row = $tempo->fetch()){
    if ($row['region'] == $_POST['log_area']){
      $confirmation['area'] = $row['contact'];
    }
  }
  Database::disconnect();

  // Les 2 tableaux à retourner
  $retour = array(
    'questionnaire' => $questionnaire,
    'confirmation' => $confirmation
  );
  echo json_encode($retour); 
}

function verif($var){
  $var=strip_tags($var);
  return $var;
}

?>