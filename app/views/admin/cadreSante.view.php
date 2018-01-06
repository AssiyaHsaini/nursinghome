<?php
  require_once(__ROOT__ .'/app/views/common/header-cadre.php');
?>

<div class="container wow fadeIn">

    <!-- <br>
    <br>
    <br>
    <br>
    <br> -->

    <div class="row head-row">

        <div class="col-sm-12">
            <div class="card-deck">

                <div class="card wow slideInLeft">
                    <div class="card-header">
                        Gestion des aides soignantes
                    </div>
                    <div class="card-body">
                        <!-- <h5 class="card-title">Liste des aides soignantes</h5> -->
                        <p class="card-text">Voir et ajouter des aides soignantes</p>
                        <a href="/nursinghome/admin/nursings" class="btn btn-dark btn-lg btn-right">Y aller</a>
                    </div>
                </div>

                <div class="card wow slideInLeft">
                    <div class="card-header">
                        Affectation des tâches
                    </div>
                    <div class="card-body">
                        <!-- <h5 class="card-title">Liste des tâches</h5> -->
                        <p class="card-text">Voir et ajouter les tâches aux aides soignantes</p>
                        <a href="/nursinghome/admin/tasks" class="btn btn-dark btn-lg btn-right">Y aller</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
	<!-- END ROW -->
	
	<br>

    <div class="row">

        <div class="col-sm-12">
            <div class="card-deck">

                <div class="card wow slideInLeft">
                    <div class="card-header">
                        Tâches non effectuées
                    </div>
                    <div class="card-body">
                        <!-- <h5 class="card-title">Liste des tâches non effectuées</h5> -->
                        <p class="card-text">Voir la liste des tâches non effectuées dans la durée impartie</p>
                        <a href="/nursinghome/admin/tasksNotDid" class="btn btn-dark btn-lg btn-right">Y aller</a>
                    </div>
                </div>

                <div class="card wow slideInLeft">
                    <div class="card-header">
                        Réinitialisation des tâches
                    </div>
                    <div class="card-body">
                        <!-- <h5 class="card-title">b</h5> -->
                        <p class="card-text">Permet la réinitialisation de toutes les tâches</p>
                        <a href="/nursinghome/admin/reset" class="btn btn-dark btn-lg btn-right">Y aller</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- END ROW -->

</div>
<!-- END CONTAINER -->

<?php
  require_once(__ROOT__ .'/app/views/common/footer.php');
?>