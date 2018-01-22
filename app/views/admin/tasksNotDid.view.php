<!-- Cette vue permet à la cadre santé de voir la liste des tâches qui n'ont pas encore été effectuées -->

<?php
// on inclue "header-cadre.php" qui est commun a toute les vues de la cadre sante
require_once(__DIR__ .'/../common/header-cadre.php');
?>

<?php $this->showErrors(); ?>

<div class="container wow bounceInLeft">
    <div class="row head-row align-items-center">
        <h2>Tâches non réalisées</h2>
    </div>

    <div class="row">

<!-- nous allons afficher ces informations dans un tableau -->

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"> ID </th>
      <th scope="col"> Prénom </th>
      <th scope="col"> Nom </th>
      <th scope="col"> Tâche </th> 
      <th scope="col"> Pièces </th>       
      <th scope="col"> Date Limite </th>
   </tr>
  </thead>
<tbody>

<?php 
// on parcourt le tableau "data['tasks']", il contient les infos des tâches non effectuées
if (isset($this->data['tasks']) && count($this->data['tasks']) > 0 ) {

    foreach($this->data['tasks'] as $task)
    {
    ?>
       
        <tr>
        <th scope="row"> <?= $task['id_person']; ?> </th>
        <td> <?= $task['lastname']; ?> </td>
        <td> <?= $task['firstname']; ?> </td>
        <td> <?= $task['name']; ?> </td>        
        <td>  <?= $task['id_room']; ?> </td>
        <td>  <?= $task['expirationdate']; ?> </td>
        </tr>
        
    <?php
    }
}
?>
</div>


</div>

<?php
// on inclue le footer qui permet ici d'inclure les bibliotheque de bootstrap
require_once(__DIR__ .'/../common/footer.php');
?>