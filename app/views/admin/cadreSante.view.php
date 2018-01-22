<!-- Cette vue est destinée à la cadre santé, elle lui propose 5 lien sdifferents:
    -Gestion des aides soignantes
    -Affectation des tâches
    -Tâches non effectuées
    -Réinitialisation des tâches
    -Création de tâche
    
Chacun de ces liens la redirige vers une autre vue
-->
<?php
// on inclue "header-cadre.php" qui est commun a toute les vues de la cadre sante
require_once(__ROOT__ .'/app/views/common/header-cadre.php');
?>

<div class="container wow fadeIn">


 <!-- première ligne  -->
    <div class="row head-row">

        <div class="col-sm-12">
            <div class="card-deck">

                <div class="card wow slideInLeft">
                    <div class="card-header">
                        Gestion des aides soignantes
                    </div>
                    <div class="card-body">
                        <p class="card-text">Voir et ajouter des aides soignantes</p>
                        <!-- premier lien: -->
                        <a href="/nursinghome/admin/nursings" class="btn btn-dark btn-lg btn-right">Y aller</a>
                    </div>
                </div>

                <div class="card wow slideInLeft">
                    <div class="card-header">
                        Affectation des tâches
                    </div>
                    <div class="card-body">
                        <p class="card-text">Voir et ajouter les tâches aux aides soignantes</p>
                        <!-- second lien -->
                        <a href="/nursinghome/admin/tasks" class="btn btn-dark btn-lg btn-right">Y aller</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- fin de la première ligne -->
	
	<br>

 <!-- deuxième ligne  -->
    <div class="row">

        <div class="col-sm-12">
            <div class="card-deck">

                <div class="card wow slideInLeft">
                    <div class="card-header">
                        Tâches non effectuées
                    </div>
                    <div class="card-body">
                        <p class="card-text">Voir la liste des tâches non effectuées dans la durée impartie</p>
                        <!-- troisième lien -->
                        <a href="/nursinghome/admin/tasksNotDid" class="btn btn-dark btn-lg btn-right">Y aller</a>
                    </div>
                </div>

                <div class="card wow slideInLeft">
                    <div class="card-header">
                        Réinitialisation des tâches
                    </div>
                    <div class="card-body">
                        <p class="card-text">Permet la réinitialisation de toutes les tâches</p>
                        <!-- quatrième lier -->
                        <a href="/nursinghome/admin/reset" class="btn btn-dark btn-lg btn-right">Y aller</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<!-- fin de la deuxieme ligne  -->

<br>

<!-- dernière ligne  -->
<div class="container">
<div class="row">

<div class="col-sm-12">
    <div class="card-deck">

        <div class="card wow slideInLeft">
            <div class="card-header">
                Création de tâches
            </div>
            <div class="card-body">
                <p class="card-text">Permet la création de nouvelles tâches</p>
                <!-- dernier lien -->
                <a href="/nursinghome/admin/createTasks" class="btn btn-dark btn-lg btn-right">Y aller</a>
            </div>
        </div>

    

    </div>
</div>
</div>


</div>

</div>



 

<?php
// on inclue le footer qui permet ici d'inclure les bibliotheque de bootstrap 
require_once(__ROOT__ .'/app/views/common/footer.php');
?>