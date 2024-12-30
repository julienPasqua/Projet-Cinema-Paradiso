<?php

require_once "autoload.php";
//require_once $_SERVER["DOCUMENT_ROOT"] . "/autoload.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Lien vers le fichier CSS local -->
    <link rel="stylesheet" href="style.css" />
    <!-- Lien vers la bibliothèque Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Lien vers Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Inclusion du fichier JavaScript -->
    <script src="index.js" defer></script>

    <title>Document</title>
  </head>

  <body>
  <header>
  <?php
if (isset($_SESSION["email"])) {
    ?>
    <div class="button-container">
        <a href="inscription.php" class="btn-primary">
            <i class="bi bi-person-plus"></i>
        </a>
        <a href="logout.php" class="btn-primary">
            <i class="bi bi-box-arrow-right"></i>
        </a>
        <span class="welcome-message">Bienvenue : <?= htmlspecialchars($_SESSION["nom"]); ?></span>
    </div>
    <?php
} else {
    ?>
    <div class="button-container">
        <a href="inscription.php" class="btn-primary">
            <i class="bi bi-person-plus"></i>
        </a>
        <a href="logout.php" class="btn-primary">
            <i class="bi bi-box-arrow-right"></i>
        </a>
    </div>
    <?php
}
?>


    <h1 id="maintitle">Cinema-Paradiso</h1>
    <button id="upcoming">Trending Series</button>
    <button id="popular">Trending Movies</button> 
    <input type="text" placeholder="Movies, Series" id="search" />
    <button id="btn"><i class='bx bx-search'></i></button>
</header>

     <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/UmzFk68Bwdk?si=11mEornK5QaDH5Q_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
    <div id="tag">
      <!-- <div class="tags">Action</div>
      <div class="tags">War</div>
      <div class="tags">Drama</div>
      <div class="tags">Comedy</div> -->
    </div>

    <!-- w3School js overlay fullscreen -->
    <div id="myNav" class="overlay">
      <!-- Button to close the overlay navigation -->
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
      <!-- Overlay content -->
      <div class="overlay-content" id="overlaycontent"></div>
        <a href="javascript:void(0)"  class="arrow left-arrow" id="left-arrow">&#8656;</a>
        <a href="javascript:void(0)"  class="arrow right-arrow" id="right-arrow">&#8658;</a>
    </div>

    <main id="main">
      <!-- Exemple de contenu de film -->
      <!-- <div class="movie">
        <img src="background.jpg" alt="movie-image" />
        <div class="movie-info">
          <h3>Movie Title</h3>
          <span class="green">9.8</span>
        </div>
        <div class="overview">
          <h3>Overview</h3>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium
          reiciendis recusandae dolor illum temporibus nihil eum blanditiis
          atque quaerat reprehenderit!
        </div>
      </div> -->

      <!-- Exemple de plusieurs films -->
      <!-- <div class="movie">
        <img src="./background.jpg" alt="movie-image" />
        <div class="movie-info">
          <h3>Movie Title</h3>
          <span class="green">9.8</span>
        </div>
        <div class="overview">
          <h3>Overview</h3>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium
          reiciendis recusandae dolor illum temporibus nihil eum blanditiis
          atque quaerat reprehenderit!
        </div>
      </div> -->
    </main>
  </body>
</html>
