<?php

// CONNEXION MYSQL
try{
  $database = new PDO('mysql:host=localhost;dbname=survey','root','root');
  }
  catch(Exception $e){
    die('ERROR: '.$e->getMessage());
  }

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
  // Création de la liste des question en fonction du CODE envoyé
  // syntaxe Code : V..E..H..M..A..S..
  if ($_POST['log_code'] == '' OR strpos($_POST['log_code'],'V')!=0 OR !strpos($_POST['log_code'],'E') OR !strpos($_POST['log_code'],'H') OR !strpos($_POST['log_code'],'M') OR !strpos($_POST['log_code'],'A') OR !strpos($_POST['log_code'],'S')){
    $confirmation['codeSuccess'] = false;
  }else{
    $tempo = explode('V' , $_POST['log_code']);
    $pourRecupV  = explode('E' , $tempo[1]);
    $code['V'] = $pourRecupV[0]; // V est OK
    $pourRecupE = explode('H' , $pourRecupV[1]);
    $code['E'] = $pourRecupE[0]; // E est Ok
    $pourRecupH = explode('M' , $pourRecupE[1]);
    $code['H'] = $pourRecupH[0]; // H est Ok
    $pourRecupM = explode('A' , $pourRecupH[1]);
    $code['M'] = $pourRecupM[0]; // M est Ok
    $pourRecupA = explode('S' , $pourRecupM[1]);
    $code['A'] = $pourRecupA[0]; // A est Ok
    $code['S'] = $pourRecupA[1]; // S est Ok

    if ( ($code['E'] + $code['H'] + $code['M'] + $code['A'] + $code['S']) > 40 ){
      $confirmation['codeSuccess'] = false;
    }else{
      // Ajout des questions E en fonction de leur nombre et en Random
      $tempo = $database->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="E" ORDER BY rand() LIMIT '.$code['E']);
      $i = 0;
      while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
        $questionnaire[$i] = $row;
        $i+=1;
      }
      // Ajout des questions H en fonction de leur nombre et en Random
      $tempo = $database->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="H"  ORDER BY rand() LIMIT '.$code['H']);
      while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
        $questionnaire[$i] = $row;
        $i+=1;
      }
      // Ajout des questions M en fonction de leur nombre et en Random
      $tempo = $database->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="M" ORDER BY rand() LIMIT '.$code['M']);
      while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
        $questionnaire[$i] = $row;
        $i+=1;
      }
      // Ajout des questions A en fonction de leur nombre et en Random
      $tempo = $database->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="A"  ORDER BY rand() LIMIT '.$code['A']);
      while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
        $questionnaire[$i] = $row;
        $i+=1;
      }
      // Ajout des questions S en fonction de leur nombre et en Random
      $tempo = $database->query('SELECT question, img, reponse, choix1, choix2, choix3, choix4 FROM questions WHERE niveau='.$code['V'].' AND typeQ="S"  ORDER BY rand() LIMIT '.$code['S']);
      while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
        $questionnaire[$i] = $row;
        $i+=1;
      }
    }
  }
  // Rechercher le contact dans la BDD en fonction de l'area
  $tempo = $database->query('SELECT region, contact FROM regions');
  while ($row = $tempo->fetch()){
    if ($row['region'] == $_POST['log_area']){
      $confirmation['area'] = $row['contact'];
    }
  }

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