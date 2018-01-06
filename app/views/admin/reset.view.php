<?php
    require_once(__ROOT__ .'/app/views/common/header-cadre.php');
?>

<?php $this->showErrors(); ?>

<div class="container h-100">

    <div class="row reset-row">

        <div class="col">

            <div class="alert alert-success none " id="alert-container">
                <h4 class="alert-heading" id="msg-container"></h4>
            </div>

            <form action="" method="post" id="formReset">
                <button type="submit" class="btn btn-dark btn-lg">Réinitialiser</button>
            </form>

        </div>

    </div>

</div>


<?php
    require_once(__ROOT__ .'/app/views/common/footer.php');
?>