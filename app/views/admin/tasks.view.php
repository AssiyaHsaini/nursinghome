<?php
require_once(__DIR__ .'/../common/header.php');
?>

<?php if (isset($this->data['errors'])) { ?>
    <div class="alert">
        <?php // echo $this->data['error'] ?>
        <?php var_dump($this->data['errors']) ?>
    </div>
<?php } ?>

<h1> tasks  </h1>

<?php 

if (isset($this->data['nursingsw']) && count($this->data['nursingsw']) > 0 ) {


    foreach($this->data['nursingsw'] as $nurse)
    {
    ?>  
        <p><? echo " - " . $nurse['lastname'] . ": "  ?> </p>
    <?php

            foreach($this->data['tasks'][$nurse['id']] as $nursingTasks)
            {
                echo "--- " . $nursingTasks['name'] . "<br>"; 
                ?>
                <form action="" method="POST">
                <input type="hidden" name="postMethod" value="delete"> 
                <input type="hidden" name="personId" value="<? echo $nurse['id']  ;?>"> 
                <input type="hidden" name="taskId" value="<? echo $nursingTasks['id_task'];?>"> 
                 <input type="hidden" name="roomId" value="<? echo $nursingTasks['id_room'];?>">
                <input type="submit" value="Supprimer" />
                </form>
                <?php
            }  
    }
}
?> 



<h1>ajouter tâche</h1> 
       
       <form action="" method="POST">
       <p>

       <select name="personId" id="personId">
       <?php 
       
       foreach($this->data['nursings'] as $nurse)
       { 
       ?>
            <option value= "<?= $nurse['id'] ?>"> <? echo $nurse['firstname'] ." ". $nurse['lastname'] . " - " . $nurse['id'] ; ?> </option>
       <?php    
       }
       ?>
       </select>

       <select name="tasks" id="tasks">
       <?php foreach($this->data['allTasks'] as $tasks)
       { 
       ?>
            <option value= "<?= $tasks['id'] ?>"> <? echo $tasks['name'] . " - " . $tasks['id'] ; ?> </option>
       <?php    
       }
       ?>
       </select>

       <select name="rooms" id="rooms">

       <?php foreach($this->data['rooms'] as $rooms)
       { 
       ?>
            <option value= "<?= $rooms['id'] ?>">  <? echo $rooms['name'] . " - " . $rooms['id'] ; ?> </option>
       <?php    
       }
       ?>
       </select>

       <label for="date"> Date </label> : <input type="date" name="date" id="date" required/>



       <input type="hidden" name="postMethod" value="add">       
       <input type="submit" value="add" /> 
       </p>
       </form>

       
