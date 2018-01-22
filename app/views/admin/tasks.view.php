<!-- Cette vue propose à la cadre santé le listing des affectations des tâches de chaque aide soignante  -->
<!-- Elle lui propose également la possibilité d'affecter une tâche à une aide soignante ou de supprimer une affectation -->
<!-- Cette vue contient deux formulaires, un pour la supression et l'autre pour l'affectation de tâches -->
<?php
// on inclue "header-cadre.php" qui est commun a toute les vues de la cadre santé
require_once(__ROOT__ .'/app/views/common/header-cadre.php');
?>

<?php $this->showErrors(); ?>

<h1> Les tâches </h1>

<?php 

if (isset($this->data['nursingsw']) && count($this->data['nursingsw']) > 0 ) {

// parcourt de "data['nursingsw']" qui contient les noms des aides soignantes qui ont été affectées à des tâches
    foreach($this->data['nursingsw'] as $nurse)
    {

        
    ?>  
       <!-- création d'un tableau qui contiendra les informations citées. un tableau sera créé pour chaque aide soignante -->
       <table class="table">
       <thead class="thead-dark">
       <!-- on affichera pour chaque aide soignante ses affecations aux tâches -->
       <h1> <? echo " - " . $nurse['lastname'] . " " .$nurse['firstname'] . ": "  ?> </h1>
       <!-- premiere ligne du tableau -->
       <tr>
       <th scope="col"> Tâche </th>
       <th scope="col"> Nom service </th>              
       <th scope="col"> Nom salle </th>       
       <th scope="col"> Description </th>
       <th scope="col">Date limite </th>
       <th scope="col"> Supprimer</th> 
       </tr>
       </thead>
       <tbody>
    <?php

// parcourt de "data['tasks'][$nurse['id']]" qui contient les informations sur les tâches dont l'aide soignante $nurse (ligne 18) a été affecté
    foreach($this->data['tasks'][$nurse['id']] as $nursingTasks)
            {            
                ?>
                <!-- première ligne avec les differentes infromations -->
                <tr>
                    <th scope="row"> <?= $nursingTasks['taskName'] ?> 
                    <td> <?=  $nursingTasks['serviceName'] ?> </td>
                     <td> <?=  $nursingTasks['roomName'] ?> </td>
                    <td> <?=  $nursingTasks['description'] ?> </td>
                    <td> <?= $nursingTasks['expirationdate'] ?> </td>                   

                    <td>
                    <!-- premier formualaire qui permet de supprimer une affectation à une tâche -->
                        <form action="" method="POST">
                        <!-- toutes les informations de ce formulaire vont nous permettre de differencier les deux formulaires de notre page. Elles vont aussi nous permettre de récupérer les données nécéssaires pour appeler la méthode de AdminController pour la supression des tâches -->
                        <input type="hidden" name="postMethod" value="delete"> <!-- celle-ci va nous permettre de differencier nos deux formulaire en affectant "delete" à postMethod -->
                        <!-- les suivantes nous permettent de récuperer l'id de l'aide soignante, l'id de la tâche, de la salle, et du service. Ces données seront donné à la methode "deleteTask" de adminController -->
                        <input type="hidden" name="personId" value="<? echo $nursingTasks['id_person']  ;?>"> 
                        <input type="hidden" name="taskId" value="<? echo $nursingTasks['id_task'];?>"> 
                        <input type="hidden" name="roomId" value="<? echo $nursingTasks['id_room'];?>">
                        <input type="hidden" name="serviceId" value="<? echo $nursingTasks['id_service'];?>">                        
                        <input type="submit" value="Supprimer" />
                        </form>
                    </td>
                <tr>
                <?php
             
            }  
    }
}
?> 
 </tbody>
</table>




       

       <h1>Ajouter tâche</h1> 


        <!-- Second formulaire qui pemrmet d'affecter une tâche à une aide soignante -->
        <!-- Pour cela la cadre santé dans choisir le nom de l'aide soignante, la tâche,la date, la salle et le service. Notre formulaire lui propose un listing de toute ces informations -->
       <form action="" method="POST">
       <div class="input-group mb-3">
                <select name="personId" id="personId" class="custom-select">
                <?php 
                    // liste les aides soignates inscrites
                    foreach($this->data['nursings'] as $nurse)
                    { 
                    ?>
                            <option value= "<?= $nurse['id'] ?>"> <? echo $nurse['firstname'] ." ". $nurse['lastname'] . " - " . $nurse['id'] ; ?> </option>
                    <?php    
                    }
                ?>
                </select>
                <div class="input-group-append">
                <label class="input-group-text" for="personId">Nom</label>
                </div>
                </div>
                   

                    

                <div class="input-group mb-3">
                   
                    <select name="tasks" id="tasks" class="custom-select">
                    <?php 
                    // liste toutes les tâches existantes
                    foreach($this->data['allTasks'] as $tasks)
                    { 
                    ?>
                            <option value= "<?= $tasks['id'] ?>"> <? echo $tasks['name'] . " - " . $tasks['id'] ; ?> </option>
                    <?php    
                    }
                    ?>
                    </select>
                    <div class="input-group-append">
                <label class="input-group-text" for="personId">Tâche</label>
                </div>
                </div>

                <div class="input-group mb-3">
                   
                   <select name="roomName" id="tasks" class="custom-select">
                   <?php 
                    // liste toutes les salles existantes
                   
                   foreach($this->data['rooms'] as $tasks)
                   { 
                   ?>
                           <option value= "<?= $tasks['id'] ?>"> <? echo $tasks['roomName'] . " - " . $tasks['id'] ; ?> </option>
                   <?php    
                   }
                   ?>
                   </select>
                   <div class="input-group-append">
               <label class="input-group-text" for="personId">Salle</label>
               </div>
               </div>

               <div class="input-group mb-3">
                   
                   <select name="service" id="tasks" class="custom-select">
                   <?php 
                    // liste toutes les services existants
                   
                   foreach($this->data['service'] as $service)
                   { 
                   ?>
                           <option value= "<?= $service['id'] ?>"> <? echo $service['name'] . " - " . $service['id'] ; ?> </option>
                   <?php    
                   }
                   ?>
                   </select>
                   <div class="input-group-append">
               <label class="input-group-text" for="personId">Service</label>
               </div>
               </div>

                   <!-- lui permet de choisir une date  -->
                    <label for="date"> Date </label> : <input type="date" name="date" id="date" required/> 
                    <br>

                   <!-- on affecte la valeur "add" à postMethod pour le differencier du formulaire "delete" -->
                    <input type="hidden" name="postMethod" value="add">       
                    <input type="submit" value="Ajouter" />  
                   
       
       </form>
       
      