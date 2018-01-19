<?php
// require_once(__DIR__ .'/../common/header-cadre.php');
require_once(__ROOT__ .'/app/views/common/header-cadre.php');
?>

<?php $this->showErrors(); ?>

<h1> Les tâches </h1>

<?php 


if (isset($this->data['nursingsw']) && count($this->data['nursingsw']) > 0 ) {


    foreach($this->data['nursingsw'] as $nurse)
    {
    ?>  
       
       <table class="table">
       <thead class="thead-dark">
       <h1> <? echo " - " . $nurse['lastname'] . " " .$nurse['firstname'] . ": "  ?> </h1>
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

 
    foreach($this->data['tasks'][$nurse['id']] as $nursingTasks)
            {
               
                ?>
                <tr>
                    <th scope="row"> <?= $nursingTasks['name'] ?> 
                    <td> <?=  $nursingTasks['serviceName'] ?> </td>                                                                                     
                    <td> <?=  $nursingTasks['roomName'] ?> </td>
                    <td> <?=  $nursingTasks['description'] ?> </td>
                    <td> <?= $nursingTasks['expirationdate'] ?> </td>                   

                    <td>
                        <form action="" method="POST">
                        <input type="hidden" name="postMethod" value="delete"> 
                        <input type="hidden" name="personId" value="<? echo $nurse['id']  ;?>"> 
                        <input type="hidden" name="taskId" value="<? echo $nursingTasks['id_task'];?>"> 
                        <input type="hidden" name="roomId" value="<? echo $nursingTasks['id_room'];?>">
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



       <form action="" method="POST">
       <div class="input-group mb-3">
                <select name="personId" id="personId" class="custom-select">
                <?php 
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
                    <?php foreach($this->data['allTasks'] as $tasks)
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
                   
                   <select name="tasks" id="tasks" class="custom-select">
                   <?php foreach($this->data['rooms'] as $tasks)
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
                   
                   <select name="tasks" id="tasks" class="custom-select">
                   <?php foreach($this->data['rooms'] as $tasks)
                   { 
                   ?>
                           <option value= "<?= $tasks['id'] ?>"> <? echo $tasks['serviceName'] . " - " . $tasks['id'] ; ?> </option>
                   <?php    
                   }
                   ?>
                   </select>
                   <div class="input-group-append">
               <label class="input-group-text" for="personId">Service</label>
               </div>
               </div>

                <div class="input-group mb-3">

                    <select name="rooms" id="rooms" class="custom-select">

                    <?php foreach($this->data['rooms'] as $rooms)
                    { 
                    ?>
                            <option value= "<?= $rooms['id'] ?>">  <? echo $rooms['name'] . " - " . $rooms['id'] ; ?> </option>
                    <?php    
                    }
                    ?>
                    </select>
                    <div class="input-group-append">
                <label class="input-group-text" for="personId">Type Salle</label>
                </div>
                </div>



                    <label for="date"> Date </label> : <input type="date" name="date" id="date" required/> 
                    <br>



                    <input type="hidden" name="postMethod" value="add">       
                    <input type="submit" value="Ajouter" />  
                   
       
       </form>
       
      