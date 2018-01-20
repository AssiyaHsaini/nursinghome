 <!-- Cette classe est commune a toutes les vues de la cadre sante, afin de nous 
 eviter de recopier ce code au début de chaque vue de la cadre sante, on le met dans "head.php" et on inclura ce fichier au début de chacune de nos vues. -->

<?php
// require_once(__DIR__ .'/head.php');
require_once(__ROOT__ .'/app/views/common/head.php');

?>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">

  <a class="navbar-brand" href="#">Cadre santé: <?php echo ucfirst($_SESSION['firstname'])." ".ucfirst($_SESSION['lastname']); ?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-nav-scroll">
    <ul class="navbar-nav bd-navbar-nav flex-row">
        <li class="nav-item">
            <a class="nav-link" href="/nursinghome/admin/">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/nursinghome/admin/nursings">Aides soignantes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/nursinghome/admin/tasks">Tâches</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/nursinghome/admin/tasksNotDid">Tâches non effectuées</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/nursinghome/admin/reset">Réinitialisation des tâches</a>
        </li>
    </ul>
  </div>

  <!-- <a class="nav-link" href="/nursinghome/admin/">Menu</a>  
  <a class="nav-link" href="/nursinghome/admin/nursings">Aides soignantes</a>
  <a class="nav-link" href="/nursinghome/admin/tasks">Tâches</a>
  <a class="nav-link" href="/nursinghome/admin/tasksNotDid">Tâches non effectuées</a> -->
  

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" href="/nursinghome/logout">Se déconnecter</a>
      </li>
     
    </ul>

  </div>
</nav>