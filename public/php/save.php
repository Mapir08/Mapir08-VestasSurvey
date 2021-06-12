<?php

require 'database.php';
$db = Database::connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $db -> query('INSERT INTO saves (`candidat`, `region`, `question`, `img`, `bonneReponse`, `reponseChoisi`) VALUES ("'.$_POST['c'].'", "'.$_POST['a'].'", "'.$_POST['q'].'", "'.$_POST['img'].'", "'.$_POST['br'].'", "'.$_POST['r'].'");');
}

Database::disconnect();

?>