<?php
require_once(__DIR__ .'/../common/header-cadre.php');
?>

<!-- <?php if (isset($this->data['errors'])) { ?>
    <div class="alert">
        <?php // echo $this->data['error'] ?>
        <?php var_dump($this->data['errors']) ?>
    </div>
<?php } ?> -->

<?php $this->showErrors(); ?>

<h1> Taches non faite </h1>


<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"> Prénom </th>
      <th scope="col"> Nom </th>
      <th scope="col"> Tâche </th> 
      <th scope="col"> Pièces </th>       
      <th scope="col"> Date Limite </th>
   </tr>
  </thead>
<tbody>

<?php 

if (isset($this->data['tasks']) && count($this->data['tasks']) > 0 ) {

    foreach($this->data['tasks'] as $task)
    {
    ?>
       
        <tr>
        <th scope="row"> <?= $task['lastname']; ?> </th>
        <td> <?= $task['firstname']; ?> </td>
        <td> <?= $task['name']; ?> </td>        
        <td>  <?= $task['id_room']; ?> </td>
        <td>  <?= $task['expirationdate']; ?> </td>
        </tr>
        
    <?php
    }
}
?>
