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
  <script src="public/js/exam.js" type="text/javascript"></script>

  <title>Survey for new Vestas employees</title>
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
    
    <section id="login" class="container-fluid blanc">
      <form id="log" method="POST" class="col-4" autocomplete="off">
        <div class="form-inline"><label for="log_name">Nom Prénom :</label><input type="text" class="form-control" name="log_name" id="log_name"></div>
        <div class="form-inline"><label for="log_code">Type exam :</label>
          <select name="log_code" id="log_code" class="form-control">
            <option value="AGENT">Agent</option>
            <option value="TECHNICIEN">Technicien</option>
          </select>
        </div>
        <div class="form-inline"><label for="log_area">Pour la Région :</label>
          <select name="log_area" id="log_area" class="form-control">
            <option value="">- Area -</option>
            <option value="ami">Amiens</option>
            <option value="arr">Arras</option>
            <option value="atl">Atlantique</option>
            <option value="bre">Bretagne</option>
            <option value="cen">Centre</option>
            <option value="cha">Champagne</option>
            <option value="lor">Lorraine</option>
            <option value="n-e">Nord-Est</option>
            <option value="rei">Reims</option>
            <option value="s-o">Sud Ouest</option>
            <option value="s-q">Saint quentin</option>
            <option value="vdr">Vallée du Rhone</option>
          </select>
        </div>
        <button type="submit" class="btn btn-colored">Go !</button>
      </form>
    </section>

    <section id="questionnaire" class="container-fluid blanc" style="display: none;">
      <form id="exam" method="POST">
        <div class="exam_question col-12"></div>
        <div class="exam_blocReponse row">
          <div class="exam_img col-md-6"></div>
          <div class="exam_listeReponses col-md-6">
          </div>
        </div>
        <div class="exam_suivant"><button type="submit" class="btn btn-colored">Suivant</button></div>
        <div class="exam_compteur"></div>
      </form>
    </section>

    <footer class="container-fluid">
      <div class="trait-reverse"></div>
      <ul class="footer-choix row">
        <li class="listeFooter"><span id="footer-detail_area">Détails Area</span></li>
        <li class="listeFooter"><a href="liste.php?v=confirm">Listing tests</a></li>
      </ul>
      <div id="footer-modal">
        <div id="footer-modal_description">
          <p>Voici les responsables des régions</p>
          <ul id="footer-modal_ul">
          <?php
            require 'public/php/database.php';
            
            $db = Database::connect();
            $tempo = $db->query('SELECT nomRegion, nom FROM regions ORDER BY nomRegion');
          
            while ($row = $tempo->fetch(PDO::FETCH_ASSOC)){
              echo '<li><span class="footer-modal_color">'.$row["nomRegion"].'</span> - '.$row["nom"].'</li>';
            }
            Database::disconnect();

          ?>
          </ul>
        </div>
      </div>
    </footer>

  </body>
</html>