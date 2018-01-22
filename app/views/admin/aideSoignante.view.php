<!-- Seule et unique vue que posesède une aide soignante. Elle peux y voir tâches qui lui sont affectées. Elle a la possibilité de valider une tâche -->


<?php
// on inclue "header-aide.php" qui est commun a toute les vues des aides soignantes
require_once(__DIR__ .'/../common/header-aide.php');
?>


<!-- tableau qui affiche les differentes données concernant les tâches de l'aide soignante  -->

<div class="container center">
    <h1 class=""> Mes tâches </h1>
</div>
<table class="table">
  <thead class="thead-dark">

<!-- premiere ligne  du tableau -->
    <tr>
        <!-- differentes colonnes  -->
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

<!-- fin de la premiere ligne  -->
  </thead>
  <tbody>
    <?php
         // $this->data['tasks'] est la donnée qui est passé en paramètre lors de la création de la vue dans la classe AdminController  
        if (isset($this->data['tasks']) && count($this->data['tasks']) > 0 ) {


        
            foreach($this->data['tasks'] as $task)
            {

            ?>
                <tr> 
                    <!-- creation d'une nouvelle ligne a haque tour de boucle  -->
                    <th scope="row"><?= $task['serviceName']; ?></th> 
                    <td><?= $task['id_room']; ?></td>
                    <td><?= $task['typeName']; ?></td>
                    <td><?= $task['taskName']; ?></td>
                    <td><?= $task['taskDescription']; ?></td>
                    <td><?= $task['expirationdate']; ?></td>

                    <!-- le contenue de la colonne qui suit depend du nombre de jour restant pour effectuer la tâche -->
                    <td>
                        <?php 
                            // si le nombre de jour vaut 1, alors on affiche 1 dans la colonne "Nombre de jour restant" (s'il reste un jour la fonction getDaysExpiration() de la classe QueriesController retourne 0 car la difference entre la date actuelle et elle même vaut 0)
                            if ($task['days']==0)
                               echo  "<span class='badge badge-warning'>" . "1". "</span>";
                            
                            // s'il est positif, on affiche le nombre de jour restant 
                            else if ($task['days']>0)
                               echo  "<span class='badge badge-secondary'>" . $task['days'] . "</span>";
                            
                            // s'il est negatif, et que la tâche n'a pas été faite, on affiche "--" 
                            else if ($task['days']<0 && $task['did']==0) 
                                    echo  "--";
                            // s'il est negatif, et que la tâche a été faite, on affiche "--" 
                            
                            else if ($task['days']<0 && $task['did']==1) 
                               echo  "--";
                        ?>
                    </td>
                    
                    <!-- cette colonne va contenir un bouton ou un badge selon la situation -->
                    <td>
                    <?php 
                        // si did=0 (did vaut 0 lorsque la tâche n'est pas faite et 1 sinon) et que le nombre de jour restant pour effectuer la tâche est >0, alors on crée bouton pour que l'aide soignante puisse validé la tâche
                        if(!$task['did'] && $task['days']>=0)
                        { ?>
                        <!-- les données de ce formulaire vous nous servir a appeler la methode validerPostsAction() de AdminController, notamment lors de l'appel de getDaysExpiration() et validerTask() qui ont besoin des trois données suivantes -->
                            <form action="" method="POST">
                                <input type="hidden" name="personId" value="<? echo $_SESSION["id"] ;?>"> 
                                <input type="hidden" name="taskId" value="<? echo $task['id_task'];?>"> 
                                <input type="hidden" name="roomId" value="<? echo $task['id_room'];?>">
                                <button type="submit" class="btn btn-dark btn-sm">Valider</button>
                            </form>
                        <?php
                        }
                        //si did=0 et que le nombre de jour est positif, alors on affiche un badge rouge 
                        else if(!$task['did'] && $task['days']<0)
                        {  
                            echo  "<span class='badge badge-danger'>" . "Pôle emploie" . "</span>";
                        }

                        // sinon on affiche un badge vert
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



