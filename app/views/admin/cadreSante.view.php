<?php
// require_once(__DIR__ .'/../common/header-cadre.php');
require_once(__ROOT__ .'/app/views/common/header-cadre.php');
?>

<!--
<a href="/nursinghome/admin/nursings">Aide Soignantes</a> <br>
<a href="/nursinghome/admin/tasks">tâches</a> <br>
<a href="/nursinghome/admin/tasksNotDid">tâches non faite</a>
-->

<div class="container">

<br>

<div class="card">
  <div class="card-header">
    Les aides soignantes
  </div>
  <div class="card-body">
    <h5 class="card-title">Liste des aides soignantes</h5>
    <p class="card-text">Voir la liste des aides soignantes et ajouter des aides soignantes</p>
    <a href="/nursinghome/admin/nursings" class="btn btn-primary">Voir</a>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
    Les tâches
  </div>
  <div class="card-body">
    <h5 class="card-title">Liste des tâches</h5>
    <p class="card-text">Voir la liste des tâches affectées aux aides soignantes et ajouter des tâches</p>
    <a href="/nursinghome/admin/tasks" class="btn btn-primary">Voir</a>
  </div>
</div>
<br>

<div class="card">
  <div class="card-header">
    Les tâches non effectuées
  </div>
  <div class="card-body">
    <h5 class="card-title">Liste des tâches non effectuées</h5>
    <p class="card-text">Voir la liste des tâches non faite et le nom de l'aide soignante</p>
    <a href="/nursinghome/admin/tasksNotDid" class="btn btn-primary">Voir</a>
  </div>
</div>

<br>

<div class="card">
  <div class="card-header">
    Réinitialiser les tâches
  </div>
  <div class="card-body">
    <h5 class="card-title">b</h5>
    <p class="card-text">b</p>
    <a href="/nursinghome/admin/reset" class="btn btn-primary">Voir</a>
  </div>
</div>

</div>
