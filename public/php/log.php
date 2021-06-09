<?php

require 'database.php';
$db = Database::connect();

if (strtolower($_POST['accountForm_log']) == Database::$user && $_POST['accountForm_pass'] == Database::$pass )
{
  echo 'go';
}

Database::disconnect();

?>