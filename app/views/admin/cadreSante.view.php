<?php
require_once(__DIR__ .'/../common/header.php');
use App\QueriesController;
?>

<?php if (isset($this->data['errors'])) { ?>
    <div class="alert">
        <?php // echo $this->data['error'] ?>
        <?php var_dump($this->data['errors']) ?>
    </div>
<?php } ?>

<h1>cadre sante </h1>
<a href="/nursinghome/admin/nursings">Aide Soignantes</a> <br>
<a href="/nursinghome/admin/tasks">tâches</a> <br>
<a href="/nursinghome/admin/tasksNotDid">tâches non faite</a>