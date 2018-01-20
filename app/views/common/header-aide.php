 <!-- Cette classe est commune a toutes les vues de la aide soignante, afin de nous 
 eviter de recopier ce code au début de chaque vue de la aide soigante, on le met dans "head.php" et on inclura ce fichier au début de chacune de nos vues. -->


<?php
// require_once(__DIR__ .'/head.php');
require_once(__ROOT__ .'/app/views/common/head.php');
?>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">

  <a class="navbar-brand" href="#">Aide Soignante : <?php echo ucfirst($_SESSION['firstname'])." ".ucfirst($_SESSION['lastname']); ?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>



  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" href="/nursinghome/logout">Se déconnecter</a>
      </li>
     
    </ul>

  </div>
</nav>