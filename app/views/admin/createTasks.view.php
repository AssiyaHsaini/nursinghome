<!-- Cette vue propose à la cadre santé de créer des tâches. Pour cela elle lui donne un nom et une description -->
<?php
// on inclue "header-cadre.php" qui est commun a toute les vues de la cadre sante
require_once(__DIR__ .'/../common/header-cadre.php');
?>

<?php
// voir classe View.php 
$this->showErrors(); ?>


<br>

<div class="container">
<h2>Ajouter une tâche</h2>
<br>


  <form action="" method="POST" id="addTask">
  <div class="form-group">
      <label for="name">Nom de la tâche</label>
      <!-- champ pour qu'elle entre le nom -->
      <input type="text" class="form-control" name="name" id="name"> 
    </div>

  <div class="form-group">
      <label for="description">Description</label>
      <!-- champ pour qu'elle entre la description de la tâche  -->
      <textarea class="form-control" name="description" id="description" rows="3"></textarea>
    </div>
    <div class="alert alert-success none " id="alert-container">
                <h4 class="alert-heading" id="msg-container"></h4>
    </div>
    <!-- bouton pour lancer la création -->
    <input type="submit" value="Ajouter" />

  </form>
</div>
<?php
require_once(__DIR__ .'/../common/footer.php');
?>
