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

if (isset($this->data['tasks']) && count($this->data['tasks']) > 0 ) {

    foreach($this->data['tasks'] as $task)
    {
    ?>
        <p><? echo " - " . $task['name']; ?></p>
    <?php
    }
}
?>
