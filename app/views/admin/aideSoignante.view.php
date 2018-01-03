<?php
require_once(__DIR__ .'/../common/header-aide.php');
?>

<?php 
// var_dump($this->data['tasks']);

?>
<div class="container center">
    <h1 class=""> Mes tâches </h1>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Service</th>
      <th scope="col">Pièce</th>
      <th scope="col">Type de Pièce</th>
      <th scope="col">Tâche</th>
      <th scope="col">Description</th>
      <th scope="col">Date limite</th>
      <th scope="col">Nombre de jours restants</th>
      <th scope="col">Etat</th>
      <th scope="col"></th>
      
    </tr>
  </thead>
  <tbody>
    <?php

        if (isset($this->data['tasks']) && count($this->data['tasks']) > 0 ) {

            foreach($this->data['tasks'] as $task)
            {
            ?>
                <tr>
                    <th scope="row"><?= $task['serviceName']; ?></th>
                    <td><?= $task['id_room']; ?></td>
                    <td><?= $task['typeName']; ?></td>
                    <td><?= $task['taskName']; ?></td>
                    <td><?= $task['taskDescription']; ?></td>
                    <td><?= $task['expirationdate']; ?></td>
                    <td>
                        <?php 
                            if ($task['days']==0)
                               echo  "<span class='badge badge-warning'>" . "1". "</span>";
                            else if ($task['days']>0)
                               echo  "<span class='badge badge-secondary'>" . $task['days'] . "</span>";
                            else if ($task['days']<0 && $task['did']==0) 
                                    echo  "--";
                            else if ($task['days']<0 && $task['did']==1) 
                               echo  "--";
                        ?>
                    </td>
                    
                    <td>
                    <?php 
                        if(!$task['did'] && $task['days']>=0)
                        { ?>
                            <form action="" method="POST">
                                <input type="hidden" name="personId" value="<? echo $_SESSION["id"] ;?>"> 
                                <input type="hidden" name="taskId" value="<? echo $task['id_task'];?>"> 
                                <input type="hidden" name="roomId" value="<? echo $task['id_room'];?>">
                                <button type="submit" class="btn btn-dark btn-sm">Valider</button>
                            </form>
                        <?php
                        }
                        else if(!$task['did'] && $task['days']<0)
                            echo  "<span class='badge badge-danger'>" . "Pôle emploie" . "</span>";
                        else 
                        {
                            echo "<span class='badge badge-success'>Validé</span>";
                        }
                        ?>
                    </td>
                </tr>
                
            <?php
            }
        }
        ?>

  </tbody>
</table>


<!-- <h1>Inscription</h1> 
       <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="lastname"> Nom </label>
                <input type="text" name="lastname" id="lastname"  class="form-control"  placeholder="Hsaini" required>
                </div>
                <div class="form-group col-md-6">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname"  class="form-control" placeholder="Assiya" required>
                </div>
                <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" id="inputAddress" placeholder="Email" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputState">Role</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choisir...</option>
                        <option value="1">aide soignante</option>
                    </select>
                </div>
                <input type="hidden" name="postMethod" value="create">   
                <input type="submit" value="Inscrire" />   
            </div>
  
            <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->
       </form>    -->



      