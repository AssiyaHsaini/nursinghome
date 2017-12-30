<?php
require_once(__DIR__ .'/../common/header.php');
?>

<?php if (isset($this->data['errors'])) { ?>
    <div class="alert">
        <?php // echo $this->data['error'] ?>
        <?php var_dump($this->data['errors']) ?>
    </div>
<?php } ?>

<h1> aide soignante  </h1>
<?php 
// var_dump($this->data['tasks']);

if (isset($this->data['tasks']) && count($this->data['tasks']) > 0 ) {

    foreach($this->data['tasks'] as $task)
    {
    ?>
        <p><? echo " - " . $task['name']; ?></p>

        <?php 
            if(!$task['did']) 
            { ?>
                <form action="" method="POST">
                <input type="hidden" name="personId" value="<? echo $_SESSION["id"] ;?>"> 
                <input type="hidden" name="taskId" value="<? echo $task['id_task'];?>"> 
                <input type="hidden" name="roomId" value="<? echo $task['id_room'];?>">
                <input type="submit" value="Valider" />
            <?php
            }
          
            else {
                echo "OK !";
            }
            ?>
    <?php
    }
}
?>
