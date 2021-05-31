<?php

// CONNEXION MYSQL
try{
  $database = new PDO('mysql:host=localhost;dbname=survey','root','root');
  }
  catch(Exception $e){
    die('ERROR: '.$e->getMessage());
  }

// 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  // $presentation = $database -> query('SELECT `candidat`, MIN(`region`) FROM `savestest` GROUP BY `candidat`');
  $liste = $database -> query ('SELECT `candidat`, CONCAT(DAY(`date`),"/",MONTH(`date`),"/",YEAR(`date`)) AS "date",`question`,`bonneReponse`,`reponseChoisi`,`img` FROM `savestest`');
}

?>