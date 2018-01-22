 <!-- Cette classe est commune a toutes les vues de la cadre sante, afin de nous 
 eviter de recopier ce code au début de chaque vue de la cadre sante, on le met dans "head.php" et on inclura ce fichier au début de chacune de nos vues. -->
 <!-- Elle represente une barre de navigation qui contient le nom et prenom de la cadre santé connecté, et different lien qui la mènera faire differentes actions-->

<?php
// require_once(__DIR__ .'/head.php');
require_once(__ROOT__ .'/app/views/common/head.php');

?>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">

<!-- nom et prenom de la cadre santé -->
  <a class="navbar-brand" href="#">Cadre santé: <?php echo ucfirst($_SESSION['firstname'])." ".ucfirst($_SESSION['lastname']); ?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-nav-scroll">
    <ul class="navbar-nav bd-navbar-nav flex-row">
        <li class="nav-item">
            <!-- lien qui la mène à la page d'accueil -->
            <a class="nav-link" href="/nursinghome/admin/">Accueil</a>
        </li>
        <li class="nav-item">
            <!-- lien qui la mène à la page de gestion des aides soignantes -->        
            <a class="nav-link" href="/nursinghome/admin/nursings">Aides soignantes</a>
        </li>
        <li class="nav-item">
            <!-- lien qui la mène à la page de gestion tâches -->        
        
            <a class="nav-link" href="/nursinghome/admin/tasks">Tâches</a>
        </li>
        <li class="nav-item">
            <!-- lien qui la mène à la page de listing des tâches non effectuées -->        
        
            <a class="nav-link" href="/nursinghome/admin/tasksNotDid">Tâches non effectuées</a>
        </li>
        <li class="nav-item">
            <!-- lien qui la mène à la page de réinitialisation des tâches -->        
        
            <a class="nav-link" href="/nursinghome/admin/reset">Réinitialisation des tâches</a>
        </li>
        <li class="nav-item">
            <!-- lien qui la mène à la page de création des tâches -->        
        
            <a class="nav-link" href="/nursinghome/admin/createTasks">Création de tâches</a>
        </li>
    </ul>
  </div>

  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
      <!-- lien pour se déconnecté -->
        <a class="nav-link" href="/nursinghome/logout">Se déconnecter</a>
      </li>
     
    </ul>

  </div>
</nav>