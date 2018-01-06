<?php
    require_once(__ROOT__ .'/app/views/common/header-cadre.php');
?>

<?php $this->showErrors(); ?>

<div class="container">

    <div class="alert alert-success alert-assiya none" role="alert">
        <h4 class="alert-heading" id="msg-container"></h4>
    </div>

    <form action="" method="post" id="formReset">
        <button type="submit" class="btn btn-dark btn-sm"> Réinitialisé </button>
    </form>
</div>



<?php
    require_once(__ROOT__ .'/app/views/common/footer.php');
?>