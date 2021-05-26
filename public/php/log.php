<?php

// LISTING DES QUESTIONS
$Q1 = array(
  'question' => "A quoi correspond le symbole ci-dessous ?",
  'img' => 'pict1',
  'reponse' => 4,
  'choix1' => "Un contacteur",
  'choix2' => "Un disjoncteur",
  'choix3' => "Un fusible",
  'choix4' => "Un transformateur"
);
$Q2 = array(
  'question' => "Quel est le composant sur la photos ?",
  'img' => 'pict2',
  'reponse' => 3,
  'choix1' => "Un contacteur",
  'choix2' => "Un disjoncteur",
  'choix3' => "Un relai thermique",
  'choix4' => "Un transformateur"
);
$Q3 = array(
  'question' => "A quoi correspond le symbole ci-dessous ?",
  'img' => 'pict3',
  'reponse' => 1,
  'choix1' => "Un contacteur",
  'choix2' => "Un disjoncteur",
  'choix3' => "Un fusible",
  'choix4' => "Un transformateur"
);
$Q4 = array(
  'question' => "A quoi correspond le symbole ci-dessous ?",
  'img' => 'pict4',
  'reponse' => 2,
  'choix1' => "Un contacteur",
  'choix2' => "Un disjoncteur magnéto-thermique",
  'choix3' => "Un fusible",
  'choix4' => "Un transformateur"
);
$Q5 = array(
  'question' => "Quel est la différence entre un relais et un contacteur ?",
  'img' => false,
  'reponse' => 2,
  'choix1' => "Le contacteur permet de supporter des courants plus faibles",
  'choix2' => "Le contacteur permet de supporter des courants plus forts"
);
$questionnaire = array(
  'Q1' => $Q1,
  'Q2' => $Q2,
  'Q3' => $Q3,
  'Q4' => $Q4,
  'Q5' => $Q5,
  'codeSuccess' => false,
  'nameSuccess' => false,
  'areaSuccess' => false,
  'candidat' => verif($_POST['log_name']),
  'area' => 'mapir@vestas.com'
);

// ACTION AU 'POST'
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $questionnaire['codeSuccess'] = true;
  $questionnaire['nameSuccess'] = true;
  $questionnaire['areaSuccess'] = true;

  if ($_POST['log_name'] == ''){
    $questionnaire['nameSuccess'] = false;
  }
  if ($_POST['log_area'] == ''){
    $questionnaire['areaSuccess'] = false;
  }
  if ($_POST['log_code'] != 'V1e23h7'){
    $questionnaire['codeSuccess'] = false;
  }

  switch ($_POST['log_area']){
    case 'cha':
      $questionnaire['area'] = 'oligu@vestas.com';
      break;
    case 'rei':
      $questionnaire['area'] = 'hicel@vestas.com';
      break;
  }

  echo json_encode($questionnaire);
}
function verif($var){
  $var=strip_tags($var);
  return $var;
}
?>