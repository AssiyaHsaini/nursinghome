<!-- Cette vue propose un bouton à la cadre santé qui va lui permettre de supprimer toutes les affectations de tâches -->
<!-- Lorsque elle clique sur le bouton "réinitialiser" un message s'affiche de façon dynamique à l'aide d'un script javaScript qui se trouve dans main.js -->

<?php
    require_once(__ROOT__ .'/app/views/common/header-cadre.php');
?>

<?php $this->showErrors(); ?>

<div class="container h-100">

    <div class="row reset-row">

        <div class="col">

            <div class="alert alert-success none " id="alert-container">
              <!-- la balise h4 contiendra le message qui indique que les tâches ont bien été initialisées, ce message est généré dans main.js  -->
                <h4 class="alert-heading" id="msg-container"></h4>
            </div>

            <form action="" method="post" id="formReset">
                <button type="submit" class="btn btn-dark btn-lg">Réinitialiser</button>
            </form>

        </div>

    </div>

</div>


<?php
// on inclue le footer qui permet ici d'inclure les bibliotheque de bootstrap, et nos scripts javaScript dont main.js
 require_once(__ROOT__ .'/app/views/common/footer.php');
?>