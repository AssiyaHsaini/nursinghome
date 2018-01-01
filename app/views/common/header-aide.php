<?php
require_once(__DIR__ .'/../common/head.php');
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