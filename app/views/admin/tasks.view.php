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
       <th scope="col"> bouton</th> 
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





<!-- <h1>ajouter tâche</h1> 
</form>  
       <form action="" method="POST">
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
                <input type="text" name="email" id="email" class="form-control" id="inputAddress" placeholder="Email" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputState">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option selected>Choisir...</option>
                        <option value="1">aide soignante</option>
                    </select>
                </div>
                <input type="hidden" name="postMethod" value="create">   
                <!-- <input type="submit" value="Inscrire" />    -->
            <!-- <button type="submit" class="btn btn-primary">Inscrire</button> 
                
            </div>
  
       </form>     -->

       

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
                <label class="input-group-text" for="personId">Options</label>
                </div>
                </div>
                   
                <!-- <div class="input-group mb-3">
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
                <label class="input-group-text" for="personId">Options</label>
                </div>
                </div> -->
                    

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
                <label class="input-group-text" for="personId">Options</label>
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
               <label class="input-group-text" for="personId">Options</label>
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
               <label class="input-group-text" for="personId">Options</label>
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
                <label class="input-group-text" for="personId">Options</label>
                </div>
                </div>



                    <label for="date"> Date </label> : <input type="date" name="date" id="date" required/> 
                    <br>



                    <input type="hidden" name="postMethod" value="add">       
                    <input type="submit" value="Ajouter" />  
       
       </form>
       
      