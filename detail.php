<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="public/css/style.css">
  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet">
  <!-- SCRIPT -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="public/js/liste.js" type="text/javascript"></script>

  <title>Listing of tests done</title>
</head>
<body>

  <?php
    if ($_GET['v'] != 'confirm' ){
      header('Location: http://survey.mapir.net');
      exit();
    }
  ?>

  <header class="container-fluid blanc">
    <div class="entete">
      <img src="public/img/Vestas_logo.png"/>
      <span id="signMAPIR">by M<a href='mailto:mapir@vestas.com'>@</a>PiR</span>
    </div>
    <div class="trait"></div>
  </header>

  <section id="resultat-list" class="container-fluid blanc">
    <h2><?php echo $_GET['qui'] ?></h2>
    <ul class="container listing">
      <?php
        require 'public/php/database.php';

        $db = Database::connect();
        $tempo = $db->query('SELECT `question`, `img`, `bonneReponse`, `reponseChoisi` FROM `saves` WHERE `candidat`="'.$_GET['qui'].'"');
        Database::disconnect();

        $nbReponse = $nbBonneReponse = 0;
        while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
          $nbReponse +=1;
          $col0='col-9';
          $col1='col-3';
          $img='<img src="public/img/questions/'.$row['img'].'.png">';
          if ($row['img'] == "false"){
            $col0='col-12';
            $col1='';
            $img='';
          }
          $reponse ='';
          if ($row["bonneReponse"] == $row["reponseChoisi"]){
            $reponse = '<div class="listing-bonneReponse">'.$row["bonneReponse"].'</div>';
            $nbBonneReponse +=1;
          }else{
            $reponse ='<div class="listing-reponseDonnee">'.$row["reponseChoisi"].'</div><div class="listing-bonneReponse">'.$row["bonneReponse"].'</div>';
          }

          echo '<li class="listing-ligne row">
                  <div class="'.$col0.'">
                    <div class="listing-question">'.$row["question"].'</div>
                    '.$reponse.'
                  </div>
                  <div class="listing-img '.$col1.'">'.$img.'</div>
                </li>';
        }
      ?>
    </ul>
    <h2><?php echo round((($nbBonneReponse/$nbReponse)*100)) ?>% de bonne réponse !</h2>
  </section>

  <footer class="container-fluid">
    <div class="trait-reverse"></div>
    <ul class="footer-choix row">
      <li class="listeFooter"><a href="liste.php?v=confirm">Retour - Liste</a></li>
    </ul>
    <p class="footer-end">Entièrement codé par M@PiR</p>
  </footer>

</body>
</html>